<? $assets_path = $this->get_behavioral_url(); ?>

<div class="container">
        <div class="row">
            <div class="col-md-8">
            	<? $this->widget('application.widgets.Frontend.Slider'); ?>
            </div> <!-- /.col-md-12 -->
            
            <div class="col-md-4">
                <div class="widget-item">
                    <div class="request-information">
                        <h4 class="widget-title">Request Information</h4>
                        <form class="request-info clearfix"> 
                            <div class="full-row">
                                <label for="yourname">Full Name:</label>
                                <input type="text" id="yourname" name="yourname">
                            </div> <!-- /.full-row -->

                            <div class="full-row">
                                <label for="email-id">Email Address:</label>
                                <input type="text" id="email-id" name="email-id">
                            </div> <!-- /.full-row -->
                            
                            <div class="full-row">
                                <div class="submit_field">
                                    <span class="small-text pull-left">Subscribe to our newsletter</span>
                                    <input class="mainBtn pull-right" type="submit" name="" value="Submit Request">
                                </div> <!-- /.submit-field -->
                            </div> <!-- /.full-row -->


                        </form> <!-- /.request-info -->
                    </div> <!-- /.request-information -->
                </div> <!-- /.widget-item -->
            </div> <!-- /.col-md-4 -->
        </div>
    </div>


    <div class="container">
        <div class="row">

            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <div class="widget-item">
                            <h2 class="welcome-text">Welcome to Universe Premium Template</h2>
                            <p><strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, adipisci, quibusdam, ad ab quisquam esse aspernatur exercitationem aliquam at fugit omnis vitae recusandae eveniet.</strong></br></br>Inventore, aliquam sequi nisi velit magnam accusamus reprehenderit nemo necessitatibus doloribus molestiae fugit repellat repudiandae dolor. Incidunt, nulla quidem illo suscipit nihil!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni, dolorem, fugiat, commodi totam accusantium illo incidunt quis eius eum iure et fugit voluptas atque ratione nobis sed omnis quod ipsa.</br></br>Vivamus mattis nibh vitae dui egestas posuere. Maecenas a est at enim blandit interdum. Cras eget ipsum ac nunc tristique tincidunt sit amet nec quam. Vivamus sed suscipit enim, et dignissim tellus.</p>
                        </div> <!-- /.widget-item -->
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.col-md-8 -->
            
            <div class="col-md-4">
        		<? $this->widget('application.widgets.Frontend.OurWorks' ); ?>
            </div>
        </div>
    </div>