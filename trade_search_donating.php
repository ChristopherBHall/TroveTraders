<?php
require 'Includes/connections.php';
?>
<?php
session_start();

if(isset($_POST['post'])){

	$page = 'http://www.trovetraders.xyz/trade_search_donating.php?item=' . $_POST['itemNameAutoComplete'];
	header('Location: '.$page, true, 303);
	exit;
}





function humanTiming ($time)
{

    $time = time() - $time; // to get the time since that moment
    $time = ($time<1)? 1 : $time;
    $tokens = array (
 //       31536000 => 'year',
  //      2592000 => 'month',
   //     604800 => 'week',
   //     86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }

}
?>
<html lang="en">
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" type="text/css" href="Includes/css/bootstrap.css" media="screen" />
<link rel="stylesheet" type="text/css" href="Includes/css/stylesheet.css" media="screen" />
<title>TroveTraders.xyz | Trade Search Selling</title>
 
  


</head>
<body>
<!-- Top of page Navbar -->
   <?php include 'navbar.php'; ?>

      <br/>
         <br/>
            <br/>
               <br/>
                  <br/>
                  
                  
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
  <?php if(isset($_GET['item'])){ ?>
<div class="container">
<div class="row">
		<div class="col-lg-1 col-md-1 col-sm-4 col-xs-0"></div>
		<div class="col-lg-10 col-md-10 col-sm-8 col-xs-12" id="tradeoffercommentsbackground">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
					<br/>
							<form action="" method="post" id="formPost">
								Item : <input type="text" placeholder="Item Name" id="itemNameAutoComplete" class="ui-autocomplete-input" autocomplete="off" name="itemNameAutoComplete"/>
								<input type="submit" class="btn btn-info" name="post" value="post">
							</form> 
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
					<br/>
							Sort by: <a href="trade_search_donating.php?sort=price&item=<? echo $_GET['item']; ?>">Price</a> | <a href="trade_search_donating.php?sort=recent&item=<? echo $_GET['item']; ?>">Most Recently Bumped</a>
					</div>
				</div>
		</div>
		<div class="col-lg-1 col-md-1 col-sm-4 col-xs-0"></div>
</div>
<br />
<br/>

  <?php } else { ?>
<div class="container">
<div class="row">
		<div class="col-lg-1 col-md-1 col-sm-4 col-xs-0"></div>
		<div class="col-lg-10 col-md-10 col-sm-8 col-xs-12" id="tradeoffercommentsbackground">
				<div class="row">
					<div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
					<br/>
							<form action="" method="post" id="formPost">
								Item : <input type="text" placeholder="Item Name" id="itemNameAutoComplete" class="ui-autocomplete-input" autocomplete="off" name="itemNameAutoComplete"/>
								<input type="submit" class="btn btn-info" name="post" value="post">
							</form> 
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
</div>
				</div>
		</div>
		<div class="col-lg-1 col-md-1 col-sm-4 col-xs-0"></div>
</div>
<br />
<br/>

<?php 
		}
		if(isset($_GET['item'])) {
			if ($_GET['sort'] == "price") {
				$itemName = $_GET['item'];
				$itemsData = $con->query("SELECT * FROM items WHERE itemname = '$itemName'");
				while($itemRows=mysqli_fetch_assoc($itemsData)) {
					$itemName = $itemRows['itemname'];
					$itemDesc = $itemRows['itemdesc'];
					$itemType = $itemRows['itemtype'];
					$itemReqLvl = $itemRows['itemrequiredlevel'];
					$itemID = $itemRows['itemid'];
				}
				$data = $con->query("SELECT * FROM trades WHERE itemid = '$itemID' ORDER BY currencyamount");
				while($tradeRows=mysqli_fetch_assoc($data)) {

					$tradeTradeID[] = $tradeRows['tradeid'];
					$tradeItemID[] = $tradeRows['itemid'];
					$tradeDateTime[] = $tradeRows['datetime']; 
					$tradeUsername[] = $tradeRows['username'];
					$tradeFluxAmount[] = $tradeRows['currencyamount'];

				} 
			}

			elseif ($_GET['sort'] == "recent") {
				$itemName = $_GET['item'];
				$itemsData = $con->query("SELECT * FROM items WHERE itemname = '$itemName'");
				while($itemRows=mysqli_fetch_assoc($itemsData)) {
					$itemName = $itemRows['itemname'];
					$itemDesc = $itemRows['itemdesc'];
					$itemType = $itemRows['itemtype'];
					$itemReqLvl = $itemRows['itemrequiredlevel'];
					$itemID = $itemRows['itemid'];
				}
				$data = $con->query("SELECT * FROM trades WHERE itemid = '$itemID' ORDER BY datetime DESC");
				while($tradeRows=mysqli_fetch_assoc($data)) {

					$tradeTradeID[] = $tradeRows['tradeid'];
					$tradeItemID[] = $tradeRows['itemid'];
					$tradeDateTime[] = $tradeRows['datetime']; 
					$tradeUsername[] = $tradeRows['username'];
					$tradeFluxAmount[] = $tradeRows['currencyamount'];

				} 
			}
            // add other sorting options here
            
            

            else {            
				$itemName = $_GET['item'];
				$itemsData = $con->query("SELECT * FROM items WHERE itemname = '$itemName'");
				while($itemRows=mysqli_fetch_assoc($itemsData)) {
					$itemName = $itemRows['itemname'];
					$itemDesc = $itemRows['itemdesc'];
					$itemType = $itemRows['itemtype'];
					$itemReqLvl = $itemRows['itemrequiredlevel'];
					$itemID = $itemRows['itemid'];
				}
				$data = $con->query("SELECT * FROM trades WHERE itemid = '$itemID'");
				while($tradeRows=mysqli_fetch_assoc($data)) {

					$tradeTradeID[] = $tradeRows['tradeid'];
					$tradeItemID[] = $tradeRows['itemid'];
					$tradeDateTime[] = $tradeRows['datetime']; 
					$tradeUsername[] = $tradeRows['username'];
					$tradeFluxAmount[] = $tradeRows['currencyamount'];
					$tradeLookingToBuy[] = $tradeRows['lookingtobuy'];
					$tradeLookingToSell[] = $tradeRows['lookingtosell'];
					$tradeLookingToTrade[] = $tradeRows['lookingtotrade'];
					$tradeLookingToDonate[] = $tradeRows['lookingtodonate'];

				}
			}
		}
		
		else { }
		
		if(isset($_GET['item'])){
			if(count($tradeTradeID) > 0){
				for ($i = 0; $i < count($tradeTradeID); $i++){

					///////////////////////////////////////////////////////////////////////////////////////////
					// SETTING THE TIME VALUE HERE, ALLOWS US TO SEE WHEN THE POST WAS LAST "POSTED/UPDATED"///
					///////////////////////////////////////////////////////////////////////////////////////////
					$time = strtotime($tradeDateTime[$i]);
					$bumpTimeValue = humanTiming($time);
					if($bumpTimeValue > 24){
						$bumpDaysBeforeRemovingHours = $bumpTimeValue / 24;
						$bumpDays = (int)$bumpDaysBeforeRemovingHours;
						$bumpHours = $bumpTimeValue - (24 * $bumpDays);
					}
					//////////////////////////////////////////////////////////////////////////////////////////////
					/////////////////////////////////////////////////////////////////////////////////////////////
?>

<!-- Recent Trades -->
<?php if($tradeLookingToDonate[$i] == 1){ ?>
<div class="row">
<div class="col-lg-2 col-md-2 col-sm-6 col-xs-0"></div>
<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12" id="recenttradesbackground">

			<div clas="row">
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" id="no-padding">
            <img src="Images/Items/<?php echo $itemID; ?>.png" id="recenttradesimage"/>
				
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<b id="recenttradeitemdataname">
									<?php echo $itemName; ?>
					</div>


							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										Seller: <?php echo $tradeUsername[$i];?>            
										</b>
							</div>
					</div>
				</div>
					<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">

					</div>
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
									<div class ="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<?php echo '<b id="recenttradeitemprice">Last bumped ' . $bumpDays . ' days and ' . $bumpHours . ' hours ago</b>'; ?>  
												</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">         
												<b id="recenttradeitemprice">
													Selling for: <?php $formatedCurrency = number_format($tradeFluxAmount[$i]); echo $formatedCurrency;?></b>
													</div>
										<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"></div>
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" id="no-padding">
												 <a href="trade_offer.php?tradeid=<?php echo $tradeTradeID[$i]; ?>"><img src="Images/MakeOffer.png" id="recenttrademakeofferimage"/></a></div>

			</div>
		</div>
	</div>
</div>
</div>

<div class="col-lg-2 col-md-2 col-sm-6 col-xs-0"></div>
<br/>
    
    <?php 

	  } else { echo '<div id="tradeoffercommentsbackground"> Noone is donating this item currently! </div>'; break; }
				}
			}
			else { echo '<div id="tradeoffercommentsbackground"> Noone is donating this item currently! </div>'; }
		}

    ?>
</div> <!-- Container DIV closer -->
</body>
</html>