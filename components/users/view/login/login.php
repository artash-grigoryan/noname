<div class="loginbox">
    <h2>Authentification</h2>
    <div id="message_info_block"> </div>
    <? if($this->_params['facebook']): ?>
        <? Controller::loadComponent('users', 'fbLogin', $this->_params);?>
    <? endif; ?>
    
    <? if($this->_params['e-mail']): ?>
        <form id="loginform" name='loginform' action="<?=BASE_PATH?>users/login/" method="post" data-ajax="false">
            <p>
                <label>E-Mail* :</label> <br />
                <input type="email" name='mail' id="mail" class="text mandatory" value="nicolas.cramail@gmail.com" data-role="none" />
            </p>
            <p>
                <label>Mot de Passe* :</label> <a href="javascript:forgotPwd();" id="forgot_pwd" data-ajax="false">Mot de passe oublié</a> <br />
                <input type="password" name='password' id="password" class="text mandatory" value="admin" />
            </p>

            <div class="formend">
                <input type="submit" name='log_but' class="submit" value="login" data-role="none"/> 
                <div class="options_form">
                    <input type="checkbox" class="checkbox" name="rememberme" value="1" checked="checked" id="rememberme" /> <label for="rememberme">Se souvenir de moi</label>
                    <? if($this->_params['registration']): ?>
                        <a href="/auth/registration/?<?=Controller::setHtmlParams(array('facebook'=>true,'redirect_uri'=>BASE_PATH.'?page=2'))?>">Inscription</a>
                    <? endif; ?>
                </div>
            </div>
        </form>
    <? endif; ?>
</div>