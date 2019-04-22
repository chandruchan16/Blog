<?php
 
 session_start();
 
 
 $username= $_SESSION['username']; 


?>   

<?php 

$host = 'localhost';
	$user = 'root';
	$password= '';
	$db= 'mydb';
	
	
 $Errfound= false;
 $content="";
 if($_SERVER["REQUEST_METHOD"] == "POST")
 {
	 $content = $_POST["content"];
	 if(empty($content))
		 $Errfound = true;
 }
 $thispage = htmlspecialchars($_SERVER["PHP_SELF"])
 ?>
 


<html>
<head>
<meta charset="utf-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="style1.css" style="text/css">
<?php echo "<title> $username blog </title>" ?>

</head>
<body>

<div class="topnav">

<h3><?php echo "Welcome $username!" ?> </h3>
 <a href="Login.php" >Logout</a> 
</div>
<div class="main">
<div class="aside">
<form action="<?= $thispage ?>"  method="POST">

<label>Write content here:</label>
<br><br>
<textarea id="content" name="content" rows="20" cols="40"></textarea>  
<br><br> 
<input type="submit" value="POST">
</form>

<?php

if($_SERVER["REQUEST_METHOD"] =="POST"  and !$Errfound)
{  
	
	$con= mysqli_connect($host,$user, $password,$db);
	
	$sql= "insert into $username (content) values ('$content')";
	
if(mysqli_query($con, $sql))
	echo "Posted successfully";
}
?>
</div>
<div class="section">
<?php


$con= mysqli_connect($host,$user, $password,$db);
$sql= "SELECT * FROM $username ORDER BY id DESC";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($result))
{
	$content = $row['content'];
	$date = $row['date'];
	
	echo "<h3> $content </h3>"."<br>";
echo "<p> $date </p>";
echo "<hr>";
}
?>

</div>

</div>


</body>
</html>



  
