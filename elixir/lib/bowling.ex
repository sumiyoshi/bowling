defmodule Bowling do
  @moduledoc false

  alias Bowling.Frame

  def score(points) do

    points
    |> Enum.map(&(Frame.cast_frame(&1)))
    |> Enum.reduce(0, &(Frame.frame_point(&1, &2)))

  end



end
