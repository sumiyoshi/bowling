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
       Frame.spare?(frame) -> add_spare_bonus(frame, Enum.slice(frames, index + 1, 1))
       true -> frame
     end
    end)
  end

  @spec add_spare_bonus(Frame.t, List.t) :: Frame.t
  defp add_spare_bonus(frame, []), do: frame

  defp add_spare_bonus(%Bowling.Frame{} = frame, [h|_] = _frames) do
    Frame.set_bonus(frame, h.first)
  end

  @spec add_strike_bonus(Frame.t, List.t) :: Frame.t
  defp add_strike_bonus(frame, []), do: frame

  defp add_strike_bonus(frame, _frames) do
#     cond do
#       h.third > 0 ->
#        Bowling.Frame.set_bonus(acc, h.first)
#        |> Bowling.Frame.set_bonus(h.second)
#       true -> Bowling.Frame.set_bonus(acc, h.first)
#     end
    frame
  end

end
