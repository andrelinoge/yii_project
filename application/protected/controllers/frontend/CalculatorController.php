<?
class CalculatorController extends FrontendController
{
    public function actionIndex()
    {
        $this->breadcrumbs[] = [
            'title' => 'Віконний калькулятор'
        ];

        $page = Page::model()->find_by_alias('calc');
        $this->page_name = $page->title;
        $this->appendTitle( $page->title );
        $this->setMainMetaTags( $page->meta_keywords, $page->meta_description );

        $model = new CalcForm();

        $this->render(
            'index',
            [
                'content'       => $page->content,
                'model'         => $model
            ]
        );
    }
    
    public function actionProcess()
    {
        if ($_POST['CalcForm'])
        {
            $model = new CalcForm();
            $model->setAttributes($_POST['CalcForm']);

            if ($model->validate())
            {
                success('', ['price' => $model->price()]);
            }
            else
            {
                failure(null, ['errors' => $model->getErrors()]);
            }
        }
        else
        {
            failure();
        }
    }
}