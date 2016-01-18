<?php
require 'Includes/connections.php';
?>
<?php
session_start();

?>
<html lang="en">
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" type="text/css" href="Includes/css/bootstrap.css" media="screen" />
<link rel="stylesheet" type="text/css" href="Includes/css/stylesheet.css" media="screen" />
<title>TroveTraders.xyz | Home Page</title>
</head>

<!-- Top of page Navbar -->
   <?php include 'navbar.php'; ?>

      <br/>
         <br/>
            <br/>
               <br/>
                  <br/>
 <?php
$tradeIDGET = $_GET['tradeid'];

require 'Includes/connections.php';

$data2 = $con->query("SELECT * FROM trades WHERE tradeid = $tradeIDGET");
        while($tradeRows=mysqli_fetch_assoc($data2)) {

            $tradeTradeID = $tradeRows['tradeid'];
            $tradeItemID = $tradeRows['itemid'];
            $tradeDatetime = $tradeRows['datetime']; 
            $tradeUsername = $tradeRows['username'];
            $tradeFluxAmount = $tradeRows['currencyamount'];

            } 
$itemData = $con->query("SELECT * FROM items WHERE itemID = '$tradeItemID'");
        while($itemDataRow = mysqli_fetch_assoc($itemData)){
             $itemDataName = $itemDataRow['itemname'];
             $itemDataDesc = $itemDataRow['itemdesc'];
             $itemDataType = $itemDataRow['itemtype'];
             $itemDataReqLvl = $itemDataRow['itemrequiredlevel'];
             }
             
        ?>
		<!-- STARTING BOOTSTRAP DIV FOR TRADE WINDOW -->
<div class="container">

<div class="row">


<div class="col-lg-2 col-md-2 col-sm-6 col-xs-0"></div>
<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12" id="recenttradesbackground">
	<div clas="row">
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
				<img src="Images/Items/<?php echo $tradeItemID; ?>.png" id="recenttradesimage"/>
				
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
					<div clas="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<b id="recenttradeitemdataname">
									<?php echo $itemDataName; ?>
					</div>
						</div>
							<div clas="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										Seller: <?php echo $tradeUsername;?>            
										</b>
						</div>
					</div>
				</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">

					</div>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<b id="recenttradeitemprice">
					Selling for: <?php echo $tradeFluxAmount;?></b>
				</div>
		</div>
	</div>
</div>
<div class="col-lg-2 col-md-2 col-sm-6 col-xs-0"></div>
<br/><br/><br/><br/><br/><br/><br/><br/>
    <?php
    

$data = $con->query("SELECT * FROM traderesponses WHERE tradeid = $tradeIDGET ORDER BY commentdatetime");
while ($row=mysqli_fetch_assoc($data)) {
            $commentTradeID[] = $row['tradeid'];
            $commentID[] = $row['commentid'];
            $comment[] = $row['comment']; 
            $commentUserName[] = $row['commentername'];
            $commentDateTime[] = $row['commentdatetime'];

        }
        $i = 0;

?>



<div class="row">
<div class="col-lg-2 col-md-2 col-sm-6 col-xs-0"></div>
<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
	<div class="row">
<?php	while($i < count($comment)){ 
?>
 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id = "tradeoffercommentstitle">
 <?php echo "   " . $commentUserName[$i]; ?>
</div>
 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="tradeoffercommentsbackground">

 <?php 
 

 echo "   " . $comment[$i]; 

 

 ?>
 
 </div>
 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="tradeoffercommentsbottom">
 <?php 
 
if($_SESSION["username"] == $commentUserName[$i] or $_SESSION['admin'] == true){
?>
<a href="edit_comment.php?commentid=<?php echo $commentID[$i]; ?> ">
<?php
    echo "edit comment";

    ?>
    </a><?php
    echo " / ";
    ?>
<a href="delete_comment.php?commentid=<?php echo $commentID[$i]; ?> ">
<?php
    echo "delete comment";

    ?>
    </a>
<?php
}
    else{  }
    


 
 
 ?>

 	 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" class="col-lg-2 col-md-2 col-sm-6 col-xs-0"></div>
 </div>
 <?php
$i++;
} 
        //Make a Post! (Post Box and Submit Button)
     if(isset($_SESSION["username"])) {
 echo ' <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="submissionfieldbackground">
    <form action="" method="post" id="submissionfield">
        <input type="text" name="commenttext" placeholder="Post comment here" id="submissiontext"/><br/>
        <input type="submit" value="post" id="submissionform" name="postcomment">
    </form>
    </div>
    ';
    $tradeid = $_GET['tradeid'];
    $comment = $_POST['commenttext'];
    $commentername = $_SESSION['username'];
}

else { echo '<div id="submissionfieldbackgroundnotloggedin"><br/><br/>You need to log in before you can comment on this trade!</div>'; }
?>

    
    
    <?php if($_SESSION["username"] == $tradeUsername){
    
}
    else{  }


require 'Includes/connections.php';
    if(isset($_POST['postcomment'])) {
    $commentlen = strlen($comment);
        if($commentlen > 1){
         $commentInput = htmlspecialchars($comment, ENT_QUOTES);
        echo $commentlen;
        $sql = $con->query("INSERT INTO traderesponses (tradeid, comment, commentername, commentdatetime)Values('{$tradeid}', '{$commentInput}', '{$commentername}', NOW())");
        
        $page = 'http://trovetraders.xyz/trade_offer.php?tradeid=' . $_GET['tradeid'];
        header('Location: '.$page, true, 303);
        exit;
         }
         else echo "Your Comment is too short!";
         }
         
    ?>
   </div>
   </div>
    </div>
</body>