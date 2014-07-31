<?php

class FileUploadAjaxController  extends Controller  {
    
    protected $_options;
    protected $_View;

    function  __construct( $_option, $_action )
    {
        $this->_View = View::getInstance($_option, $_action);
        $this->_View->disableTemplate();
        
        $this->_options = array(
            'actionFile' => 'defaultActionFile',
            'script_url' => FILEUPLOADAJAX_PATH,
            'upload_dir' => FILEUPLOADAJAX_ABS_PATH.'files/',
            'upload_url' => FILEUPLOADAJAX_PATH.'files/',
            'user_dirs'  => false,
            'mkdir_mode' => 0755,
            'param_name' => 'files',
            // Set the following option to 'POST', if your server does not support
            // DELETE requests. This is a parameter sent to the client:
            'delete_type' => 'DELETE',
            'access_control_allow_origin' => '*',
            'access_control_allow_credentials' => false,
            'access_control_allow_methods' => array(
                'OPTIONS',
                'HEAD',
                'GET',
                'POST',
                'PUT',
                'PATCH',
                'DELETE'
            ),
            'access_control_allow_headers' => array(
                'Content-Type',
                'Content-Range',
                'Content-Disposition'
            ),
            // Enable to provide file downloads via GET requests to the PHP script:
            //     1. Set to 1 to download files via readfile method through PHP
            //     2. Set to 2 to send a X-Sendfile header for lighttpd/Apache
            //     3. Set to 3 to send a X-Accel-Redirect header for nginx
            // If set to 2 or 3, adjust the upload_url option to the base path of
            // the redirect parameter, e.g. '/files/'.
            'download_via_php' => false,
            // Read files in chunks to avoid memory limits when download_via_php
            // is enabled, set to 0 to disable chunked reading of files:
            'readfile_chunk_size' => 10 * 1024 * 1024, // 10 MiB
            // Defines which files can be displayed inline when downloaded:
            'inline_file_types' => '/\.(gif|jpe?g|png)$/i',
            // Defines which files (based on their names) are accepted for upload:
            'accept_file_types' => '/.+$/i',
            // The php.ini settings upload_max_filesize and post_max_size
            // take precedence over the following max_file_size setting:
            'max_file_size' => null,
            'min_file_size' => 1,
            // The maximum number of files for the upload directory:
            'max_number_of_files' => null,
            // Image resolution restrictions:
            'max_width' => null,
            'max_height' => null,
            'min_width' => 1,
            'min_height' => 1,
            // Set the following option to false to enable resumable uploads:
            'discard_aborted_uploads' => true,
            // Set to true to rotate images based on EXIF meta data, if available:
            'orient_image' => false,
            'image_versions' => array(
                // Uncomment the following version to restrict the size of
                // uploaded images:
                /*
                '' => array(
                    'max_width' => 1920,
                    'max_height' => 1200,
                    'jpeg_quality' => 95
                ),
                */
                // Uncomment the following to create medium sized images:
                /*
                'medium' => array(
                    'max_width' => 800,
                    'max_height' => 600,
                    'jpeg_quality' => 80
                ),
                */
                'thumbnail' => array(
                    // Uncomment the following to force the max
                    // dimensions and e.g. create square thumbnails:
                    //'crop' => true,
                    'max_width' => 80,
                    'max_height' => 80
                )
            )
        );
    }
    
    function init($params = array('view'=>'evolvedTheme1', 'action'=>'defaultActionFile'))
    {
        /*
         * List of views : 'evolvedTheme1', 'evolved', 'basic'
         */
        
        $this->_View->setAction($params['view']);
        $this->_View->_params = $params;
    }
    
    function defaultActionFile()
    {
        $this->_View->disableView();
        $this->_options['actionFile'] = 'defaultActionFile';
        new FileUploadAjaxModel($this->_options, true);
    }

    function forumFiles($params = array())
    {
        $this->_View->disableView();
        $forumId = $params['forum_id'];
        $this->_options['actionFile'] = 'forumFiles';
        $relPathName = PATH.'template/default/files/'.$forumId.'/';
        $absPathName = ABS_PATH.'template/default/files/'.$forumId.'/';

        $this->setDirectory($relPathName, $absPathName);

        $this->addResizeFolder('thumbnail_400x400', 400, 400);

        if(Controller::getVars('delete', false))
        {
            //DELETE
            self::loadModel('forum')->delete('forum_files',array('name'=> $this->getFileName().'.'.$this->getFileExtension()));
        }
        if(Controller::getVars('upload', false))
        {
            //UPLOAD
            if( !file_exists($absPathName) )
            {
                mkdir($absPathName, 0777);
            }

            $name = sha1($this->getFileName().rand(0, 99999)).'.'.$this->getFileExtension();
            $this->setFileName($name);

            self::loadModel('forum')->insert('forum_files',array('type'=>$this->getFileType(), 'forum_id'=>$forumId, 'name'=>$name));

        }
        new FileUploadAjaxModel($this->_options, true);
    }
    
    public function setDirectory($_relFileUrl, $_absFileUrl)
    {
        $this->_options['upload_dir'] = $_absFileUrl;
        $this->_options['upload_url'] = $_relFileUrl;
    }
    
    public function addResizeFolder($_name, $_maxWidth, $_maxHeight, $_jpegQuality = 80)
    {
        $this->_options['image_versions'][$_name] = array(  'max_width' => $_maxWidth,
                                                            'max_height' => $_maxHeight,
                                                            'jpeg_quality' => $_jpegQuality);
    }
    
    public function setMaxNumberOfFiles($_numberOfFiles)
    {
        $this->_options['max_number_of_files'] = $_numberOfFiles;
    }
    
    private function setFileName($_fileName)
    {
        $this->_options['fileName']  = $_fileName;
    }
    
    private function getFileName()
    {
        if(Controller::getVars('delete', false))
        {
            $fileFullName = Controller::getVars('file');
            
        }
        elseif(Controller::getVars('upload', false))
        {
            $fileFullName = $_FILES['files']['name'][0];
        } 
        else
        {
            return false;
        }
        $fileFullName = explode('.', $fileFullName);
        $fileName = $fileFullName[0];
        return $fileName;
    }
    
    private function getFileExtension()
    {
        if(Controller::getVars('delete', false))
        {
            $fileFullName = Controller::getVars('file');
            
        }
        elseif(Controller::getVars('upload', false))
        {
            $fileFullName = $_FILES['files']['name'][0];
        } 
        else
        {
            return false;
        }
        $fileFullName = explode('.', $fileFullName);
        $fileType = $fileFullName[1];
        return $fileType;
    }

    private function getFileType()
    {
        return $_FILES['files']['type'][0];
    }
    
    private function getFileFullName()
    {
        if(Controller::getVars('delete', false))
        {
            return $fileFullName = Controller::getVars('file');
            
        }
        elseif(Controller::getVars('upload', false))
        {
            return $fileFullName = $_FILES['files']['name'][0];
        } 
        else
        {
            return false;
        }
    }
}
?>