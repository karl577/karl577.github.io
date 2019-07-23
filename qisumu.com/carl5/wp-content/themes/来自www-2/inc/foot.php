<div id="bottom">
  <div class="container">
    <div class="row-fluid">
      <div class="span3 widget clearfix">
        <div class="header">
          <h4>声明</h4>
        </div>
        <div class="content">
          <p><?php echo get_option('statement')?></p>
        </div>
      </div>
      
      <div class="span9 widget clearfix">
        <div class="links-cloud">
          <div class="header">
            <h4>友情链接</h4>
            <h5 class="pull-right">申请链接</h5>
          </div>
          <ul>
            <?php echo get_option('foot_link')?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
