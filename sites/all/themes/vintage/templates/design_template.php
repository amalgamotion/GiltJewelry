<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<div id="wrapper">
  <div id="top_nav"></div>
  <div id="main">
    <div id="left_col">
    
      <div id="inside_left">
        <div><a href="/"><img src="../logo.png" /></a></div>
        <div id="left_nav">
					<?php if ($main_menu || $secondary_menu): ?>
              <?php print theme('links', array('links' => $main_menu, 'attributes' => array('id' => 'primary', 'class' => array('links', 'clearfix', 'main-menu')))); ?>
              <?php print theme('links', array('links' => $secondary_menu, 'attributes' => array('id' => 'secondary', 'class' => array('links', 'clearfix', 'sub-menu')))); ?>
          <?php endif; ?>
        </div>
        <div id="blog_block">
        	<?php print render($page['left_blog']); ?>
        </div>
        <div id="social_networks">
        	<?php print render($page['social_neworks']); ?>
        </div>
      </div> 
      
    </div>
    <div id="right_col">
      <div id="content_wrapper">
      
      	<?php if ($breadcrumb || $title|| $messages || $tabs || $action_links): ?>
          <div id="content-header">

            <?php print $breadcrumb; ?>

            <?php if ($page['highlight']): ?>
              <div id="highlight"><?php print render($page['highlight']) ?></div>
            <?php endif; ?>

            <?php if ($title): ?>
              <h1 class="title"><?php print $title; ?></h1>
            <?php endif; ?>

            <?php print $messages; ?>
            <?php print render($page['help']); ?>

            <?php if ($tabs): ?>
              <div class="tabs"><?php print render($tabs); ?></div>
            <?php endif; ?>

            <?php if ($action_links): ?>
              <ul class="action-links"><?php print render($action_links); ?></ul>
            <?php endif; ?>
            
          </div> <!-- /#content-header -->
        <?php endif; ?>
      
      	<?php if ($page['content_top']): ?>
          <div id="content_top">
            <?php print render($page['content_top']); ?>
          </div>
        <?php endif; ?>
        
        <div id="content-area">
          <?php print render($page['content']) ?>
        </div>
        
      </div>
    </div>
    
  </div>
  
  <div id="shadow_bottom"></div>
  
  <div id="footer_wrapper">
  	<div style="margin-left:auto; margin-right:auto; width: 1002px; clear:both;">
    	<div style="background-image:url(../images/left_dragon.png); width:50px; height:36px; float:left;"></div>
      <div id="footer"><?php print render($page['footer']); ?></div>
      <div style="background-image:url(../images/right_dragon.png); width:50px; height:36px; float:right;"></div>
    </div>
  </div>
</div>
</body>
</html>