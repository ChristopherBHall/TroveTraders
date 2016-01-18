
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
					<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Prices<span class="caret"></span></a>
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
			</ul>
			</div>
           <?php
    if(isset($_SESSION['id'])) { ?>
<div class="container-fluid">
	<div class="row">
	<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7"></div>

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