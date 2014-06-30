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
        $model->action = CalcForm::GET_PRICE;

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
                if ($model->action == CalcForm::GET_PRICE)
                {
                    success('', ['price' => $model->price()]);
                }
                else
                {
                    $model->save();
                    success('Ми отримали ваші розрахунку і зв\'яжемося з вами в найкоротший термін', ['price' => $model->price()]);
                }
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