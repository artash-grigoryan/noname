
<div class="bs-docs-section">

    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1 id="forms">Welcome <?=$this->_user->first_name?> <?=$this->_user->last_name?></h1>
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
            <p></p>
        </div>
    </div>
</div>


