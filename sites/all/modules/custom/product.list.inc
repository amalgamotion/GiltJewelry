<?php
ini_set('display_errors',1);
function commerce_product_views($pid=null){
	return '';
	$tid=get_categeory($pid);
	//echo '<pre>';print_r($tid);exit;
	//return views_embed_view('testing_node_product','block_1',27);
	//return views_embed_view('testing_node_product','block_1',17);
	/*
	//vin=2,era=7,art=8
	global $base_url;  
	global $user,$V_id;
	//echo $_GET['q'];
	$archive_filter="";
	$archive_query='';
	$sold=0;
	if($_GET['q']=='archive_products') {
		$sold=1;
		$archive_query=" LEFT JOIN {field_data_commerce_stock} field_data_commerce_stock ON commerce_product.product_id = field_data_commerce_stock.entity_id AND (field_data_commerce_stock.entity_type = 'commerce_product' AND field_data_commerce_stock.deleted = '0')";
		$archive_filter=" AND (field_data_commerce_stock.commerce_stock_value = '0') ORDER BY field_product_commerce_product__weight_weights_weight ASC";
		$cat = get_categeory_archive();
	}else{
		$archive_query=" LEFT JOIN {field_data_commerce_stock} field_data_commerce_stock ON commerce_product.product_id = field_data_commerce_stock.entity_id AND (field_data_commerce_stock.entity_type = 'commerce_product' AND field_data_commerce_stock.deleted = '0')";
		$archive_filter=" AND (field_data_commerce_stock.commerce_stock_value > '0') ORDER BY field_product_commerce_product__weight_weights_weight ASC";
		$cat = get_categeory($pid);
	}
	
	//echo '<pre>';print_r($archive_cat);echo '</pre>';
	//exit;
	/* $connection = Database::getConnection('default', 'default');
	$connectionOptions = $connection->getConnectionOptions();
	echo "<pre>";
	print_r($connectionOptions);
	exit; 
	Array
	(
		[driver] => mysql
		[database] => amalgamotion_gil
		[username] => amalgamotion_gil
		[password] => 5pD5twMA
		[host] => localhost
		[prefix] => Array
			(
				[default] => 
			)

	)
	

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
	//echo '<pre>';print_r($cat);exit;
	
	$productCountStatus=false;
	if(!empty($cat)) {
		$output.="<table>";
		$output.="<tbody>";
	
		$record =array();
		foreach($cat as $key=>$val) {
			//$val
			
			//echo "<br>";
			$product_query="SELECT taxonomy_term_data_field_data_taxonomy_catalog.name AS taxonomy_term_data_field_data_taxonomy_catalog_name, taxonomy_term_data_field_data_field_era.name AS taxonomy_term_data_field_data_field_era_name,taxonomy_term_data_field_data_field_artisan.name AS taxonomy_term_data_field_data_field_artisan_name,
			taxonomy_term_data_field_data_taxonomy_catalog.vid AS taxonomy_term_data_field_data_taxonomy_catalog_vid, 
			taxonomy_term_data_field_data_field_era.vid AS taxonomy_term_data_field_data_field_era_vid,
			taxonomy_term_data_field_data_field_artisan.vid AS taxonomy_term_data_field_data_field_artisan_vid,
			taxonomy_term_data_field_data_taxonomy_catalog.tid AS taxonomy_term_data_field_data_taxonomy_catalog_tid, taxonomy_term_data_field_data_taxonomy_catalog__taxonomy_vocabulary.machine_name AS taxonomy_term_data_field_data_taxonomy_catalog__taxonomy_voc, commerce_product.product_id AS product_id, field_product_commerce_product.nid AS field_product_commerce_product_nid,
			field_product_commerce_product__weight_weights.weight AS field_product_commerce_product__weight_weights_weight,
			field_product_commerce_product.created AS field_product_commerce_product_created, 'taxonomy_term' AS field_data_field_content_taxonomy_term_entity_type
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
			
			LEFT JOIN {weight_weights} field_product_commerce_product__weight_weights ON field_product_commerce_product.nid = field_product_commerce_product__weight_weights.entity_id
			";
			
			$product_query.=$archive_query;
			$product_query.=" WHERE (( (field_data_taxonomy_catalog.taxonomy_catalog_tid = '".$val."' OR field_data_field_era.field_era_tid = '".$val."' OR field_data_field_artisan.field_artisan_tid = '".$val."')) )AND(( (field_product_commerce_product.type IN  ('jewelry')) )) AND (field_product_commerce_product.status = '1') ";
			$product_query.=$archive_filter;
			//echo $product_query;exit;
			$Query = db_query($product_query);
			
			$count = $Query->rowCount();
			$ReadMoreCount = $Query->rowCount();
			$currnt_taxonomy_path=drupal_lookup_path('alias', 'taxonomy/term/'.$val, $path_language = NULL);
			if($count>0){
				$productCountStatus=true;
				$record = $Query->fetchAll(); 
				$output.="<tr>"; 
			}else{
				if($pid!=$val) {
					$below = get_categeory($val);
					if (!empty($below)) {
						$sm=taxonomy_term_load($val);	
						$getCheck=get_productCheck($val);						
						if(count($getCheck)>0){
							$output.='<tr><td colspan="4" class="article-additional-info"><div class="view-grouping"><div class="view-grouping-header"><h3><a href="'.$base_url.'/'.$currnt_taxonomy_path.'">'.$sm->name.'</a></h3></div></div></td></tr>';
						}							
					}
				}
			}
			
			if($count>4&&$pid!=$val) {
				$count=4;
				$Product_More=1;
			}
			
			//echo $count."-".$val."<br/>"; 
			
			
			//echo '<pre>';print_r($record);echo '</pre>';exit;
			for($i=0;$i<$count;$i++) {
				if($i==0 && $pid!=$val){
					$output.='<tr><td class="article-additional-info td_heading" colspan="4"><div class="view-grouping"><div class="view-grouping-header"><h3><a href="'.$base_url.'/'.$currnt_taxonomy_path.'">'.Pvoc_name($V_id,$record[$i]).'</a></h3></div></div></td></tr>';
				}
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
				if($pid!=$val){
					$output.="<td class='article-additional-info productInfo'>";
				}else{
					$output.="<td class='article-additional-info singleCategory'>";
				}
				
				if($pid==$val) {
					//$output.='<div class="view-grouping"><div class="view-grouping-header">&nbsp;</div></div>';
				}else{
					if($i==0) {
						//$output.='<div class="view-grouping"><div class="view-grouping-header"><a href="'.$base_url.'/'.$currnt_taxonomy_path.'">'.Pvoc_name($V_id,$record[$i]).'</a></div></div>';
						//$output.='<div class="view-grouping"><div class="view-grouping-header">&nbsp;</div></div>';
					}else{
						//$output.='<div class="view-grouping"><div class="view-grouping-header">&nbsp;</div></div>';
					}
				}
				
				
				if($product_details->field_product_image) {
					$resizedImage=image_style_url('square_thumbnail', $product_details->field_product_image['und'][0]['uri']);
					/* $output.="<div class='product_image'><a href='".$base_url.'/'.$path."'><img width='160' height='160' src='".file_create_url($product_details->field_product_image['und'][0]['uri'])."'/></a><div/>";
					$output.="<div class='product_image'><a href='".$base_url.'/'.$path."'><img width='160' height='160' src='".$resizedImage."'/></a><div/>";
				}
				$output.="<div class='product_title'>".substr($product_details->title,0,25).'</div>';
				$output.='<div class="product_purchase"><a href="'.$base_url.'/'.$path.'">See Details/Purchase</a></div>';
				$output.='<div class="product_currency">'.commerce_currency_format($product_details->commerce_price['und'][0]['amount'],$currency_code, $object = NULL, $convert = TRUE).'</div>';
				//$output.='<a href="#">Add to Wishlist</a></div>';
				
				//$output.='<div class="product_whist">'.l(t('Add to Wishlist'), $url, $params).'</div>';
				
				//$link_exists = _commerce_wishlist_link($user->uid);
				if($in_wishlist==1){
					if($sold==1) {
						$output.='<div class="product_whist">'.l(t('Already in wishlist'), 'user/' . $user->uid . '/wishlist').'</div>';
					}
					else{
						$output.='<div class="product_whist">'.l(t('Already in wishlist'), 'user/' . $user->uid . '/wishlist').' | '.l(t('Add to Bag'),'product/add/'.$product_id.'/1').'</div>';
					}
				}else{	
					if($sold==1) {
						$output.='<div class="product_whist">'.l(t('Already in wishlist'), 'user/' . $user->uid . '/wishlist').'</div>';
					}
					else{
						$output.='<div class="product_whist">'.l(t('Add to Wishlist'), $url, $params).' | '.l(t('Add to Bag'),'product/add/'.$product_id.'/1').'</div>';
					}
				}
				
				//$output.=bt_donation_form_page($product_id);
				if($i==3&&$Product_More==1) {
					$RemainCount=$ReadMoreCount-4;
					if($RemainCount!=0) {
						
						/* $output.='<tr class="more_product"><td colspan="4" align="right"><a class="more_product_link" href="'.$base_url.'/product/catalg/'.$val.'">Click to see '.$RemainCount.' more items</a></td></tr>';
						$taxUrl=$base_url.'/'.drupal_lookup_path('alias', 'taxonomy/term/'.$val, $path_language = NULL);
						
						$output.='<tr class="more_product"><td colspan="4" align="right"><a class="more_product_link" href="'.$taxUrl.'">Click to see '.$RemainCount.' more items</a></td></tr>';
					
					}
				}
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
	 */
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

function get_productCheck($id) {
  $result='';
  $c = taxonomy_get_children($id);
  if(!empty($c)) {
	$result = array();
	foreach ($c as $t => $d){
		$productCheck=db_query("select * from field_data_taxonomy_catalog as a, field_data_field_era as b, field_data_field_artisan as c
WHERE a.taxonomy_catalog_tid = '".$t."' OR b.field_era_tid = '".$t."' OR c.field_artisan_tid = '".$t."'");
		$count = $productCheck->rowCount();
		if($count>0){		
			$result[] = $count;
			break;
		}		
		$below = get_productCheck($t);
		 if (!empty($below)) {
		  foreach ($below as $nt => $nd){
			$result[$nt] = $nt;
			$productCheck=db_query("select * from field_data_taxonomy_catalog as a, field_data_field_era as b, field_data_field_artisan as c
WHERE a.taxonomy_catalog_tid = '".$t."' OR b.field_era_tid = '".$t."' OR c.field_artisan_tid = '".$t."'");
			$count = $productCheck->rowCount();
			if($count>0){		
				$result[] = $count;
				break;
			}
			
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

function get_voc_id($tid) {
	$id='';
	$Visd=taxonomy_term_load($tid);
	if(is_object($Visd))
		$id=$Visd->vid;
	
	return $id;
}

function Pvoc_name($cid,$Pro_Ar) {
	$Cname="";
	if($cid==7) {
		$Cname=$Pro_Ar->taxonomy_term_data_field_data_field_era_name;
	}
	else if($cid==8) {
		$Cname=$Pro_Ar->taxonomy_term_data_field_data_field_artisan_name;
	}
	else if($cid==2) {
		$Cname=$Pro_Ar->taxonomy_term_data_field_data_taxonomy_catalog_name;
	}	
	return $Cname;
}


function product_catalog_filter($tid) {
	$V_id=get_voc_id($tid);
	//echo $V_id;exit;
	global $user;
	global $base_url;
	$output='';
	$main_taxonomy=taxonomy_term_load($tid);
	if(!empty($main_taxonomy)) {
		$product_image=isset($main_taxonomy->uc_catalog_image['und'][0]['uri'])?$main_taxonomy->uc_catalog_image['und'][0]['uri']:'';
		
		$output.="
		<div class='product_content'>
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
	
	$Query = db_query("SELECT taxonomy_term_data_field_data_taxonomy_catalog.name AS taxonomy_term_data_field_data_taxonomy_catalog_name, taxonomy_term_data_field_data_field_era.name AS taxonomy_term_data_field_data_field_era_name,taxonomy_term_data_field_data_field_artisan.name AS taxonomy_term_data_field_data_field_artisan_name,
		taxonomy_term_data_field_data_taxonomy_catalog.vid AS taxonomy_term_data_field_data_taxonomy_catalog_vid, 
		taxonomy_term_data_field_data_field_era.vid AS taxonomy_term_data_field_data_field_era_vid,
		taxonomy_term_data_field_data_field_artisan.vid AS taxonomy_term_data_field_data_field_artisan_vid,
		taxonomy_term_data_field_data_taxonomy_catalog.tid AS taxonomy_term_data_field_data_taxonomy_catalog_tid, taxonomy_term_data_field_data_taxonomy_catalog__taxonomy_vocabulary.machine_name AS taxonomy_term_data_field_data_taxonomy_catalog__taxonomy_voc, commerce_product.product_id AS product_id, field_product_commerce_product.nid AS field_product_commerce_product_nid, field_product_commerce_product.created AS field_product_commerce_product_created, 'taxonomy_term' AS field_data_field_content_taxonomy_term_entity_type
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

		WHERE (( (field_data_taxonomy_catalog.taxonomy_catalog_tid = '".$tid."' OR field_data_field_era.field_era_tid = '".$tid."' OR field_data_field_artisan.field_artisan_tid = '".$tid."')) )AND(( (field_product_commerce_product.type IN  ('jewelry')) )) AND (field_product_commerce_product.status = '1')");
		
		$count = $Query->rowCount();
		$ReadMoreCount = $Query->rowCount();
		$currnt_taxonomy_path=drupal_lookup_path('alias', 'taxonomy/term/'.$tid, $path_language = NULL);
		if($count>0){
			$output.="<table>";
			$output.="<tbody>";
			$productCountStatus=true;
			$record = $Query->fetchAll(); 
			$output.="<tr>"; 
		}else{
			/* if($pid!=$tid) {
				$below = get_categeory($val);
				if (!empty($below)) {
					$sm=taxonomy_term_load($val);	
					$getCheck=get_productCheck($val);						
					if(count($getCheck)>0){
						$output.='<tr><td colspan="4" class="article-additional-info td_heading"><div class="view-grouping"><div class="view-grouping-header"><a href="'.$base_url.'/'.$currnt_taxonomy_path.'">'.$sm->name.'</a></div></div></td></tr>';
					}					
					
				}
			} */
		}
		
		if($count >4) {
			//$count=4;
			$Product_More=1;
		}
		
		//echo $count."-".$val."<br/>"; 
		
		
		//echo '<pre>';print_r($record);echo '</pre>';
		for($i=0;$i<$count;$i++) {
			if($i==0){
				$output.='<tr><td class="article-additional-info td_heading" colspan="4"><div class="view-grouping"><div class="view-grouping-header"><a href="'.$base_url.'/'.$currnt_taxonomy_path.'">'.Pvoc_name($V_id,$record[$i]).'</a></div></div></td></tr>';
			}
			if(($i>0&&$i%4==0)) {
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
			$output.="<td class='article-additional-info productInfo'>";
			
			/* if($pid==$tid) {
				//$output.='<div class="view-grouping"><div class="view-grouping-header">&nbsp;</div></div>';
			}else{
				if($i==0) {
					//$output.='<div class="view-grouping"><div class="view-grouping-header"><a href="'.$base_url.'/'.$currnt_taxonomy_path.'">'.Pvoc_name($V_id,$record[$i]).'</a></div></div>';
					//$output.='<div class="view-grouping"><div class="view-grouping-header">&nbsp;</div></div>';
				}else{
					//$output.='<div class="view-grouping"><div class="view-grouping-header">&nbsp;</div></div>';
				}
			} */
			$output.="<div class='product_image'><a href='".$base_url.'/'.$path."'><img width='160' height='160' src='".file_create_url($product_details->field_product_image['und'][0]['uri'])."'/></a><div/>";
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
		$output.="</tbody></table>";
		if($productCountStatus==true){
			return $output;
		}else{
			return $output.'<div class="view-empty">
								<div class="empty_view">There are no products in this category currently available.</div>
							</div>';
		}
		return $output;
	}
	
	function get_categeory_archive() {
		//vin=2,era=7,art=8
		$vid=array(2,7,8);
		$tids=array();
		foreach($vid as $tid) {
			$archive_tid=taxonomy_get_tree($tid);
			for($a=0;$a<count($archive_tid);$a++) {
				$tids[]=$archive_tid[$a]->tid;
			}
		}
		return $tids;
		//echo '<pre>';print_r($tids);echo '</pre>';
	}

?>
