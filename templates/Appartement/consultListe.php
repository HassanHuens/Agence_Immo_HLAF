<!-- code html de la page-->
<h2 class="text-center">Les appartements</h2>

<?php
if (count($lesApparts) == 0) {
    echo ("Il n'y a pas d'appartements");
} else {
?>
    <table class="table table-bordered table-lg">
        <thead class="table-light">
            <tr>
                <th class="col">Rue</th>
                <th class="col">Batiment</th>
                <th class="col">Etage</th>
                <th class="col">Superficie</th>
                <th scope="col">Orientation</th>
                <th class="col">Nombre de pièces</th>
                <th scope="col">Type d'appartement</th>
                <th scope="col">Proprietaire</th>
                <th scope="col">Ville</th>




            </tr>
        </thead>
        <?php foreach ($lesApparts as $unAppart) {
            echo ("<tr>");
            echo ("<td>" . $unAppart->getRue() . "</td>");
            echo ("<td>" . $unAppart->getBatiment() . "</td>");
            echo ("<td>" . $unAppart->getEtage() . "</td>");
            echo ("<td>" . $unAppart->getSuperficie() . "</td>");
            echo ("<td>" . $unAppart->getOrientation()  . "</td>");
            echo ("<td>" . $unAppart->getNbPieces() . "</td>");
            echo ("<td>" . $unAppart->getLeTypeAppart()->getLibelle() . "</td>");
            echo ("<td>" . $unAppart->getLeProprietaire()->getNom() . "</td>");
            echo ("<td>" . $unAppart->getLaVille()->getNom() . "</td>");


            echo ("</tr>");
        } ?>
    </table>
<?php
}
?>