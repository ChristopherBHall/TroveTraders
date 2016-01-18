<?php require 'Includes/connections.php';
session_start();

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="stylesheet.css" media="screen" />
<title>TroveTraders.xyz | Home Page</title>
 
  


</head>
<body>
<!-- Top of page Navbar -->
   <?php include 'navbar.php'; ?>

      <br/>
         <br/>
            <br/>
               <br/>
                  <br/>
<?php

$commentIDGET = $_GET['commentid'];

$data = $con->query("SELECT * FROM traderesponses WHERE commentid = $commentIDGET");
while ($row=mysqli_fetch_assoc($data)) {
            $commentTradeID = $row['tradeid'];
            $commentID = $row['commentid'];
            $comment = $row['comment']; 
            $commentUserName = $row['commentername'];
            $commentDateTime = $row['commentdatetime'];

        }
        
            if($commentUserName == $_SESSION['username'] or $_SESSION['admin'] == true){
?>
<div id='submissionfieldbackground'>
<form action="" method="post">
    Are you sure?
    <input type="submit" name="yes" value="Yes" style="color:black;">
    <input type="submit" name="no" value="No" style="color:black;">
</form>
</div>
<?php 
}
 else {
 }
    if($commentUserName == $_SESSION['username'] or $_SESSION['admin'] == true){
                    if(isset($_POST['yes'])) {
                                $sql = $con->query("DELETE FROM traderesponses WHERE commentid = $commentIDGET");
        
                    $page = 'http://trovetraders.xyz/trade_offer.php?tradeid=' . $commentTradeID;
                    header('Location: '.$page, true, 303);
                    exit;
                     }
                     if(isset($_POST['no'])) {              
                    $page = 'http://trovetraders.xyz/trade_offer.php?tradeid=' . $commentTradeID;
                    header('Location: '.$page, true, 303);
                    exit; 
                    } 
         }
            
            
        else { echo " <div id='submissionfieldbackground'> This is not your comment... Nice try. If you got here by accident, let me know. I don't think thats likely though.. you just wanted to mess with someone elses comment. RUDE"; }

?>