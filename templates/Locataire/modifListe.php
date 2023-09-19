<!-- code html de la page-->
<h1 class="text-center">Modification d'un Locataire</h1>
<form action="/locataire/modifForm" method='post'>
    <div class=" row mb-3">
        <?php
        if (count($lesLocataires) == 0) {
            echo ("Aucun locataire");
        } else {
        ?>
            <label for="lesDem" class="col-lg-4 col-form-label">Choisissez le Locataire à modifier</label>
            <div class="col-sm-12">
                <!-- liste déroulante -->
                <select class="form-select form-select-md" onChange="submit();" name="lstLocataire">
                    <?php foreach ($lesLocataires as $unlocataire) {
                        $id = $unlocataire->getId();
                        $libelle = $unlocataire->getTypeAppartement()->getLibelle() . ' , superficie : ' . $unlocataire->getSuperficie();
                        if (isset($_POST['lstLocataire']) == true && $_POST['listLocataire'] == $id)
                            echo ("<option selected value=$id>$libelle</option>");
                        else
                            echo ("<option value=$id>$libelle</option>");
                    } ?>
                </select>
            </div>
        <?php
        }
        ?>
    </div>
</form>
<?php
if (isset($msg)) echo $msg;
?>