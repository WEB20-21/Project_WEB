<!--Διαχείριση προφιλ-->
<?php

/*Σύνδεση με την σελίδα connect.php*/
include_once 'connect.php';
echo "Connected Successfully";
echo "<br>";

session_start();
$user = $_SESSION['user'];
echo "Welcome ".$user;
echo "<br>";


?>

<!DOCTYPE html>
<html>
  <head>
    <title>Profile Management</title>
  </head>
  <body>
  
  <!--Menu-->
  <a href='/logout-system.php'>Log out</a>
  <a href='/profile.management-system.php'>Profile management</a>
  <a href='/upload-system.php'>Upload</a>
  <a href='/home-system.php'>Home</a>
  
  <!--Αλλαγή στοιχείων-->
   <h1>Change Info</h1>
   <form action="?" method="post">
   <label>New Username</label>
   <input type="text" name="user" value="<?php $username ?>"> <br>
   
   <label>Old Password</label>
   <input type="password" name="oldpass" value="<?php $oldpass ?>"> <br>
   
    <label>New Password</label>
	<input type="password" name="pass" value="<?php $pass ?>"> <br>
	
	<label>Confirm New Password</label>
	<input type="password" name="conpass" value="<?php $conpass ?>"> <br>
	
	<input type="submit" name ="submit" value="Submit">
	<br>
	
	<h1>Statistics</h1>
	<?php
	
	$iduser=mysqli_query($conn,"SELECT iduserinfo FROM userinfo WHERE username='".$user."'" );
	$result=mysqli_fetch_array($iduser);
	$idu=$result['iduserinfo'];//pairnoume to id tou user
	
	$da=mysqli_query($conn,"SELECT date FROM harfiles WHERE iduserinfo='".$idu."' ORDER BY date DESC" );
	$result=mysqli_fetch_array($da);
	$date=$result['date'];//pairnoume to pio prosfato date
	echo "Ημερομηνία τελευταίου upload: ".$date;
	echo "<br>";

	$result=mysqli_query($conn,"SELECT * FROM harfiles WHERE iduserinfo='".$idu."'"); 
	$count=mysqli_num_rows($result);//pairnoume to plhthos twn eggrafwn pou ekane o xrhsths
	echo "Πλήθος εγγραφών που αναρτήθηκαν: ".$count;
		
	$result1=mysqli_query($conn,"SELECT * FROM entries INNER JOIN harfiles  ON entries.idharfiles=harfiles.idharfiles WHERE iduserinfo='".$idu."'"); 
	$count1=mysqli_num_rows($result1);//pairnoume to plhthos twn eggrafwn pou ekane o xrhsths
	echo ", στα οποία αντιστοιχούν: ".$count1." entries.";
	echo "<br>";
	
	?>
	
	<!--Έλεγχος ορθότητας του password-->
	<?php include 'profile.management-system-errors.php' ?>
	</body>
</html>