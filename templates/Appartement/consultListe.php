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
                <th scope="col">Type d'appartement</th>
                <th class="col">superficie</th>
                <th scope="col">orientation</th>
            </tr>
        </thead>
        <?php foreach ($lesApparts as $unAppart) {
            echo ("<tr>");
            echo ("<td>" . $unAppart->getTypeAppartement()->getLibelle() . "</td>");
            echo ("<td>" . $unAppart->getSuperficie() . "</td>");
            echo ("<td>" . $unAppart->getOrientation()  . "</td>");
            echo ("</tr>");
        } ?>
    </table>
<?php
}
?>