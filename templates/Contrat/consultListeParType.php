<!-- code html de la page-->
<h1 class="text-center">Liste des contrats</h1>
<form action="/contrat/listeParTypeTrait" method='post'>
    <div class=" row mb-3">
        <?php
            if (count($lesTypesLocation) == 0) {
                echo ("Aucun contrat");
            } else {
        ?>
        <label for="lesDem" class="col-lg-4 col-form-label">Choisissez le type de location</label>
        <div class="col-sm-12">
            <!-- liste déroulante -->
            <select class="form-select form-select-md" onChange="submit();" name="lstTypeLocation">
                <option value=0>Veuillez sélectionner le type de locataire</option>
                <?php foreach ($lesTypesLocation as $unTypesLocation) {
                    $id = $unTypesLocation->getId();
                    $libelleTypeLocation = $unTypesLocation->getLibelle();
                    if (isset($_POST['lstTypeLocation']) == true && $_POST['lstTypeLocation'] == $id)
                        echo ("<option selected value=$id>$libelleTypeLocation</option>");
                    else
                        echo ("<option value=$id>$libelleTypeLocation</option>");
                } ?>
            </select>
            <!-- /liste déroulante -->
        </div>
        <?php
            }
        ?>
    </div>
</form>


<?php
    if (isset($lesContrats)) {
?>
        <table class="table table-bordered table-lg">
            <!-- On affiche le nom des colonnes -->
            <thead class="table-light">
                <tr>
                    <th scope="col">Début</th>
                    <th class="col">Fin</th>
                    <th scope="col">Montant des charges</th>
                    <th scope="col">Montant de la caution</th>
                    <th scope="col">Montant du loyer hors charges</th>
                    <th scope="col">Salaire du locataire</th>
                    <th scope="col">Locataire</th>
                    <th scope="col">Garant</th>
                    <th scope="col">Appartement</th>
                </tr>
            </thead>
            <!-- On affiche le contenu des colonnes -->
            <?php foreach ($lesContrats as $unContrat) {
                echo ("<tr>");
                echo ("<td>" . $unContrat->getDebut()->format('Y-m-d') . "</td>");
                echo ("<td>" . $unContrat->getFin()->format('Y-m-d') . "</td>");
                echo ("<td>" . $unContrat->getMontantCharge()  . "</td>");
                echo ("<td>" . $unContrat->getMontantCaution() . "</td>");
                echo ("<td>" . $unContrat->getMontantLoyerHc()  . "</td>");
                echo ("<td>" . $unContrat->getSalaireLocataire()  . "</td>");
                echo ("<td>" . $unContrat->getLeLocataire()->getNom() . " " . $unContrat->getLeLocataire()->getPrenom() . "</td>");
                echo ("<td>" . $unContrat->getLeGarant()->getNom()  . " " . $unContrat->getLeGarant()->getPrenom()  . "</td>");
                echo ("<td>" . $unContrat->getLAppartement()->getId()  . "</td>");
                echo ("</tr>");
            } ?>
        </table>
<?php
    }
?>

<?php
    if (isset($msg)) echo $msg;
?>