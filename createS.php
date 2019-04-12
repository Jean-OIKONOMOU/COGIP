<?php require "templates/header.php"; ?>
<h3 class="my-4">Ajouter une société.</h3>
<section>
    <form action="installS.php" method="post">
        <fieldset>
            <div class="form-group">
        <label for="societyname">Nom de la société</label><br>
        <input class="form-control" type="text" name="societyname" id="societyname" placeholder="Le nom de la société" >
        </div>

          <div class="form-group">
        <label for="tvanumber">N° de TVA</label><br>
        <input class="form-control" type="text" name="tvanumber" id="tvanumber" placeholder="Ex: BE 01 234 567 891" pattern="[A-Z]{2}[ \.\-]?[0]{1}[ \.\-]?[0-9]{9}">
          </div>

          <div class="form-group">
        <label for="societycountry">Pays</label><br>
        <input class="form-control" type="text" name="societycountry" id="societycountry" placeholder="Le pays de la société">
          </div>

          <div class="form-group">
        <label for="societytype">Type de société</label>
        <select class="form-control" name="societytype" id="societytype" size="1" >
            <option>Client</option>
            <option>Fournisseur</option>
        </select>
          </div>

        	<button class="btn btn-primary my-3" type="submit" name="submit" value="submit">Envoyer</button>
        </fieldset>
    </form>
</section>
<?php include "templates/footer.php"; ?>
