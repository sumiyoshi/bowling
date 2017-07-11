defmodule Bowling.Frame do
  @moduledoc false

  defstruct first: 0, second: 0, third: 0, bonus: 0

  @doc """

  iex> Bowling.Frame.set_bonus(%Bowling.Frame{}, 10)
  %Bowling.Frame{bonus: 10, first: 0, second: 0, third: 0}
  """
  @spec set_bonus(Frame.t, Integer.t) :: Frame.t
  def set_bonus(%Bowling.Frame{} = frame, bonus), do: %{frame | bonus: frame.bonus + bonus}

  @doc """

  iex> Bowling.Frame.strike?(%Bowling.Frame{first: 10})
  true

  iex> Bowling.Frame.strike?(%Bowling.Frame{first: 9})
  false
  """
  @spec strike?(Frame.t) :: Boolean.t
  def strike?(%Bowling.Frame{} = frame), do: frame.first == 10

  @doc """

  iex> Bowling.Frame.spare?(%Bowling.Frame{first: 9, second: 1})
  true

  iex> Bowling.Frame.spare?(%Bowling.Frame{first: 9})
  false
  """
  def spare?(%Bowling.Frame{} = frame), do: (frame.first + frame.second) == 10

  @doc """

  iex> Bowling.Frame.frame_point(%Bowling.Frame{}, 0)
  0

  iex> Bowling.Frame.frame_point(%Bowling.Frame{first: 1, second: 2, third: 3, bonus: 4}, 0)
  10
  """
  @spec frame_point(Frame.t, Integer.t) :: Integer.t
  def frame_point(%Bowling.Frame{} = frame, point) do
    point + frame.first + frame.second + frame.third + frame.bonus
  end

  @doc """

  iex> Bowling.Frame.cast_frame({1, 0})
  %Bowling.Frame{bonus: 0, first: 1, second: 0, third: 0}

  iex> Bowling.Frame.cast_frame({1, 2, 3})
  %Bowling.Frame{bonus: 0, first: 1, second: 2, third: 3}
  """
  @spec cast_frame(Taple.t) :: Frame.t
  def cast_frame({first, second, third}), do: %Bowling.Frame{first: first, second: second, third: third}
  def cast_frame({first, second}), do: %Bowling.Frame{first: first, second: second}
  def cast_frame(_), do: %Bowling.Frame{}
end
