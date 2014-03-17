<?php
/**
 * @author: Andriy Tolstokorov
 * Date: 10/4/12
 */

/** @var $this ListGrid  */

Yii::import('application.widgets.Templated.Pager');
/** @var $model ActiveRecord */
/** @var $pagination CPagination */
?>


<?php if ( $isData ): ?>
    <div id = "<?= $widgetWrapperId; ?>">
        <div class="dataTables_wrapper">
            <? if( $enableItemsLimitSelector ): ?>
                <div class="dataTables_length">
                    <label>Show <?= $itemsLimitSelect; ?> entries</label>
                </div>
            <? endif; ?>
            <form id="<?= $widgetFormId; ?>">

                <input type="hidden"
                       id="data_storage"
                       data-wrapper_id="<?= $widgetWrapperId; ?>"
                />

                <table class="table dataTable active-grid" cellpadding="0" cellspacing="0" width="100%">
                    <? //   RENDER TABLE HEADER  ?>
                    <thead>
                        <tr>
                            <? foreach( $listHeaders as $field ): ?>
                                <th style="text-align: center;"><?= $model->getAttributeLabel( $field ); ?></th>
                            <? endforeach; ?>
                            <th style="text-align: center; width: 280px">Actions</th>
                        </tr>
                    </thead>

                    <? //   RENDER TABLE BODY  ?>
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
                            ?>

                            <tr id="row_<?= $id; ?>">
                                <? foreach( $cells as $cell ): ?>
                                    <td>
                                        <?= $cell; ?>
                                    </td>
                                <? endforeach; ?>

                                <td class="actions">
                                    <a class="btn btn-small btn-quaternary move-up" href = "<?= $url_up; ?>" data-row="#row_<?= $id; ?>">
                                        <span class="isw-up"></span><?= _('Up'); ?>
                                    </a>
                                    <a class="btn btn-small btn-quaternary move-down" href = "<?= $url_down; ?>" data-row="#row_<?= $id; ?>">
                                        <span class="isw-down"></span><?= _('Down'); ?>
                                    </a>
                                    <a class="btn btn-small btn-quaternary move-top" href = "<?= $url_top; ?>" data-row="#row_<?= $id; ?>">
                                        <span class="isw-up_circle"></span><?= _('Top'); ?>
                                    </a>
                                    <a class="btn btn-small btn-quaternary move-bottom" href = "<?= $url_bottom; ?>" data-row="#row_<?= $id; ?>">
                                        <span class="isw-donw_circle"></span><?= _('Bottom'); ?>
                                    </a>
                                </td>
                            </tr>
                        <? endforeach; ?>
                    </tbody>

                    <? if( $listFilters ): ?>
                        <tfoot>
                        <tr>
                            <? foreach( $listHeaders as $field ): ?>
                                <? if( isset( $listFilters[ $field ] ) ): ?>
                                    <td>
                                        <?=
                                        CHtml::activeDropDownList(
                                            $model,
                                            $field,
                                            $listFilters[ $field ],
                                            array(
                                                'onchange' => 'return onChangeFilter(
                                                            this,
                                                            \'' .
                                                $this->getActionUrlWithoutParam(
                                                    array( get_class($model) => $field )
                                                )
                                                . '\'
                                                        )',
                                                'style' => 'width: auto;'
                                            )
                                        );
                                        ?>
                                    </td>
                                <? else: ?>
                                    <td></td>
                                <? endif; ?>
                            <? endforeach; ?>
                            <td></td>
                        </tr>
                        </tfoot>
                    <? endif; ?>
                </table>
            </form>

            <? //   RENDER ADDITIONAL INFO  ?>
            <div class="dataTables_info">
                <?= _( 'Total:' ) ?>
                <span id = "<?= $widgetFormId ?>_itemCountHolder"
                      data-items_on_page_count="<?= $countOfItems; ?>"
                      data-total_items_count="<?= $pagination->itemCount; ?>"><?= $pagination->itemCount; ?></span>
            </div>
            <? //   RENDER PAGINATION  ?>
            <?
                $this->widget(
                    'Pager',
                    array(
                        'pagination' => $pagination,
                        'viewFile' => 'backend-table-ajax',
                        'widgetWrapperId' => $widgetWrapperId
                    )
                );
            ?>
        </div>
    </div>
<?php else: ?>
    <div id = "<?= $widgetWrapperId; ?>">
        <div class="dataTables_wrapper">
            <form id="<?= $widgetFormId; ?>">
                <input type="hidden"
                       id="data_storage"
                       data-wrapper_id="<?= $widgetWrapperId; ?>"
                       data-confirm_message="<?= $messageDeleteConfirmation; ?>"
                    />
                <? if( $listFilters ): ?>
                    <table class="table dataTable" cellpadding="0" cellspacing="0" width="100%">
                        <?php //   RENDER TABLE HEADER  ?>
                        <thead>
                        <tr>
                            <? foreach( $listHeaders as $field ): ?>
                                <th style="text-align: center;"><?= $model->getAttributeLabel( $field ); ?></th>
                            <? endforeach; ?>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <? foreach( $listHeaders as $field ): ?>
                                <td>
                                    <? if( isset( $listFilters[ $field ] ) ): ?>
                                        <?=
                                        CHtml::activeDropDownList(
                                            $model,
                                            $field,
                                            $listFilters[ $field ],
                                            array(
                                                'class' => 'asd',
                                                'onchange' => 'return onChangeFilter(
                                        this,
                                        \''.
                                                $this->getActionUrlWithoutParam(
                                                    array( get_class($model) => $field )
                                                ).'\'
                                    )',
                                                'style' => 'margin-bottom: 0px'
                                            )
                                        );
                                        ?>
                                    <? endif; ?>
                                </td>
                            <? endforeach; ?>
                        </tr>
                        </tfoot>
                    </table>
                <? endif; ?>
            </form>

            <?php //   RENDER ADDITIONAL INFO  ?>
            <div class="dataTables_info">
                <strong><?= _( 'Oops! Nothing was found' ); ?>.</strong>
                <? if( $this->enableCreating ): ?>
                    <br/><br/>
                <? endif; ?>
            </div>

        </div>
    </div>
<? endif; ?>

<? //   ADDITIONAL JS FUNCTIONS  ?>

<? if( !$skipScripts ): ?>
    <script type="text/javascript">
        function onChangeSorter( link )
        {
            var $link = jQuery( link );
            var $dataStorage = jQuery( '#data_storage');
            jQuery( '#' + $dataStorage.data( 'wrapper_id' ) ).load(
                $link.attr( 'href' ),
                function()
                {
                    jQuery( 'form' ).find( 'input:checkbox' ).uniform();
                }
            );
            return false;
        }

        function changeItemsPerPageLimit( select )
        {
            var newItemsLimit = select.options[ select.selectedIndex ].value;
            jQuery.get(
                jQuery( select ).data( 'action_url'),
                {
                    'items_limit' : newItemsLimit
                },
                function(data)
                {
                    jQuery( '#<?= $widgetWrapperId; ?>' ).replaceWith( data );
                }
            );
        }

        function onChangeFilter( caller, actionUrl )
        {
            var $caller = jQuery( caller );
            actionUrl += '?&' + $caller.attr( 'name' ) + '=' + $caller.val();
            jQuery( '#' + jQuery( '#data_storage').data( 'wrapper_id' ) ).load(actionUrl);
            return false;
        }

        $(document).ready(function(){
            // move up
            $("table.active-grid").on(
                "click",
                "a.move-up",
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

            // move down
            $("table.active-grid").on(
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

            // move top
            $("table.active-grid").on(
                "click",
                "a.move-top",
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
                            var $tbody = jQuery($this.data("row")).parents('table tbody');
                            $tbody.find('tr:first-child').before(jQuery($this.data("row")));

                            alert('<?= _('Record moved to the top of the list'); ?>');
                        }
                    );
                    return false;
                }
            );

            // move bottom
            $("table.active-grid").on(
                "click",
                "a.move-bottom",
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
                            var $tbody = jQuery($this.data("row")).parents('table tbody');
                            $tbody.find('tr:last-child').after(jQuery($this.data("row")));
                            alert('<?= _('Record moved to the bottom'); ?>');
                        }
                    );
                    return false;
                }
            );
        });

    </script>
<?php endif; ?>
