<?php

class Car{
    public $brand;
    public $color;
    public $speed;

    public function start()
    {
        return "Car is starting. color is :". $this->color;
    }
    public function stop()
    {
        return "Car is stopping";
    }

    public function getColor()
    {
        return $this->color;
    }
    public function accelarate()
    {
        $this->speed += 10;
        return "Car is accelarating in {$this->speed} km/h";
    }
    public function brake()
    {
        $this-
    }
}

$car1 = new Car();
$car1->brand = "Toyota";
$car1->color = "Red";
$car1->speed = 0;

echo $car1->getColor();
echo "<br/>";
echo $car1->accelarate();
echo "<br/>";
echo "<br/>";