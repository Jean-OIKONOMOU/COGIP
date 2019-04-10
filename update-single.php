<?php

require "config.php";
require "common.php";
if (isset($_POST['submit'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $user =[
      "id"        => $_POST['id'],
      "nom" => $_POST['nom'],
      "prenom"  => $_POST['prenom'],
      "phone"       => $_POST['phone'],
      "email"     => $_POST['email'],
      "societe"  => $_POST['societe'],
      "date"      => $_POST['date']
    ];

    $sql = "UPDATE users
            SET id = :id,
              nom = :nom,
              prenom = :prenom,
              phone = :phone,
              email = :email,
              societe = :societe,
              date = :date
            WHERE id = :id";

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

    $sql = "SELECT * FROM users WHERE id = :id";
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
          <td style="text-align:right;">
            <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?>:</label>
          </td>
          <td>
          <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'date' ? 'readonly' : null)?> <?php echo ($key === 'id' ? 'readonly' : null)?> <?php echo ($key === 'societe' ? 'readonly' : null)?> >
          </td>
        </form>
        </tr>
      <?php endforeach; ?>
  </tbody>
</table>

<button class="btn btn-warning" type="submit" name="submit" value="Submit" name="button">Valider les modifications</button>
</div>

<?php require "templates/footer.php"; ?>
