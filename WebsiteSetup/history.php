<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="mainPageStyle.css"/>
<body>
<ul>
  <li><a href="index.php">Home</a></li>
  <li><a href="about.php">About</a></li>
  <li><a href="contact.php">Contact</a></li>
  <li><a class="active" href="user.php">User</a></li>
  <div style="float:right" class="searchB">
    <li><a href="search.php">Search</a></li>
  </div>
</ul>
</body>
</html>

<h3>History</h3>

<table align = "left" border = "1" cellpadding = "3" cellspacing = "2">  
<tr>  
<td> Name </td>
<td> Time </td>
</tr>

<!--show user history-->

<?php

require_once "config.php";

$userid = $_SESSION["id"];
$s1 = "SELECT titleId,date FROM viewingHistory WHERE userId = '$userid' ORDER BY date DESC";
$r1 = mysqli_query($conn, $s1);
if (mysqli_num_rows($r1) > 0) {
	while($row1 = mysqli_fetch_assoc($r1)) {
    $movieid = $row1["titleId"];
    $s2 = "SELECT title FROM titleAkas WHERE titleId = '$movieid'";
    $r2 = mysqli_query($conn, $s2);
    if (mysqli_num_rows($r1) > 0) {
      $row2 = mysqli_fetch_assoc($r2);
		  echo "<tr>";
	    echo "<td><a href='info.php?movieid=$movieid'>" . $row2["title"] . "</a></td>";
	    echo "<td>" . $row1["date"] . "</td>";
      echo "</tr>";
    }
	}
}

?>