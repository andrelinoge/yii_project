<?php
class FrontBreadCrumbs
{
    public static function catalog($model, $route, $category_name)
    {
        $result[] = array( 'name' => $model->getValue() );

        if ( $model->parent_id )
        {
            $gotRoot = FALSE;
            while ( !$gotRoot )
            {
                $model = $model
                    ->byLanguage()
                    ->find(
                        'catalog_id = :value',
                        array(
                            ':value' => $model->parent_id
                        )
                    );

                if ( $model )
                {
                    $result[] = array(
                        'name' => $model->getValue(),
                        'url' => createUrl( $route, array( 'catalog' => $model->catalog_id ) )
                    );

                    if ( (int)$model->parent_id == 0 )
                    {
                        $gotRoot = TRUE;
                    }
                }
                else
                {
                    $gotRoot = TRUE;
                }
            }
        }

        $result[] = array(
            'name' => $category_name,
            'url' => createUrl($route)
        );
        $result = array_reverse($result);

        return $result;
    }

    public static function item($model, $catalog_route, $category_name)
    {
        $result[] = array( 'name' => $model->getTitle() );

        $catalog = $model->getCatalog();

        if ( $catalog->parent_id )
        {
            $gotRoot = FALSE;
            while ( !$gotRoot )
            {
                $catalog = $catalog
                    ->byLanguage()
                    ->find(
                        'catalog_id = :value',
                        array(
                            ':value' => $catalog->parent_id
                        )
                    );

                if ( $catalog )
                {
                    $result[] = array(
                        'name' => $catalog->getValue(),
                        'url' => createUrl( $catalog_route, array( 'catalog' => $catalog->tag ) )
                    );

                    if ( (int)$catalog->parent_id == 0 )
                    {
                        $gotRoot = TRUE;
                    }
                }
                else
                {
                    $gotRoot = TRUE;
                }
            }
        }
        else
        {
            $result[] = array(
                'name' => $catalog->getValue(),
                'url' => createUrl( $catalog_route, array( 'catalog' => $catalog->tag ) )
            );
        }

        $result[] = array(
            'name' => $category_name,
            'url' => createUrl( $catalog_route )
        );
        $result = array_reverse($result);

        return $result;
    }
}