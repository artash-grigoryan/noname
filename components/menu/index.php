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
            <li><a href="<?=PATH?>">Home</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Parameters <span class="caret"></span></a>
                <ul aria-labelledby="download" class="dropdown-menu">
                    <li><a href="<?=PATH?>users/account/">See my account</a></li>
                    <li><a href="<?=PATH?>users/updateInfo/?form=1">Update my account</a></li>
                    <li><a href="<?=PATH?>users/updatePhoto/?form=1">Update my picture</a></li>
                    <li><a href="<?=PATH?>users/updateInfo/?form=1&password=1">Update my password</a></li>
                    <li><a href="<?=PATH?>users/sessionsActives/">Manage my sessions</a></li>
                    <li><a href="<?=PATH?>users/logout/">Logout</a></li>
                </ul>
            </li>
            <li id="search_forms" class="dropdown">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Search <span class="caret"></span></a>
                <ul aria-labelledby="download" class="dropdown-menu">
                    <li>
                        <form id="user_search" action="<?=BASE_PATH?>users/search/" method="post">
                            <fieldset>
                                <legend>Search</legend>
                                <div class="form-group">
                                    <label class="control-label">A product, a travel or an user  ...</label>
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