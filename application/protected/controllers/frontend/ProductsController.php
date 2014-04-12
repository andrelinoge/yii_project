<?php

class ProductsController extends FrontendController
{

	public function actionIndex($category_alias)
	{
        $category = ProductCategory::model()->find_by_alias($category_alias);

        $this->page_name = $category->title;
        $this->appendTitle( $category->title );
        $this->setMainMetaTags( $category->meta_keywords, $category->meta_description );

        $criteria = new CDbCriteria();
        $criteria->condition = 'category_id = :category_id';
        $criteria->params = [ ':category_id' => $category->id];

        $pagination = new CPagination();
        $pagination->pageSize = 10;

        $dp = new CActiveDataProvider('Product', [ 'criteria'   => $criteria,'pagination' => $pagination ]);

        $products   = $dp->data;
        $pagination = $dp->pagination;

        $this->render(
            'index',
            [
                'content'    => $category->content,
                'products'   => $products,
                'pagination' => $pagination
            ]
        );
	}

    public function actionShow($category_alias, $product_alias)
    {
        $product = Product::model()->with('gallery')->find_by_alias($product_alias);

        if (!$product)
        {
            throw new CHttpException(404);
        }

        $this->page_name = $product->title;

        $this->appendTitle( $product->title );
        $this->setMainMetaTags( $product->meta_keywords, $product->meta_description );

        $this->render(
            'show',
            [
                'product'   => $product
            ]
        );
    }

}