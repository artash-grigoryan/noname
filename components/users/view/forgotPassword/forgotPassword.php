
<div class="bs-docs-section">

    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1 id="forms">Welcome</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div id="login" class="col-lg-6">
            <div class="well bs-component">
                <form id="login_form" class="form-horizontal" action="<?=BASE_PATH?>users/forgotPassword/" method="post">
                    <fieldset>
                        <legend>Forgot password</legend>
                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-2 control-label">Mail*</label>
                                <div class="col-lg-10">
                                    <input class="form-control mandatory" id="inputEmail" placeholder="Email" type="text" name='mail'>
                                </div>
                            </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <a href="<?=PATH?>" class="btn btn-default cancel">Cancel</a>
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>

        <div id="login_info" class="col-lg-4 col-lg-offset-1">
            <p>Please, enter you mail</p>
            <p>
                If you don't remember your E-mail, send message via <a href="<?=PORT.DOM_NAME?>/contact/">our contact page</a>,<br />
            </p>
        </div>
    </div>

</div>