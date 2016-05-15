<?php
require 'Includes/connections.php';
?>
<?php
session_start();

?>
    <html lang="en">
<head>
    <!-- Css and page setup -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="Includes/css/bootstrap.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="Includes/css/stylesheet.css" media="screen" />
    <title>TroveTraders.xyz | Home Page</title>
</head>
<body>
<!-- Top of page Navbar -->
<?php include 'navbar.php'; ?>
<!-- Makes sure that theres plenty of space after the navbar -->
<br/>
<br/>
<br/>
<br/>
<br/>
<?php 

//Gets the trade idea from the URL and sets its to tradeIDGET
$tradeIDGET = $_GET['tradeid'];


$data = $con->query("SELECT * FROM trades WHERE tradeid = $tradeIDGET");
while($row = mysqli_fetch_assoc($data)){

    $tradeDateTime = $row['datetime'];
    $tradeUsername = $row['username'];
    $tradeClosed = $row['closed'];
}
echo $tradeClosed;


if($_SESSION["username"] == $tradeUsername){
    
if($tradeClosed == 1){ $closedBool = 0; echo "TRUE";}
else { $closedBool = 1; echo "FALSE";}
    $sql = $con->query("UPDATE trades SET closed = '$closedBool', datetime = NOW() WHERE tradeid = $tradeIDGET");


$page = 'http://trovetraders.xyz/trade_offer.php?tradeid=' . $_GET['tradeid'];
header('Location: '.$page, true, 303);
exit;


}
else{  }
?>
</body>
