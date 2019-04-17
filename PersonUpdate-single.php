<?php

require "config.php";
require "common.php";
if (isset($_POST['submit'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "UPDATE people
            SET
              people_id = '".$_POST['people_id']."',
              people_nom = '".$_POST['people_nom']."',
              people_prenom = '".$_POST['people_prenom']."',
              people_email = '".$_POST['people_email']."',
              people_phone = '".$_POST['people_phone']."',
              societe_societe_id = '".$_POST['societe_societe_id']."'
            WHERE people_id = ".$_GET["id"].";";

  $statement = $connection->prepare($sql);
  $statement->execute($user);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
if (isset($_GET['id'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $id = $_GET['id'];

    $sql = "SELECT * FROM people WHERE people_id = :id";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
  echo "Something went wrong!";
  exit;
}
?>

<?php require "templates/header.php"; ?>

<h2 class="mb-5">Modification</h2>
<div class="table-responsive">
<table class="table">

  <tbody>
      <?php foreach ($user as $key => $value) : ?>
        <tr>

          <form method="post">

          <td class="text-left">
            <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?>:</label>
          </td>

          <td>
          <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo htmlspecialchars($value); ?>" <?php echo ($key === 'people_id' ? 'readonly' : null)?> <?php echo ($key === 'societe_societe_id' ? 'readonly' : null)?> >
          </td>

        </tr>
        <?php endforeach; ?>
        <tr>
          <td>
            <?php if (isset($_POST['submit']) && $statement) : ?>
              <?php echo "Mise à jour du profil > OK."; ?><?php endif; ?>
          </td>
        </tr>

  </tbody>
</table>

<button class="btn btn-warning" type="submit" name="submit" value="submit">Valider les modifications</button>
</form>
</div>
<?php require "templates/footer.php"; ?>
