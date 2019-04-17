<?php
    try{
        require "config.php";
        require "common.php";

        $conn = new PDO($dsn, $username, $password, $options);

        $sqlS = "SELECT * FROM societe WHERE societe_nom = :societe_nom";
        $tout = "SELECT * FROM societe";
        $nomS = $_POST["societyname"];

        $statement = $conn->prepare($sqlS);
        $statement->bindParam(":societe_nom", $nomS, PDO::PARAM_STR);
        $statement->execute();

        $stou = $conn->prepare($tout);
        $stou->bindParam(":societe_nom", $nomS, PDO::PARAM_STR);
        $stou->execute();

        $result=$statement->fetchALL();
        $result2=$stou->fetchALL();

    } catch(PDOException $error){
        echo $sqlS."<br>".$error->getMessage();
    }
    require "templates/header.php";?>
<?php
    if (isset($_POST['submit'])) {
        if ($result && $statement->rowCount() > 0) {
?>
<h2>Résultat de la recherche</h2>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Nom</th>
            <th>N° de TVA</th>
            <th>Pays</th>
            <th>Type de société</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($result as $row) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row["societe_id"]); ?></td>
            <td><?php echo htmlspecialchars($row["societe_nom"]); ?></td>
            <td><?php echo htmlspecialchars($row["societe_tva"]); ?></td>
            <td><?php echo htmlspecialchars($row["societe_pays"]); ?></td>
            <td><?php echo htmlspecialchars($row["societe_type"]); ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php } else { ?>
    > No results found for <?php echo htmlspecialchars($_POST['societyname']);
      }
    }
 ?>
<br><br>
<!-- <h2>Liste des sociétés</h2>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Nom</th>
            <th>N° de TVA</th>
            <th>Pays</th>
            <th>Type de société</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($result2 as $row) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row["societe_id"]); ?></td>
            <td><?php echo htmlspecialchars($row["societe_nom"]); ?></td>
            <td><?php echo htmlspecialchars($row["societe_tva"]); ?></td>
            <td><?php echo htmlspecialchars($row["societe_pays"]); ?></td>
            <td><?php echo htmlspecialchars($row["societe_type"]); ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table> -->
<br>
<form method="post">
    <label for="societyname">Rechercher une société</label><br>
    <input type="text" id="societyname" name="societyname">
    <input type="submit" name="submit" value="Recherche"><br><br>
</form>

<?php include "templates/footer.php"; ?>
