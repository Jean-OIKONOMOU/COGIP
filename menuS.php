<?php require "templates/header.php";

try {
    require "config.php";
    require "common.php";

    $conn = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT * FROM societe ORDER BY societe_nom ASC";

    $statement = $conn->prepare($sql);
    $statement->execute();

    $result=$statement->fetchALL();

    } catch(PDOException $error){
    echo $sql."<br>".$error->getMessage();
    }
    //recherche societe

    if (isset($_POST['submit'])) {
        if ($result && $statement->rowCount() > 0) {
            header('Location: readS.php');
            exit;
    } else { ?>
        > No results found for <?php echo escape($_POST['societyname']);
    }
}
 ?>
 <br><br>
<h2 class="mb-5">SOCIÉTÉS</h2>
<div class="table-responsive">
    <table class="table">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Éditer</th>
            <th>Supprimer</th>
        </tr>
    </thead>
        <tbody>
            <?php foreach ($result as $row) : ?>
            <tr>
                <td><a title="Voir les informations" href="singleSoc.php?id=<?php echo escape($row["societe_id"]); ?>"><?php echo escape($row["societe_nom"]);?></a></td>
                <td><a title="Cliquez pour modifier" href="editS.php?id=<?php echo escape($row["societe_id"]); ?>">
                        <i class="fas fa-pen text-right"></i></a></td>
                <td><a title="Cliquez pour supprimer" href="deleteS.php?id=<?php echo escape($row["societe_id"]); ?>"><i
                            class="fas fa-trash-alt"></i></a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
<form method="post">
    <label for="societyname">Rechercher une société</label><br>
    <!-- <input type="text" id="societyname" name="societyname"> -->
    <input type="submit" name="submit" value="Recherche"><br><br>
</form>
</div>

<?php include "templates/footer.php"; ?>
