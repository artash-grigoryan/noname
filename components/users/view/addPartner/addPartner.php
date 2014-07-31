<div id="addpartner-page" class="bs-docs-section">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-12">
                <h1>Ajouter un partenaire</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">

            <form id="addpartner_form" class="form-horizontal" action="<?=BASE_PATH?>users/addPartner/?parentId=<?=$this->parentId?>&submit=1" method="post">
                <fieldset>
                    <legend>Informations du partenaire</legend>
                        <div class="form-group">
                            <label for="inputEmail" class="col-lg-2 control-label">E-Mail*</label>
                            <div class="col-lg-10">
                                <input class="form-control mandatory" id="inputEmail" placeholder="E-Mail" type="text" name="mail" value="<?=!empty($this->_user->mail)?$this->_user->mail:''?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputFirstName" class="col-lg-2 control-label">Prénom*</label>
                            <div class="col-lg-10">
                                <input class="form-control mandatory" id="inputFirstName" placeholder="Prénom" type="text" name="first_name" value="<?=!empty($this->_user->first_name)?$this->_user->first_name:''?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-lg-2 control-label">Nom*</label>
                            <div class="col-lg-10">
                                <input class="form-control mandatory" id="inputName" placeholder="Nom" type="text" name="last_name" value="<?=!empty($this->_user->last_name)?$this->_user->last_name:''?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputStreet" class="col-lg-2 control-label">Rue</label>
                            <div class="col-lg-10">
                                <input class="form-control" id="inputStreet" placeholder="Rue" type="text" name='street' value="<?=!empty($this->_user->street)?$this->_user->street:''?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputZip" class="col-lg-2 control-label">Code Postal</label>
                            <div class="col-lg-10">
                                <input class="form-control" id="inputZip" placeholder="Code Postal" type="text" name='zip' value="<?=!empty($this->_user->zip)?$this->_user->zip:''?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputCity" class="col-lg-2 control-label">Ville</label>
                            <div class="col-lg-10">
                                <input class="form-control" id="inputCity" placeholder="Ville" type="text" name='city' value="<?=!empty($this->_user->city)?$this->_user->city:''?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputCountry" class="col-lg-2 control-label">Pays</label>
                            <div class="col-lg-10">
                                <input class="form-control" id="inputCountry" placeholder="Pays" type="text" name='country' value="<?=!empty($this->_user->country)?$this->_user->country:'France'?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPhone" class="col-lg-2 control-label">Téléphone</label>
                            <div class="col-lg-10">
                                <input class="form-control" id="inputPhone" placeholder="Téléphone" type="text" name='phone' value="<?=!empty($this->_user->phone)?$this->_user->phone:''?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="button" class="btn btn-default cancel">Annuler</button>
                                <button type="submit" class="btn btn-primary">Envoyer</button>
                            </div>
                        </div>
                </fieldset>
            </form>

        </div>
    </div>
</div>