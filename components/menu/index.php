<div class="container">
    <div id="logo" class="navbar-header">
        <a class="navbar-brand" href="<?=PATH?>">
            Psio
        </a>
        <button data-target="#navbar-main" data-toggle="collapse" type="button" class="navbar-toggle collapsed">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>

    <div id="navbar-main" class="navbar-collapse collapse">

        <ul class="nav navbar-nav navbar-left">
            <li><a href="<?=PATH?>">Actualités</a></li>
            <li><a href="<?=PATH?>sales">Ventes</a></li>
            <li><a href="<?=PATH?>docs">Documents</a></li>
            <li><a href="<?=PATH?>testimonials">Témoignages</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Paramètres <span class="caret"></span></a>
                <ul aria-labelledby="download" class="dropdown-menu">
                    <li><a href="<?=PATH?>users/account/">Voir mes informations</a></li>
                    <li><a href="<?=PATH?>users/updateInfo/?form=1">Modifier mes informations</a></li>
                    <li><a href="<?=PATH?>users/updatePhoto/?form=1">Modifier ma photo</a></li>
                    <li><a href="<?=PATH?>users/updateInfo/?form=1&password=1">Modifier mon mot de passe</a></li>
                    <li><a href="<?=PATH?>users/sessionsActives/">Gérer mes sessions actives</a></li>
                    <li><a href="<?=PATH?>users/partners/">Gérer mes partenaires</a></li>
                    <li><a href="<?=PATH?>users/logout/">Déconnexion</a></li>
                </ul>
            </li>
            <li id="search_forms" class="dropdown">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Recherche <span class="caret"></span></a>
                <ul aria-labelledby="download" class="dropdown-menu">
                    <li>
                        <form id="user_search" action="<?=BASE_PATH?>users/search/" method="post">
                            <fieldset>
                                <legend>Rechercher sur le site</legend>
                                <div class="form-group">
                                    <label class="control-label">Un partenaire, un document ou une actu ...</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"/>
                                        <span class="input-group-btn">
                                          <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                                        </span>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>

    </div>
</div>