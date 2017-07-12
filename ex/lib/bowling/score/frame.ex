defimpl Bowling.Score, for: Bowling.Frame do
  @moduledoc false

  @spec add_strike_bonus(Frame.t, List.t) :: Frame.t
  def add_spare_bonus(frame, []), do: frame

  def add_spare_bonus(frame, [h|_] = _frames) do
    set_bonus(frame, h.first)
  end

  @spec add_strike_bonus(Frame.t, List.t) :: Frame.t
  def add_strike_bonus(frame, []), do: frame

  def add_strike_bonus(frame, [h|t] = _frames) do
    set_bonus(frame, h.first)
    |> set_bonus(h.second)
    |> add_strike_bonus(t)
  end

  @spec set_bonus(Frame.t, Integer.t) :: Frame.t
  def set_bonus(%Bowling.Frame{} = frame, bonus) do
    case frame.bonus + bonus <= 20 do
      true -> %{frame | bonus: frame.bonus + bonus}
       _ -> frame
    end
  end

  @spec strike?(Frame.t) :: Boolean.t
  def strike?(%Bowling.Frame{} = frame), do: frame.first == 10

  @spec spare?(Frame.t) :: Boolean.t
  def spare?(%Bowling.Frame{} = frame), do: (frame.first + frame.second) == 10

  @spec frame_point(Frame.t, Integer.t) :: Integer.t
  def frame_point(%Bowling.Frame{} = frame, point) do
    point + frame.first + frame.second + frame.third + frame.bonus
  end
end

