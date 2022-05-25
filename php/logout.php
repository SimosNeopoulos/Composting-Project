<?php

session_start();
unset($_SESSION);
header("Location:../html/homepage.html");
session_destroy();

?>