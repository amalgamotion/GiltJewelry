<?php
global $base_url;
$node_id = $node->nid;
$social = service_links_render($node);	
$content['field_product'][0]['submit']['#value']="add to bag";	
$imageUrl=$content['field_product']['#object']->field_product_image;	
?>
<link type="text/css" rel="stylesheet" href="<?php echo $base_url;?>/sites/all/themes/vintage/tinycarousel.css" media="all" />
<script type="text/javascript" src="<?php echo $base_url;?>/sites/all/themes/vintage/jquery.tinycarousel.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo $base_url;?>/sites/all/modules/field_slideshow/field_slideshow.css?nab25y" media="all" />
<script>jQuery(document).ready(function(){ jQuery(".group1").colorbox({rel:'group1'}); });</script>
<style>.field-slideshow { height:320px !important;width:320px !important;}</style>
<script type="text/javascript" src="<?php echo $base_url;?>/sites/all/modules/field_slideshow/field_slideshow.js?nab25y"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#slider1').tinycarousel();
	
	jQuery('#field-slideshow-1-pager li a img')
	  .mouseenter(function() {  		
		jQuery('.field-slideshow-slide-1').css({ "display": "none", "opacity": "0", "z-index": "0" });	
		var data=jQuery(this).attr("class");
		var arr=data.split(' ');
		var ex_arr=arr[1].split('-');
		var mda=ex_arr[0]+'-'+ex_arr[1]+'-slide-'+ex_arr[3];			
		if(jQuery('.'+mda).css("display")=="none"){
			jQuery('.'+mda).css({ "display": "block", "opacity": "1", "z-index": "4" });
		}
	  })
	  .mouseleave(function() {
		var data=jQuery(this).attr("class");
		var arr=data.split(' ');
		var ex_arr=arr[1].split('-');
		var mda=ex_arr[0]+'-'+ex_arr[1]+'-slide-'+ex_arr[3];		
		if(jQuery('.'+mda).css("display")=="block"){
			jQuery('.'+mda).css({ "display": "none", "opacity": "0", "z-index": "0" });
		}
		var mmda=ex_arr[0]+'-'+ex_arr[1]+'-slide-1';
		jQuery('.'+mmda).css({ "display": "block", "opacity": "1", "z-index": "4" });
	  });
	  
	  
});
 
function back_function() {
	window.history.back()
}
</script>

<div id="jwl_cnt_widget">
	<div class="jcnt_tle"><h2 class="title">vintage gallery</h2></div>
	<div class="jcnt_backg"><a href="javascript:back_function()">< Back to Gallery</a></div>
	<div class="jww_inner">		
		<div class="jww_slide">
			<?php 					
				foreach($imageUrl['und'] as $key=>$values){							
					$tempArray=array();
					foreach($imageUrl['und'][$key] as $k=>$v){											
						$tempArray[$k]=$v;								
					}
					$imageUrl['und'][$key]=array();
					$imageUrl['und'][$key]=$tempArray;						
				}	
				
			?>
			<div class="field field-name-field-product-image field-type-image field-label-above">
				<div class="field-label">Image:&nbsp;</div>
				<div class="field-items">
					<div class="field-item even">
						<div class="field-slideshow-wrapper" id="field-slideshow-1-wrapper">
							<div class="field-slideshow" style="height:320px">				
								<?php
								$i=1;
								$n=1;
								foreach($imageUrl['und'] as $key=>$values){			
									$class='none';
									if($n==1) $class='block';
									$new_image_url= image_style_url('large',$imageUrl['und'][$key]['uri']);
								?>
								<div class="field-slideshow-slide field-slideshow-slide-<?php echo $n;?> even first" style="display:<?php echo $class;?>;height:320px;width:320px;">					
								<a class="group1" href="<?php echo $new_image_url;?>" title="<?php print $title; ?>"><img width="320" height="320" alt="" src="<?php echo $new_image_url;?>" typeof="foaf:Image" class="field-slideshow-image field-slideshow-image-<?php echo $n;?>"></a>            
								</div>		
								<?php
								$n++;
								}
								?>         
							</div>  
						<?php if(count($imageUrl['und'])>6) { ?>	
							<div id="slider1">
							        <a class="buttons prev" href="#"><img src="<?php echo $base_url;?>/sites/all/themes/vintage/images/prev.png" width="16" height="32"></a>
							
								<div class="viewport">
									<ul class="overview" id="field-slideshow-<?php echo $i;?>-pager">
										<?php
										
										foreach($imageUrl['und'] as $key=>$values){									
											$new_image_url= image_style_url('thumbnail',$imageUrl['und'][$key]['uri']); 							
										?>
										<li><a href="#">
									<img width="50" height="65" alt="" src="<?php echo $new_image_url;?>" typeof="foaf:Image" class="field-slideshow-thumbnail field-slideshow-thumbnail-<?php echo $i;?>"></a>
									</li>
										<?php
										$i++;
										}
										?>
									</ul>
								</div>
							
								<a class="buttons next" href="#"><img src="<?php echo $base_url;?>/sites/all/themes/vintage/images/next.png" width="16" height="32"></a>
							
						    </div>
				  <?php } else
				        { ?>
						    
							<div id="slider1">
								<div class="viewport" id="second_thumb">
									<ul class="overview" id="field-slideshow-<?php echo $i;?>-pager">
										<?php
										
										foreach($imageUrl['und'] as $key=>$values){									
											$new_image_url= image_style_url('thumbnail',$imageUrl['und'][$key]['uri']); 							
										?>
										<li><a href="#">
									<img width="45" height="45" alt="" src="<?php echo $new_image_url;?>" typeof="foaf:Image" class="field-slideshow-thumbnail field-slideshow-thumbnail-<?php echo $i;?>"></a>
									</li>
										<?php
										$i++;
										}
										?>
									</ul>
								</div>
						    </div>
						
				 <?php } ?>		
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="jww_rgtcnt">
			<?php if($title): ?><div class="jprd_tle"><h3 class="title"><?php print $title; ?></h3></div><?php endif; ?>
			<div class="jprd_scnt"></div>
			<div class="jprd_formscnt">
				<?php $stock=$content['product:commerce_price']['#object']->commerce_stock['und'][0]['value'];
				if($stock>0) { ?>
				<div class="jprd_form_wgt"><?php echo $content['product:commerce_price'][0]['#markup']; ?>	</div>
				<?php }; ?>
				<div class="jprd_form_wgt"><?php echo @$content['body']['#object']->body['und'][0]['value']; ?>	</div>
				<div class="social_media_buttons">
					<?php 
					$block = module_invoke('social_share', 'block_view', 'social_media_buttons');
					print render($block['content']);
					?>
				</div>
				<?php $stock=$content['product:commerce_price']['#object']->commerce_stock['und'][0]['value'];
				if($stock>0) { ?>
					<div class="jprd_form_sbt"><?php print render($content['field_product'][0]); ?></div>
				<?php }; ?>
					
			</div>
			<div class="jprd_form_sbt"><?php print render($content['field_addthis']); ?></div>
		</div>
	</div>	
</div>