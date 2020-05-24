<?php
setcookie("id", "", time() - 60*60*24*3, "/");
setcookie("hash", "", time() - 60*60*24*3, "/");
header("Location: /entry.php"); exit();
?>		