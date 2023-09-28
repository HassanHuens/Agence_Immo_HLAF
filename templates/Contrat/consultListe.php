<!-- code html de la page-->
<h2 class="text-center">Les contrats</h2>

<?php
if (count($lesContrats) == 0) {
    echo ("Il n'y a pas de contrat");
} else {
?>
    <table class="table table-bordered table-lg">
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
                <th scope="col">Type de location</th>
            </tr>
        </thead>
        <?php foreach ($lesContrats as $unContrat) {
            echo ("<tr>");
            echo ("<td>" . $unContrat->getDebut()->format('Y-m-d') . "</td>");
            echo ("<td>" . $unContrat->getFin()->format('Y-m-d') . "</td>");
            echo ("<td>" . $unContrat->getMontantCharge()  . "</td>");
            echo ("<td>" . $unContrat->getMontantCaution() . "</td>");
            echo ("<td>" . $unContrat->getMontantLoyerHc()  . "</td>");
            echo ("<td>" . $unContrat->getSalaireLocataire()  . "</td>");
            echo ("<td>" . $unContrat->getLeLocataire()->getId() .  "</td>");
            echo ("<td>" . $unContrat->getLeGarant()->getId()  . "</td>");
            echo ("<td>" . $unContrat->getLAppartement()->getId()  . "</td>");
            echo ("<td>" . $unContrat->getLeTypeLocation()->getId()  . "</td>");
            echo ("</tr>");
        } ?>
    </table>
<?php
}
?>