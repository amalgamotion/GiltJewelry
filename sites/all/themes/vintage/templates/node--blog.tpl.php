<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>">
	<div class="node-inner">
    
    <?php if (!$page): ?>
      <h3<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h3>
    <?php else: ?>
    	<h3 style="text-transform: none;"><?php print $title; ?></h3>
    <?php endif; ?>

    <?php print $user_picture; ?>
		    
    <?php if ($display_submitted): ?>
    	 <div style="margin-top: 0px; margin-bottom: 10px; font-size:10px;">By: <?php print $name; ?>, <?php print $date; ?></div>
    <?php endif; ?>

  	<div class="content">
    
  	  <?php 
  	    // We hide the comments and links now so that we can render them later.
        hide($content['comments']);
        hide($content['links']);
				hide($content['fb_social_Facebook comments']);
        print render($content['body']);
       ?>
  	</div>
  	
    <?php if (!empty($content['links']['terms'])): ?>
      <div class="terms">
      <?php print render($content['links']['terms']); ?>
      </div>
    <?php endif;?>
    
    <?php print render($content['field_tags']); ?>
    
    <?php print render($content['field_addthis']); ?>
    
    <?php /*?><?php print render($content['sharethis']); ?><?php */?>
    
    <?php /*?><h3 class="title">add a new comment</h3>
    <div><?php print render($content['fb_social_Facebook comments']); ?></div>

  	
    <?php if (!empty($content['terms'])): ?>
	    <div class="links"><?php print render($content['terms']); ?></div>
	  <?php endif; ?><?php */?>
    
    <?php if (!empty($content['comments'])): ?>
	    <div class="links"><?php print render($content['comments']); ?></div>
	  <?php endif; ?>
        
	</div> <!-- /node-inner -->
</div> <!-- /node-->