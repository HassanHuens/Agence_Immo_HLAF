<!-- code html de la page-->
<h1 class="text-center">Modification d'un appartement</h1>
<form action="/appartement/modifForm" method='post'>
    <div class=" row mb-3">
        <?php
        if (count($lesApparts) == 0) {
            echo ("Aucun appartement");
        } else {
        ?>
            <label for="lesDem" class="col-lg-4 col-form-label">Choisissez l'appartement à modifier</label>
            <div class="col-sm-12">
                <!-- liste déroulante -->
                <select class="form-select form-select-md" onChange="submit();" name="lstApparts">
                    <?php foreach ($lesApparts as $unAppart) {
                        $id = $unAppart->getId();
                        $libelle = $unAppart->getLeTypeAppart()->getLibelle() . ' , superficie : ' . $unAppart->getSuperficie();
                        if (isset($_POST['lstApparts']) == true && $_POST['lstApparts'] == $id)
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