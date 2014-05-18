<? $assets_path = $this->get_behavioral_url(); ?>

<div class="container">
        <div class="row">
            <div class="col-md-8">
            	<? $this->widget('application.widgets.Frontend.Slider'); ?>
            </div> <!-- /.col-md-12 -->
            
            <div class="col-md-4">
                <? $this->widget('application.widgets.Frontend.WSizerRequest'); ?>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">

            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <div class="widget-item">
                            <?= $content; ?>
                        </div> <!-- /.widget-item -->
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.col-md-8 -->
            
            <div class="col-md-4">
        		<? $this->widget('application.widgets.Frontend.OurWorks' ); ?>
            </div>
        </div>
    </div>
</div>  