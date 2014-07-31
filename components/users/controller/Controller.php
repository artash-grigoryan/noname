<?php

class UsersController  extends Controller  {
    
    public function welcome ()
    {
        $this->_View->disableTemplate();
        $this->_View->_user = User::getIdentity();
        
        if(!empty($this->_View->_user->fbid)) {
            $this->_View->_fbUserPicture = $this->_Model->getFbUserProfilePicture($this->_View->_user->fbid);
        }
    }
    
    /*
     * Login Check & Form
     * 
     * Params :
     *      facebook        : 1 if you want a facebook auth, 0 else
     *      e-mail          : 1 if you want a mail auth,     0 else
     *      redirect_uri  : the redirection after the authentification by the user
     * 
     * The login function check the connexion for first and redirect relatively to the response
     * 
     * It can be called with ajax and php
     */
    
    function login($params = array('facebook' => true, 'e-mail' => true, 'redirect_uri' => CURRENT_PATH, 'registration' => false, 'necessary_auth' => ADMIN))
    {
        if(self::getMode() == 'ajax') {
            $this->_View->disableTemplate();
        }
        $params['facebook']     = !isset($params['facebook'])    ? true         : $params['facebook'];
        $params['e-mail']       = !isset($params['e-mail'])      ? true         : $params['e-mail'];
        $params['redirect_uri'] = !isset($params['redirect_uri'])? CURRENT_PATH : urldecode($params['redirect_uri']);
        $params['registration'] = !isset($params['registration'])? false        : $params['registration'];
      
        $Auth = new Auth($params);
        try {
            if($Auth->checkUserValidation()) {
                if($Auth->hasAuth($params['necessary_auth'])) {
                    if(self::getMode() == 'ajax') {
                        exit('Connexion réussie <script type="text/javascript">top.location.href="'.$params['redirect_uri'].'"</script>');
                    }
                    else {
                        header('Location: '.$params['redirect_uri']);
                    }
                }
                else {
                    $this->_View->_err_mess = 'Vous n\'avez pas les droits nécessaires pour acceder à cette page';
                    $Auth->logout();
                }
            }
        }
        catch (SException $e)
        {
            if(self::getMode() == 'ajax') {
                exit( $e->getTranslate() );
            }
            else {
                $this->_View->_err_mess = $e->getTranslate();
            }
        }
        $this->_View->_params = $params;
    }
    
    /*
     * Login Check & Form
     * 
     * Params :
     *      facebook        : 1 if you want a facebook auth, 0 else
     *      e-mail          : 1 if you want a mail auth,     0 else
     *      redirect_uri  : the redirection after the authentification by the user
     * 
     * The login function check the connexion for first and redirect relatively to the response
     * 
     * It can be called with ajax and php
     */
    
    function lockedLoginForm($params = array('facebook' => true, 'e-mail' => true, 'redirect_uri' => PATH, 'registration' => false, 'necessary_auth' => CLIENT))
    {
        $this->_View->setTemplate(ABS_PATH.'template/exception/');

        $params['facebook']     = !isset($params['facebook'])    ? true         : $params['facebook'];
        $params['e-mail']       = !isset($params['e-mail'])      ? true         : $params['e-mail'];
        $params['redirect_uri'] = !isset($params['redirect_uri'])? CURRENT_PATH : urldecode($params['redirect_uri']);
        $params['registration'] = !isset($params['registration'])? false        : $params['registration'];

        $Auth = new Auth($params);
        try {
            if($Auth->checkUserValidation()) {
                if($Auth->hasAuth($params['necessary_auth'])) {
                    self::loadComponent('mail', 'newCustomerConnexion');
                    if(User::getIdentity()->fbid) {
                        $this->_Model->sendFbNotification(User::getIdentity()->fbid, 'Nouvelle connexion à votre espace client');
                    }
                    if(self::getMode() == 'ajax') {
                        exit('Connexion réussie <script type="text/javascript">top.location.href="'.$params['redirect_uri'].'"</script>');
                    }
                    else {
                        self::loadComponent('notification', 'success', 'Bienvenue dans votre espace');
                        header('Location: '.$params['redirect_uri']);
                    }
                }
                else {
                    self::loadComponent('notification', 'info', 'Vous n\'avez pas les droits nécessaires pour acceder à cette page');
                    //$Auth->logout();
                }
            }
        }
        catch (SException $e)
        {
            if(self::getMode() == 'ajax') {
                exit( $e->getTranslate() );
            }
            else {
                self::loadComponent('notification', 'error', $e->getTranslate());
                header('Location: '.PATH);
            }
        }
        $this->_View->_params = $params;
    }
    
    
    function fbLogin($params = array('registration'=>false, 'redirect_uri'=>PATH))
    {
        $this->_View->disableTemplate();
        
        $urlParsed = parse_url($params['redirect_uri']);
        $urlParsed['scheme'] = !empty($urlParsed['scheme']) ? $urlParsed['scheme']  : '';
        $urlParsed['host']   = !empty($urlParsed['host'])   ? $urlParsed['host']    : '';
        $urlParsed['path']   = !empty($urlParsed['path'])   ? $urlParsed['path']    : '';
        $urlParsed['query']  = !empty($urlParsed['query'])  ? $urlParsed['query']   : '';
        if($params['registration']) {
            $params['facebook_redirect_uri'] = PATH.'users/registration?method=submitFacebook&facebookRegistration=1&' . self::setHtmlParams(array('redirect_uri'=>$params['redirect_uri']));
        }
        else {
            $params['facebook_redirect_uri'] = $urlParsed['scheme'].'://'.$urlParsed['host'].$urlParsed['path'].'?'.$urlParsed['query'].(!empty($urlParsed['query'])?'&':'').'facebookRegistration=1';
        }
        
        $this->_View->_fbActive = $this->_Model->getFbUser();
        
        if(!empty($this->_View->_fbActive))
        {
            $this->_View->_fbUserPicture = $this->_Model->getFbUserProfilePicture($this->_View->_fbActive);
            $this->_View->_fbUserName = $this->_Model->getFbUserName($this->_View->_fbActive);
        }
        $this->_View->_fbLoginUrl = $this->_Model->getFbLoginUrl($params['facebook_redirect_uri']);
    }
    
    
    /*
     * Registration
     * 
     * User Registation form and submit
     * 
     * Params :
     *      facebook        : 1 if you want a facebook registration, 0 else
     *      e-mail          : 1 if you want a mail registration,     0 else
     *      redirect_uri  : the redirection after the registration by the user
     * 
     * NEW_USER_AUTH need to be declared in configs
     * This function show the form and registrate the user after send a email
     * Auth = 2 by default
     * 
     * It can be called with ajax and php
     */

    function registration($params = array('facebook' => true, 'e-mail' => true, 'redirect_uri' => PATH))
    {
        $this->_View->setTemplate(ABS_PATH.'template/exception/');
        if(!defined('NEW_USER_AUTH')) {
            throw new Exception('UsersController::registration -> NEW_USER_AUTH need to be declared in configs');
        }
        
        $params['facebook']     = !isset($params['facebook'])    ? false         : $params['facebook'];
        $params['e-mail']       = !isset($params['e-mail'])      ? true          : $params['e-mail'];
        $params['redirect_uri'] = !isset($params['redirect_uri'])? PATH          : urldecode($params['redirect_uri']);

        $urlParsed = parse_url($params['redirect_uri']);
        $urlParsed['scheme'] = !empty($urlParsed['scheme']) ? $urlParsed['scheme']  : '';
        $urlParsed['host']   = !empty($urlParsed['host'])   ? $urlParsed['host']    : '';
        $urlParsed['path']   = !empty($urlParsed['path'])   ? $urlParsed['path']    : '';
        $urlParsed['query']  = !empty($urlParsed['query'])  ? $urlParsed['query']   : '';
        
        $params['redirect_uri'] = $urlParsed['scheme'].'://'.$urlParsed['host'].$urlParsed['path'].'?'.$urlParsed['query'];
        
        $Auth = new Auth($params);
        
        $user = array();
        switch (Controller::getVars('method', false)) 
        {
            case 'submitMail':
                
                $user['mail']             = $this->_View->_mail       = self::getVars('mail'      , false);
                $user['first_name']       = $this->_View->_first_name = self::getVars('first_name', false);
                $user['last_name']        = $this->_View->_last_name  = self::getVars('last_name' , false);
                $user['password']         = self::getVars('password'  , false);
                $password_confirm         = self::getVars('password_confirm'  , false);
                $user['active']           = 1;
                $user['auth']             = NEW_USER_AUTH;
                $user['pwd_token']        = sha1(uniqid(rand(0,100)));
        
                if(Controller::hasEmptyValues($user))
                {
                    self::loadComponent('notification', 'error', 'Vous devez remplir tous les champs obligatoires');
                }
                elseif($user['password'] != $password_confirm)
                {
                    self::loadComponent('notification', 'error', 'Les mots de passe sont différents');
                }
                else
                {
                    try 
                    {
                        $user['password'] = Utils::hashStr($user['password']);
                        $User = $Auth->registration($user, true);
                        if(!empty($User)) {
                            //$User->activate();

                            self::sendMailConfirmation($User->id);

                            if(self::getMode() == 'ajax') {
                                exit('<script type="text/javascript">top.location.href="'.$params['redirect_uri'].'";</script>');
                            }
                            else {
                                header('Location:'.$params['redirect_uri']);
                            }
                        }
                        else {
                            self::loadComponent('notification', 'error', 'Une erreur est survenue, veuillez nous contacter via '.MAIL_FROM);
                        }
                    }
                    catch (SException $e) 
                    {
                        self::loadComponent('notification', 'error', $e->getTranslate());
                    }
                }
                
                break;
            case 'submitFacebook':
                
                $Auth = new Auth($params);
                try 
                {
                    $Auth->checkUserValidation();
                    $this->_Model->sendFbNotification(User::getIdentity()->fbid, 'Nouvelle connexion à votre espace client');
                    
                    self::loadComponent('notification', 'success', 'Bienvenue<br />'.User::getIdentity()->first_name.' '.User::getIdentity()->last_name);
                    header('Location:'.$params['redirect_uri']);
                }
                catch (Exception $e) 
                {
                    $userInfo = $this->_Model->getFbUserInfo();

                    if(empty($userInfo))
                    {
                        self::loadComponent('notification', 'info', 'Vous n\'êtes pas connecté avec Facebook');
                        header('Location:'.PATH);
                    }
                    else
                    {
                        $user = array();
                        $user['auth']       = NEW_USER_AUTH;
                        $user['active']     = 1;
                        $user['fbid']       = $userInfo['id'];
                        $user['mail']       = $userInfo['email'];
                        $user['first_name'] = $userInfo['first_name'];
                        $user['last_name']  = $userInfo['last_name'];
                        $user['gender']     = $userInfo['gender'];

                        try 
                        {
                            $User = $Auth->registration($user, true);
                            //$User->activate();

                            $this->_Model->sendFbNotification($User->fbid, 'Bienvenue');
                            self::loadComponent('notification', 'success', 'Bienvenue '.$User->first_name.' '.$User->last_name);
                            
                            header('Location:'.$params['redirect_uri']);
                        }
                        catch (SException $e) 
                        {
                            if($e->getCode() == 23000) {
                                try {
                                    $User = User::getUserByMail($user['mail']);
                                    $User->fbSync($user['fbid']);
                                    $User->activate();
                                }
                                catch(SException $e) {
                                    self::loadComponent('notification', 'error', $e->getTranslate());
                                }
                            }
                            else {
                                self::loadComponent('notification', 'error', $e->getTranslate());
                            }
                            header('Location:'.PATH);
                        }
                    }
                }
                break;
        }
        $this->_View->_params = $params;
    }

    function partners() {

        $this->_View->_user = User::getIdentity();
    }

    function getPartnerChildren() {

        $this->_View->disableView();
        exit(json_encode(
            array(
                'admin'  => Auth::hasAuth(ADMIN),
                'children' => $this->_Model->getChildren(self::getVars('parentId', User::getIdentity()->id)))
            )
        );

    }

    function addPartner() {

        $this->_View->parentId = self::getVars('parentId');

        if(self::getVars('submit', false)) {

            $user = array();
            $user['mail']       = self::getVars('mail', false);
            $user['first_name'] = self::getVars('first_name', false);
            $user['last_name']  = self::getVars('last_name', false);
            if(!self::hasEmptyValues($user)) {

                $user['street']     = self::getVars('street', false);
                $user['zip']        = self::getVars('zip', false);
                $user['city']       = self::getVars('city', false);
                $user['country']    = self::getVars('country', false);
                $user['phone']      = self::getVars('phone', false);
                $user['parent_id']  = self::getVars('parentId', false);
                $user['level']      = User::getUser($user['parent_id'])->level + 1;
                $user['pwd_token']  = sha1(uniqid(rand(0,100)));
                $user['auth']       = CLIENT;

                try {

                    $this->_View->_user  = new User($user);
                    $this->_View->_user->insert();
                    self::loadComponent('notification', 'success', 'Le partenaire à bien été inséré');
                    self::loadComponent('mail', 'sendMailNewPartner', array('mail'=>$this->_View->_user->mail, 'user_name'=>$this->_View->_user->first_name . ' ' . $this->_View->_user->last_name, 'token'=>$this->_View->_user->pwd_token));
                    header('Location:'.PATH.'users/partners/');
                }
                catch(Exception $e) {
                    self::loadComponent('notification', 'error', 'Veuillez vérifier tous les champs et recommencer');
                }
            }
            else {
                self::loadComponent('notification', 'error', 'Veuillez remplir tous les champs marqués d\'une étoile');
            }
        }
    }

    /*
     * SendMailConfirmation
     */

    function sendMailConfirmation($_id = false) {

        $this->_View->setTemplate(ABS_PATH.'template/exception/');

        try {

            if(!empty($_id)) {

                $_User = User::getUser($_id);
            }
            else {

                User::reload();
                $_User = User::getIdentity();
            }

            if(empty($_User->pwd_token)) {
                $_User->pwd_token = sha1(uniqid(rand(0,100)));
                $_User->setToken($_User->pwd_token);
            }

            if(empty($_User->verified)) {
                self::loadComponent('mail', 'sendMailConfirmation', array('mail'=>$_User->mail, 'user_name'=>$_User->first_name . ' ' . $_User->last_name, 'token'=>$_User->pwd_token));
                self::loadComponent('notification', 'success', 'Un E-mail contenant un lien de vérification vient d\'être envoyé à l\'adresse '.$_User->mail);
            }
            else {
                self::loadComponent('notification', 'info', 'Votre E-mail a déjà été vérifié.');
            }
        }
        catch (Exception $e) {

            self::loadComponent('notification', 'error', 'Une erreur s\'est produite, veuillez-vous reconnecter');
        }
    }

    /*
     * Logout
     * 
     * Logout of all sessions facebook and mail actives
     * 
     * Params :
     *      facebook     : to force the loggout on facebook even if the user is not synchronized
     *      redirect_uri : the redirection after the logout by the user
     */
    
    function logout( $params = array('redirect_uri'=>PATH) )
    {	
        Auth::logout();
        $this->_View->_redirect_uri = $params['redirect_uri'];
        if(Controller::getVars('facebook', false))
        {
            $this->_View->disableTemplate();
            $this->_View->_fbAppId = $this->_Model->getFbAppId();
            $this->_View->setAction('logoutFb');
            //$this->_View->display();
        }
        else
        {
            header("Location:".$params['redirect_uri']);
        }
    }
    
    /*
     * Forgot Password
     * 
     * Send an email to the user with a token 
     */
    
    function forgotPassword()
    {
        $this->_View->setTemplate(ABS_PATH.'template/exception/');

        $mail = Controller::getVars('mail', false);
        if(!empty($mail) && !User::hasIdentity()) {
            try {
                if(User::hasIdentity()) {
                    $user = User::getIdentity();
                    $mail = $user->mail;
                }
                else {
                    $user = User::getUserByMail($mail);
                }
                $token = sha1(uniqid($user->id));
                $user->setToken($token);

                self::loadComponent('mail', 'forgotPassword', array('user_to' => $user->id, 'token' => $token));

                self::loadComponent('notification', 'success', 'Un E-Mail viens d\'être envoyé à ' . $mail);
                header('Location:'.PATH);
            }
            catch (Exception $e)
            {
                self::loadComponent('notification', 'info', 'Cet E-Mail n\'est pas répertorié sur le site');
            }
        }
    }

    /*
     * Reset Password 
     * 
     * Verifie the email and token and purpose an reset formular
     */
    function resetPassword()
    {
        $this->_View->setTemplate(ABS_PATH.'template/exception/');

        $this->_View->_mail             = Controller::getVars('mail', false);
        $this->_View->_token            = Controller::getVars('token', false);

        if(self::getVars('mailSubmit', false)) {
            $this->_View->_password         = Controller::getVars('newpassword', false);
            $this->_View->_password_confirm = Controller::getVars('newpassword_confirm', false);

            try {
                $user = User::getUserByMailToken($this->_View->_mail, $this->_View->_token);
                if(!empty($this->_View->_password) && !empty($this->_View->_password_confirm))
                {
                    if($this->_View->_password == $this->_View->_password_confirm)
                    {
                        if($user->setPassword($this->_View->_password))
                        {
                            self::loadComponent('notification', 'success', 'Le mot de passe à été modifié');
                            $user->activate();
                            $user->setToken(NULL);
                            $user->setMailVerified();
                            header('Location:'.PATH);
                        }
                    }
                    else
                    {
                        self::loadComponent('notification', 'info', 'Les mots de passe sont différents');
                        header('Location:'.PATH.'users/resetPassword/?mail='.$this->_View->_mail.'&token='.$this->_View->_token);
                    }
                }
                else
                {
                    self::loadComponent('notification', 'info', 'Veuillez saisir tous les champs');
                    header('Location:'.PATH.'users/resetPassword/?mail='.$this->_View->_mail.'&token='.$this->_View->_token);
                }
            }
            catch (Exception $e) {
                self::loadComponent('notification', 'error', 'Vous n\'avez pas les autorisations nécessaires');
                header('Location:'.PATH.'users/resetPassword/?mail='.$this->_View->_mail.'&token='.$this->_View->_token);
            }
        }
    }

    function resetPasswordForm() {

        $this->_View->disableTemplate();
        $this->_View->_mail             = Controller::getVars('mail', false);
        $this->_View->_token            = Controller::getVars('token', false);
    }
    
    function confirmMail()
    {
        $this->_View->setTemplate(ABS_PATH.'template/exception/');

        $mail = Controller::getVars('mail', false);
        $token = Controller::getVars('token', false);
                
        try {

            $user = User::getUserByMailToken($mail, $token);
            $user->setToken(NULL);
            $user->setMailVerified();
            self::loadComponent('notification', 'success', 'Votre E-mail '.$user->mail.' a bien été vérifié.');
        }
        catch(SException $e) {

            try {

                if(!empty(User::getUserByMail($mail)->verified)) {
                    self::loadComponent('notification', 'info', 'Votre E-mail a déjà été vérifié.');
                }
                else {
                    throw new Exception();
                }
            }
            catch (Exception $e) {

                self::loadComponent('notification', 'error', 'l\'E-mail ne peux pas être vérifié.');
            }
        }
    }
    
    function account()
    {
        if(self::getVars('id', false)) {

            if($this->_Model->isInTree(self::getVars('id', false)) || Auth::hasAuth(ADMIN)) {
                $this->_View->_user = User::getUser(self::getVars('id'));
            }
            else {
                self::loadComponent('notification', 'info', 'Vous n\'avez pas les droits suffisants pour accéder à cette page');
                header('Location:'.PATH);
            }
        }
        else {

            User::reload();
            $this->_View->_user = User::getIdentity();
        }

        $this->_View->setTitle($this->_View->_user->first_name. ' ' .$this->_View->_user->last_name);
        if(!empty($this->_View->_user->fbid)) {
            $this->_View->_fbUserPicture = $this->_Model->getFbUserProfilePicture($this->_View->_user->fbid);
        }
    }

    function activeAccount() {

        $mail = self::getVars('mail', false);

        if(!empty($mail)) {
            try {
                $this->_View->_user = User::getUserByMail($mail);
                $this->_View->setTemplate(ABS_PATH.'template/exception/');
            }
            catch(Exception $e) {
                self::loadComponent('notification', 'error', 'Un problème est survenu, <a href="mailto:'.MAIL_FROM.'">veuillez contacter l\'administrateur du site</a>  ');
            }
        }
        else {
            self::loadComponent('notification', 'error', 'Un problème est survenu, <a href="mailto:'.MAIL_FROM.'">veuillez contacter l\'administrateur du site</a>  ');
        }

    }
    
    function updatePhoto()
    {
        $this->_View->setTitle('Photo de profil');

        $dirName = WEBSITE_ABS_PATH.'template/default/images/profile/';
        $imageName = Utils::hashStr(User::getIdentity()->id).'.png';
        $fullName = $dirName . $imageName;
        $fullThumbnailName = $dirName .'thumbnail/'. $imageName;

        switch (self::getVars('action_file')) {
            
            case 'save':

                // saveProfilePicture()

                $imageData = $_POST['imageData'];

                $this->_Model->saveCameraImg($imageData, $fullName);
                if(!Utils::fctredimimage(400, 300, $dirName, $imageName, $dirName, $imageName)) {
                    self::loadComponent('notification', 'error', 'L\'image doit être supérieur à 400x300');
                }
                else {
                    Utils::fctredimimage(1200, 50, $dirName.'thumbnail/', $imageName, $dirName, $imageName);
                    $this->_Model->redimProfilePicture($fullThumbnailName, $fullThumbnailName);
                }
                exit(1);

                break;

            case 'upload':
                
                // uploadProfilePicture()

                $this->_Model->saveUploadImg($_FILES['profilePicture'], $fullName);
                if(!Utils::fctredimimage(400, 300, $dirName, $imageName, $dirName, $imageName)) {
                    self::loadComponent('notification', 'error', 'L\'image doit être supérieur à 400x300');
                }
                else {
                    Utils::fctredimimage(1200, 50, $dirName.'thumbnail/', $imageName, $dirName, $imageName);
                    $this->_Model->redimProfilePicture($fullThumbnailName, $fullThumbnailName);
                }

                header('Location: '.PATH.'users/account/');

                break;
            
            case 'delete':
                
                // deleteProfilePicture()

                $this->_Model->deleteImg($fullName);

                header('Location: '.PATH.'users/account/');

                break;
        }
    }

    function updateInfo()
    {
        if(self::getVars('id', false)) {

            if((User::getIdentity()->id == self::getVars('id', false)) || Auth::hasAuth(ADMIN)) {
                $this->_View->_user = User::getUser(self::getVars('id'));
            }
            else {
                self::loadComponent('notification', 'info', 'Vous n\'avez pas les droits suffisants pour accéder à cette page');
                header('Location:'.PATH);
            }
        }
        else {

            User::reload();
            $this->_View->_user = User::getIdentity();
        }

        if(self::getMode()=='ajax') {
            $this->_View->disableTemplate();
        }

        if(self::getVars('submit')) {
            $userInfo = array();
            if(!Controller::getVars('password', false)) {
                $this->_View->_user->first_name = $userInfo['first_name'] = self::getVars('first_name');
                $this->_View->_user->last_name = $userInfo['last_name']  = self::getVars('last_name');
                if(!self::hasEmptyValues($userInfo)) {
                    $this->_View->_user->street  = $userInfo['street']  = self::getVars('street');
                    $this->_View->_user->zip     = $userInfo['zip']     = self::getVars('zip');
                    $this->_View->_user->city    = $userInfo['city']    = self::getVars('city');
                    $this->_View->_user->country = $userInfo['country'] = self::getVars('country');
                    $this->_View->_user->phone   = $userInfo['phone']   = self::getVars('phone');
                    $this->_Model->update('users', $userInfo, array('id'=>$this->_View->_user->id));
                    self::loadComponent('notification', 'success', 'Les modifications ont bien été prises en compte');
                    header('Location:'.PATH.'users/account/?id='.$this->_View->_user->id);
                }
                else {
                    self::loadComponent('notification', 'error', 'Veuillez remplir tous les champs marqués d\'une étoile');
                }
            }
            else {
                $old_password = self::getVars('old_password');
                if(Utils::hashStr($old_password) == $this->_View->_user->password) {
                    $new_password = self::getVars('new_password');
                    $new_password2 = self::getVars('new_password2');
                    if($new_password == $new_password2) {
                        $this->_Model->update('users', array('password'=>Utils::hashStr($new_password)), array('id'=>$this->_View->_user->id));
                        self::loadComponent('notification', 'success', 'Le mot de passe a bien été modifié');
                        header('Location:'.PATH.'users/account/?id='.$this->_View->_user->id);
                    }
                    else {
                        self::loadComponent('notification', 'error', 'Les mots de passe sont différents');
                    }
                }
                else {
                    self::loadComponent('notification', 'error', 'Le mot de passe n\'est pas valide <a class="forgot_password" onclick="forgotPasswordAccount(this);return false;" href="'.PATH.'users/forgotPassword/">Mot de passe oublié ?</a>');
                }
            }
        }
        
    }

    function deletePartner() {

        $this->_View->disableView();

        if(Auth::hasAuth(ADMIN)) {
            $userId = self::getVars('id', false);
            if(!empty($userId)) {
                if($this->_Model->deletePartner($userId)) {
                    self::loadComponent('notification', 'success', 'Cet utilisateur à bien été supprimé');
                    header('Location:'.PATH.'users/partners/');
                    return;
                }
            }
            self::loadComponent('notification', 'error', 'Un problème est survenu, veuillez réessayer');
        }
        else {
            self::loadComponent('notification', 'error', 'Vous n\'avez pas les droits nécessaires pour effectuer cette action');
        }
        header('Location:'.PATH.'users/partners/');
    }
    
    function sessionsActives()
    {
        if(self::getMode()=='ajax') {
            $this->_View->disableTemplate();
        }
        $this->_View->_sessions = $this->_Model->selectAll('sessions', array('user_id'=>User::getIdentity()->id, 'active'=>1), array('date'=>'DESC'));
    }
    
    function deleteSession()
    {
        $success = User::getIdentity()->disableSession(self::getVars('sessionId'));
        if(self::getMode()=='ajax') {
            exit($success);
        }
        else {
            header('Location:'.PATH.'users/account/');
        }
    }
}
?>
