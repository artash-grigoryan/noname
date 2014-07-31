
<div id="registration" class="bs-docs-section">

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

                <form id="registration_form" class="form-horizontal" action="<?=BASE_PATH?>users/registration/?method=submitMail" method="post">
                    <fieldset>
                        <legend>Registration</legend>
                        <? if($this->_params['e-mail']): ?>
                            <div class="form-group">
                                <label for="inputFirstName" class="col-lg-2 control-label">First name*</label>
                                <div class="col-lg-10">
                                    <input class="form-control mandatory" id="inputFirstName" placeholder="Prénom" value="<?=!empty($this->_first_name)?$this->_first_name:''?>" type="text" name='first_name'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="col-lg-2 control-label">Last name*</label>
                                <div class="col-lg-10">
                                    <input class="form-control mandatory" id="inputName" placeholder="Nom" value="<?=!empty($this->_last_name)?$this->_last_name:''?>" type="text" name='last_name'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-2 control-label">Mail*</label>
                                <div class="col-lg-10">
                                    <input class="form-control mandatory" id="inputEmail" placeholder="Email" value="<?=!empty($this->_mail)?$this->_mail:''?>" type="text" name='mail'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword" class="col-lg-2 control-label">Password*</label>
                                <div class="col-lg-10">
                                    <input class="form-control mandatory" id="inputPassword" placeholder="Mot de passe" type="password" name="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPasswordConfirm" class="col-lg-2 control-label">Confirm your password*</label>
                                <div class="col-lg-10">
                                    <input class="form-control mandatory" id="inputPasswordConfirm" placeholder="Confirmez le mot de passe" type="password" name="password_confirm">
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

        <div id="registration_info" class="col-lg-4 col-lg-offset-1">
            <p>Please, enter a valid first name, last name and mail and a strong password you will remember easily</p>
            <p>A mail will be send to your address</p>
        </div>
    </div>

</div>
