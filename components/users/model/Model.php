<?php

class UsersModel extends Model {

    function isInTree($userId) {

        if(User::getIdentity()->id == $userId) {
            return true;
        }
        $parents  = $this->getAllParents(User::getIdentity()->id);
        foreach($parents as $parent){
            if($parent['id'] == $userId) {
                return true;
            }
        }
        $children = $this->getAllChildren(User::getIdentity()->id);
        foreach($children as $child){
            if($child['id'] == $userId) {
                return true;
            }
        }
        return false;
    }

    function getPartnersByLevel($level){

        $query = "
            SELECT
                      *
                FROM
                      users
                WHERE
                      level = :level
    	";

        return $this->_db->doQueryAll($query, array('level'=>$level));
    }

    function getAllChildren($parentId, $children = array()) {

        $littleChildren = $this->getChildren($parentId);

        if(!empty($littleChildren)) {

            foreach($littleChildren as $child) {

                $children[] = $child;
                $children = array_merge($this->getAllChildren($child['id'], $children));
            }
        }

        return $children;
    }

    function getChildren($parentId){

        $query = "
            SELECT
                      *
                FROM
                      users
                WHERE
                      parent_id = :parentId
    	";

        return $this->_db->doQueryAll($query, array('parentId'=>$parentId));
    }

    function getAllParents($childId) {

        $parents = array();
        $parent = $this->getParent($childId);

        while(!empty($parent)) {

            $parents[] = $parent;
            $parent = $this->getParent($parent['id']);
        }


        return $parents;
    }

    function getParent($childId){

        $query = "
            SELECT
                      *
                FROM
                      users as child
                JOIN
                      users as parent
                  ON
                      parent.id = child.parent_id
                WHERE
                      child.id = :childId
    	";

        return $this->_db->doQueryOne($query, array('childId'=>$childId));
    }

    function deletePartner($userId) {

        $user = User::getUser($userId);
        $query = "
            DELETE
                FROM
                      users
                WHERE
                      users.id = :userId
    	";

        if($this->_db->doQuery($query, array('userId'=>$userId))) {

            $this->recursRestoreLinks($user->id, $user->parent_id);
            return true;
        }
        return false;
    }

    public function recursRestoreLinks($oldParentId, $newParentId = null)
    {
        $children = $this->getChildren($oldParentId);

        if(!empty($children)) {

            foreach ($children as $child)
            {
                $data = array();
                if($newParentId != null) {
                    $data['parent_id'] = $newParentId;
                }
                $data['level'] = --$child['level'];

                $this->update('users', $data, array('id'=>$child['id']));
                self::recursRestoreLinks($child['id']);
            }
        }
    }

    public function saveCameraImg($imageData, $fullName)
    {
        $image = imagecreatefrompng($imageData);

        try {
            if( file_exists($fullName) ){
                chmod($fullName,0777);
                unlink($fullName);
            }
            imagealphablending($image, false);
            imagesavealpha($image, true);
            imagepng($image, $fullName);
            chmod($fullName,0777);
            imagedestroy($image);
        }
        catch(Exception $e)
        {
                return $e->getMessage();
        }
    }

    public function redimProfilePicture($fullName, $fullThumbnailName)
    {
        $image = imagecreatefrompng($fullName);
        $resizeImage = imagecreatetruecolor(50,50);
        $width = imagesx($image);
        imagecopy($resizeImage, $image, 0, 0, ($width-50)/2, 0, 50, 50);
        imagepng($resizeImage, $fullThumbnailName);
        chmod($fullThumbnailName,0777);
        imagedestroy($image);
        imagedestroy($resizeImage);
    }

    public function saveUploadImg($image, $fname)
    {
        set_time_limit(60);

        $ftmp = $image['tmp_name'];
        $type = @explode('/', $image['type']);
        $type = isset($type[1]) ? $type[1] : '';

        if( file_exists($fname) ){
            chmod($fname,0777);
            unlink($fname);
        }
        try
        {
            switch (strtolower($type)){
                case 'jpg':
                case 'jpeg':
                    $src = imagecreatefromjpeg($ftmp);
                    break;
                case 'png':
                    $src = imagecreatefrompng($ftmp);
                    break;
                case 'gif':
                    $src = imagecreatefromgif($ftmp);
                    break;
            }
            imagepng($src, $fname);
            chmod($fname,0777);
            imagedestroy($src);
        }
        catch(Exception $e)
        {
                return $e->getMessage();
        }

    }
    
    public function deleteImg($fname)
    {
        if( file_exists($fname) ){
            chmod($fname,0777);
            unlink($fname);
        }
    }

}
?>