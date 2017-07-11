defmodule Bowling do
  @moduledoc false

  alias Bowling.Frame

  @spec score(List.t) :: Integer.t
  def score(points) do

    points
    |> Enum.map(&(Frame.cast_frame(&1)))
    |> add_bonus()
    |> Enum.reduce(0, &(Frame.frame_point(&1, &2)))

  end

  defp add_bonus(frames) do

    Enum.with_index(frames)
    |> Enum.map(fn({%Bowling.Frame{} = frame, index}) ->
     cond do
       Frame.strike?(frame) -> add_strike_bonus(frame, Enum.slice(frames, index + 1, 2))
       Frame.spare?(frame) -> frame
       true -> frame
     end
    end)
  end


  defp add_strike_bonus(frame, _) do
#    Bowling.Frame.set_bonus(frame, frame.second)
#    |> Bowling.Frame.set_bonus(frame.third)

    frame
  end

#  defp add_strike_bonus(frame, [h|t] = _frames) do
#     cond do
#       h.third > 0 ->
#        Bowling.Frame.set_bonus(acc, h.first)
#        |> Bowling.Frame.set_bonus(h.second)
#       true -> Bowling.Frame.set_bonus(acc, h.first)
#     end
#  end

end
