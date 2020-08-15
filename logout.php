<?php
//start session
session_start();

session_unset();//unset the data
session_destroy();//distroy the session

header("Location:index.php");
exit();