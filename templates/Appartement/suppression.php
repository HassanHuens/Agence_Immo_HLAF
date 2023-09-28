<h1 class="text-center">Suppression d'un appartement</h1>
<form action="/appartement/supprTrait" method="post">
    <input type="hidden" name="idAppart" value="<?php if ($lAppart != null) echo $lAppart->getId(); ?>">
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
        <?php 
             echo ("<tr>");
             echo ("<td>" . $lAppart->getRue() . "</td>");
             echo ("<td>" . $lAppart->getBatiment() . "</td>");
             echo ("<td>" . $lAppart->getEtage() . "</td>");
             echo ("<td>" . $lAppart->getSuperficie() . "</td>");
             echo ("<td>" . $lAppart->getOrientation()  . "</td>");
             echo ("<td>" . $lAppart->getNbPieces() . "</td>");
             echo ("<td>" . $lAppart->getLeTypeAppart()->getLibelle() . "</td>");
             echo ("<td>" . $lAppart->getLeProprietaire()->getNom() . "</td>");
             echo ("<td>" . $lAppart->getLaVille()->getNom() . "</td>");

            echo ("</tr>");
         ?>
    </table>
    <div class="p-3 mb-4">
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Supprimer</button>
        </div>
    </div>
</form>
<div class="p-3 mb-4">
        <div class="text-center">
        <button onclick="window.location.href = 'suppression';">Annuler</button>
        </div>
    </div>
<?php
if (isset($msg)) echo $msg;
?>