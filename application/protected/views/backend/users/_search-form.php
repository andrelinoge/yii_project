<?php
/**
 * @author Andriy Tolstokorov
 */

?>

<div class="row-fluid">
    <div class="span12">
        <div class="head clearfix">
            <div class="isw-zoom"></div>
            <h1><?= _( 'Search' ); ?></h1>
        </div>

        <div class="block-fluid table-sorting clearfix">
            <?= CHtml::beginForm( $action, 'get', array( 'id' => 'search-toys', 'name' => get_class( $model ) ) ); ?>
                <div class="row-fluid clearfix">
                    <div class="span3">
                        <?=
                        FormDecorator::textField(
                            $model,
                            'name',
                            array(
                                'placeholder' => _( 'Name' )
                            ),
                            'text-field-search'
                        );
                        ?>
                    </div>
            </div>


            <div class="footer tar">
                <?= CHtml::resetButton( _( 'Reset' ), array( 'class' => 'btn' ) ); ?>

                <?= CHtml::submitButton(_( 'Search' ), array( 'class' => 'btn' ) ); ?>
            </div>

        <?= CHtml::endForm(); ?>
    </div>
</div>