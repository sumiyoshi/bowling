defimpl Bowling.Score, for: Bowling.Frame do

  def add_spare_bonus(frame, []), do: frame

  def add_spare_bonus(frame, [h|_] = _frames) do
    set_bonus(frame, h.first)
  end

  def add_strike_bonus(frame, []), do: frame

  def add_strike_bonus(frame, [h|t] = _frames) do
    set_bonus(frame, h.first)
    |> set_bonus(h.second)
    |> add_strike_bonus(t)
  end

  @doc """

  iex> Bowling.Frame.set_bonus(%Bowling.Frame{}, 10)
  %Bowling.Frame{bonus: 10, first: 0, second: 0, third: 0}
  """
  @spec set_bonus(Frame.t, Integer.t) :: Frame.t
  def set_bonus(%Bowling.Frame{} = frame, bonus) do
    case frame.bonus + bonus <= 20 do
      true -> %{frame | bonus: frame.bonus + bonus}
       _ -> frame
    end
  end

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
  @spec spare?(Frame.t) :: Boolean.t
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
end

