<?php
include 'C:\web\Xampp\htdocs\MainFolder(1)\user-main\config\config.php';
session_unset();
session_destroy();
header("location: log-in.php");