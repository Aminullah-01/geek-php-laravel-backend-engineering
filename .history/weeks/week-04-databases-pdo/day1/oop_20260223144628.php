<?php

class Car{
    public $brand;
    public $color;
    public $speed;

    public function __construct($name, $color, $speed)
    {
        $this->brand = 
    }

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
        $this->speed -= 10;
        if($this->speed < 0){
            $this->speed = 0;
        }
        return "Car is braking. current speed is {$this->speed} km/h";
    }
}

$car1 = new Car("Toyota", "Red", 0);


$car2 = new Car();
$car2->brand = "Homand";
$car2->color = "Green";
$car2->speed = 12;

echo $car1->getColor();
echo "<br/>";
echo $car1->accelarate();
echo "<br/>";
echo "<br/>";

echo $car1->brake();

echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";

echo $car2->getColor();
echo "<br/>";
echo $car2->accelarate();
echo "<br/>";
echo "<br/>";

echo $car2->brake();
echo "<br/>";

function addTwoNumbers($a, $b){
    return $a + $b;
}

echo addTwoNumbers(4, 8);
echo "<br/>";
echo addTwoNumbers(30, 2);