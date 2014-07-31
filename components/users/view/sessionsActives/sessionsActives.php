<div id="account-page" class="bs-docs-section">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-12">
                <h1>Mon compte</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div id="sessions-info" class="bs-component">
                <h2>Mes sessions actives</h2>
                <div id="sessions_actives">
                    <? foreach ($this->_sessions as $session) : ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="last_log session_block">
                                    <span>Dernier accès :</span> <?=date('d-m-Y à H:i', strtotime($session['date']))?>
                                </div>
                                <a class="delete_session" href="<?=PATH?>users/deleteSession/?sessionId=<?=$session['session_id']?>">Arrêter l’activité</a>
                            </div>
                            <div class="panel-body">
                                <div class="localisation session_block">
                                    <span>Ip :</span> <?=$session['remote_addr']?> <a target="_blank" href="http://www.localiser-ip.com/?ip=<?=$session['remote_addr']?>">Localiser</a>
                                </div>
                                <div class="peripherique session_block">
                                    <span>Périphérique :</span> <?=$session['http_user_agent']?>
                                </div>
                            </div>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>