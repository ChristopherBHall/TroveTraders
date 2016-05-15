



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="Includes/css/bootstrap.css" media="screen" />
<link rel="stylesheet" type="text/css" href="Includes/css/stylesheet.css" media="screen" />


<nav class="navbar navbar-default navbar-fixed-top">
<div class="container-fluid">
				<div class="navbar-header">
					      <a class="navbar-brand" href="index.php">Trove Traders</a>
				</div>
				<div>
				 <ul class="nav navbar-nav">
					<li class="dropdown">
						 <a class="dropdown-toggle" data-toggle="dropdown" href="#">Trading<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="new_trade.php">New Trade</a></li>
							<li><a href="trade_search_selling.php">Search Selling</a></li>
							<li><a href="trade_search_buying.php">Search Buyers</a></li>
							<li><a href="trade_search_trading.php">Search Trading</a></li>
                            <li><a href="trade_search_donating.php">Search Giving</a></li>
                            <li><a href="trade_search.php">Search All</a></li>
						</ul>
					</li>

					 <!--					<li class="dropdown">
                                     <a class="dropdown-toggle" data-toggle="dropdown" href="#">other<span class="caret"></span></a>
                                         <ul class="dropdown-menu">
                                             <li><a href="#">....</a></li>
                                             <li><a href="#">....</a></li>
                                             <li><a href="#">....</a></li>
                                             <li><a href="#">....</a></li>
                                         </ul>
                                     </li>
                                     <li class="dropdown">
                                     <a class="dropdown-toggle" data-toggle="dropdown" href="#">other<span class="caret"></span></a>
                                         <ul class="dropdown-menu">
                                             <li><a href="#">....</a></li>
                                             <li><a href="#">....</a></li>
                                             <li><a href="#">....</a></li>
                                             <li><a href="#">....</a></li>
                                         </ul>
                                     </li>
                                 <li class="dropdown">
                                     <a class="dropdown-toggle" data-toggle="dropdown" href="#">other<span class="caret"></span></a>
                                         <ul class="dropdown-menu">
                                             <li><a href="#">....</a></li>
                                             <li><a href="#">....</a></li>
                                             <li><a href="#">....</a></li>
                                             <li><a href="#">....</a></li>
                                         </ul>
                                     </li> -->
					 <li class="dropdown">
						 <a class="dropdown-toggle" data-toggle="dropdown" href="#">My Stuff<span class="caret"></span></a>
						 <ul class="dropdown-menu">
							 <li><a href="./trade_personal.php">My Trades</a></li>
							 <li><a href="./trade_newcomments.php">New Comments</a></li>
							 <li><a href="#">Coming Soon!</a></li>
							 <li><a href="#">Coming Soon!</a></li>
						 </ul>
					 </li>
			</ul>
			</div>
           <?php
    if(isset($_SESSION['id'])) { ?>
<div class="container-fluid">
	<div class="row">
	<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7"></div>
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
		<?php
		require 'Includes/connections.php';
			$newCommentCheckerUsername = $_SESSION["username"];

		$data = $con->query("SELECT * FROM traderesponses WHERE commenttradeop = '$newCommentCheckerUsername'");
		while($row = mysqli_fetch_assoc($data)){

			$commentCheckerNew[] = $row['commentnew'];
			

		}
		$i = 0;
		while($i <= count($commentCheckerNew)){
			if($commentCheckerNew[$i] == 'FALSE'){ $i++; }
			elseif($commentCheckerNew[$i] == 'TRUE'){ echo "</br><p align='right'><a href='./trade_newcomments.php'> You have a new comment!</a></p>"; break; }
            else { break; }
		}
			
		?>
	</div>

		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" id="signedinbackground">
			Signed in as :<?php echo '<span style="color:yellow"> '. $_SESSION["username"] . ' </span>' ?> 
			
			<a href="logout.php">Sign Out</a>
			
		</div>
	</div>
</div>
 <?php
    }
    else { ?>
<a href="login.php"> <div id="signin">Sign In</div> </a> <a href="signup.php"> <div id="signup">Sign Up</div> </a> <?php 
    }
        ?>

</nav>