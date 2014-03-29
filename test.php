<?php
session_start();
include_once "auth/user.php";

print_r(authenticate('manimoon','nfdsnf'));
echo "\n";
login(0);
echo "\n";
print_r($_SESSION);
echo "\n";
logout();
echo "====\n";
print_r($_SESSION);
?>
