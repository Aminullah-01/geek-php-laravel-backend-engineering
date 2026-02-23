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
        $this->start += 10;
        return "Car is accelarating in {$this->speed} km/h";
    }
}

$car1 = new Car();
$car1->brand = "Toyota";
$car1->color = "Red";
$car1->speed = 0;

echo $car1->getColor();
