<?php
class User{
    private $name;
    private $email;
    private $age;

    public function __construct($name, $email, $age)
    {
        $this->name = $name;
        $this->setEmail($email);
        $this->setAge($age);
    }
    public function setEmail($email)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "Invalid email format";
        }else{
            $this->email = $email;
        }
    }
    public function setAge($age)
    {   
        if($age >= 18 && $age <= 100){
            $this->age = $age;
        }
        else{
            echo "Invalid age";
        }
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function getAge()
    {
        return $this->age;
    }
    public function getName()
    {
        return $this->name;
    }
    
}

$user = new User("Abubakar", "abk@gmail.com", 80);

echo $user->getEmail();
echo "<br>";
echo $user->getAge();
echo "<br>";
echo $user->getName();

echo $user->setEmail("abk@gmail.ng");
echo $user->setAge(100);

echo $user->getEmail();
echo "<br>";
echo $user->getAge();
echo "<br>";
echo $user->getName();