<?php

class Car{
    public $brand;
    public $color;
    public $speed;

    public function start()
    {
        return "Car is starting";
    }
    public function stop()
    {
        return "Car is stopping";
    }
}

$car1 = new Car();
$car1->brand = "Toyota";
$car1->color = "Red";
$car1->speed = 0;

echo $car1->start();
echo $cart->color;
