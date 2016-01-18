<?php
require 'Includes/connections.php';
?>
<?php
session_start();
unset($_SESSION['id']);
unset($_SESSION['username']);
session_unset();
session_destroy();
header('Location: index.php')
?>