<!DOCTYPE HTML>

<html lang="fr">
    <head>
        
        <?=$this->getTitle()?>
        <meta charset="UTF-8" />
        <?=$this->getMetas()?>
        
        <?=$this->getLinks()?>
        
        <script type="text/javascript">
            domain      = '<?=DOM_NAME?>';
            path        = '<?=PATH?>';
            base_path   = '<?=BASE_PATH?>';
            currentPath = '<?=CURRENT_PATH?>';
            mobile      = '<?=Utils::isMobile()?>';
            exception   = <?=!empty($this->_exception)?$this->_exception:'false'?>;
        </script>
        <?=$this->getScripts()?>
        <? Utils::loadGoogleAnalytics('UA-46326421-1') ?>
        
        <!--[if lte IE 9]><link rel="stylesheet" href="<?=PATH?>template/default/css/ie9.css" /><![endif]-->
        <!--[if lte IE 8]><link rel="stylesheet" href="<?=PATH?>template/default/css/ie8.css" /><![endif]-->
    
    </head>
    <body>
        <? //Utils::loadFbSync('fr_FR') ?>

        <!-- Header -->
        <div id="header" class="navbar navbar-default">

            <? Controller::loadComponent('menu', 'index'); ?>

        </div>

        <!-- Main -->
        <div id="main" class="container">

            <? $this->loadView(); ?>

        </div>

        <!-- Footer -->
        <footer>
            <? Controller::loadComponent('footer'); ?>
        </footer>

    </body>
</html>