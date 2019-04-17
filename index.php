<?php

/**
  * List all users with a link to edit
  */

try {
  require "config.php";
  require "common.php";

  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM people";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();

  $sql = "SELECT * FROM societe";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result2 = $statement->fetchAll();

  $sql = "SELECT * FROM facture";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result3 = $statement->fetchAll();

} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}

?>
<?php require "templates/header.php"; ?>

<h2>Bienvenue</h2>

<div class="container">
  <div class="row my-5">
<div class="table-responsive">
  <h4 class="mb-3">Derniers Contacts:</h4>
<table>
  <thead>
    <tr>
      <th>#</th>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Société</th>
    </tr>
  </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
      <tr>
        <td class="px-3"><?php echo htmlspecialchars($row["people_id"]); ?></td>
        <td class="px-3"><?php echo htmlspecialchars($row["people_nom"]); ?></td>
        <td class="px-3"><?php echo htmlspecialchars($row["people_prenom"]); ?></td>
        <td class="px-3"><?php echo htmlspecialchars($row["people_email"]); ?></td>
        <td class="px-3"><?php echo htmlspecialchars($row["people_phone"]); ?></td>
        <td class="px-3"><?php echo htmlspecialchars($row["societe_societe_id"]); ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
  </div>

  <div class="row my-5">
<div class="table-responsive">
    <h4 class="mb-3">Dernières Sociétés:</h4>
<table>
  <thead>
    <tr>
      <th>#</th>
      <th>Nom</th>
      <th>Pays</th>
      <th>TVA</th>
      <th>Type</th>
    </tr>
  </thead>
    <tbody>
    <?php foreach ($result2 as $row) : ?>
      <tr>
        <td class="px-3"><?php echo htmlspecialchars($row["societe_id"]); ?></td>
        <td class="px-3"><?php echo htmlspecialchars($row["societe_nom"]); ?></td>
        <td class="px-3"><?php echo htmlspecialchars($row["societe_pays"]); ?></td>
        <td class="px-3"><?php echo htmlspecialchars($row["societe_tva"]); ?></td>
        <td class="px-3"><?php echo htmlspecialchars($row["societe_type"]); ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
  </div>

  <div class="row my-5">
<div class="table-responsive">
    <h4 class="mb-3">Dernières Sociétés:</h4>
<table>
  <thead>
    <tr>
      <th>#</th>
      <th>Numéro de facture</th>
      <th>Émission</th>
      <th>Prestation</th>
      <th>Encodage</th>
    </tr>
  </thead>
    <tbody>
    <?php foreach ($result3 as $row) : ?>
      <tr>
        <td class="px-3"><?php echo htmlspecialchars($row["facture_id"]); ?></td>
        <td class="px-3"><?php echo htmlspecialchars($row["facture_numero"]); ?></td>
        <td class="px-3"><?php echo htmlspecialchars($row["facture_date"]); ?></td>
        <td class="px-3"><?php echo htmlspecialchars($row["facture_prestation_date"]); ?></td>
        <td class="px-3"><?php echo htmlspecialchars($row["facture_insertion_date"]); ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
  </div>

</div>
<?php require "templates/footer.php"; ?>
