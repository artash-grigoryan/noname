
<div class="bs-docs-section">

    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1 id="forms">Bienvenue <?=$this->_user->first_name?> <?=$this->_user->last_name?> dans l'espace partenaires Psio</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div id="login" class="col-lg-6">
            <div class="well bs-component">
                <? Controller::loadComponent('users', 'resetPasswordForm'); ?>
            </div>
        </div>

        <div id="login_info" class="col-lg-4 col-lg-offset-1">
            <p>Vous êtes maintenant inscrit en tant que partenaire et utilisateur du site</p>
            <p>Entrez un nouveau mot de passe de connexion</p>
            <p>
                Pour un mot de passe fort et sécurisé, veuillez entrer des chiffres ainsi que des caractères spéciaux.
            </p>
        </div>
    </div>
</div>


