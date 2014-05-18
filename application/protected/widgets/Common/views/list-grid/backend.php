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
                       data-confirm_message="<?= $messageDeleteConfirmation; ?>"
                />
                <table class="table dataTable" cellpadding="0" cellspacing="0" width="100%">
                    <?php //   RENDER TABLE HEADER  ?>
                    <thead>
                        <tr>
                            <? if ( $allowGroupOperations ): ?>
                                <th style=" width: 20px; text-align: center;" class="checkerNoMargin">
                                    <input type="checkbox"
                                           onchange="return onCheckAll( this );">
                                </th>
                            <? endif; ?>
                            <? if ( $enableSort ): // if sort enabled - create active headers ?>
                                <? foreach( $listHeaders as $field ): ?>
                                    <? if( in_array( $field, $sortableFields ) ): ?>
                                        <?
                                            $class = '';
                                            if( $this->isAscSort( $field ) ) {
                                                $class = 'sorting_asc';
                                            } else if ( $this->isDescSort( $field ) ) {
                                                $class = 'sorting_desc';
                                            }
                                        ?>
                                        <th style="text-align: center;" class="<?= $class; ?>">
                                            <a onclick = "return onChangeSorter(this);"
                                                href="<?= $this->getUrlForSort( $field ); ?>">
                                                <?= $model->getAttributeLabel( $field ); ?>
                                            </a>
                                        </th>
                                    <? else: ?>
                                        <th style="text-align: center;">
                                            <?= $model->getAttributeLabel( $field ); ?>
                                        </th>
                                    <? endif; ?>
                                <? endforeach; ?>
                            <? else: ?>
                                <? foreach( $listHeaders as $field ): ?>
                                    <th style="text-align: center;"><?= $model->getAttributeLabel( $field ); ?></th>
                                <? endforeach; ?>
                            <? endif; ?>
                            <th style="text-align: center; width: 180px">Actions</th>
                        </tr>
                    </thead>

                    <?php //   RENDER TABLE BODY  ?>
                    <tbody>
                        <? foreach( $models as $record ): ?>
                            <? $cells = $record->{$rowCellsGetterMethod}(); ?>
                                <tr id="<?= $widgetFormId ?>_record_<?= $record->{$primary}; ?>" class="odd">
                                    <? if ( $allowGroupOperations ): ?>
                                        <td>
                                            <input type="checkbox"
                                                   name="<?= $groupingCheckboxName; ?>[]"
                                                   value="<?= $record->{$primary}; ?>" >
                                        </td>
                                    <? endif; ?>

                                    <? foreach( $cells as $cell ): ?>
                                        <td><?= $cell; ?></td>
                                    <? endforeach; ?>

                                    <? //   RECORD OPTIONS  ?>
                                    <td style="text-align: center;">

                                        <? if( $this->enableViewing ): ?>
                                            <a href = "<?= $this->getViewActionURL( array( 'id' => $record->{$primary} ) ); ?>"
                                               class="btn btn-small btn-quaternary">
                                                <span class="isw-zoom"></span> <?//= _( 'View' ); ?>
                                            </a>
                                        <? endif; ?>

                                        <? if( $this->enableEditing ): ?>
                                            <a href = "<?= $url = $this->getEditActionURL( array( 'id' => $record->{$primary} ) ); ?>"
                                               class="btn btn-small btn-quaternary">
                                                <span class="isw-edit"></span> <?//= _( 'Edit' ); ?>
                                            </a>
                                        <? endif; ?>

                                        <?
                                            $onClick = 'return confirm(\'' . $messageDeleteConfirmation . '\');';
                                            if ( $useAjaxDelete )
                                            {
                                                $onClick = 'return ajaxDelete(this, \''. $widgetFormId .'\')';
                                            }
                                        ?>

                                        <? if( $this->enableDeleting ): ?>
                                            <a href = "<?= $this->getDeleteActionURL( array( 'id' => $record->{$primary} ) ); ?>"
                                               data-record_id = "<?= $record->$primary; ?>"
                                               onclick = "<?= $onClick; ?>"
                                               class="btn btn-small btn-quaternary">
                                                <span class="isw-delete"></span> <?//= _( 'Delete' ); ?>
                                            </a>
                                        <? endif; ?>
                                    </td>
                                </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <? if( $listFilters ): ?>
                        <tfoot>
                            <tr>
                                <? if( $allowGroupOperations ): ?>
                                    <td></td>
                                <? endif; ?>
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

            <?php //   RENDER ADDITIONAL INFO  ?>
            <div class="dataTables_info">
                <?= _( 'Total:' ) ?>
                <span id = "<?= $widgetFormId ?>_itemCountHolder"
                      data-items_on_page_count="<?= $countOfItems; ?>"
                      data-total_items_count="<?= $pagination->itemCount; ?>"><?= $pagination->itemCount; ?></span>
            </div>
            <?php //   RENDER PAGINATION  ?>
            <?php
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
                    <? if ( $enableSort ): // if sort enabled - create active headers ?>
                    <? foreach( $listHeaders as $field ): ?>
                        <? if( in_array( $field, $sortableFields ) ): ?>
                            <?
                            $class = '';
                            if( $this->isAscSort( $field ) ) {
                                $class = 'sorting_asc';
                            } else if ( $this->isDescSort( $field ) ) {
                                $class = 'sorting_desc';
                            }
                            ?>
                            <th style="text-align: center;" class="<?= $class; ?>">
                                <a onclick = "return onChangeSorter(this);"
                                   href="<?= $this->getUrlForSort( $field ); ?>">
                                    <?= $model->getAttributeLabel( $field ); ?>
                                </a>
                            </th>
                            <? else: ?>
                            <th style="text-align: center;">
                                <?= $model->getAttributeLabel( $field ); ?>
                            </th>
                            <? endif; ?>
                        <? endforeach; ?>
                    <? else: ?>
                    <? foreach( $listHeaders as $field ): ?>
                        <th style="text-align: center;"><?= $model->getAttributeLabel( $field ); ?></th>
                        <? endforeach; ?>
                    <? endif; ?>
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
                <a href="<?= $this->getCreateActionUrl(); ?>"
                   class="btn btn-small btn-quaternary">
                    <span class="isw-plus"></span><?= _( 'New' ); ?>
                </a>
            <? endif; ?>
        </div>

    </div>
</div>
<?php endif; ?>

<?php //   ADDITIONAL JS FUNCTIONS  ?>

<?php if( !$skipScripts ): ?>
    <script type="text/javascript">
        function ajaxDelete( caller, formId ) {
            var $caller = jQuery( caller );
            var $dataStorage = jQuery( '#data_storage');
            if ( confirm( $dataStorage.data('confirm_message') ) ) {
                // send delete request
                jQuery.ajax({
                    url: $caller.attr( 'href'),
                    cache: false,
                    type: "GET",
                    data: { ajax: "true" }
                }).success(function ( data ) {
                    // on success - remove row from table, if no rows left - reload page
                    var $counter = jQuery( '#' + formId + '_itemCountHolder' );
                    var newTotalCount = $counter.data( 'total_items_count' ) - 1;
                    var newItemOnPageCount = $counter.data( 'items_on_page_count' ) - 1;

                    if ( newItemOnPageCount <= 0 ) {
                        window.location.reload();
                        return false;
                    }
                    $counter
                        .data( 'total_items_count', newTotalCount )
                        .data( 'items_on_page_count', newItemOnPageCount )
                        .html( newTotalCount );

                    jQuery( '#' + formId + '_record_' + $caller.data( 'record_id' ) ).remove();
                });
                return false;
            } else {
                return false;
            }
        }

        function onChangeSorter( link ) {
            var $link = jQuery( link );
            var $dataStorage = jQuery( '#data_storage');
            jQuery( '#' + $dataStorage.data( 'wrapper_id' ) ).load(
                $link.attr( 'href' ),
                function() {
                    jQuery( 'form' ).find( 'input:checkbox' ).uniform();
                }
            );
            return false;
        }

        function changeItemsPerPageLimit( select ) {
            var newItemsLimit = select.options[ select.selectedIndex ].value;
            jQuery.get(
                jQuery( select ).data( 'action_url'),
                {
                    'items_limit' : newItemsLimit
                },
                function(data) {
                    jQuery( '#<?= $widgetWrapperId; ?>' ).replaceWith( data );
                    jQuery( 'form' ).find( 'input:checkbox' ).uniform();
                }
            );
        }

        function onCheckAll( self ) {
            if(!jQuery( self ).is(':checked') ) {
                jQuery( self )
                    .parents( 'table' )
                    .find('.checker span' )
                    .removeClass( 'checked' )
                    .find( 'input[type=checkbox]' )
                    .attr( 'checked', false );
            } else {
                jQuery( self )
                    .parents( 'table' )
                    .find( '.checker span' )
                    .addClass( 'checked' )
                    .find( 'input[type=checkbox]' )
                    .attr( 'checked', true );
            }
        }

        function onChangeFilter( caller, actionUrl ) {
            var $caller = jQuery( caller );
            actionUrl += '?&' + $caller.attr( 'name' ) + '=' + $caller.val();
            jQuery( '#' + jQuery( '#data_storage').data( 'wrapper_id' ) ).load(
                    actionUrl,
                    function() {
                        jQuery( 'form' ).find( 'input:checkbox' ).uniform();
                    }
            );
            return false;
        }

    </script>
<?php endif; ?>
