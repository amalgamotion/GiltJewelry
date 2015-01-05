<?php
/**
 * @file views-view-fields.tpl.php
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
?>

<div style="border-bottom:solid 1px #C6B081;">

	<div style="background-image: url(http://beta.giltjewelry.com/<?php print $directory; ?>/images/horizontal_dots.png); background-repeat: repeat-x; background-position: bottom; padding-bottom: 10px; margin-bottom: 10px;">
		<div class="float-left"><?php print $fields['field_profile_picture']->content ?></div>
  		<h3><?php print $fields['field_full_name']->content ?></h3>
    	<p><?php print $fields['field_biography']->content ?></p>
  </div>

</div>