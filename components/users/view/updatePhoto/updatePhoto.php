
<div id="camera_snapshot" class="bs-docs-section">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-12">
                <h1>Update profile picture</h1>
            </div>
        </div>
    </div>

    <div class="col-lg-12">

        <div id="picture-upload" class="well bs-component">
            <h2>Upload picture</h2>
            <form class="form-horizontal" method="POST" action="<?=BASE_PATH?>users/updatePhoto/?action_file=upload" enctype="multipart/form-data" >
                <fieldset>
                    <div class="form-group">
                        <label for="inputPicture" class="col-lg-2 control-label">Image</label>
                        <div class="col-lg-10">
                            <input class="form-control" id="inputEmail" type="file" name="profilePicture" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </div>
                </fieldset>
            </form>

        </div>
    </div>

    <div class="col-lg-12">

        <div id="picture-camera" class="well bs-component">
            <h2>Take a picture</h2>

            <div class="display_block">
                <video id="video"></video>
                <canvas id="canvas" style="display:none"></canvas>
            </div>
            <div class="block_button">
                <button id="startbutton" class="btn btn-primary button button_picture" >Take a picture</button>
                <button id="reloadbutton" class="btn btn-primary button button_picture" style="display:none">Retry</button>
                <button id="savebutton" class="btn btn-primary button button_picture" style="display:none">Save picture</button>
            </div>
        </div>
    </div>

    <? if(file_exists(WEBSITE_ABS_PATH.'template/default/images/profile/'.Utils::hashStr(User::getIdentity()->id).'.png')): ?>
        <div class="col-lg-12">

            <div id="picture-delete" class="bs-component">
                <h2>Delete existant picture</h2>
                <div class="form-horizontal">
                    <div class="form-group">
                        <img src="<?=WEBSITE_PATH.'template/default/images/profile/'.Utils::hashStr(User::getIdentity()->id).'.png'?>" alt="photo de profil" />
                        <a href="<?=BASE_PATH?>users/updatePhoto/?action_file=delete" class="btn btn-primary">Delete</a>
                    </div>
                </div>
            </div>

        </div>
    <? endif; ?>

</div>