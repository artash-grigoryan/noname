
<div class="bs-docs-section">

    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1 id="forms">Bienvenue dans l'espace partenaires Psio</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div id="login" class="col-lg-6">
            <div class="well bs-component">
                <form id="login_form" class="form-horizontal" action="<?=BASE_PATH?>users/forgotPassword/" method="post">
                    <fieldset>
                        <legend>Mot de passe oublié</legend>
                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-2 control-label">Email*</label>
                                <div class="col-lg-10">
                                    <input class="form-control mandatory" id="inputEmail" placeholder="Email" type="text" name='mail'>
                                </div>
                            </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <a href="<?=PATH?>" class="btn btn-default cancel">Annuler</a>
                                <button type="submit" class="btn btn-primary">Envoyer</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>

        <div id="login_info" class="col-lg-4 col-lg-offset-1">
            <p>Veuillez entrer votre E-mail de connexion</p>
            <p>
                Si vous ne vous souvenez plus de votre E-mail, laissez nous un message via <a href="<?=PORT.DOM_NAME?>/contact/">notre page de contact</a>,<br />
                Nous vous répondrons dans les meilleurs delais.
            </p>
        </div>
    </div>

</div>