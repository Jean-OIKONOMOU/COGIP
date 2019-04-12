<?php include "templates/header.php"; ?>

  <?php

  require "config.php";
  require "common.php";

  if (isset($_POST['submit'])) {

  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $contact = array(
      "people_nom"     => $_POST['nom'],
      "people_prenom"  => $_POST['prenom'],
      "people_email"   => $_POST['email'],
      "people_phone"   => $_POST['phone'],
      "societe_societe_id"  => $_POST['societe']
    );

  $sql = sprintf(
      "INSERT INTO %s (%s) values (%s)",
      "people",
      implode(", ", array_keys($contact)),
      ":" . implode(", :", array_keys($contact))
  );

  $statement = $connection->prepare($sql);
  $statement->execute($contact);


  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }}

  try {

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT societe_id FROM societe";

    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();

  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }

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

    <select class="form-control" for="societe" name="societe" id="societe">
      <option value=""></option>
      <?php foreach ($result as $row) : ?>
      <option><?php echo escape($row["societe_id"]); ?></option>
        <?php endforeach;  ?>
    </select>

    	<button class="btn btn-primary my-3" type="submit" name="submit" value="submit">Envoyer</button>
      <?php if (isset($_POST['submit']) && $statement) { ?>
        <?php echo escape($_POST['nom']);?>Envoyé!<?php
        $reloadpage = $_SERVER['PHP_SELF']."#myForm";
        header("Location:$reloadpage");
        exit();?>
      <?php } ?>

</div>
    </form>
  
    <?php include "templates/footer.php"; ?>
