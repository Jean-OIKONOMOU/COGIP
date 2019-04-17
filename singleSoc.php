<?php require "templates/header.php";
    require "config.php";
    require "common.php";

    if (isset($_GET["id"])){
        try{
            $conn = new PDO ($dsn, $username, $password, $options);
            $id = $_GET["id"];

            $sql = "SELECT * FROM societe WHERE societe_id = :id";
            $statement = $conn->prepare($sql);
            $statement->bindValue(":id", $id);
            $statement->execute();

            $societeShow = $statement->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $error){
            echo $sql."<br>".$error->getMessage();
        }
    } else {
        echo "Oups, cela n'a pas marché";
        exit;
    }
?>

<h2>Voir les informations</h2>

<table>
    <thead>

    </thead>
    <tbody>
        <?php foreach ($societeShow as $row => $value) { ?>
        <tr>
            <td><?php echo htmlspecialchars($value); ?></td>

        </tr>
        <?php } ?>
    </tbody>
</table>
<br><br>
<?php require "templates/footer.php"; ?>
