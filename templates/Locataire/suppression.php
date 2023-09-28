<!-- code html de la page-->
<h2 class="text-center">Suppression d'un locataire</h2>
<form action="/locataire/supprTrait" method='post'>
<input type="hidden" name="idLocataire" value="<?php if ($leLoca != null) echo $leLoca->getId(); ?>">
    <div class="p-3 mb-4">
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
        <?php  
            echo ("<tr>");
            echo ("<td>" . $leLoca->getNom() . "</td>");
            echo ("<td>" . $leLoca->getPrenom()  . "</td>");
            echo ("<td>" . $leLoca->getEmail()  . "</td>");
            echo ("<td>" . $leLoca->getTelephone()  . "</td>");
            echo ("<td>" . $leLoca->getRue()  . "</td>");
            echo ("<td>" . $leLoca->getVille()->getNom()  . "</td>");
            echo ("<td>" . $leLoca->getLeImpression()->getLibelle()  . "</td>");
            echo ("<td>" . $leLoca->getCategorieSocioprofessionnelle()->getLibelle()  . "</td>");
            echo ("</tr>");
             ?>
        </table>
        <div class="p-3 mb-4">
            <div class="text-center">
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </div>
        </div>
    </form>
    <div class="p-3 mb-4">
        <div class="text-center">
             <a class="btn btn-primary" href="/locataire/suppression">Annuler</a>
        </div>
    </div>

<?php
if (isset($msg)) echo $msg;
?>