defmodule Bowling do
  @moduledoc false

  alias Bowling.Score

  @spec score(List.t, any) :: Integer.t
  def score(points, frame) do

    points
    |> Enum.map(&(frame.cast_frame(&1)))
    |> add_bonus()
    |> Enum.reduce(0, &(Score.frame_point(&1, &2)))

  end

  def add_bonus(frames) do
    Enum.with_index(frames)
    |> Enum.map(fn({frame, index}) ->
     cond do
       Score.strike?(frame) -> Score.add_strike_bonus(frame, Enum.slice(frames, index + 1, 2))
       Score.spare?(frame) -> Score.add_spare_bonus(frame, Enum.slice(frames, index + 1, 1))
       true -> frame
     end
    end)
  end

end
