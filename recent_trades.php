<?php
require 'Includes/connections.php';
?>
<html lang="en">
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" type="text/css" href="Includes/css/bootstrap.css" media="screen" />
<link rel="stylesheet" type="text/css" href="Includes/css/stylesheet.css" media="screen" />
<title>TroveTraders.xyz | Homepage</title>



</head>
<body>

<div class="container-fluid">
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
 <?php

$data = $con->query("SELECT * FROM trades ORDER BY datetime DESC");
        while($row = mysqli_fetch_assoc($data)){
            $tradeTradeID[] = $row['tradeid'];
            $tradeItemID[] = $row['itemid'];
            $tradeDateTime[] = $row['datetime']; 
            $tradeUsername[] = $row['username'];
            $tradeFluxAmount[] = $row['currencyamount'];
			$tradeCurrencyAmount[] = $row['currencytype'];
			$tradeLookingToSell[] = $row['lookingtosell'];
			$tradeLookingToBuy[] = $row['lookingtobuy'];
			$tradeLookingToTrade[] = $row['lookingtotrade'];
			$tradeLookingToDonate[] = $row['lookingtodonate'];
			$tradeItemRarity[] = $row['itemrarity'];
			$tradeItemPrimaryStat[] = $row['itemprimarystat'];
			$tradeItemSecondaryStat[] = $row['itemsecondarystat'];
			$tradeItemThirdStat[] = $row['itemthirdstat'];
			$tradeItemFourthStat[] = $row['itemfourthstat'];
			$tradeRingLevel[] = $row['ringlevel'];
			$tradeItemAmount[] = $row['itemamount'];
			$tradeClosed[] = $row['closed'];
            }
$itemData = $con->query("SELECT * FROM items");
        while($itemDataRow = mysqli_fetch_assoc($itemData)){
             $itemDataItemID[] = $itemDataRow['itemid'];
             $itemDataName[] = $itemDataRow['itemname'];
             $itemDataDesc[] = $itemDataRow['itemdesc'];
             $itemDataType[] = $itemDataRow['itemtype'];
             $itemDataReqLvl[] = $itemDataRow['itemrequiredlevel'];
			 $itemDataItemRarity[] = $itemDataRow['itemrarity'];
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



<?php 



//Creates all of the rows of recent trades to 10 or the max amount of rows that are present below 10.

for ($i = 0; $i < 10; $i++){
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
//FIND THE ITEMS NAMES ACCORDING TO ITS ID IN THE ITEM TABLE/////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
for ($a = 0; $a < count($itemDataItemID); $a++){
    if($itemDataItemID[$a] == $tradeItemID[$i]){
    $orderedItemID[] = $itemDataItemID[$a];
    $orderedDataName[] = $itemDataName[$a];
    $orderedItemDesc[] = $itemDataDesc[$a];
    $orderedItemType[] = $itemDataType[$a];
    $orderedItemReqLvl[] = $itemDataReqLvl[$a];
	$orderedItemRarity[] = $itemDataItemRarity[$a];
    }


}

if($tradeItemID[$i] == "" || $tradeClosed[$i] == 1 || $bumpDays > 7){}
else{
?>


<div class="row">
<div class="col-lg-2 col-md-2 col-sm-6 col-xs-0"></div>
<?php if($orderedItemRarity[$i] == "Common"){ echo '<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12" id="recenttradesbackground">'; }
elseif($orderedItemRarity[$i] == "Uncommon"){ echo '<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12" id="recenttradesbackgrounduncommon">'; }
elseif($orderedItemRarity[$i] == "Rare"){ echo '<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12" id="recenttradesbackgroundrare">'; }
elseif($orderedItemRarity[$i] == "Epic"){ echo '<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12" id="recenttradesbackgroundepic">'; }
elseif($orderedItemRarity[$i] == "Legendary"){ echo '<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12" id="recenttradesbackgroundlegendary">'; }
elseif($orderedItemRarity[$i] == "Relic"){ echo '<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12" id="recenttradesbackgroundrelic">'; }
elseif($orderedItemRarity[$i] == "Resplendent"){ echo '<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12" id="recenttradesbackgroundresplendent">'; }
elseif($orderedItemRarity[$i] == "shadow"){ echo '<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12" id="recenttradesbackgroundshadow">'; }
elseif($orderedItemRarity[$i] == "radiant"){ echo '<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12" id="recenttradesbackgroundradiant">'; }
else{ echo '<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12" id="recenttradesbackground">'; } ?>

			<div clas="row">
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" id="no-padding">
            <img src="Images/Items/<?php echo $tradeItemID[$i]; ?>.png" id="recenttradesimage"/>
				
				</div>
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<?php if($tradeRingLevel[$i] >= 1){ 
									echo '<b id="recenttradeitemdataname">' . $itemDataItemRarity[$i] . "&nbsp;&nbsp;&nbsp;" . $orderedDataName[$i] . "&nbsp;Lvl: " .$tradeRingLevel[$i]; }
							  else { 
									if($tradeItemAmount[$i] > 1){ echo '<b id="recenttradeitemdataname">' ?><?php echo "&nbsp;&nbsp;&nbsp;" . $orderedDataName[$i] . " x" . $tradeItemAmount[$i];} 
										else  {echo '<b id="recenttradeitemdataname">' ?><?php echo "&nbsp;&nbsp;&nbsp;" . $orderedDataName[$i]; }
								}
									?>
					</div>


							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<?php if($tradeLookingToSell[$i] == 1){
										  $tradeType = "&nbsp;&nbsp;&nbsp;" . "Seller : ";
									  }elseif($tradeLookingToBuy[$i] == 1){
										  $tradeType = "&nbsp;&nbsp;&nbsp;" . "Buyer : ";
									  }elseif($tradeLookingToTrade[$i] == 1){
										  $tradeType = "&nbsp;&nbsp;&nbsp;" . "Trader : ";
									  }
									  elseif($tradeLookingToDonate[$i] == 1){
										  $tradeType = "&nbsp;&nbsp;&nbsp;" . "Giver : ";
									  } 
									  else { }
									  ?>
										 <?php echo $tradeType . $tradeUsername[$i]; ?>               
										</b><br/>
										<?php 
										if($tradeItemPrimaryStat[$i] == ""){} else {
										echo  '<b id="recenttradeitemdataname">' . "&nbsp;&nbsp;&nbsp;" . "Primary stat: " . $tradeItemPrimaryStat[$i] . '</b>';}
										echo '<br/>';
										if($tradeItemSecondaryStat[$i] == ""){} else {
										echo  '<b id="recenttradeitemdataname">' . "&nbsp;&nbsp;&nbsp;" . "Secondary stat: " . $tradeItemSecondaryStat[$i] . '</b>'; }
										if($tradeItemThirdStat[$i] == ""){} else {
										echo '<br/>';
										echo  '<b id="recenttradeitemdataname">' . "&nbsp;&nbsp;&nbsp;" . "Third stat: " . $tradeItemThirdStat[$i] . '</b>'; }
										echo '<br/>';
										if($tradeItemFourthStat[$i] == ""){} else {
										echo  '<b id="recenttradeitemdataname">' . "&nbsp;&nbsp;&nbsp;" . "Fourth stat: " . $tradeItemFourthStat[$i] . '</b>'; }

?>
							</div>
							
					</div>
				</div>
					<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">

					</div>
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
									<div class ="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<?php 
												if($bumpDays > 1 ){
													echo '<b id="recenttradeitemprice">Last bumped ' . $bumpDays . ' days and ' . $bumpHours . ' hours ago</b>'; 
												}
												elseif(($bumpDays < 1) && ($bumpHours > 1)){
													echo '<b id="recenttradeitemprice">Last bumped ' . $bumpHours . ' hours ago</b>';
												}
												elseif($bumpHours < 1){
													echo '<b id="recenttradeitemprice">Last bumped ' . $bumpTimeValue . ' ago</b>';
												}
												else { echo '<b id="recenttradeitemprice">Last bumped ' . $bumpTimeValue . ' ago</b>'; }
											
                                                ?>
												</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">         
												<b id="recenttradeitemprice">
																			<?php if($tradeLookingToSell[$i] == 1){
																					  $tradePriceText = "Selling for : ";
																				  }elseif($tradeLookingToBuy[$i] == 1){
																					  $tradePriceText = "Buying for : ";
																				  }elseif($tradeLookingToTrade[$i] == 1){
																					  $tradePriceText = "Trading for : ";
																				  }
																				  elseif($tradeLookingToDonate[$i] == 1){
																					  $tradePriceText = "Just giving it away for free!!";
																				  } 
																				  else { }
																		if($tradeLookingToDonate[$i] == 1){ echo $tradePriceText; }
																				  else {
                                                                            

													echo $tradePriceText; $formatedCurrency = number_format($tradeFluxAmount[$i]); echo $formatedCurrency . " " . $tradeCurrencyAmount[$i]; } ?></b>
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
}
}
 ?>
	</div>
<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!-- RightSideAdTroveTraders -->
	<ins class="adsbygoogle"
		 style="display:inline-block;width:300px;height:600px"
		 data-ad-client="ca-pub-8603240894201085"
		 data-ad-slot="1946738859"></ins>
	<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
	</script>
</div>
</div>
</body>
</html>