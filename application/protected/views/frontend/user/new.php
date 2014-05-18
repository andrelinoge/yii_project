<?
$assets_path = $this->get_behavioral_url();
Yii::app()
    ->clientScript
    ->registerPackage( 'uploader' );
?>
<div class="row-fluid">

<!-- Data block -->
<article class="span12 data-block nested">
    <div class="data-container">
        <header>
            <h2>New user</h2>
        </header>
        <section class="tab-content">

            <?= Form::begin( $user, 'create', ['class' => 'form-horizontal ajax-form'] ); ?>
                <fieldset>
                    <legend>Registration form</legend>

                    <div class="row-fluid">
                        <div class="span6">
                            <?= FormDecorator::textField($user, 'first_name', ['class' => 'input-xlarge'] ); ?>
                            <?= FormDecorator::textField($user, 'last_name', ['class' => 'input-xlarge'] ); ?>
                            <?= FormDecorator::emailField($user, 'email', ['class' => 'input-xlarge'] ); ?>

                            <?= FormDecorator::passwordField($user, 'password', ['class' => 'input-xlarge'] ); ?>
                            <?= FormDecorator::passwordField($user, 'confirm_password', ['class' => 'input-xlarge'] ); ?>
                        </div>

                        <div class="span6">
                            <div data-provides="fileupload" class="fileupload fileupload-new">
                                <div class="fileupload-new fileupload-small thumbnail">
                                    <img src="<?= $assets_path; ?>/img/sample_content/upload-50x50.png"
                                         width="75px"
                                         alt="Upload preview"
                                         id="thumbnail">
                                </div>

                                <div id="photo_uploader" class="btn">
                                    Фото
                                </div>
                            </div>
                        </div>
                    </div>

                    <?= CHtml::activeHiddenField($user, 'photo', ['id' => 'user_photo']); ?>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-alt btn-primary">Сохранить</button>
                    </div>
                </fieldset>
            <?= Form::end_form(); ?>


        </section>
    </div>
</article>
<!-- /Data block -->

</div>

<script type="text/javascript">
    $(function(){
        uploader = new UploaderController();
        uploader.user_photo();
    });
</script>