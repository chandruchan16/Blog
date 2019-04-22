<html>
<head>
<meta charset="utf-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css"> 
<title> Register</title>
</head>
<body>

<?php 
  
  $username= $pass= $emailid= "";
  $usernameErr= $passErr= $emailidErr= "";
  $Errfound= false;
  
  if($_SERVER["REQUEST_METHOD"] == "POST" )
  {
    $username = $_POST["username"];
	if(empty($username))
	{  $usernameErr= " *Name is mandatory";
	    $Errfound= true;
	}
	else
		if(!preg_match('/^[a-zA-Z0-9]/', $username))
		{	$usernameErr= " *Only letters and numbers allowed";
	    $Errfound= true;
	}
	$emailid= $_POST["emailid"];
	if(empty($emailid))
	{   $emailidErr =" *Email is mandatory";
	    $Errfound = true;
	}
	else
		if (!filter_var($emailid, FILTER_VALIDATE_EMAIL)) 
	{
	$emailidErr = "Invalid email format";
	$Errfound = true;	
	}
    $pass= $_POST["pass"];
     if(empty($pass))
	{   $passErr= "*Password is mandatory";
        $Errfound = true;
    }
	else 
		if(!preg_match('/^[a-zA-Z0-9]/', $pass))
	
	{ $passErr= " *Only letters and numbers allowed";
	    $Errfound= true;
		 
  }	}
		$thispage = htmlspecialchars($_SERVER["PHP_SELF"])
?>
		
	 <div class="login-box">
    
        <h1>CREATE</h1>
<form action= "<?= $thispage ?>" method ="POST" >
<label>Username:</label>  <input type="text" id="username" name="username" placeholder="Enter name" value="<?= $username ?>"/>
<span><font color="red"><?=  $usernameErr; ?></font></span> <br> 
<label>Email id:</label>    <input type="email" id="emailid" name= "emailid" placeholder= "Enter email" value="<?= $emailid ?>"/>
<span><font color="red"> <?=  $emailidErr; ?></font></span><br>

<label>Password:</label>	<input type="password" id="pass" name="pass" placeholder= "Enter password" value="<?= $pass ?>"/>
<span><font color="red"> <?=  $passErr; ?></font></span><br>

<input type="submit" name="create" value="CREATE">
<label>Back to</label> <a href="Login.php">Login </a> <label>?</label>
</form>


<?php    

  if(!$Errfound  and $_SERVER["REQUEST_METHOD"] =="POST")
  {	  	
     $host = 'localhost';
	$user = 'root';
	$password= '';
	$db= 'mydb';

	$con= mysqli_connect($host,$user, $password,$db);
	
	$query = "insert into mytab (username,email,password) values ('$username', '$emailid','$pass')";
	$sql = "CREATE TABLE $username ( id INT(4) AUTO_INCREMENT, content VARCHAR(255), date TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP, primary key(id))";
	if(mysqli_query($con,$query) and mysqli_query($con, $sql))
	  echo "<p class='correct'>CREATED SUCCESSFULLY!!</p>";
	else
		echo "<p class='wrong'>Already existing username and Email</p>";
	
	

  }
  
?>	
</div>
</body>
</html>