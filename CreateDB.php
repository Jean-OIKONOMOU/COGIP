<?php
require "config.php";
try {
  $connection = new PDO("mysql:host=$host", $username, $password, $options);
  $sql = file_get_contents("data/COGIP.sql");
  $connection->exec($sql);

  echo "Base de données créée avec succès.";
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
 ?>
