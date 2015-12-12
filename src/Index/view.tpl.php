<div class="row" style="margin-top: 8em;">
        <div class="col-lg-6 col-lg-offset-3">
            <form role="form" method="post">
                    <div class="form-group">
                        <?php echo $this->form->get('name')->get('control')->addCssClasses('form-control'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->form->get('password')->get('control')->addCssClasses('form-control'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->form->get('submit')->addCssClasses('btn btn-default'); ?>
                    </div>
            </form>
        </div>
</div>
