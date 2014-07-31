
<div id="login" class="bs-docs-section">

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

                <? if($this->_params['facebook']): ?>
                    <? Controller::loadComponent('users', 'fbLogin', $this->_params); ?>
                <? endif; ?>

                <form id="login_form" class="form-horizontal" action="<?=BASE_PATH?>" method="post">
                    <fieldset>
                        <legend>Authentification</legend>
                        <? if($this->_params['e-mail']): ?>
                            <div class="form-group">
                                <? if($this->_params['registration']): ?>
                                    <a class="registration_link" href="javascript:;">
                                        Nouveau partenaire Psio ?
                                    </a>
                                <? endif; ?>
                                <label for="inputEmail" class="col-lg-2 control-label">Email*</label>
                                <div class="col-lg-10">
                                    <input class="form-control mandatory" id="inputEmail" placeholder="Email" type="text" name='mail'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword" class="col-lg-2 control-label">Mot de Passe*</label>
                                <div class="col-lg-10">
                                    <input class="form-control mandatory" id="inputPassword" placeholder="Password" type="password" name="password">
                                    <a href="<?=PATH?>users/forgotPassword/" class="forgot_pwd" data-ajax="false">Mot de passe oublié</a>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="rememberme" checked="checked"> Se souvenir de moi
                                        </label>
                                    </div>
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

        <div id="login_info" class="col-lg-4 col-lg-offset-1">
            <p>Veuillez entrer vos identifiants de connexion<br />(votre mail et le mot de passe envoyé dans le mail d'inscription).</p>
            <p>
                Si vous avez oublié votre mot de passe,
                cliquez sur <span class="italic">" mot de passe oublié "</span>. <br /> (Un lien de changement de mot de passe vous sera automatiquement envoyé par mail)</p>
            <p>
                Si vous ne parvenez pas à vous connecter, laissez nous un message via <a href="<?=PORT.DOM_NAME?>/contact/">notre page de contact</a>,<br />
                Nous vous répondrons dans les meilleurs delais.
            </p>
        </div>
    </div>

</div>

<? if($this->_params['registration']): ?>
    <? Controller::loadComponent('users', 'registration'); ?>
<? endif; ?>