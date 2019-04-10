<?php
/*
$servername = "localhost";
$username = "root";
$password = "bob99bob";
$dbname = "chat";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
   $db_host        = 'localhost';
   $db_user        = 'root';
   $db_pass        = 'bob99bob';
   $db_database    = 'chat';
   $db = @new mysqli ($db_host, $db_user, $db_pass, $db_database);
}*/

 $db = @new mysqli ("localhost", "root", "bob99bob", "chat");
if($db->connect_error) {
  exit("Database entry denied.");
}
?>
