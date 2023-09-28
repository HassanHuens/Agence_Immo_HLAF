<!-- code html de la page-->
<h2 class="text-center">Les utilisateurs</h2>

<?php
if (count($lesUtilisateurs) == 0) {
    echo ("Il n'y a pas d'appartements");
} else {
?>
    <table class="table table-bordered table-lg">
        <thead class="table-light">
            <tr>
                <th scope="col">profil</th>
                <th class="col">nom</th>
                <th scope="col">prénom</th>
            </tr>
        </thead>
        <?php foreach ($lesUtilisateurs as $unUtilisateur) {
            echo ("<tr>");
            echo ("<td>" . $unUtilisateur->getProfil()->getLibelle() . "</td>");
            echo ("<td>" . $unUtilisateur->getNom() . "</td>");
            echo ("<td>" . $unUtilisateur->getPrenom()  . "</td>");
            echo ("</tr>");
        } ?>
    </table>
<?php
}
?>