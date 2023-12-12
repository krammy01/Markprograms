<?php
$int_var = 12345;
$another_int = -12345 + 12345;
$many = 2.2888800;
$many_2 = 2.2111200;
$few = $many + $many_2;
print("$many + $many_2 = $few<br>"); // Corrected the print statement
if (TRUE)
    print("This will always print<br>");
else
    print("This will never print<br>");

$true_num = 3 + 0.14159;
$true_str = "Tried and true"; // Added a semicolon at the end
$true_array[49] = "An array element";
$false_array = array();
$false_null = NULL;
$false_num = 999 - 999;
$false_str = "";
$string_1 = "This is a string in double quotes";
$string_2 = 'This is a somewhat longer, singly quoted string'; // Used single quotes
$string_39 = "This string has thirty-nine characters";
$string_0 = ""; // a string with zero characters

$variable = "name";
$literally = 'My $variable will not print!\\n';
print($literally);

$literally = "My $variable will print!\\n";
print($literally);
?>
