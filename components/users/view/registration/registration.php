
<div id="registration" class="bs-docs-section">

    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1 id="forms">Bienvenue dans l'espace partenaires Psio</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="well bs-component">

                <form id="registration_form" class="form-horizontal" action="<?=BASE_PATH?>users/registration/?method=submitMail" method="post">
                    <fieldset>
                        <legend>Enregistrement</legend>
                        <? if($this->_params['e-mail']): ?>
                            <div class="form-group">
                                <label for="inputFirstName" class="col-lg-2 control-label">Prénom*</label>
                                <div class="col-lg-10">
                                    <input class="form-control mandatory" id="inputFirstName" placeholder="Prénom" value="<?=!empty($this->_first_name)?$this->_first_name:''?>" type="text" name='first_name'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="col-lg-2 control-label">Nom*</label>
                                <div class="col-lg-10">
                                    <input class="form-control mandatory" id="inputName" placeholder="Nom" value="<?=!empty($this->_last_name)?$this->_last_name:''?>" type="text" name='last_name'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-2 control-label">Email*</label>
                                <div class="col-lg-10">
                                    <input class="form-control mandatory" id="inputEmail" placeholder="Email" value="<?=!empty($this->_mail)?$this->_mail:''?>" type="text" name='mail'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword" class="col-lg-2 control-label">Mot de Passe*</label>
                                <div class="col-lg-10">
                                    <input class="form-control mandatory" id="inputPassword" placeholder="Mot de passe" type="password" name="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPasswordConfirm" class="col-lg-2 control-label">Confirmez votre Mot de Passe*</label>
                                <div class="col-lg-10">
                                    <input class="form-control mandatory" id="inputPasswordConfirm" placeholder="Confirmez le mot de passe" type="password" name="password_confirm">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="button" class="btn btn-default cancel">Annuler</button>
                                    <button type="submit" class="btn btn-primary">Envoyer</button>
                                </div>
                            </div>
                        <? endif; ?>
                    </fieldset>
                </form>

            </div>
        </div>

        <div id="registration_info" class="col-lg-4 col-lg-offset-1">
            <p>Veuillez entrer votre nom, prénom et E-mail valide ainsi que le mot de passe que vous utiliserez pour vos prochaines connexions</p>
            <p>Un E-mail contenant un lien de vérification va vous être envoyé.</p>
            <p>Pour un mot de passe fort et sécurisé, veuillez entrer des chiffres ainsi que des caractères spéciaux.</p>
            <p>Si vous ne parvenez pas à vous enregistrer, laissez nous un message via <a href="<?=PORT.DOM_NAME?>/contact/">notre page de contact</a>,<br /> Nous vous répondrons dans les meilleurs delais.</p>
        </div>
    </div>

</div>
