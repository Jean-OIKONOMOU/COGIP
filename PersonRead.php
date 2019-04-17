
<?php
require "config.php";
require "common.php";
if (isset($_POST['submit'])) {
  try {

    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT * FROM people WHERE people_nom = :nom";
    $nom = $_POST['nom'];
    $statement = $connection->prepare($sql);
    $statement->bindParam(':nom', $nom, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
} ?>

<?php include "templates/header.php"; ?>


    <h2>Qui cherchez-vous?</h2>
        <form method="post" >
    <div class="form-group">
    	<label for="nom"></label>
    	<input class="form-control" placeholder="Son nom." type="text" id="nom" name="nom">
    	<input class="form-control col-12 col-md-12 col-lg-6 my-5" type="submit" name="submit" value="Shazam!">
    </form>
    </div>

    <?php
    if (isset($_POST['submit'])) {
      if ($result && $statement->rowCount() > 0) { ?>
<h3 class="my-4">> Résultat</h3>
<div class="table-responsive">
<table class="table">
          <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Prénom</th>
      <th scope="col">Nom</th>
      <th scope="col">Phone</th>
      <th scope="col">Email</th>
      <th scope="col">Société</th>
    </tr>
          </thead>
          <tbody>
      <?php foreach ($result as $row) { ?>
          <tr>
    <td><?php echo htmlspecialchars($row["people_id"]); ?></td>
    <td><?php echo htmlspecialchars($row["people_prenom"]); ?></td>
    <td><?php echo htmlspecialchars($row["people_nom"]); ?></td>
    <td><?php echo htmlspecialchars($row["people_phone"]); ?></td>
    <td><?php echo htmlspecialchars($row["people_email"]); ?></td>
    <td><?php echo htmlspecialchars($row["societe_societe_id"]); ?></td>
          </tr>
        <?php } ?>
          </tbody>
      </table>
    </div>
      <?php } else { ?>
        <h3 class="my-4">> Aucun résultat pour "<?php echo htmlspecialchars($_POST['nom']); ?>".</h3>
      <?php }
    } ?>
    <?php include "templates/footer.php"; ?>
