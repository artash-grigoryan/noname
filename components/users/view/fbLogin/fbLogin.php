
<div id="fb_login_block">
    <img class="logo_title" alt="facebook" src="<?=USERS_PATH?>view/images/facebook_01.png" />
    <a id="login_button" href="<?=$this->_fbLoginUrl?>" >
        <img src="<?=USERS_PATH?>view/images/fb-connect.png" alt="connexion" title="Connexion" />
    </a>
        <?if($this->_fbActive):?>
            <div id="fb_user_block">
                <img class="user_picture" src="<?=$this->_fbUserPicture?>">
                <div id="sync_action">
                    <?=$this->_fbUserName?>
                </div>
                <a id="logout_button" href="<?=PATH?>users/logout/?facebook=1&redirect_uri=<?=CURRENT_PATH?>" class="logout">
                    Ce n'est pas vous ?
                </a>
            </div>
        <? endif; ?>
</div>