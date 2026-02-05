<?php

class BankAccount{
    public $accountNumber;
    public $balance;

    public function __construct($accountNo, $actualBalance)
    {
        $this->accountNumber = $accountNo;
        $this->balance = $actualBalance;
    }

    public function deposit($amount)
    {
        $this->balance += $amount;
        return $this->balance;
    }
    public function withdrawal($amount)
    {
        if($amount > $this->balance){
            return "Insfuant balance";
        }
        else{
            $this->balance -= $amount;
            return "Balance: {$this->balance}";
        }
        
    }
    public static function index()
    {
        return "this static function";
    }
}

$user = new BankAccount(23276327623, 1000);
echo "Current Balance: {$user->balance}";
echo "<br>";
echo number_format($user->deposit(500), 2);
echo "<br>";
echo $user->withdrawal(500);

echo "<br>";
echo "<br>";


$user2 = new BankAccount(323232, 20000);
echo "Current Balance: {$user2->balance}";
echo "<br>";
echo $user2->deposit(500);
echo "<br>";
echo $user2->withdrawal(1700);
echo "<br>";
echo $user2->withdrawal(3000);

echo "<br>";
echo "<br>";

echo BankAccount::index();