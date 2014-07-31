<!doctype html>
<html lang="fr">
    <head>
        <?=$this->getTitle()?>
        
        <meta charset="UTF-8" />
        <?=$this->getMetas()?>
        
        <?=$this->getLinks()?>
        <link type="text/css" rel="stylesheet" href="<?=PATH?>template/exception/css/style.css"/>
        <link type="text/css" rel="stylesheet" href="<?=COM_PATH?>home/view/css/exception.css"/>
        
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
        <?/* Utils::loadFbSync('fr_FR') */?>
        
        <header>
                <? Controller::loadComponentFile('title'); ?>
        </header>		<!-- #header ends -->

        <div id="container" class="exception">
            <section id="content">
                <? Controller::loadComponent('home', 'exception'); ?>
                <? $this->loadView(); ?>
            </section>
        </div>
        <div id="overlay"></div>
        <div id="content-overlay"></div>
        
        <footer>
            <? /* Controller::loadComponentFile('footer'); */?>
        </footer>
    </body>
</html>