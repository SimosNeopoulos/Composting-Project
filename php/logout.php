<?php

session_start();
unset($_SESSION);
header("Location:../html/homepage.php");
session_destroy();

?>