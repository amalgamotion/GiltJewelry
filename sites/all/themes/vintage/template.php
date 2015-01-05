<?php
/*
 * Here we override the default HTML output of drupal.
 * refer to http://drupal.org/node/550722
 */
 
// Auto-rebuild the theme registry during theme development.
if (theme_get_setting('clear_registry')) {
  // Rebuild .info data.
  system_rebuild_theme_data();
  // Rebuild theme registry.
  drupal_theme_rebuild();
}
// Add Zen Tabs styles
if (theme_get_setting('vintage_tabs')) {
  drupal_add_css( drupal_get_path('theme', 'vintage') .'/css/tabs.css');
}

function vintage_preprocess_html(&$variables) {
	//echo '<pre>';print_r($variables);exit;
	//vinatge_ant,era,artisan
	//echo arg(0);exit;
	if((arg(0)=="node" && (arg(1)=='vinatge_ant'||arg(1)=='era'||arg(1)=='artisan')) or arg(0)=="sold-archive" or arg(0)=="made-to-order" ) {
		$variables['classes_array'][] = ' page-products ';
	}
	
   drupal_add_css('https://fonts.googleapis.com/css?family=EB+Garamond', array('group' => CSS_THEME));
}
	
function vintage_preprocess_page(&$vars, $hook) {
	//echo arg(0).arg(1);exit;
	//echo 'dsf';
	//echo '<pre>';print_r($vars['theme_hook_suggestions']);exit;
  if (isset($vars['node_title'])) {
    $vars['title'] = $vars['node_title'];
  }
  // Adding a class to #page in wireframe mode
  if (theme_get_setting('wireframe_mode')) {
    $vars['classes_array'][] = 'wireframe-mode';
  }
  // Adding classes wether #navigation is here or not
  if (!empty($vars['main_menu']) or !empty($vars['sub_menu'])) {
    $vars['classes_array'][] = 'with-navigation';
  }
  if (!empty($vars['secondary_menu'])) {
    $vars['classes_array'][] = 'with-subnav';
  }
	 if (isset($vars['node'])) {
		$vars['theme_hook_suggestions'][] = 'page__'. $vars['node']->type;
	 }
	
	/*$jscrollpane_js = '
    $(document).ready(function() { 
      $(".content_area").jScrollPane();
    });';
  drupal_add_js($jscrollpane_js, 'inline');
  $vars['scripts'] = drupal_get_js();  Note: use appropriate method for your theme for adding js   */
	
	//Product view
	if (isset($vars['node'])) {
		if($vars['node']->type=='jewelry') {
			$vars['theme_hook_suggestions'][] = 'page__node__' . $vars['node']->type;
		}
		// if($vars['node']->type=='made_to_order') {
			// $vars['theme_hook_suggestions'][] = 'page__products';
		// }
	}
	
	// if(arg(0)=='node' && arg(1)==56) {
		// drupal_add_js("jQuery(document).ready(function(){jQuery('#block-views-vgtt-block_1 .views-view-grid tr').css('display','none');jQuery('#block-views-vgtt-block_1 .views-view-grid tr.row-1').css('display','block');});","inline");
	// }
	// if(arg(0)=='node' && arg(1)==58) {
		// drupal_add_js("jQuery(document).ready(function(){jQuery('#block-views-vgtt_clone-block_1 .views-view-grid tr').css('display','none');jQuery('#block-views-vgtt_clone-block_1 .views-view-grid tr.row-1').css('display','block');});","inline");
	// }
	// if(isset($vars['page']['left_column']['taxonomy_menu_block_1']) && !empty($vars['page']['left_column']['taxonomy_menu_block_1'])) {
		// drupal_add_js("jQuery(document).ready(function(){ 
			// jQuery('#block-taxonomy_menu_block-1 ul li').has('ul').addClass('btmb');
			// jQuery('#block-taxonomy_menu_block-1 ul li a.active').parents('li').hasClass('btmb')?jQuery('#block-taxonomy_menu_block-1 ul li a.active').parents('li').removeClass('btmb').addClass('btmbact'):jQuery('#block-taxonomy_menu_block-1 ul li a.active').parents('li').removeClass('btmbact');
			// jQuery('#block-taxonomy_menu_block-1 li ul li').removeClass('btmbact');
			// jQuery('#block-taxonomy_menu_block-1 ul li a.active').siblings('ul').css('display','block');
			// jQuery('#block-taxonomy_menu_block-1 li ul li a.active').parents('ul').css('display','block');
		// }); function fn_termmenu(v){ if(jQuery('#termmenu_'+v+' ul').css('display') == 'none'){jQuery('#termmenu_'+v).removeClass('btmb').addClass('btmbact'); } 
				// else { jQuery('#termmenu_'+v).removeClass('btmbact').addClass('btmb');  } jQuery('#termmenu_'+v+' ul').slideToggle('slow');
		// }", "inline");
	// }
	
	//Product view
	/*if (($views_page = views_get_page_view()) && $views_page->name === "jewlry") {
      $variables['theme_hook_suggestions'][] = 'page__views__jewlry';
    }*/
	
}

/*function vintage_preprocess_views_view_field(&$variables) {
  if(isset($variables['view']->name) && $variables['view']->name=='jewlry') {
    $function = "vintage_preprocess_views_view__" .$variables['view']->name;
  }
}
*/

function vintage_preprocess_node(&$vars) {
	if($vars['type']=='jewelry') {
		//$vars['node_product_images']=$vars['service_links'];
	}
	//echo '<pre>';print_r($vars);exit;
  // Add a striping class.
  $vars['classes_array'][] = 'node-' . $vars['zebra'];
}

function vintage_preprocess_block(&$vars, $hook) {
  // Add a striping class.
  $vars['classes_array'][] = 'block-' . $vars['zebra'];
}

/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return
 *   A string containing the breadcrumb output.
 */
function vintage_breadcrumb($variables) {
	global $base_url;
	/* $nid=arg(1);
	$node=node_load($nid);
	$output='';
	if(arg(0)=="node"&&$node->type=="jewelry") {		
		if(!empty($node->field_node_catalog)) {
			$term_id=$node->field_node_catalog['und'][0]['tid'];
		}
		else if(!empty($node->field_node_era)) {
			$term_id=$node->field_node_era['und'][0]['tid'];
		}
		else  {
			$term_id=$node->field_node_artisan['und'][0]['tid'];
		}
		$term_object=taxonomy_get_parents_all($term_id);
		$count=count($term_object)-1;
		//echo $term_object[2]->name;
		for($i=$count;$i>=0;$i--) {
			$variables['breadcrumb'][]=l($term_object[$i]->name,$base_url.url('taxonomy/term/' . $term_object[$i]->tid));
		}
		
		array_shift($variables['breadcrumb']);
		
		$output .= '<div class="breadcrumb custom_breadcrumb">' . implode(' » ', $variables['breadcrumb']) . '</div>';
		return $output;
	} */

	//echo '<pre>';print_r($variables['breadcrumb']);echo '</pre>';exit;
// $variables['breadcrumb'][]=l('about','node/118');
// $output="";
// $output .= '<div class="breadcrumb">' . implode(' » ', $variables['breadcrumb']) . '</div>';
// return $output;
  
 /* if(arg(0)=='product' && is_numeric(arg(1)) && arg(2)=='list') { 
 return '';
 }

  $breadcrumb = $variables['breadcrumb'];
  // Determine if we are to display the breadcrumb.
  $show_breadcrumb = theme_get_setting('vintage_breadcrumb');
  if ($show_breadcrumb == 'yes' || $show_breadcrumb == 'admin' && arg(0) == 'admin') {

    // Optionally get rid of the homepage link.
    $show_breadcrumb_home = theme_get_setting('vintage_breadcrumb_home');
    if (!$show_breadcrumb_home) {
      array_shift($breadcrumb);
    }

    // Return the breadcrumb with separators.
    if (!empty($breadcrumb)) {
      $breadcrumb_separator = theme_get_setting('vintage_breadcrumb_separator');
      $trailing_separator = $title = '';
      if (theme_get_setting('vintage_breadcrumb_title')) {
        $item = menu_get_item();
        if (!empty($item['tab_parent'])) {
          // If we are on a non-default tab, use the tab's title.
          $title = check_plain($item['title']);
        }
        else {
          $title = drupal_get_title();
        }
        if ($title) {
          $trailing_separator = $breadcrumb_separator;
        }
      }
      elseif (theme_get_setting('vintage_breadcrumb_trailing')) {
        $trailing_separator = $breadcrumb_separator;
      }

      // Provide a navigational heading to give context for breadcrumb links to
      // screen-reader users. Make the heading invisible with .element-invisible.
      $heading = '<h2 class="element-invisible">' . t('You are here') . '</h2>';

      return $heading . '<div class="breadcrumb">' . implode($breadcrumb_separator, $breadcrumb) . $trailing_separator . $title . '</div>';
    }
  }
  // Otherwise, return an empty string.
  return ''; */
}

/* 	
 * 	Converts a string to a suitable html ID attribute.
 * 	
 * 	 http://www.w3.org/TR/html4/struct/global.html#h-7.5.2 specifies what makes a
 * 	 valid ID attribute in HTML. This function:
 * 	
 * 	- Ensure an ID starts with an alpha character by optionally adding an 'n'.
 * 	- Replaces any character except A-Z, numbers, and underscores with dashes.
 * 	- Converts entire string to lowercase.
 * 	
 * 	@param $string
 * 	  The string
 * 	@return
 * 	  The converted string
 */	
function vintage_id_safe($string) {
  // Replace with dashes anything that isn't A-Z, numbers, dashes, or underscores.
  $string = strtolower(preg_replace('/[^a-zA-Z0-9_-]+/', '-', $string));
  // If the first character is not a-z, add 'n' in front.
  if (!ctype_lower($string{0})) { // Don't use ctype_alpha since its locale aware.
    $string = 'id'. $string;
  }
  return $string;
}

/**
 * Generate the HTML output for a menu link and submenu.
 *
 * @param $variables
 *   An associative array containing:
 *   - element: Structured array data for a menu link.
 *
 * @return
 *   A themed HTML string.
 *
 * @ingroup themeable
 */ 
/* function vintage_menu_link(array $variables) { 

  $element = $variables['element']; 
  $sub_menu = '';
  
  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }
  
  if($element['#href']=='cart/my') {
	$element['#title']=$element['#original_link']['link_title']=$element['#original_link']['title']=$element['#title'].' ('.items_on_cart().')';
  }
  
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  // Adding a class depending on the TITLE of the link (not constant)
  $element['#attributes']['class'][] = vintage_id_safe($element['#title']);
  // Adding a class depending on the ID of the link (constant)
  $element['#attributes']['class'][] = 'mid-' . $element['#original_link']['mlid'];
  
   
	if($element['#original_link']['menu_name']=='menu-custom-main-menu' && $element['#href']=='node/56') {  
		return '<li' . drupal_attributes($element['#attributes']) . ' id="sub_menu">' . $output . custom_nicemenucontent() .'</li>';
	}
   
   return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
  
} */



function vintage_menu_link(array $variables) {
	
  $element = $variables['element'];
 // echo '<pre>';print_r($element);echo '</pre>';
  //echo $element['#original_link']['p1'];echo '<br>';
  //echo '<pre>';print_r($element['#original_link']['module']);echo '</pre>';
  //echo '<br>';
  //echo '<pre>';print_r($element);echo '</pre>';
  //echo '<pre>';print_r($sub);echo '</pre>';
  $sub_menu = '';
  if ($element['#below']) { 
    $sub_menu = drupal_render($element['#below']);
  }
	//echo '<pre>';print_r($element['#below']);echo '</pre>';
	//echo strpos($element['#href'],'taxonomy/term/');echo '<br>';
	if (strpos($element['#href'],'taxonomy/term/') !== false) {
		$href = str_replace('taxonomy/term/','products/',$element['#href']);
		//$element['#href'] = $href;
		$output = l($element['#title'], $element['#href'], $element['#localized_options']);
	}else{
		if(($element['#href'] == 'node/56' || $element['#title'] =='Gallery')) {
			 $output = '<a href="javascript:void(0)" class="nolink">' . $element['#title'] . '</a>';
			 return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
		}else{
			if($element['#original_link']['p1']=='3767' && $element['#original_link']['module']=='menu') {
				// echo '<pre>';print_r($element['#original_link']);echo '</pre>';
				// return "";
				$output = l($element['#title'], $element['#href'], $element['#localized_options']);
			}else{
				//echo $element['#title'] .'---' .$element['#href'];echo '<br>';
				if($element['#title']=='Shopping Bag'&&$element['#href']=='cart/my') {
					$quantity= product_count();
					if($quantity) {
						$Pcount=$quantity;
						$output = l($element['#title'] .' ( '.$Pcount.' )', $element['#href'], $element['#localized_options']);
					}else{
						$output = l($element['#title'], $element['#href'], $element['#localized_options']);
					}
					
				}else {
					$output = l($element['#title'], $element['#href'], $element['#localized_options']);
				}
			}
		}
	}
	//echo $element['#href'];
	//echo '<br>';
 
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}  
/* 

 function vintage_link($variables) {
	//echo '<pre>';print_r($variables);echo '</pre>';
	$variables['path'] = 'product';
  return '<a href="' . check_plain(url($variables['path'], $variables['options'])) . '"' . drupal_attributes($variables['options']['attributes']) . '><span>' . ($variables['options']['html'] ? $variables['text'] : check_plain($variables['text'])) . '</span></a>';
}
   */
 

function custom_nicemenucontent(){
	global $base_url;
	//echo '<pre>'; print_r(taxonomy_get_tree(2));  exit();
	$output='<ul>';
	foreach(taxonomy_get_tree(2) as $key=>$val) {
		if($val->parents[0]==0) {
			$output.='<li><a href="'.$base_url.'/product/'. $val->tid .'/list">'. $val->name .'</a></li>';
		}
	}		
	$output.='</ul>';
	return $output;
}

function items_on_cart(){
	global $user;
	$line_items=0;
	if(isset($user) && !empty($user->uid)) {
		$cart=commerce_cart_order_load($user->uid);
		$line_items=count($cart->commerce_line_items['und']);
		return $line_items;
	}
	return $line_items;
}

/**
 * Override or insert variables into theme_menu_local_task().
 */
function vintage_preprocess_menu_local_task(&$variables) {
  $link =& $variables['element']['#link'];

  // If the link does not contain HTML already, check_plain() it now.
  // After we set 'html'=TRUE the link will not be sanitized by l().
  if (empty($link['localized_options']['html'])) {
    $link['title'] = check_plain($link['title']);
  }
  $link['localized_options']['html'] = TRUE;
  $link['title'] = '<span class="tab">' . $link['title'] . '</span>';
}

/*
 *  Duplicate of theme_menu_local_tasks() but adds clearfix to tabs.
 */

function vintage_menu_local_tasks(&$variables) {  
  $output = '';
  if (!empty($variables['primary'])) {
    $variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
    $variables['primary']['#prefix'] .= '<ul class="tabs primary clearfix">';
    $variables['primary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['primary']);
  }
  if (!empty($variables['secondary'])) {
    $variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
    $variables['secondary']['#prefix'] .= '<ul class="tabs secondary clearfix">';
    $variables['secondary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['secondary']);
  }
  return $output;
}

function vintage_form_comment_form_alter (&$form, &$form_state) {
	//dpm($form);  //shows original $form array
	$form['author']['homepage']['#access'] = FALSE;
	unset($form['subject']);
}

function vintage_form_alter(&$form, &$form_state, $form_id) {
	global $base_url;
	
	
	/* echo $node_id=arg(1);
	$nodeDetails=node_load($node_id);
	
	echo "<pre>";
	print_r($form_state[default_product]->type);
	exit; 
*/
	
	
	
	

	if($form_id=='contact_site_form'){
		$form['#action']=str_replace('/colorbox', '',$form['#action']);
	}
	
	
		
	/* if(strchr($form_id,"commerce_cart_add_to_cart_form")!=''){		
		$inquiryUrl=$base_url.'/content/inquire-about/?nid='.$form_state['context']['entity_id'].'&node_title='.$form_state['default_product']->title.'&sku='.$form_state['default_product']->sku;
		$form['test_content'] = array(
		  '#type' => 'link',
		  '#title' => t('Inquire About'),
		  '#href' => $inquiryUrl,
		  '#weight'=>$form['submit']['#weight']+1,
		  '#attributes'=>array('class' => array('custom_inquire'))		  
		 );
	} */
	
	
	
	
	if(strchr($form_id,"commerce_cart_add_to_cart_form")!=''){			
		
		if(arg(0)=='node'){
		$inquiryUrl=$base_url.'/content/inquire-about/?nid='.$form_state['context']['entity_id'].'&node_title='.$form_state['default_product']->title.'&sku='.$form_state['default_product']->sku; 
		 unset($form['element']['#ajax']['progress']['message']);	
     if(isset($form['attributes']['#weight'])){   	 
		if($form_state['default_product']->type=='jewelry') {
			$form['lineSpace'] = array(
					'#markup' => '',
					'#weight'=>$form['attributes']['#weight']+2,
			);
		}
	}
        //$made_to_order = $form_state[default_product]->type=='made_to_order';			
		if($form_state['default_product']->type=='made_to_order') {	 
			$form['lineSpace'] = array(
					'#markup' => '<br/><br/><br/><br/><br/>',
					'#weight'=>(isset($form['attributes']['#weight'])?$form['attributes']['#weight']:0)+2,
			);	
		}
		
		$form['line_item_fields']['#value']='Add to Bag';
		$form['submit']['#value']='Add to Bag';
		$form['submit']['#id']='edit-submit';		
		$form['add_to_wishlist']['#weight']=$form['submit']['#weight']-1;	
		$form['add_to_wishlist']['#markup']=str_replace('|','',$form['add_to_wishlist']['#markup']);
		
		$form['test_content'] = array(
		  '#type' => 'link',
		  '#title' => t('Inquire About'),
		  '#href' => $inquiryUrl,
		  '#weight'=>$form['submit']['#weight']+1,
		  '#attributes'=>array('class' => array('custom_inquire'))		  
		 );
		
		}
		
	}
	
	
}


/*function vintage_form_comment_form_alter(&$form, &$form_state, &$form_id) {
  $form['comment_body']['#after_build'][] = 'vintage_customize_comment_form';  
}

function vintage_customize_comment_form(&$form) {
  // Hide guideliness
  $form[LANGUAGE_NONE][0]['format']['guidelines']['#access'] = FALSE; // Note �und�, you may need to set your comment form language code instead
  // Hide Filter Tips
  $form[LANGUAGE_NONE][0]['format']['help']['#access'] = FALSE;
  // Hide Filter Fieldset
  $form[LANGUAGE_NONE][0]['format']['#theme_wrappers'] = NULL;
  return $form;  
}*/


function product_count() {
    global $user;
    $quantity = 0;

    $order = commerce_cart_order_load($user->uid);

    if ($order) {
        $wrapper = entity_metadata_wrapper('commerce_order', $order);
        $line_items = $wrapper->commerce_line_items;
        $quantity = commerce_line_items_quantity($line_items, commerce_product_line_item_types());
        $total = commerce_line_items_total($line_items);
        $currency = commerce_currency_load($total['currency_code']);
    }
    return $quantity;
}

function vintage_commerce_extra_panes_termsofservice_form_alter(&$form, &$form_state, $form_id) {
    if (strpos($form_id, 'commerce_checkout_form_') === 0) {
        $extra_panes = commerce_extra_panes_get_panes();
        $enabled_panes = commerce_checkout_panes(array('enabled' => TRUE));
        $page_id = $form_state['checkout_page']['page_id'];
        foreach ($extra_panes as $extra_pane) {
            if ($extra_pane->status) {
                $pane_id = 'extra_pane__' . $extra_pane->extra_type . '__' . $extra_pane->extra_id;
                if ($enabled_panes[$pane_id]['page'] == $page_id) {
                    if (variable_get('cep_tos_' . $pane_id, 0)) {
                        $form[$pane_id]['termsofservice'] = array(
                            '#type' => 'checkbox',
                            '#title' => t('I agree with the Return Policy'),
                            '#required' => variable_get('cep_tos_required_' . $pane_id, 0),
                            '#weight' => variable_get('cep_tos_position_' . $pane_id, 'below') == 'below' ? 1 : -1,
                        );
                        // Add a generic class.
                        $form[$pane_id]['#attributes'] = array(
                            'class' => array('terms-of-service'),
                            '#weight' => 0,
                        );
                    }
                }
            }
        }
    }
}
