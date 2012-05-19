<?php $this->beginContent('//layouts/main'); ?>
    <div class="container" style="padding-top: 40px">

        <?php if($this->breadcrumbs) { ?>
        <div class="well" style="margin-top: 10px; padding: 5px; padding-left: 10px">
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
        )); ?><!-- breadcrumbs -->
        </div>
        <div style="float: left">
          <script type="text/javascript"><!--
          google_ad_client = "ca-pub-1820435160715571";
          /* Center index */
          google_ad_slot = "8367098407";
          google_ad_width = 468;
          google_ad_height = 60;
          //-->
          </script>
          <script type="text/javascript"
          src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
          </script>
    </div>
    <div style="float: left">
         <script type="text/javascript"><!--
         google_ad_client = "ca-pub-1820435160715571";
         /* Preview page */
         google_ad_slot = "0855140398";
         google_ad_width = 468;
         google_ad_height = 60;
         //-->
         </script>
         <script type="text/javascript"
         src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
         </script>
    </div>
    <div style="clear: both"></div>
        <?php } ?>

        <div class="content" style="padding-left: 15px; padding-right: 15px">
            <?php echo $content; ?>
        </div>

    </div><!-- page -->
<?php $this->endContent(); ?>

