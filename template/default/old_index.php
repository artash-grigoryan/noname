<!doctype html>
<html lang="fr">
    <head>
        <?=$this->getTitle()?>
        
        <meta charset="UTF-8" />
        <?=$this->getMetas()?>
        
        <?=$this->getLinks()?>
        
        <script type="text/javascript">
            domain      = '<?=DOM_NAME?>';
            path        = '<?=PATH?>';
            currentPath = '<?=CURRENT_PATH?>';
            exception   = <?=!empty($this->_exception)?$this->_exception:'false'?>;
        </script>
        <?=$this->getScripts()?>
        <? Utils::loadGoogleAnalytics('UA-46326421-1') ?>
    </head>

    <body>
        <? Utils::loadFbSync('fr_FR') ?>
        
        <header>
            <? Controller::loadComponent('title'); ?>
        </header>		<!-- #header ends -->

        <div id="container">
            <? Controller::loadComponent('sound'); ?>
            <aside>
                <? Controller::loadComponent('menu'); ?>
            </aside>
            <section id="content">
                <? Controller::loadComponent('users', 'welcome'); ?>
                <h2 id="page-title"><?=$this->_title?></h2>
                <? $this->loadView(); ?>
            </section>
        </div>
        <? Controller::loadComponent('menu', 'slider'); ?>
        <div id="overlay"></div>
        <div id="content-overlay"></div>
        
        <footer>
            <? //Controller::loadComponentFile('footer'); ?>
        </footer>
    </body>
</html>