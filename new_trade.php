<?php
require 'Includes/connections.php';
?>
<?php
session_start();

$result = $con->query("SELECT * FROM items");
$row = $result->fetch_array(MYSQLI_BOTH);
$itemNamesArray = $row['itemid'];
?>
<?php
if (isset($_POST['post'])) {
    $_SESSION['itemNameAutoComplete'] = $_POST['itemNameAutoComplete'];
    $itemSelected = $_POST['itemNameAutoComplete'];
}
else {
    $_POST['itemNameAutoComplete'] = 'test';
    $itemSelected = '';
}

if (isset($_POST['posttrade'])) {
    $_SESSION['itemprice'] = $_POST['itemprice'];
    $itemprice = $_POST['itemprice'];
}
else {
    $itemprice = '';
}
?>

<html lang="en">
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" type="text/css" href="Includes/css/bootstrap.css" media="screen" />
<link rel="stylesheet" type="text/css" href="Includes/css/stylesheet.css" media="screen" />
<title>TroveTraders.xyz | Homepage</title>


  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

        <script language="JavaScript" type="text/javascript">
            $(document).ready(function ($) {
                $("#itemNameAutoComplete").autocomplete({
                    source: 'itemnameautocomplete.php',
                    minLength: 1,

                });
            });
        </script>


</head>
<body>

  <!-- Top of page Navbar -->
   <?php include 'navbar.php'; ?>
   
   
        <br />
    <br />
        <br />

        <br />
<div class="container">
<div class="row">
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-0"></div>
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-0" id="newtradesbackground">
 <?php 
 if(isset($_SESSION["username"])) {
	if(!isset($_GET["radio"]) && !isset($_GET["donateRadio"])) {
	?>
<form>
    <input type='radio' name='radio' value='sell'/>Looking to sell?<br/>
    <input type='radio' name='radio' value='buy'/>Looking to buy?<br/>
    <input type='radio' name='radio' value='trade'/>Looking to trade?<br/>
    <input type='radio' name='radio' value='give'/>Looking to give the item away?<br/>
	<input method="post" type="submit" class="btn btn-info" value="post">
</form>

<?php } else { } }
else { echo 'You need to log in before you can make a trade!'; }

///////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////SELLING AN ITEM: RADIO CHOICE 1/////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////
 if(isset($_GET["radio"])) {
	 if($_GET['radio'] == 'sell'){
		 $radioString = "Input the name of the item you would like to sell, and select it from the drop down. ";
	 }
	 elseif($_GET['radio'] == 'buy'){
		 $radioString = "Input the name of the item you would like to buy, and select it from the drop down. ";
	 }
	 elseif($_GET['radio'] == 'trade'){
		 $radioString = "Input the name of the item you would like to trade, and select it from the drop down. ";
	 }
	 elseif($_GET['radio'] == 'give'){
		 $radioString = "Input the name of the item you would like to donate, and select it from the drop down. ";
	 }
	 else{ $radioString = "Something broke, was the URL modified?";}

 echo '
    <form action="" method="post" id="formPost">
	' . 
		$radioString . '<br/>
        Item : <input type="text" placeholder="Item Name" id="itemNameAutoComplete" class="ui-autocomplete-input" autocomplete="off" name="itemNameAutoComplete"/>
        <input type="submit" class="btn btn-info" name="post" value="post">
    </form>
    '; 
}


?>
</div>
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-0"></div>

<?php
if (isset($_POST['post']) && isset($_SESSION["username"])) {
    if ($data = $con->query("SELECT * FROM items WHERE itemname LIKE '%$itemSelected%'")) {
        while($row = mysqli_fetch_array($data)) {
            $itemID = htmlentities(stripslashes($row['itemid']));
            $itemName = htmlentities(stripslashes($row['itemname']));
            $itemDesc = htmlentities(stripslashes($row['itemdesc']));
            $itemType = htmlentities(stripslashes($row['itemtype']));
            $itemRecPrice = htmlentities(stripslashes($row['itemrecommendedpriceflux']));
            $itemImage = htmlentities(stripslashes($row['itemimage']));
            $itemReqLevel = htmlentities(stripslashes($row['itemrequiredlevel']));
            
            $_SESSION['itemID'] = $itemID;
            
                
        }
    }
} ?>
</div>
<?php
$con->close();
if(isset($_POST['post'])){
    if(strlen($itemSelected) > 1 && $itemSelected == $itemName){ 

		////////////////////////////////////////////////////////////////////////
		////////////////////////SELLING SECTION/////////////////////////////////
		////////////////////////////////////////////////////////////////////////
		if($_GET['radio'] == 'sell'){
			
					?>
												<div class="col-lg-4 col-md-4 col-sm-6 col-xs-0"></div></div>
											<div class="row">
											<div class="col-lg-3 col-md-3 col-sm-5 col-xs-0"></div>
											<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12" id="newtradesbackground"> <?php
								echo 'You have selected that you would like to sell a ' . $itemSelected . ' How much would you like to sell this item for?';
								echo '<br />';

                                                                                                                        ?>

											<div class="row">
											<br/>
											<div class="col-lg-6 col-md-6 col-sm-8 col-xs-6">
													<?php
								echo '<form action="" method="post" id="posttrade">';
								echo 'Sell for: <input name="itemprice" type="text" id="itemprice" style="color:black;">';
                                                    ?>
                                                
                                                    <select name="currencytype" style="color:black;">
                                                        <option value="Flux" style="color:black;">Flux</option>
                                                        <option value="Glim" style="color:black;">Glim</option>
														<!-- <option value="Chaos Chest" style="color:black;">Chaos Chest</option> -->
                                                    </select>
                                               
												</div>
													<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
													<div class="col-lg-3 col-md-3 col-sm-9 col-xs-6">
													<?php
								echo '<input type="submit" class="btn btn-info" name="posttrade" value="Post Trade">
													</form>';
			
													?> </div></div></div></div><?php
			}
		////////////////////////////////////////////////////////////////////////
		////////////////////////BUYING SECTION/////////////////////////////////
		////////////////////////////////////////////////////////////////////////
		elseif($_GET['radio'] == 'buy'){ ?>
										<div class="col-lg-4 col-md-4 col-sm-6 col-xs-0"></div></div>
						<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-5 col-xs-0"></div>
						<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12" id="newtradesbackground"> <?php
			echo 'You have selected that you would like to buy a ' . $itemSelected . ' How much would you like to buy this item for?';
			echo '<br />';
                                                                                                    ?>
						<div class="row">
						<br/>
						<div class="col-lg-6 col-md-6 col-sm-8 col-xs-6">
								<?php
			echo '<form action="" method="post" id="posttrade">';
			echo 'Buy for: <input name="itemprice" type="text" id="itemprice" style="color:black;">';
                                ?>	

							                        <select name="currencytype" style="color:black;">
                                                        <option value="Flux" style="color:black;">Flux</option>
                                                        <option value="Glim" style="color:black;">Glim</option>
														<!-- <option value="Chaos Chest" style="color:black;">Chaos Chest</option> -->
                                                    </select>

								</div>
								<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
								<div class="col-lg-3 col-md-3 col-sm-9 col-xs-6">
								<?php
			echo '<input type="submit" class="btn btn-info" name="posttrade" value="Post Trade">
								</form>';
			
                                ?> </div></div></div></div><?php
			}

		////////////////////////////////////////////////////////////////////////
		////////////////////////TRADING SECTION/////////////////////////////////
		////////////////////////////////////////////////////////////////////////
		elseif($_GET['radio'] == 'trade'){ ?>
										<div class="col-lg-4 col-md-4 col-sm-6 col-xs-0"></div>
						<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-5 col-xs-0"></div>
						<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12" id="newtradesbackground"> <?php
			echo 'You have selected that you would like to buy a ' . $itemSelected . ' How much would you like to buy this item for?';
			echo '<br />';
                                                                                                    ?>
						<div class="row">
						<br/>
						<div class="col-lg-6 col-md-6 col-sm-8 col-xs-6">
								<?php
			echo '<form action="" method="post" id="posttrade">';
			echo 'Buy for: <input name="itemprice" type="text" id="itemprice" style="color:black;">';
                                ?>	

							                        <select name="currencytype" style="color:black;">
                                                        <option value="Flux" style="color:black;">Flux</option>
                                                        <option value="Glim" style="color:black;">Glim</option>
														<!-- <option value="Chaos Chest" style="color:black;">Chaos Chest</option> -->
                                                    </select>

								</div>
								<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
								<div class="col-lg-3 col-md-3 col-sm-9 col-xs-6">
								<?php
			echo '<input type="submit" class="btn btn-info" name="posttrade" value="Post Trade">
								</form>';
			
                                ?> </div></div></div></div><?php
		}

		////////////////////////////////////////////////////////////////////////
		////////////////////////DONATE SECTION/////////////////////////////////
		///////////////////////////////////////////////////////////////////////
		elseif($_GET['radio'] == 'give'){ ?>
										<div class="col-lg-4 col-md-4 col-sm-6 col-xs-0"></div>
						<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-5 col-xs-0"></div>
						<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12" id="newtradesbackground"> <?php
			echo 'You have selected that you would like to give away a ' . $itemSelected;
			echo '<br />';
                                                                                                    ?>
						<div class="row">
						<br/>
						<div class="col-lg-6 col-md-6 col-sm-8 col-xs-6">
<form>
    <input type='radio' name='donateRadio' value='yes'/>Yes<br/>
    <input type='radio' name='donateRadio' value='no'/>No<br/>
		<input method="post" type="submit" class="btn btn-info" value="post">
</form>

								</div>
								<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
								<div class="col-lg-3 col-md-3 col-sm-9 col-xs-6">
</div></div></div></div><?php
		}
		}
						
    else{
	?>
	<div class="row">
<br/>
<div class="row">
<div class="col-lg-3 col-md-3 col-sm-5 col-xs-0"></div>
<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12" id="newtradesbackground">		<?php 
        echo "You didn't select anything! Make sure to select the item from the dropdown to create a trade!";

        
    }
}

                                                                                   ?>
<?php       
require 'Includes/connections.php';
    if(isset($_POST['posttrade']) or isset($_GET['donateRadio'])) {
            $fluxAmount = $_POST['itemprice'];
            if($fluxAmount > 1000000000){ ?>
			<div class="row">
<div class="col-lg-3 col-md-3 col-sm-5 col-xs-0"></div>
<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12" id="newtradesbackground"> 
               <?php echo $fluxAmount . " Thats a bit much.. dontcha think?"; ?></div> <?php
            }
            else if($fluxAmount < 1 && !isset($_GET['donateRadio'])) {
			?>
			<div class="row">
<div class="col-lg-3 col-md-3 col-sm-5 col-xs-0"></div>
<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12" id="newtradesbackground"> 
               <?php 
            echo "We have giveaways elsewhere on the site! Go donate the item there!"; ?> </div><?php
            }
            else {
                if(isset($_SESSION["username"])) {
                    $username = $_SESSION["username"];
                        if(isset($_SESSION['itemID'])) {
                            $itemID = $_SESSION['itemID'];
							if($_GET['radio'] == 'sell'){
								$lookingToSell = 1;
							}
							elseif($_GET['radio'] == 'buy'){
								$lookingToBuy = 1;
							}
							elseif($_GET['radio'] == 'trade'){
								$lookingToTrade = 1;
							}
							elseif($_GET['radio'] == 'give' or ($_GET['donateRadio']) == 'yes'){
								$lookingToDonate = 1;
							}
							else { 
							}
							$currencyType = $_POST['currencytype'];
							$sql = $con->query("INSERT INTO trades (username, datetime, itemid, currencyamount, currencytype, wanteditemid1, wanteditemid2, wanteditemid3, wanteditemid4, wanteditemid5, wanteditemid6, wanteditemid7, wanteditemid8, sellingitem1, sellingitem2, sellingitem3, sellingitem4, sellingitem5, sellingitem6, sellingitem7, sellingitem8, lookingtosell, lookingtobuy, lookingtotrade, lookingtodonate)Values('{$username}', NOW(), '{$itemID}', '{$fluxAmount}', '{$currencyType}', '{$wantedItemID1}', '{$wantedItemID2}', '{$wantedItemID3}', '{$wantedItemID4}', '{$wantedItemID5}', '{$wantedItemID6}', '{$wantedItemID7}', '{$wantedItemID8}', '{$sellingItemID1}', '{$sellingItemID2}', '{$sellingItemID3}', '{$sellingItemID4}', '{$sellingItemID5}', '{$sellingItemID6}', '{$sellingItemID7}', '{$sellingItemID8}', '{$lookingToSell}', '{$lookingToBuy}', '{$lookingToTrade}', '{$lookingToDonate}' )");
									?>	<div class="row">
<div class="col-lg-3 col-md-3 col-sm-5 col-xs-0"></div>
<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12" id="newtradesbackground"> <?php
                            echo "Your item has successfuly been added to the trades!"?> </div><?php
                            }
                            else { echo "Was an item not selected?"; }
                    }
                else { echo "Are you not logged in?"; }
    
            }
    
          
    }
                                                                                                 ?>
</div>
</div>
</div>
</div>
</div>
</div>


</body>
</html>