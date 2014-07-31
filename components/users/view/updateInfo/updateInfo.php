<div id="updateinfo-page" class="bs-docs-section">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-12">
                <h1><?=!Auth::hasAuth(ADMIN) ? 'Modifier mes informations' : 'Modifier les informations de '.$this->_user->first_name. ' ' .$this->_user->last_name?></h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">

            <div class="well bs-component">
                <? if(!Controller::getVars('password', false)): ?>
                    <form id="updateinfo_form" class="form-horizontal" action="<?=BASE_PATH?>users/updateInfo/?id=<?=$this->_user->id?>&submit=1" method="post">
                        <fieldset>
                            <legend>Informations Générales</legend>
                                <div class="form-group">
                                    <label for="inputFirstName" class="col-lg-2 control-label">Prénom*</label>
                                    <div class="col-lg-10">
                                        <input class="form-control mandatory" id="inputFirstName" placeholder="Prénom" type="text" name="first_name" value="<?=$this->_user->first_name?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-lg-2 control-label">Nom*</label>
                                    <div class="col-lg-10">
                                        <input class="form-control mandatory" id="inputName" placeholder="Nom" type="text" name="last_name" value="<?=$this->_user->last_name?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputStreet" class="col-lg-2 control-label">Rue</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="inputStreet" placeholder="Rue" type="text" name='street' value="<?=$this->_user->street?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputZip" class="col-lg-2 control-label">Code Postal</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="inputZip" placeholder="Code Postal" type="text" name='zip' value="<?=$this->_user->zip?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputCity" class="col-lg-2 control-label">Ville</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="inputCity" placeholder="Ville" type="text" name='city' value="<?=$this->_user->city?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-lg-2 control-label">Pays</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="inputEmail" placeholder="Pays" type="text" name='country' value="<?=!empty($this->_user->country)?$this->_user->country:'France'?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPhone" class="col-lg-2 control-label">Téléphone</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="inputPhone" placeholder="Téléphone" type="text" name='phone' value="<?=$this->_user->phone?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        <a href="<?=PATH?>users/account/?id=<?=$this->_user->id?>" class="btn btn-default cancel">Annuler</a>
                                        <button type="submit" class="btn btn-primary">Modifier</button>
                                        <a id="delete_partner" class="btn btn-danger" href="<?=PATH?>users/deletePartner/?id=<?=$this->_user->id?>" onclick="return confirm('Supprimer ce partenaire ? ');">Supprimer ce partenaire</a>
                                    </div>
                                </div>
                        </fieldset>
                    </form>

                <? else: ?>

                    <form id="user_password_form" class="form-horizontal" action="<?=BASE_PATH?>users/updateInfo/?submit=1&password=1">
                        <fieldset>
                            <legend>Mot de passe</legend>
                            <div class="form-group">
                                <label for="inputPassword" class="col-lg-2 control-label">Nouveau Mot de Passe*</label>
                                <div class="col-lg-10">
                                    <input class="form-control mandatory" id="inputPassword" placeholder="Password" type="password" name="newpassword">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword" class="col-lg-2 control-label">Confirmez le Mot de Passe:*</label>
                                <div class="col-lg-10">
                                    <input class="form-control mandatory" id="inputPassword" placeholder="Password" type="password" name="newpassword_confirm">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <a href="<?=PATH?>users/account/?id=<?=$this->_user->id?>" class="btn btn-default cancel">Annuler</a>
                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>

                <? endif; ?>
            </div>

        </div>
    </div>
</div>