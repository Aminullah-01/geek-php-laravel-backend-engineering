<?php
// Name of students
$studentName = "Muhammad Auwal";

// students score
$studentScore = 91;

// grading system
if($studentScore > 90 || $studentScore == 100){
    echo $studentName." got <b>A+</b> grade in all subjects";
}elseif($studentScore > 80 || $studentScore == 89){
    echo $studentName." got <b>A</b> grade in all subjects";
}elseif($studentScore > 70 || $studentScore == 79){
    echo $studentName." got <b>B</b> grade in all subjects";
}elseif($studentScore >60 || $studentScore == 69){
    echo $studentName." got <b>C</b> grade in all subjects";
}elseif($studentScore >50 || $studentScore == 59){
    echo $studentName." got <b>D</b> grade in all subjects";
}else{
    echo $studentName." got <b>D</b> grade in all subjects";
}

/*
switch($studentScore){
    case 90 || 1000:
        echo "A+";
        break;
    case 80:
        echo "A";
        break;
    default:
        echo "Invalid score";
        break;
}
        */









?>