<?php $this->beginContent('//layouts/main'); ?>
    <div class="container-fluid" style="padding-top: 40px">

        <?php if($this->breadcrumbs) { ?>
        <div class="well" style="margin-top: 10px; padding: 5px; padding-left: 10px">
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
        )); ?><!-- breadcrumbs -->
        </div>
        <?php } ?>

        <div class="sidebar well">
            <p style="font-weight: bold; font-size: 1.5em">Факультеты</p>
            <?php $this->widget('Tree'); ?>
        </div>

        <div class="content" style="padding-left: 20px; margin-left: 270px">
            <?php echo $content; ?>
        </div>

    </div><!-- page -->
<?php $this->endContent(); ?>

