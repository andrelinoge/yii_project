<?
/**
 * @var $this Controller
 * @var $form LoginForm
 */
$assets_path = $this->get_behavioral_url();
Yii::app()->clientScript->registerScriptFile("{$assets_path}/js/lib/jquery.oauthpopup.js");
?>

<section>
    <div>
        <a href="#" id="fb_login">
            FB
        </a>
        &nbsp;&nbsp;&nbsp;
        <a href="#" id="vk_login">
            VK
        </a>
        &nbsp;&nbsp;&nbsp;
        <a href="#" id="twitter_login">
            Twitter
        </a>
    </div>
    <!-- Login form -->
    <?= Form::begin($form, createUrl('session/create'), array('class' => 'ajax-form')); ?>
        <fieldset>
            <div class="control-group">
                <?= Form::label($form, 'email', array('class' => "control-label")); ?>
                <div class="controls">
                    <?= Form::input($form, 'email', array('placeholder' => "email")); ?>
                </div>
            </div>

            <div class="control-group">
                <?= Form::label($form, 'password', array('class' => "control-label")); ?>
                <div class="controls">
                    <?= Form::password($form, 'password', array('placeholder' => "password")); ?>
                    <label class="checkbox">
                        <?= Form::checkbox($form, 'remember_me'); ?> Remember me
                    </label>
                </div>
            </div>

            <div class="form-actions">
                <button class="btn btn-primary btn-alt" type="submit"><span class="awe-signin"></span> Log in</button>
            </div>
        </fieldset>
    <?= Form::end_form(); ?>

</section>

<nav>
    <ul>
        <li><a href="<?= createUrl('user/restorePassword'); ?>">Lost password?</a></li>
    </ul>
</nav>

<div id="fb-root"></div>
<script type="text/javascript">
    $(function(){
        var authorizationController = new AuthorizationController();

        authorizationController.initialize_vk(
            '#vk_login',
            '<?= createUrl('socialAuthorization/vk'); ?>',
            '<?= app()->params['oAuth']['vk']['app_id']; ?>',
            '<?= createUrl('site/index'); ?>'
        );

        authorizationController.initialize_fb(
            '#fb_login',
            '<?= $this->createUrl( 'socialAuthorization/fb'); ?>',
            '<?= app()->params['oAuth']['fb']['app_id']; ?>'
        );

        authorizationController.initialize_twitter(
            '<?= $this->createUrl('socialAuthorization/twitter'); ?>',
            '<?= $this->createUrl('site/index'); ?>'
        );
    });
</script>


