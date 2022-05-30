<?php

session_start();
unset($_SESSION);
header("Location:../html/index.php");
session_destroy();

?>