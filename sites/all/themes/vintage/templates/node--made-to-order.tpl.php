<?php
	//$content['field_product']['#title']='sadasdasd';
	//$content['field_product']['#weight'] =1;
	//echo '<pre>';print_r($node);echo '</pre>'; exit;
	//echo '<pre>';print_r($content);echo '</pre>'; exit;
	//echo '<pre>';print_r($content);echo '</pre>'; exit;
	global $base_url;
	$node_id = $node->nid;
	$social = service_links_render($node);
	$thum_slide_img=array();
	//echo '<pre>';print_r($content['body']['#object']);echo '</pre>'; exit;
	$content['field_product'][0]['submit']['#value']="add to bag";
	//$node1=(array)$node;
	//echo '<pre>';print_r($content);echo '</pre>'; exit;
	//echo $content['body']['#object']->field_node_product_image;exit;
	$imageUrl=$content['field_node_made_to_order']['#object']->field_product_image;
    //echo "<pre>";
	//print_r($imageUrl);
	//echo "</pre>"; 
	//exit;
?>
<link type="text/css" rel="stylesheet" href="<?php echo $base_url;?>/sites/all/themes/vintage/tinycarousel.css" media="all" />
<script type="text/javascript" src="<?php echo $base_url;?>/sites/all/themes/vintage/jquery.tinycarousel.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo $base_url;?>/sites/all/modules/field_slideshow/field_slideshow.css?nab25y" media="all" />
        <script>
			jQuery(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				jQuery(".group1").colorbox({rel:'group1'});
			});
		</script>
	
<style>
.field-slideshow
{
height:320px !important;
width:320px !important;
}
</style>
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
	<div class="jcnt_tle"><h2 class="title"><?php print render($content['field_node_made_to_order']); ?></h2></div>
	<div class="jcnt_backg"><a href="javascript:back_function()">< Back to Gallery</a></div>
	<div class="jww_inner">
		
		<div class="jww_slide">
			<?php 
				// foreach($imageUrl['und'] as $key=>$values){							
					// $tempArray=array();
					// foreach($imageUrl['und'][$key]['file'] as $k=>$v){											
						// $tempArray[$k]=$v;								
					// }
					// $imageUrl['und'][$key]['file']=array();
					// $imageUrl['und'][$key]['file']=$tempArray;					
				// }
			// ?>
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
                                //$thum_slide_img[] = $new_image_url;								
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
                                //$thum_slide_img[] = $new_image_url;								
							?>
						<li><a href="#">
						<img width="45" height="65" alt="" src="<?php echo $new_image_url;?>" typeof="foaf:Image" class="field-slideshow-thumbnail field-slideshow-thumbnail-<?php echo $i;?>"></a>
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
			
			<div class="jprd_scnt">
			</div>
			<div class="jprd_formscnt">

				<div class="jprd_form_wgt"><?php echo $content['product:commerce_price'][0]['#markup']; ?>	</div>
				<div class="jprd_form_wgt"><?php echo $content['body']['#object']->body['und'][0]['value']; ?>	</div>
				<div class="social_media_buttons">
				<?php //print render(block_get_blocks_by_region('social_media_buttons'));?>
				<?php 
						$block = module_invoke('social_share', 'block_view', 'social_media_buttons');
						print render($block['content']);
				?>
				</div>
				<?php				
				 $stock=$content['product:commerce_price']['#object']->commerce_stock['und'][0]['value'];
				 if($stock>0){
				?>
				
				<div class="jprd_form_sbt"><?php print render($content['field_product'][0]); ?></div>
				
				<?php /* <div class="jprd_form_faq"><a href="<?php print $base_url;?>/content/inquire-about/?nid=<?php print $node_id; ?>&node_title=<?php print $title; ?>&sku=<?php echo $content['product:commerce_price']['#object']->sku; ?>">Inquire About</a></div> */ ?>
				
				<?php
				}
				?>
				
			</div>
            <div class="jprd_form_sbt"><?php print render($content['field_addthis']); ?></div>
		</div>
	</div>	
</div>


