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

<div id="blog-teaser">

	<div id="blog-dots">
  	<?php /*?><h2 class="title"><?php print $fields['title']->content; ?></h2><?php */?>
    <h3><?php print $fields['title']->content; ?></h3>
    <div style="margin-top: 0px; font-size:10px;">By: <a href="/blog/<?php print $fields['name']->content; ?>"><?php print $fields['field_full_name']->content; ?></a>, <?php print $fields['created']->content; ?></div>
    <p><?php print $fields['body']->content; ?></p>
    <!--p>This is a the Blog Theme</p-->
    <div><?php print $fields['comments_link']->content; ?></div>
    <div class="field-name-field-tags">Tags: <?php print $fields['term_node_tid']->content; ?></div>
    <div><?php //print $fields['field_addthis']->content; ?> <div class="atclear"></div></div>
    <div class="atclear"></div>
  </div>

</div>