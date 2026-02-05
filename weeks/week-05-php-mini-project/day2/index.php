<?php

class Animal{
    protected $name;
    protected $age;

    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function eat()
    {
        return $this->name . " is eating";
    }

    public function getInformation()
    {
        return "{$this->name} is {$this->age} years old";
    }
}

class Dogs extends Animal{
    private $breed;

    public function __construct($name, $age, $breed)
    {
        parent::__construct($name, $age);
        $this->breed = $breed;
    }

    public function breed()
    {
        return $this->name . " is a " . $this->breed;
    }


}

class Cat extends Animal{
    private $color;

    public function __construct($name, $age, $color)
    {
        parent::__construct($name, $age);
        $this->color = $color;
    }

    public function color()
    {
        return $this->name . " is a " . $this->color;
    }
    public function eat()
    {
        return "{$this->name} is working eating on time ";
    }
}


$dog = new Dogs("Dog", 2, "Golden Retriever");
echo $dog->eat();
echo "<br>";
echo $dog->getInformation();
echo "<br>";
echo $dog->breed();

echo "<br>";
$cat = new Cat("Call cat", 2, "White");

echo $cat->eat();
echo "<br>";
echo $cat->getInformation();
echo "<br>";
echo $cat->color();


echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";

class Shape{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function calculateArea()
    {
        return "{$this->name} logic for calculate area not implemented";
    }
    public function getName()
    {
        return $this->name;
    }
}

class Rectangle extends Shape{
    private $width;
    private $hight;

    public function __construct($width, $height) {
        parent::__construct("Rectangle");

        $this->width = $width;
        $this->hight = $height;

    }

    public function calculateArea()
    {
        return $this->width * $this->hight;
    }
}

class Circle extends Shape{
    private $radius;

    public function __construct($radius) {
        parent::__construct("Circle");
        $this->radius = $radius;

    }

    public function calculateArea()
    {
        return $this->radius * $this->radius * 3.14159;
    }
}

class Triangle extends Shape{
    private $base;
    private $height;

    public function __construct($base, $height) {
        parent::__construct("Triangle");
        $this->base = $base;
        $this->height = $height;

    }
}

$shapes = [
    new Circle(20),
    new Rectangle(20, 40),
    new Triangle(10, 40)
];

foreach($shapes as $shape){
    echo "Area of " . $shape->getName() . " is " . $shape->calculateArea();
    echo "<br>";
}




// static class 

class Helper{
    public static $pi = 3.14159;
    public static function calculateArea($radius){
        return self::$pi * $radius * $radius;
    }

    public static function addTwo($a, $b)
    {
        return $a + $b;
    }

    public static function multiply($a, $b)
    {
        return $a + $b;
    }

}

echo Helper::calculateArea(10);
echo "<br>";
echo Helper::addTwo(10, 20);
echo "<br>";
echo Helper::multiply(10, 20);

echo "<br>";

echo Helper::$pi;