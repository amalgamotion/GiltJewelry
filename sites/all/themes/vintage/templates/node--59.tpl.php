<?php
	//echo 'sdfsadfsdaf';
	$id = isset($_REQUEST['nid']) ? $_REQUEST['nid']:'';
	$node_details = node_load($id);
	if(!empty($node_details)) { 
	///echo $node_details->field_product['und'][0]['product_id'];
	$product = commerce_product_load($node_details->field_product['und'][0]['product_id']);
	//$product_images = file_create_url($product->field_product_image['und'][0]['uri']);
	$currency_code = $product->commerce_price['und'][0]['currency_code'];
	//echo '<pre>';print_r($product);exit;
	drupal_set_title('Inquire About '.$node_details->title); 
	if(!empty($node_details->field_product_image)) {
		$product_images=file_create_url($node_details->field_product_image['und'][0]['uri']);
	}
?>
	<div id="jwl_cnt_widget">
		<div class="jcnt_tle"><h3 class="title"><?php print 'Inquire About '.$node_details->title; ?></h3></div> 
		<div class="jww_inner">
			<div class="jww_slide">
				<img width="320" height="320" src="<?php print $product_images; ?>">
			</div>
			<div class="jww_rgtcnt">
				<div class="jprd_scnt">
					<div class="jprd_form_wgt"><?php print commerce_currency_format($product->commerce_price['und'][0]['amount'],$currency_code, $object = NULL, $convert = TRUE); ?></div>
					<div class="jprd_form_wgt"><!--php print $node_details->body['und'][0]['value']; ?--><?php print $node->body['und'][0]['value']; ?></div>
				</div>
			</div>
			<div style="clear:both;padding-top: 21px;" class="conatct_form">
				<?php $content['body'][0]=array(''); ?>
				<?php print render($content); ?>
			</div>
		</div>
	</div>
<?php }else {
	print render($content); 	
} ?>