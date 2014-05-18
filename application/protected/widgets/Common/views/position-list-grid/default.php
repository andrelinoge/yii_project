<?php
/**
 * @author Andre Linoge
 * Date: 10/4/12
 * NOTE: Don`t edit this File!!! This raw template just for example
 */

Yii::import('application.components.widgets.TemplatePager.TemplatePager');
/** @var $model ActiveRecord */
?>

<div>
    <? if ( $isData ): ?>

    <table class="action-grid">
        <thead>
            <tr>
                <? foreach( $headers as $field ): ?>
                    <th>
                        <?= $model->getAttributeLabel( $field ); ?>
                    </th>
                <? endforeach; ?>

                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?
                /** @var BackendController $controller */
                $controller = $this->getController();
            ?>
            <? foreach( $models as $model ): ?>
                <?
                    $cells = $model->$rowCellsGetterMethod();
                    $id = $model->$primary;

                    $url_up = $controller->createUrl( $this->actionMoveUp, array('id' => $id) );
                    $url_down = $controller->createUrl( $this->actionMoveDown, array('id' => $id) );
                    $url_top = $controller->createUrl( $this->actionMoveTop, array('id' => $id) );
                    $url_bottom = $controller->createUrl( $this->actionMoveBottom, array('id' => $id) );
                    $url_reset = $controller->createUrl( $this->actionResetPosition, array('id' => $id) );
                ?>

                <tr id="row_<?= $id; ?>">
                    <? foreach( $cells as $cell ): ?>
                        <td>
                            <?= $cell; ?>
                        </td>
                    <? endforeach; ?>

                    <td class="actions">
                        <a class="move-up" href = "<?= $url_up; ?>" data-row="#row_<?= $id; ?>">
                            Up
                        </a>
                        <a class="move-down" href = "<?= $url_down; ?>" data-row="#row_<?= $id; ?>">
                            Down
                        </a>
                        <a class="move-top" href = "<?= $url_top; ?>" data-row="#row_<?= $id; ?>">
                            Top
                        </a>
                        <a class="move-bottom" href = "<?= $url_bottom; ?>" data-row="#row_<?= $id; ?>">
                            Bottom
                        </a>
                    </td>
                </tr>
            <? endforeach; ?>
        </tbody>
    </table>
    <? else: ?>
        <p>Found nothing!</p>
    <? endif; ?>

    <?
        $this->widget(
            'TemplatePager',
            array(
                'pagination'    => $pagination,
            )
        );
    ?>
</div>

<? if( !$skipScripts ): ?>
    <script type="text/javascript">
        jQuery( document ).ready(
            function()
            {
                // move up
                $("table.action-grid > td.actions").on(
                    "click",
                    "a.move-down",
                    function(event)
                    {
                        var $this = $(this);
                        var params = {
                            url: $this.attr( 'href'),
                            cache: false,
                            type: "GET",
                            data: { ajax: "true" }
                        }

                        jQuery.ajax( params ).success(
                            function ( data )
                            {
                                jQuery($this.data("row")).next().after(jQuery($this.data("row")));
                            }
                        );
                        return false;
                    }
                );

                // move down
                $("table.action-grid > td.actions").on(
                    "click",
                    "a.move-down",
                    function(event)
                    {
                        var $this = $(this);
                        var params = {
                            url: $this.attr( 'href'),
                            cache: false,
                            type: "GET",
                            data: { ajax: "true" }
                        }

                        jQuery.ajax( params ).success(
                            function ( data )
                            {
                                jQuery($this.data("row")).prev().before(jQuery($this.data("row")));
                            }
                        );
                        return false;
                    }
                );
            }
        );
    </script>
<? endif; ?>