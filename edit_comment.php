<?php require 'Includes/connections.php';
session_start();

?>
<html lang="en">
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" type="text/css" href="Includes/css/bootstrap.css" media="screen" />
<link rel="stylesheet" type="text/css" href="Includes/css/stylesheet.css" media="screen" />
<title>TroveTraders.xyz | Edit Comment</title>
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

$data = $con->query("SELECT * FROM traderesponses WHERE commentid = $commentIDGET ORDER BY commentdatetime");
while ($row=mysqli_fetch_assoc($data)) {
            $commentTradeID = $row['tradeid'];
            $commentID = $row['commentid'];
            $comment = $row['comment']; 
            $commentUserName = $row['commentername'];
            $commentDateTime = $row['commentdatetime'];

        }


if($commentUserName == $_SESSION['username'] or $_SESSION['admin'] == true){

                if(isset($_SESSION["username"])) {
         echo ' 
<div class="container">
	<div class="row">
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" id="submissionfieldbackground">
            <form action="" method="post" id="submissionfield">
                <input type="text" name="commenttext" value=" ' . $comment . ' " id="submissiontext"/>
                <input type="submit" value="Save Changes to Comment" id="submissionform" name="postcomment">
            </form>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
	</div>
</div>
            ';
            $tradeid = $_GET['tradeid'];
            $updatedComment = $_POST['commenttext'];
            $commentername = $_SESSION['username'];
        }
        else { echo "log in"; }

            if(isset($_POST['postcomment'])) {
            $commentlen = strlen($updatedComment);
                if($commentlen > 1){

                $sql = $con->query("UPDATE traderesponses SET comment = '$updatedComment' WHERE commentid = $commentIDGET");
        
                $page = 'http://trovetraders.xyz/trade_offer.php?tradeid=' . $commentTradeID;
                header('Location: '.$page, true, 303);
                exit;
                 }
                 else echo "Your Comment is too short!";
                 }
         
        }
        else { echo " <div id='submissionfieldbackground'> This is not your comment... Nice try. If you got here by accident, let me know. I don't think thats likely though.. you just wanted to mess with someone elses comment. RUDE"; }
?>