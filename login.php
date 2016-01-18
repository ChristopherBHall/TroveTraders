<?php
require 'Includes/connections.php';
?>
<?php
        
        if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $result = $con->query("SELECT * FROM members WHERE username='$username'");
  
        $row = $result->fetch_array(MYSQLI_BOTH);
        
        if(password_verify($password, $row['password'])){
        
        session_start();
        
        $_SESSION['id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        if($row['admin'] == 1){
        $_SESSION['admin'] = true;
        }
        header('Location: index.php');
        }
        else {
            session_start();
            $_SESSION['logInFail'] = 'yes';
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
<title>TroveTraders.xyz | Sign In</title>
 
  


<!-- Top of page Navbar -->
   <?php include 'navbar.php'; ?>    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
<div class="container">
<div class="row">
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-0"></div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="signupbackground">  
    <table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form name="form1" method="post" action="login.php">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td colspan="3"><strong>Member Login </strong></td>
<?php
    if(isset($_SESSION['logInFail'])) {
        echo ('<font color = "red">The Username or Password is incorrect</font>');
    }
?>
</tr>
<tr>
<td width="78">Username</td>
<td width="6">:</td>
<td width="294"><input name="username" type="text" id="username"></td>
</tr>
<tr>
<td>Password</td>
<td>:</td>
<td><input name="password" type="password" id="password"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="login" value="login"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>
</div>
</div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-0"></div>
</div>
</div>

</body>
</html>