<?php
session_start();
session_destroy();
header("Location: ../admin-access.php");
exit();
?>
