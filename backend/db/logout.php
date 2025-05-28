<?php
session_start();
session_destroy();
header("Location: ../../frontend/app/login.php");
exit();
?>
