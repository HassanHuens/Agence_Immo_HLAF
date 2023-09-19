<!-- code html de la page-->
<h2 class="text-center">Les locataires</h2>

<?php
if (count($lesLocataires) == 0) {
    echo ("Il n'y a pas de locataire");
} else {
?>
    <table class="table table-bordered table-lg">
        <thead class="table-light">
            <tr>
                <th class="col">Nom et Prénom</th>
                <th class="col">Prénom</th>
                <th class="col">Email</th>
                <th class="col">Téléphone</th>
                <th class="col">Rue</th>
                <th class="col">Ville</th>
                <th class="col">Impréssion</th>
                <th class="col">Catégorie Socioprofessionnelle</th>
            </tr>
        </thead>
        <?php foreach ($lesLocataires as $unLocataire) {
            echo ("<tr>");
            echo ("<td>" . $unLocataire->getNom() . "</td>");
            echo ("<td>" . $unLocataire->getPrenom()  . "</td>");
            echo ("<td>" . $unLocataire->getEmail()  . "</td>");
            echo ("<td>" . $unLocataire->getTelephone()  . "</td>");
            echo ("<td>" . $unLocataire->getRue()  . "</td>");
            echo ("<td>" . $unLocataire->getVille()->getNom()  . "</td>");
            echo ("<td>" . $unLocataire->getLeImpression()->getLibelle()  . "</td>");
            echo ("<td>" . $unLocataire->getCategorieSocioprofessionnelle()->getLibelle()  . "</td>");
            echo ("</tr>");
        } ?>
    </table>
<?php
}
?>