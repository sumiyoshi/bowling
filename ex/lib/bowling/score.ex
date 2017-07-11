defprotocol Bowling.Score do
  @moduledoc false

  @spec add_spare_bonus(any, List.t) :: any
  def add_spare_bonus(frame, list)

  @spec add_strike_bonus(any, List.t) :: any
  def add_strike_bonus(frame, list)

  @spec set_bonus(any, Integer.t) :: any
  def set_bonus(frame, bonus)

  @spec frame_point(any, Integer.t) :: Integer.t
  def frame_point(frame, point)

  @spec strike?(any) :: Boolean.t
  def strike?(frame)

  @spec spare?(any) :: Boolean.t
  def spare?(frame)
end

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

  def set_bonus(frame, bonus), do: Bowling.Frame.set_bonus(frame, bonus)

  def frame_point(frame, point), do: Bowling.Frame.frame_point(frame, point)

  def strike?(frame), do: Bowling.Frame.strike?(frame)

  def spare?(frame), do: Bowling.Frame.spare?(frame)
end
