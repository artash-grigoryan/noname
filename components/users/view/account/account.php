<div id="account-page" class="bs-docs-section">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-12">
                <h1><?=(User::getIdentity()->id == $this->_user->id) ? 'My account' : $this->_user->first_name. ' ' .$this->_user->last_name; ?></h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">

            <div id="account-info" class="bs-component">
                <h2>General information</h2>
                <div class="jumbotron">
                    <div class="profile_picture">
                        <? if(file_exists(ABS_PATH.'template/default/images/profile/'.Utils::hashStr($this->_user->id).'.png')) : ?>
                            <img src="<?=PATH.'template/default/images/profile/'.Utils::hashStr($this->_user->id).'.png'?>" alt="profile picture" />
                        <? elseif(!empty($this->_fbUserPicture)) : ?>
                            <img src="<?=$this->_fbUserPicture?>" alt="profile picture" />
                        <? else : ?>
                            <img src="<?=PATH?>template/default/images/male_unknown.png" alt="profile picture" />
                        <? endif; ?>
                        <? if(User::getIdentity()->id == $this->_user->id) : ?>
                            <a id="update_picture_link" class="btn btn-primary btn-xs" href="<?=PATH?>users/updatePhoto/?form=1">Update</a>
                        <? endif; ?>
                    </div>
                    <h3><?=$this->_user->first_name?> <?=$this->_user->last_name?></h3>
                    <div class="cmp_info mail">
                        <p>
                            <?=(!empty($this->_user->mail))?'<a href="mailto:'.$this->_user->mail.'">'.$this->_user->mail.'</a>':''?><br/>
                            <?=(!empty($this->_user->phone))?'<a href="tel:'.$this->_user->phone.'">'.$this->_user->phone.'</a>':''?>
                        </p>
                    </div>
                    <div class="cmp_info address">
                        <p>
                            <?=(!empty($this->_user->street))?$this->_user->street.',':''?><br/>
                            <?=(!empty($this->_user->zip))?$this->_user->zip:''?> <?=(!empty($this->_user->city))?$this->_user->city.',':''?> <?=(!empty($this->_user->country))?$this->_user->country:''?>
                        </p>
                    </div>
                    <? if((User::getIdentity()->id == $this->_user->id) || (Auth::hasAuth(ADMIN))) : ?>
                        <a id="update_info_link" class="btn btn-primary" href="<?=PATH?>users/updateInfo/?id=<?=$this->_user->id?>&form=1">Update</a>
                    <? endif; ?>
                </div>
            </div>

        </div>
    </div>
</div>
