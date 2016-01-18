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
<title>TroveTraders.xyz | Sign Up</title>
 
  


</head>
    <body>
<!-- Top of page Navbar -->
   <?php include 'navbar.php'; ?>
        <br />
        <br />
        <br />


<div class="container">
<div class="row">
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-0"></div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="signupbackground">  
<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form name="form1" method="post" action="signup.php">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
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
<td>Verify Password</td>
<td>:</td>
<td><input name="passwordverify" type="password" id="passwordverify"></td>
</tr>
<td>Email</td>
<td>:</td>
<td><input name="email" type="text" id="email"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="register" value="register"></td>
</tr>
</table>
<?php       
 
    if(isset($_POST['register'])) {
    session_start();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordverify = $_POST['passwordverify'];
    $email = $_POST['email'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if($password == $passwordverify){
                    $storePassword = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));
                    $sql=$con->query("SELECT * FROM members WHERE username='$username'");
                         if(mysqli_num_rows($sql)>=1)
                           {
                            echo"<p style='color:red;'>name already exists</p>";
                           }
                         else
                            {
                         $sqlemailcheck=$con->query("SELECT * FROM members WHERE email='$email'");
                             if(mysqli_num_rows($sqlemailcheck)>=1){
                                 echo"<p style='color:red;'>email is already being used!</p>";
                                 }
                                 else
                                 {
                                   $sqlinsert = $con->query("INSERT INTO members (username, email, password)Values('{$username}', '{$email}', '{$storePassword}')");
                                    } 
                            }
                    }
                    else{ echo "<p style='color:red;'>Your passwords aren't the same!</p>";}
          }
          else{ echo "<p style='color:red;'>That is not a valid email address!</p>";}
    }
?>
</div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-0"></div>
</div>
</div>


</body>
</html>