<div id="partners-page" class="bs-docs-section">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-12">
                <h1>Mes partenaires</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">

            <div class="well bs-component">
                <h2>Liste de mes partenaires</h2>
                <ul class="partners_list">
                    <li id="user_<?=$this->_user->id?>">
                        <a class="user_name" href="<?=PATH?>users/account/"><?=$this->_user->first_name . ' ' . $this->_user->last_name?></a>
                        <ul id="original_tree" class="tree">
                            <?php if(Auth::hasAuth(ADMIN)):?>
                                <li class="new_user_link">
                                    <a href="<?=PATH?>users/addPartner/?parentId=<?=$this->_user->id ?>&form=1">Ajouter un partenaire</a>
                                </li>
                            <?endif;?>
                        </ul>
                    </li>
                    <?php if(Auth::hasAuth(ADMIN)):?>
                        <li class="new_user_link">
                            <a href="<?=PATH?>users/addPartner/?parentId=0">Ajouter un partenaire</a>
                        </li>
                    <?endif;?>
                </ul>
            </div>

        </div>
    </div>
</div>