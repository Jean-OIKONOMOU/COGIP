<?php
    require "templates/header.php";
    require "config.php";
    require "common.php";

if (isset($_POST['submit'])) {
  try {
    $conn = new PDO($dsn, $username, $password, $options);
    // $societe =[
    //   "id"        => $_POST['id'],
    //   "nom" => $_POST['societyname'],
    //   "pays"  => $_POST['societycountry'],
    //   "tva"       => $_POST['tvanumber'],
    //   "types"     => $_POST['societytype']
    // ];

    $sql = "UPDATE societe
            SET societe_id = '".$_POST['societe_id']."',
              societe_nom = '".$_POST['societe_nom']."',
              societe_pays = '".$_POST['societe_pays']."',
              societe_tva = '".$_POST['societe_tva']."',
              societe_type = '".$_POST['societe_type']."'
            WHERE societe_id = ".$_GET["id"].";";

  $statement = $conn->prepare($sql);
  $statement->execute($societe);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
if (isset($_GET['id'])) {
  try {
    $conn = new PDO($dsn, $username, $password, $options);
    $id = $_GET['id'];

    $sql = "SELECT * FROM societe WHERE societe_id = :id";
    $statement = $conn->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $societe = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
  echo "Oups, cela n'a pas marché";
  exit;
}
?>

<h2 class="mb-5">Modification</h2>
<div class="table-responsive">
<table class="table">

  <tbody>
      <?php foreach ($societe as $key => $value) : ?>
        <tr>

          <form method="post">

          <td class="text-left">
            <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?>:</label>
          </td>

          <td>
          <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'societe_id' ? 'readonly' : null)?> <?php echo ($key === 'societe_type' ? 'readonly' : null)?> >
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
