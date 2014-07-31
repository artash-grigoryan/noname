
<div id="login" class="bs-docs-section">

    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1 id="forms">Welcome</h1>
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
                                        New user ?
                                    </a>
                                <? endif; ?>
                                <label for="inputEmail" class="col-lg-2 control-label">Mail*</label>
                                <div class="col-lg-10">
                                    <input class="form-control mandatory" id="inputEmail" placeholder="Email" type="text" name='mail'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword" class="col-lg-2 control-label">Password*</label>
                                <div class="col-lg-10">
                                    <input class="form-control mandatory" id="inputPassword" placeholder="Password" type="password" name="password">
                                    <a href="<?=PATH?>users/forgotPassword/" class="forgot_pwd" data-ajax="false">Forgot password ?</a>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="rememberme" checked="checked">
                                            Remember me
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="button" class="btn btn-default cancel">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                            </div>
                        <? endif; ?>
                    </fieldset>
                </form>

            </div>
        </div>

        <div id="login_info" class="col-lg-4 col-lg-offset-1">
            <p>Please enter your mail and password</p>
        </div>
    </div>

</div>

<? if($this->_params['registration']): ?>
    <? Controller::loadComponent('users', 'registration'); ?>
<? endif; ?>