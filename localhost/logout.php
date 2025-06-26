<?php
session_start();
session_destroy();
header("Location: clearlogin.php");
exit;