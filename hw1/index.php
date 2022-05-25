<?php


$name = "Faryal Gohar";
$creditHours = 16;
$gpa = 3.67;

var_dump(gettype($name));
echo("<br>");
var_dump(gettype($creditHours));
echo("<br>");
var_dump(gettype($gpa));
echo("<br>");
print("Welcome ". $name);
echo("<br>");
if($creditHours >= 12){
    print("FULL TIME STUDENT");
}else{
    print("PART TIME STUDENT");
}
echo "<br>";
print("Sever Info");


echo $_SERVER['PHP_SELF'];
echo "<br>";
echo $_SERVER['SERVER_NAME'];
echo "<br>";
echo $_SERVER['HTTP_HOST'];
echo "<br>";

echo "<br>";
echo $_SERVER['HTTP_USER_AGENT'];
echo "<br>";
echo $_SERVER['SCRIPT_NAME'];