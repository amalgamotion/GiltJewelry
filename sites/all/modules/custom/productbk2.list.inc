<?php
ini_set('display_errors',1);
$parent=taxonomy_get_parents(25);
echo '<pre>';print_r($parent);exit;
function commerce_product_views($pid){
	global $base_url;  
	global $user;
	$cat = get_categeory($pid);

	$cat[$pid]=$pid;
	$main_taxonomy=taxonomy_term_load($pid);
	$V_id=get_voc_id($pid);
	
	
	$output="";
	$limit=0;
	$Product_More=0;
	
	if(!empty($main_taxonomy)) {
		$product_image=isset($main_taxonomy->uc_catalog_image['und'][0]['uri'])?$main_taxonomy->uc_catalog_image['und'][0]['uri']:'';
		
		$output.="
		<div class='product_content'>
			<div class='product_tax_title'><h2 class='lower-title'>
				".$main_taxonomy->name."</h2>
			</div>
			<div class='product_tax_container'>
				<div class='product_tax_contents'>
					".@$main_taxonomy->description."
				</div>
				<div class='product_tax_images'>
					".get_images($product_image)."
				</div>
			</div>
		</div>";
	}
	
	
	$productCountStatus=false;
	if(!empty($cat)) {
		$output.="<table>";
		$output.="<tbody>";
	
		$record =array();
		foreach($cat as $key=>$val) {
			//$val
			
			//echo "<br>";
			$Query = db_query("SELECT taxonomy_term_data_field_data_taxonomy_catalog.name AS taxonomy_term_data_field_data_taxonomy_catalog_name, taxonomy_term_data_field_data_field_era.name AS taxonomy_term_data_field_data_field_era_name,taxonomy_term_data_field_data_field_artisan.name AS taxonomy_term_data_field_data_field_artisan_name,
			taxonomy_term_data_field_data_taxonomy_catalog.vid AS ta