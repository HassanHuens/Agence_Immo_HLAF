<h1 class="text-center">Ajout d'un appartement</h1>
<form action="/appartement/ajoutTrait" method='post'>
<div class="row mb-3">
        <label for="rue" class="col-lg-4 col-form-label">Rue</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" name="rue" value="<?php if (isset($unAppart))  echo $unAppart->getRue();  ?>" id="rue">
        </div>
    </div>
    <div class="row mb-3">
        <label for="batiment" class="col-lg-4 col-form-label">Batiment</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" name="batiment" value="<?php if (isset($unAppart))  echo $unAppart->getBatiment();  ?>" id="batiment">
        </div>
        <div class="row mb-3">
        <label for="etage" class="col-lg-4 col-form-label">Etage</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" name="etage" value="<?php if (isset($unAppart))  echo $unAppart->getEtage();  ?>" id="etage">
        </div>
    </div>
    <div class="row mb-3">
        <label for="superficie" class="col-lg-4 col-form-label">Superficie</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" name="superficie" value="<?php if (isset($unAppart))  
            echo $unAppart->getSuperficie();
          ?>" id="superficie">
        </div>
    </div>
    <div class="row mb-3">
        <label for="orientation" class="col-lg-4 col-form-label">Orientation</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" name="orientation" value="<?php if (isset($unAppart))  echo $unAppart->getOrientation();  ?>" id="orientation">
        </div>
    </div>
    <div class="row mb-3">
        <label for="nb_pieces" class="col-lg-4 col-form-label">Nombre de pièces</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" name="nb_pieces" value="<?php if (isset($unAppart))  echo $unAppart->getNbPieces();  ?>" id="nb_pieces">
        </div>
    </div>
   
    <div class="row mb-3">
        <label for="lstTypeAppart" class="col-lg-4 col-form-label">Type d'appartement</label>
        <div class="col-sm-12">
            <!-- liste déroulante -->
            <select class="form-select form-select-md" name="lstTypeAppart">
                <?php foreach ($lesTypesAppartements as $unType) {
                    $id = $unType->getId();
                    $lib = $unType->getLibelle();
                    if (isset($unAppart) && $unAppart->getTypeAppartement()->getId() == $id)
                        echo ("<option selected value=$id>$lib</option>");
                    else
                        echo ("<option value=$id>$lib</option>");
                } ?>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <label for="lstProprietaires" class="col-lg-4 col-form-label">Proprietaire</label>
        <div class="col-sm-12">
            <!-- liste déroulante -->
            <select class="form-select form-select-md" name="lstProprietaires">
                <?php foreach ($lesProprietaires as $unProprietaire) {
                    $id = $unProprietaire->getId();
                    $nom = $unProprietaire->getNom();
                    if (isset($unAppart) && $unAppart->getLeProprietaire()->getId() == $id)
                        echo ("<option selected value=$id>$nom</option>");
                    else
                        echo ("<option value=$id>$nom</option>");
                } ?>
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <label for="lstVilles" class="col-lg-4 col-form-label">Ville</label>
        <div class="col-sm-12">
            <!-- liste déroulante -->
            <select class="form-select form-select-md" name="lstVilles">
                <?php foreach ($lesVilles as $uneVille) {
                    $id = $uneVille->getInsee();
                    $nom = $uneVille->getNom();
                    if (isset($unAppart) && $unAppart->getLaVille()->getInsee() == $id)
                        echo ("<option selected value=$id>$nom</option>");
                    else
                        echo ("<option value=$id>$nom</option>");
                } ?>
            </select>
        </div>
    </div>


    <div class="p-3 mb-4">
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </div>
</form>
<?php
if (isset($msg)) echo $msg;
?>