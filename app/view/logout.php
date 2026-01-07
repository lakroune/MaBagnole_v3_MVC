<?php

session_start();
session_unset();
session_abort();  //??
session_destroy();
header("Location: login.php");
exit();
