<?php
    require "templates/header.php";
    require "config.php";
    require "common.php";

    $nomsociete = $_POST["societyname"];
    $tva = $_POST["tvanumber"];
    $payssociete = $_POST["societycountry"];
    $typesociete = $_POST["societytype"];

    if (isset($_POST['submit']) && !empty($nomsociete) && !empty($tva) && !empty($payssociete) && !empty($typesociete)){

    try{
        $conn = new PDO($dsn, $username, $password, $options);
        $rq = $conn-> prepare("INSERT INTO societe (societe_nom, societe_pays, societe_tva, societe_type) VALUES (:societe_nom, :societe_pays, :societe_tva, :societe_type)");
        $rq->execute(array(
            "societe_nom" => $nomsociete,
            "societe_pays" => $payssociete,
            "societe_tva" => $tva,
            "societe_type" => $typesociete
        ));

        echo "Registration successful<br>";

    } catch(PDOExeption $error){
        echo $sql."<br>".$error->getMessage();
    }
    } elseif (empty($nomsociete) || empty($payssociete) || empty($tva) || empty($typesociete)) {
        echo "All field are required";
        die();
    }
    require "templates/footer.php";
?>
