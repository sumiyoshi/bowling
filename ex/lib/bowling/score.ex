defprotocol Bowling.Score do
  @moduledoc false

  def add_spare_bonus(frame, list)

  def add_strike_bonus(frame, list)

  def set_bonus(frame, bonus)

  def frame_point(frame, point)

  def strike?(frame)

  def spare?(frame)
end
