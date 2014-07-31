<div class="welcome">
    
    <? if(User::hasIdentity()): ?>
    
        <div id="logo">
            <a href="<?=PATH?>users/account/">
                <span class="image"><img src="<?=file_exists(WEBSITE_ABS_PATH.'template/default/images/profile/'.Utils::hashStr($this->_user->id).'.png')?(WEBSITE_PATH.'template/default/images/profile/'.Utils::hashStr($this->_user->id).'.png'):(!empty($this->_fbUserPicture)?$this->_fbUserPicture:PATH.'template/default/images/male50x50.png')?>" alt="profile picture" /></span>
                <h1 id="title"><?=$this->_user->first_name?> <?=$this->_user->last_name?></h1>
            </a>
            <span class="byline"><a href="<?=PATH?>users/logout/?<?=Controller::setHtmlParams(array('redirect_uri'=>WEBSITE_PATH))?>">Logout</a></span>
        </div>
        
    <? else: ?>
    
        <div id="logo">
            <span class="image"><img src="<?=PATH?>template/default/images/male50x50.png" alt="" /></span>
            <h1 id="title">New user ?</h1>
            <span class="byline"><a href="<?=PATH?>">Connexion</a></span>
        </div>
    
    <? endif; ?>
    
</div>
