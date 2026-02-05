<?php

class Car{
    public $brand;
    public $color;
    public $speed;

    public function __construct($brand = "", $color = "")
    {
        $this->brand = $brand;
        $this->color = $color;

        echo "The car {$this->brand} is created  with color {$this->color}<br/>";
    }

    public function start()
    {
        return "The car is starting...";
    }

    public function accelerate()
    {
        $this->speed += 10;
        return "Speed increase to {$this->speed} km/h";
    }

    public function getInfo()
    {
        return "Brand: {$this->brand}, Color: {$this->color}, Speed: {$this->speed} km/h";
    }

    public function brake()
    {
        $this->speed -= 10;
        if($this->speed < 0){
            $this->speed = 0;
        }
        return "Speed decrease to {$this->speed} km/h";
    }
}


$car1 = new Car("Toyota", "Red");
$car1->brand = "Toyota";
$car1->color = "Red";
$car1->speed = 0;

echo $car1->getInfo();
$car2 = new Car;
$car2->brand = "Honda";
$car2->color = "Blue";
$car2->speed = 20;


echo $car1->start();
echo "<br/>";
echo $car1->accelerate();
echo "<br/>";
echo $car1->brake();
echo "<br/>";


echo $car2->start();
echo "<br/>";
echo $car2->accelerate();
echo "<br/>";
echo $car2->brake();
echo "<br/>";


