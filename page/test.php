<!--
Map
- map[]
- hasPoint(Point):bool
- getWidth():int
- getHeight():int
caseIsAllowed(Point):bool

Point
- row
- column

Path
- points
- length():int
- contains(Point):bool
- addPoint(Point) -->

<?php

class Point
{
	protected $row;
	protected $column;

	public function __construct(int $row, int $column)
	{
		$this->row = $row;
		$this->column = $column;

		public function getRow(){
			return $this->row;
		}

		public function getColumn():int{
			return $this->column;
		}

	}
}

class Path
{
	protected $points;

	public function __construct()
	{
		$this->points = [];
	}

	public function getLength():int{
		return count($this->points);
	}

	public function contains(Point $point):bool{
		return in_array($point, $this->points);
	}
	public function addPoint(Point $point):void{
		$this->point[] = $point;
		//array_push($this->points, $point);
	}

	public function isAllowed(){
		
	}
}