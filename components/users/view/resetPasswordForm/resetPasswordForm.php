<form id="login_form" class="form-horizontal" action="<?=BASE_PATH?>users/resetPassword/?mail=<?=$this->_mail?>&token=<?=$this->_token?>&mailSubmit=1" method="post">
    <fieldset>
        <legend>Initialisation du mot de passe</legend>
        <div class="form-group">
            <label for="inputEmail" class="col-lg-2 control-label">Email*</label>
            <div class="col-lg-10">
                <input class="form-control mandatory" id="inputEmail" placeholder="Email" type="text" name='mail' value="<?=$this->_mail?>" disabled="disabled">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword" class="col-lg-2 control-label">Nouveau Mot de Passe*</label>
            <div class="col-lg-10">
                <input class="form-control mandatory" id="inputPassword" placeholder="Mot de passe" type="password" name="newpassword">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword" class="col-lg-2 control-label">Confirmez le Mot de Passe:*</label>
            <div class="col-lg-10">
                <input class="form-control mandatory" id="inputPassword" placeholder="Confirmez le Mot de Passe" type="password" name="newpassword_confirm">
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