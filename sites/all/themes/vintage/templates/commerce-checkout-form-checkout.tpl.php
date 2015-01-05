<?php
	
	drupal_add_css(drupal_get_path('theme', 'vintage') . '/css/wishlist.css');
?>
	<?php print render($form['cart_contents']); ?>
 
<fieldset>
    <legend>Shiping Info</legend>
	<div class="part1">
		<div class="fullname">	
			<?php echo render($form['customer_profile_shipping']['commerce_customer_address']['und'][0]['name_block']['name_line']); ?>
		</div>
		<div class="country">	
			<?php echo render($form['customer_profile_shipping']['commerce_customer_address']['und'][0]['country']); ?>
		</div>
	</div>
	
	<div class="part2">
		<div class="add1">	
			<?php echo render($form['customer_profile_shipping']['commerce_customer_address']['und'][0]['street_block']['thoroughfare']); ?>
		</div>
		<div class="add2">	
			<?php echo render($form['customer_profile_shipping']['commerce_customer_address']['und'][0]['street_block']['premise']); ?>
		</div>
	</div>
	
	<div class="part3">
		<div class="city">	
			<?php echo render($form['customer_profile_shipping']['commerce_customer_address']['und'][0]['locality_block']['locality']); ?>
		</div>
		<div class="state">	
			<?php echo render($form['customer_profile_shipping']['commerce_customer_address']['und'][0]['locality_block']['administrative_area']); ?>
		</div>
		<div class="zip">	
			<?php echo render($form['customer_profile_shipping']['commerce_customer_address']['und'][0]['locality_block']['postal_code']); ?>
		</div>
	</div>
</fieldset>

<fieldset>
	<legend>Billing Info </legend>
	<div class="part1">
		<div class="fullname">	
			<?php echo render($form['customer_profile_billing']['commerce_customer_address']['und'][0]['name_block']['name_line']); ?>
		</div>
		<div class="country">	
			<?php echo render($form['customer_profile_billing']['commerce_customer_address']['und'][0]['country']); ?>
		</div>
	</div>
	
	<div class="part2">
		<div class="add1">	
			<?php echo render($form['customer_profile_billing']['commerce_customer_address']['und'][0]['street_block']['thoroughfare']); ?>
		</div>
		<div class="add2">	
			<?php echo render($form['customer_profile_billing']['commerce_customer_address']['und'][0]['street_block']['premise']); ?>
		</div>
	</div>
	
	<div class="part3">
		<div class="city">	
			<?php echo render($form['customer_profile_billing']['commerce_customer_address']['und'][0]['locality_block']['locality']); ?>
		</div>
		<div class="state">	
			<?php echo render($form['customer_profile_billing']['commerce_customer_address']['und'][0]['locality_block']['administrative_area']); ?>
		</div>
		<div class="zip">	
			<?php echo render($form['customer_profile_billing']['commerce_customer_address']['und'][0]['locality_block']['postal_code']); ?>
		</div>
	</div>
</fieldset>

<?php
	print render($form['form_id']);
	print render($form['form_token']);
	print render($form['form_build_id']);
	print render($form['buttons']['continue']);
	print render($form['buttons']['cancel']);
 ?>
