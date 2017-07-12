defmodule Bowling.FrameTest do
  use ExUnit.Case

  test "cast_frame" do
    assert Bowling.Frame.cast_frame({1, 0}) == %Bowling.Frame{bonus: 0, first: 1, second: 0, third: 0}
    assert Bowling.Frame.cast_frame({1, 2, 3}) == %Bowling.Frame{bonus: 0, first: 1, second: 2, third: 3}
  end

  test "set_bonus" do
    assert Bowling.Score.set_bonus(%Bowling.Frame{}, 10) == %Bowling.Frame{bonus: 10, first: 0, second: 0, third: 0}
  end

  test "strike?" do
    assert Bowling.Score.strike?(%Bowling.Frame{first: 10}) == true
    assert Bowling.Score.strike?(%Bowling.Frame{first: 9}) == false
  end

  test "spare?" do
    assert Bowling.Score.spare?(%Bowling.Frame{first: 9, second: 1}) == true
    assert Bowling.Score.spare?(%Bowling.Frame{first: 9}) == false
  end

  test "frame_point" do
    assert Bowling.Score.frame_point(%Bowling.Frame{}, 0) == 0
    assert Bowling.Score.frame_point(%Bowling.Frame{first: 1, second: 2, third: 3, bonus: 4}, 0) == 10
  end
end
