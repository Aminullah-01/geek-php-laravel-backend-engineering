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

$car1 = new 