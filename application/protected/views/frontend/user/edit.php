<?
/** @var User $user */
/** @var ChangePasswordForm $assets_path */
$assets_path = $this->get_behavioral_url();
Yii::app()
    ->clientScript
    ->registerPackage( 'uploader' );
?>
<div class="row-fluid">

    <article class="span12 data-block nested">
        <div class="data-container">
            <header>
                <h2>Profile</h2>
            </header>
            <section class="tab-content">

                <?= Form::begin( $user, 'update', ['class' => 'form-horizontal ajax-form'] ); ?>
                <fieldset>
                    <legend>Edit data</legend>

                    <div class="row-fluid">
                        <div class="span6">
                            <?= FormDecorator::textField($user, 'first_name', ['class' => 'input-xlarge'] ); ?>
                            <?= FormDecorator::textField($user, 'last_name', ['class' => 'input-xlarge'] ); ?>
                            <?= FormDecorator::emailField($user, 'email', ['class' => 'input-xlarge'] ); ?>
                        </div>

                        <div class="span6">
                            <div data-provides="fileupload" class="fileupload fileupload-new">
                                <div class="fileupload-new fileupload-small thumbnail">
                                    <img src="<?= $user->get_thumbnail('s'); ?>"
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
</div>

<div class="clearfix"></div>

<div class="row-fluid">
    <article class="span12 data-block nested">
        <div class="data-container">
            <header>
                <h2>Change password</h2>
            </header>
            <section>
                <?= Form::begin( $change_password_form, 'updatePassword', ['class' => 'form-horizontal ajax-form'] ); ?>
                    <fieldset>
                        <?= FormDecorator::passwordField($change_password_form, 'old', ['class' => 'input-xlarge', 'value' => ''] ); ?>
                        <?= FormDecorator::passwordField($change_password_form, 'new', ['class' => 'input-xlarge'] ); ?>
                        <?= FormDecorator::passwordField($change_password_form, 'confirm', ['class' => 'input-xlarge'] ); ?>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-alt btn-primary">Изменить пароль</button>
                        </div>
                    </fieldset>
                </form>
            </section>
        </div>
    </article>

</div>

<script type="text/javascript">
    $(function(){
        uploader = new UploaderController();
        uploader.user_photo();
    });
</script>