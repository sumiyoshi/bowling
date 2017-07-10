defmodule BowlingTest do
  use ExUnit.Case
  doctest Bowling

  test "all 1" do

    point = [
      {1,0},
      {1,0},
      {1,0},
      {1,0},
      {1,0},
      {1,0},
      {1,0},
      {1,0},
      {1,0},
      {1,0,0}
    ]

    assert Bowling.score(point) == 10
  end

  test "all 5" do

    point = [
      {5,0},
      {5,0},
      {5,0},
      {5,0},
      {5,0},
      {5,0},
      {5,0},
      {5,0},
      {5,0},
      {5,0,0}
    ]

    assert Bowling.score(point) == 50
  end


  test "all strike" do

    point = [
      {10,0},
      {10,0},
      {10,0},
      {10,0},
      {10,0},
      {10,0},
      {10,0},
      {10,0},
      {10,0},
      {10,10,10}
    ]

    assert Bowling.score(point) == 300
  end
end
