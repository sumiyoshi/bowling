defmodule Bowling.Frame do
  @moduledoc false

  defstruct first: 0, second: 0, third: 0, bonus: 0

  @type t :: %Bowling.Frame{first: Integer.t, second: Integer.t, third: Integer.t, bonus: Integer.t}

  @spec cast_frame(Taple.t) :: Frame.t
  def cast_frame({first, second, third}), do: %Bowling.Frame{first: first, second: second, third: third}
  def cast_frame({first, second}), do: %Bowling.Frame{first: first, second: second}
  def cast_frame(_), do: %Bowling.Frame{}
end
