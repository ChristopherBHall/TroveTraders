<?php
require 'Includes/connections.php';
?>
<?php
session_start();
if(isset($_SESSION["id"])){
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="stylesheet.css" media="screen" />
<title>TroveTraders.xyz | Home Page</title>
 
  


</head>
<body>
<!-- Top of page Navbar -->
   <?php include 'navbar.php'; ?>
    

        <br />
    <br />
        <br />
        <br />
      <img style="margin:0px auto;display:block"  src="Images/TradingBackground.png" />
              <br />
        <br />
        <?php include 'recent_trades.php'; ?>

</body>
</html>