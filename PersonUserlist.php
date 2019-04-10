<?php
require "config.php";
require "common.php";

try {

  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM users ORDER BY nom ASC";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();

} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>

<?php require "templates/header.php"; ?>

<h2 class="mb-5">Page ANNUAIRE</h2>
<div class="table-responsive">
<table class="table">

  <tbody>
  <?php foreach ($result as $row) : ?>
    <tr>
      <td><a title="Cliquez pour modifier." href="PersonUpdate-single.php?id=<?php echo escape($row["id"]);?>">Fiche de contact de <?php echo escape($row["prenom"]);?> <?php echo escape($row["nom"]); ?><i class="fas fa-pen"></i></a></td>
      <td><a title="Cliquez pour supprimer." href="PersonDelete.php?id=<?php echo escape($row["id"]); ?>"><i class="fas fa-trash-alt"></i></a></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
</div>

    <?php include "templates/footer.php"; ?>
