<script type="text/javascript">
    jQuery(function() {
			jQuery('.content_area').jScrollPane({
				verticalDragMinHeight: 34,
				verticalDragMaxHeight: 34, 
				verticalGutter: 20
			});
		});
</script>

<div id="static_scroll" style="background-image:url(<?php print render($content['field_image_path']); ?>);">
<?php /*?><div id="static_scroll"><?php */?>

	<div id="left_column">
  	<div class="content_area">
  		<?php print render($content['field_static_content']); ?>
    </div>
  </div>
  
  <div id="right_column">
  
  	<div class="content_area">
  		<?php print render($content['body']); ?>
    </div>
  </div>

</div>