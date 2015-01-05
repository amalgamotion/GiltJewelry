<?php
	ini_set('display_errors',1);
	//echo '<pre>';print_r($terms);echo '</pre>';
function commerce_product_views($pid){
	global $base_url;
	global $user;
	$cat = get_categeory($pid);
	$cat[$pid]=$pid;
	$main_taxonomy=taxonomy_term_load($pid);
	
	//echo '<pre>';print_r($main_taxonomy);exit;
	$output="";
	$limit=0;
	
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
			//echo $pid;echo '<br>';
			
			
			// $Query = db_query("SELECT taxonomy_term_data_field_data_taxonomy_catalog.name AS taxonomy_term_data_field_data_taxonomy_catalog_name, taxonomy_term_data_field_data_taxonomy_catalog.vid AS taxonomy_term_data_field_data_taxonomy_catalog_vid, taxonomy_term_data_field_data_taxonomy_catalog.tid AS taxonomy_term_data_field_data_taxonomy_catalog_tid, taxonomy_term_data_field_data_taxonomy_catalog__taxonomy_vocabulary.machine_name AS taxonomy_term_data_field_data_taxonomy_catalog__taxonomy_voc, commerce_product.product_id AS product_id, field_product_commerce_product.nid AS field_product_commerce_product_nid, field_product_commerce_product.created AS field_product_commerce_product_created, 'taxonomy_term' AS field_data_field_content_taxonomy_term_entity_type
			// FROM 
			// {commerce_product} commerce_product
			// LEFT JOIN {field_data_taxonomy_catalog} field_data_taxonomy_catalog ON commerce_product.product_id = field_data_taxonomy_catalog.entity_id AND (field_data_taxonomy_catalog.entity_type = 'commerce_product' AND field_data_taxonomy_catalog.deleted = '0')
			// LEFT JOIN {taxonomy_term_data} taxonomy_term_data_field_data_taxonomy_catalog ON field_data_taxonomy_catalog.taxonomy_catalog_tid = taxonomy_term_data_field_data_taxonomy_catalog.tid
			// LEFT JOIN {field_data_field_product} field_data_field_product ON commerce_product.product_id = field_data_field_product.field_product_product_id
			// LEFT JOIN {node} field_product_commerce_product ON field_data_field_product.entity_id = field_product_commerce_product.nid
			// LEFT JOIN {taxonomy_vocabulary} taxonomy_term_data_field_data_taxonomy_catalog__taxonomy_vocabulary ON taxonomy_term_data_field_data_taxonomy_catalog.vid = taxonomy_term_data_field_data_taxonomy_catalog__taxonomy_vocabulary.vid
			// WHERE (( (field_data_taxonomy_catalog.taxonomy_catalog_tid = '".$val."' ) )AND(( (field_product_commerce_product.type IN  ('jewelry')) )))
			// ORDER BY field_product_commerce_product_created DESC
			// LIMIT 10 OFFSET 0");
			
			$Query = db_query("SELECT taxonomy_term_data_field_data_taxonomy_catalog.name AS taxonomy_term_data_field_data_taxonomy_catalog_name, taxonomy_term_data_field_data_taxonomy_catalog.vid AS taxonomy_term_data_field_data_taxonomy_catalog_vid, taxonomy_term_data_field_data_taxonomy_catalog.tid AS taxonomy_term_data_field_data_taxonomy_catalog_tid, taxonomy_term_data_field_data_taxonomy_catalog__taxonomy_vocabulary.machine_name AS taxonomy_term_data_field_data_taxonomy_catalog__taxonomy_voc, commerce_product.product_id AS product_id, field_product_commerce_product.nid AS field_product_commerce_product_nid, field_product_commerce_product.created AS field_product_commerce_product_created, 'taxonomy_term' AS field_data_field_content_taxonomy_term_entity_type
			FROM 
			commerce_product commerce_product
			LEFT JOIN field_data_taxonomy_catalog field_data_taxonomy_catalog ON commerce_product.product_id = field_data_taxonomy_catalog.entity_id AND (field_data_taxonomy_catalog.entity_type = 'commerce_product' AND field_data_taxonomy_catalog.deleted = '0')
			LEFT JOIN {taxonomy_term_data} taxonomy_term_data_field_data_taxonomy_catalog ON field_data_taxonomy_catalog.taxonomy_catalog_tid = taxonomy_term_data_field_data_taxonomy_catalog.tid
			LEFT JOIN field_data_field_product field_data_field_product ON commerce_product.product_id = field_data_field_product.field_product_product_id
			LEFT JOIN node field_product_commerce_product ON field_data_field_product.entity_id = field_product_commerce_product.nid
			LEFT JOIN taxonomy_vocabulary taxonomy_term_data_field_data_taxonomy_catalog__taxonomy_vocabulary ON taxonomy_term_data_field_data_taxonomy_catalog.vid = 
			taxonomy_term_data_field_data_taxonomy_catalog__taxonomy_vocabulary.vid

			LEFT JOIN {field_data_field_era} field_data_field_era ON commerce_product.product_id = field_data_field_era.entity_id AND (field_data_field_era.entity_type = 'commerce_product' AND field_data_field_era.deleted = '0')
			LEFT JOIN {taxonomy_term_data} taxonomy_term_data_field_data_field_era ON field_data_field_era.field_era_tid = taxonomy_term_data_field_data_field_era.tid
			
			LEFT JOIN {field_data_field_artisan} field_data_field_artisan ON commerce_product.product_id = field_data_field_artisan.entity_id AND (field_data_field_artisan.entity_type = 'commerce_product' AND field_data_field_artisan.deleted = '0')
			LEFT JOIN {taxonomy_term_data} taxonomy_term_data_field_data_field_artisan ON field_data_field_artisan.field_artisan_tid = taxonomy_term_data_field_data_field_artisan.tid

			WHERE (( (field_data_taxonomy_catalog.taxonomy_catalog_tid = '".$val."' OR field_data_field_era.field_era_tid = '".$val."' OR field_data_field_artisan.field_artisan_tid = '".$val."')) )AND(( (field_product_commerce_product.type IN  ('jewelry')) ))");
			
			$count = $Query->rowCount();
			if($count>0){
				$productCountStatus=true;
				$record = $Query->fetchAll(); 
				$output.="<tr>"; 
			}
			
			if($count >4&&$pid!=$val) {
				$count=4;
			}
			// if($count>0){
				// echo $val."===".$count;
				// echo '<br>';
			// }
			
			
			for($i=0;$i<$count;$i++) {	
				if(($pid==$val) &&($i>0&&$i%4==0)) {
					$output.="</tr><tr>";
				}
			
				$product_id=$record[$i]->product_id;
				$field_product_commerce_product_nid= $record[$i]->field_product_commerce_product_nid;
				$product_details=commerce_product_load($product_id);
				$currency_code = $product_details->commerce_price['und'][0]['currency_code'];
				//echo '<pre>';print_r($product_details);echo '</pre>';
				$in_wishlist = commerce_wishlist_in_wishlist($user->uid, $product_id);
				$path=drupal_lookup_path('alias', $path = 'node/'.$field_product_commerce_product_nid, $path_language = NULL);
				
				$url = 'wishlist-actions/nojs/add/' . $user->uid . '/' . $product_id . '/' . $field_product_commerce_product_nid;
				$params = array(
				  'attributes' => array(
					'class' => array('ajax' => 'use-ajax', 'add-to-wishlist'),
					'id' => 'add-wishlist-' . $product_id
				  ),
				  'query' => array('list' => 'list','destination' => $_GET['q'], 'token' => drupal_get_token()
				  ),
				);
				if (!$user->uid) {
				  unset($params['attributes']['class']['ajax'], $params['query']);
				  $params['query']['product_id'] = $product_id;
				  $params['query']['nid'] = $field_product_commerce_product_nid;
				  $params['query']['original_url'] = $_GET['q'];
				  $url = 'user/login';
				}
				$output.="<td class='article-additional-info'>";
				
				if($pid==$val) {
					$output.='<div class="view-grouping"><div class="view-grouping-header">&nbsp;</div></div>';
				}else{
					if($i==0 && ($record[$i]->taxonomy_term_data_field_data_taxonomy_catalog_name!=$main_taxonomy->name)) {
						$output.='<div class="view-grouping"><div class="view-grouping-header"><a href="'.$base_url.'/products/'.$val.'">'.$record[$i]->taxonomy_term_data_field_data_taxonomy_catalog_name.'</a></div></div>';
					}else{
						$output.='<div class="view-grouping"><div class="view-grouping-header">&nbsp;</div></div>';
					}
				}
				$output.="<div class='product_image'><a href='".$base_url.'/'.$path."'><img width='160' height='193' src='".file_create_url($product_details->field_product_image['und'][0]['uri'])."'/></a><div/>";
				$output.="<div class='product_title'>".substr($product_details->title,0,25).'</div>';
				$output.='<div class="product_purchase"><a href="'.$base_url.'/'.$path.'">See Details/Purchase</a></div>';
				$output.='<div class="product_currency">'.commerce_currency_format($product_details->commerce_price['und'][0]['amount'],$currency_code, $object = NULL, $convert = TRUE).'</div>';
				//$output.='<a href="#">Add to Wishlist</a></div>';
				
				//$output.='<div class="product_whist">'.l(t('Add to Wishlist'), $url, $params).'</div>';
				
				//$link_exists = _commerce_wishlist_link($user->uid);
				if($in_wishlist==1){					
					$output.='<div class="product_whist">'.l(t('Already in wishlist'), 'user/' . $user->uid . '/wishlist').' | '.l(t('Add to Bag'),'product/add/'.$product_id.'/1').'</div>';
				}else{					
					$output.='<div class="product_whist">'.l(t('Add to Wishlist'), $url, $params).' | '.l(t('Add to Bag'),'product/add/'.$product_id.'/1').'</div>';
				}
				
				//$output.=bt_donation_form_page($product_id);
				$output.="</td>";
				$extra=4-$count;
				//echo "$i==$count";echo '<br>';
				if($i==($count-1)) {
					for($e=0;$e<$extra;$e++){
						$output.="<td></td>";
					}
				}
			}
			$count = $Query->rowCount();
			if($count>0){
				$output.="</tr>";
			}
		}
		$output.="</tbody></table>";
	}else{
		return $output.'<div class="view-empty">
							<div class="empty_view">There are no products in this category currently available.</div>
						</div>';
	}
	
	
	if($productCountStatus==true){
		return $output;
	}else{
		return $output.'<div class="view-empty">
							<div class="empty_view">There are no products in this category currently available.</div>
						</div>';
	}
	
}
function get_categeory($id) {
	$result='';
  $c = taxonomy_get_children($id);
  if(!empty($c)) {
	$result = array();
	foreach ($c as $t => $d){
		$result[$t] = $t;
		$below = get_categeory($t);
		if (!empty($below)) {
		  foreach ($below as $nt => $nd){
			$result[$nt] = $nt;
		  }
		}
	}
  }
  return $result;
}


function get_images($links) {
	if($links!=""){
		return '<img height=150 width=200 src="'.file_create_url($links).'"/>';
	}
	return '';
}


?>