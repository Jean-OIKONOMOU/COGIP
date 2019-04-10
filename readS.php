<?php
    if (isset($_POST["submit"])){
        try{
            //CONFIG.PHP
            $host = "localhost";
            $usernameGa = "phpmyadmin";
            $passwordGa = "user";
            $dbname = "COGIP";
            $dsn = "mysql:host=$host;dbname=$dbname";
            $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

            //require "config.php";
            require "common.php";

            $conn = new PDO($dsn, $usernameGa, $passwordGa, $options);

            $sqlS = "SELECT * FROM societe WHERE societe_nom = :societe_nom";
            $nomS = $_POST["societyname"];

            $statement = $conn->prepare($sqlS);
            $statement->bindParam(":societe_nom", $nomS, PDO::PARAM_STR);
            $statement->execute();

            $result=$statement->fetchALL();

        } catch(PDOException $error){
            echo $sql."<br>".$error->getMessage();
        }
    }

    include "Templates/Header.php";

    if (isset($_POST['submit'])) {
    	if ($result && $statement->rowCount() > 0) {
?>
<h2>Liste des sociétés</h2>

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
            <td><?php echo escape($row["societe_id"]); ?></td>
            <td><?php echo escape($row["societe_nom"]); ?></td>
            <td><?php echo escape($row["societe_tva"]); ?></td>
            <td><?php echo escape($row["societe_pays"]); ?></td>
            <td><?php echo escape($row["societe_type"]); ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php } else { ?>
> No results found for <?php echo escape($_POST['societyname']); ?>.
<?php }
} ?>
<br>
<form method="post">
    <label for="societyname">Rechercher une société</label>
    <input type="text" id="societyname" name="societyname">
    <input type="submit" name="submit" value="Recherche">
</form>

<?php include "Templates/Footer.php"; ?>