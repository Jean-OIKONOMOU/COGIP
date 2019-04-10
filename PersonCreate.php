<?php include "templates/Header.php"; ?>

  <?php

  require "config.php";
  require "common.php";

  if (isset($_POST['submit'])) {

  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $contact = array(
      "nom" => $_POST['nom'],
      "prenom"  => $_POST['prenom'],
      "phone"       => $_POST['phone'],
      "email"     => $_POST['email'],
      "societe"  => $_POST['societe']
    );

  $sql = sprintf(
      "INSERT INTO %s (%s) values (%s)",
      "users",
      implode(", ", array_keys($contact)),
      ":" . implode(", :", array_keys($contact))
  );

  $statement = $connection->prepare($sql);
  $statement->execute($contact);
  // if ($statement === true) {
  //   echo "Registration successful. <br/>";
  // } else {
  //   echo "Registration failed. <br/>";
  // }
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }}


  ?>

<h3 class="my-4">Ajouter un contact.</h3>

<form method="post" id="myForm" action="<?php echo $_SERVER['PHP_SELF'];?>#myForm">
      <div class="form-group">
    	<label for="nom">Nom</label>
    	<input class="form-control" placeholder="Votre nom." maxlength="30" type="text" name="nom" id="nom">
      </div>

<div class="form-group">
    	<label for="prenom">Prénom</label>
    	<input class="form-control" placeholder="Votre prénom." maxlength="30" type="text" name="prenom" id="prenom">
      </div>

<div class="form-group">
    	<label for="phone">Phone</label>
    	<input class="form-control" placeholder="Votre numéro de téléphone." maxlength="12" type="text" name="phone" id="phone">
      </div>

<div class="form-group">
    	<label for="email">Email</label>
    	<input type="email" class="form-control" aria-describedby="emailHelp" maxlength="40" placeholder="Enter email" name="email" id="email">
        <small id="emailHelp" class="form-text text-muted">Ne pas compromettre les emails! <i class="fas fa-user-ninja"></i></small>
        </div>

        <div class="form-group">
    	<label for="societe">Société</label>

    <select class="form-control" name="societe" id="societe">
      <option>COGIP</option>
      <option>SILK ROAD</option>
      <option>PETROL INC</option>
    </select>
    	<button class="btn btn-primary my-3" type="submit" name="submit" value="submit">Submit</button>
      <?php if (isset($_POST['submit']) && $statement) { ?>
        <?php echo escape($_POST['nom']);?>successfully added. <?php
        $reloadpage = $_SERVER['PHP_SELF']."#myForm";
        header("Location:$reloadpage");
        exit();?>

      <?php } ?>
</div>

    </form>
    <form>



    <?php include "templates/Footer.php"; ?>
