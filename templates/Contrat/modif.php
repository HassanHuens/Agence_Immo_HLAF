<!-- code html de la page-->
<h1 class="text-center">Modification d'un contrat</h1>
<form action="/contrat/modifTrait" method='post'>

<div class="row mb-3">
        <label for="debut" class="col-lg-4 col-form-label">Début</label>
        <div class="col-sm-12">
            <input type="date" class="form-control" name="debut" value="<?php if (isset($leContrat))  echo $leContrat->getDebut();  ?>" id="debut">
        </div>
    </div>
    <div class="row mb-3">
        <label for="fin" class="col-lg-4 col-form-label">Fin</label>
        <div class="col-sm-12">
            <input type="date" class="form-control" name="fin" value="<?php if (isset($leContrat))  echo $leContrat->getFin();  ?>" id="fin">
        </div>
    </div>
    <div class="row mb-3">
        <label for="montantCharges" class="col-lg-4 col-form-label">Montant des charges</label>
        <div class="col-sm-12">
            <input type="number" class="form-control" name="montantCharges" value="<?php if (isset($leContrat))  echo $leContrat->getMontantCharge();  ?>" id="montantCharges">
        </div>
    </div>
    <div class="row mb-3">
        <label for="montantCaution" class="col-lg-4 col-form-label">Montant de la caution</label>
        <div class="col-sm-12">
            <input type="number" class="form-control" name="montantCaution" value="<?php if (isset($leContrat))  echo $leContrat->getMontantCaution();  ?>" id="montantCaution">
        </div>
    </div>
    <div class="row mb-3">
        <label for="montantLoyerHc" class="col-lg-4 col-form-label">Montant du loyer hors charges</label>
        <div class="col-sm-12">
            <input type="number" class="form-control" name="montantLoyerHc" value="<?php if (isset($leContrat))  echo $leContrat->getMontantLoyerHc();  ?>" id="montantLoyerHc">
        </div>
    </div>
    <div class="row mb-3">
        <label for="salaireLocataire" class="col-lg-4 col-form-label">Salaire du locataire</label>
        <div class="col-sm-12">
            <input type="number" class="form-control" name="salaireLocataire" value="<?php if (isset($leContrat))  echo $leContrat->getSalaireLocataire();  ?>" id="salaireLocataire">
        </div>
    </div>

    <!-- titre de la ligne à remplir -->
    <div class="row mb-3">
        <label for="typeFrais" class="col-lg-4 col-form-label">Locataire</label>
        <div class="col-sm-12">
            <!-- liste déroulante -->
            <select class="form-select form-select-md" name="lstLocataire">
                <?php foreach ($lesLocataires as $unLocataire) {
                    $id = $unLocataire->getId();
                    $nom = $unLocataire->getNom();
                    $prenom = $unLocataire->getPrenom();
                    $nomPrenom = "$nom $prenom";
                    if (isset($leLocataire) && $leContrat->getLesLocataires()->getId() == $id)
                        echo ("<option selected value=$id>$nomPrenom</option>");
                    else
                        echo ("<option value=$id>$nomPrenom</option>");
                } ?>
            </select>
        </div>
    </div>

    <!-- titre de la ligne à remplir -->
    <div class="row mb-3">
        <label for="typeFrais" class="col-lg-4 col-form-label">Garant</label>
        <div class="col-sm-12">
            <!-- liste déroulante -->
            <select class="form-select form-select-md" name="lstGarant">
                <?php foreach ($lesGarants as $unGarant) {
                    $id = $unGarant->getId();
                    $nom = $unGarant->getNom();
                    $prenom = $unGarant->getPrenom();
                    $nomPrenom = "$nom $prenom";
                    if (isset($leGarant) && $leContrat->getLesGarants()->getId() == $id)
                        echo ("<option selected value=$id>$nomPrenom</option>");
                    else
                        echo ("<option value=$id>$nomPrenom</option>");
                } ?>
            </select>
        </div>
    </div>

    <!-- titre de la ligne à remplir -->
    <div class="row mb-3">
        <label for="typeFrais" class="col-lg-4 col-form-label">Appartement</label>
        <div class="col-sm-12">
            <!-- liste déroulante -->
            <select class="form-select form-select-md" name="lstAppartement">
                <?php foreach ($lesApparts as $unAppart) {
                    $id = $unAppart->getId();
                    $batiment = $unAppart->getBatiment();
                    $rue = $unAppart->getRue();
                    $nomVille = $unAppart->getLaVille()->getNom();
                    $typeAppart = $unAppart->getLeTypeAppart()->getLibelle();
                    $cpVille = $unAppart->getLaVille()->getCodePostal();
                    $infoAppart = "$batiment $rue, $nomVille $cpVille ($typeAppart)";
                    if (isset($leAppart) && $leContrat->getLesApparts()->getId() == $id)
                        echo ("<option selected value=$id>$infoAppart</option>");
                    else
                        echo ("<option value=$id>$infoAppart</option>");
                } ?>
            </select>
        </div>
    </div>

    <!-- titre de la ligne à remplir -->
    <div class="row mb-3">
        <label for="typeFrais" class="col-lg-4 col-form-label">Type de Location</label>
        <div class="col-sm-12">
            <!-- liste déroulante -->
            <select class="form-select form-select-md" name="lstTypeLocation">
                <?php foreach ($lesTypesLocation as $unTypeLocation) {
                    $id = $unTypeLocation->getId();
                    $libelle = $unTypeLocation->getLibelle();
                    if (isset($leTypeLocation) && $leTypeLocation->getLesTypes()->getId() == $id)
                        echo ("<option selected value=$id>$libelle</option>");
                    else
                        echo ("<option value=$id>$libelle</option>");
                } ?>
            </select>
        </div>
    </div>

    <input type="hidden" name="idLocataire" value="<?php if ($leContrat != null) echo $leContrat->getId(); ?>">



    <div class="p-3 mb-4">
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </div>
</form>
<?php
if (isset($msg)) echo $msg;
?>