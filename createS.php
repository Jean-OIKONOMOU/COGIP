<?php include "Templates/Header.php"; ?>
<section>
    <form action="installS.php" method="post">
        <fieldset>
        <label for="societyname">Nom de la société</label><br>
        <input type="text" name="societyname" id="societyname" placeholder="Le nom de la société" >
        <br><br>
        <label for="tvanumber">N° de TVA</label><br>
        <input type="text" name="tvanumber" id="tvanumber" placeholder="Ex: BE 01 234 567 891" pattern="[A-Z]{2}[ \.\-]?[0]{1}[ \.\-]?[0-9]{9}">
        <br><br>
        <label for="societycountry">Pays</label><br>
        <input type="text" name="societycountry" id="societycountry" placeholder="Le pays de la société">
        <br><br>
        <label for="societytype">Type de société</label><br><br>
        <select name="societytype" id="societytype" size="1" >
            <option>Client</option>
            <option>Fournisseur</option>
        </select>
        <br><br>
        <input type="submit" name="submit" value="Envoyer">
        </fieldset>
    </form>
</section>
<?php include "Templates/Footer.php"; ?>