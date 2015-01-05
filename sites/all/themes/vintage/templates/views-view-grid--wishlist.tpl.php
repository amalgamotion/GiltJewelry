<?php

/**
 * @file
 * Default simple view template to display a rows in a grid.
 *
 * - $rows contains a nested array of rows. Each row contains an array of
 *   columns.
 *
 * @ingroup views_templates
 */
 //echo '<pre>';print_r($views); echo '</pre>';exit;
 drupal_add_css(drupal_get_path('theme', 'vintage') . '/css/wishlist.css');
?><div class="product_class">
<?php if (!empty($title)) : ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<table class="<?php print $class; ?> wishlist_table"<?php print $attributes; ?>>
  <?php if (!empty($caption)) : ?>
    <caption><?php print $caption; ?></caption>
  <?php endif; ?>

  <tbody>
    <?php foreach ($rows as $row_number => $columns){ ?>
      <tr <?php if ($row_classes[$row_number]) { print 'class="' . $row_classes[$row_number] .'"';  } ?>>
        <?php foreach ($columns as $column_number => $item) { ?>
          <td <?php if ($column_classes[$row_number][$column_number]) { 
			print 'class="' . $column_classes[$row_number][$column_number] .'"';  } ?>>
            <?php print $item; ?>
          </td>
        <?php } ?>
      </tr>
    <?php }  ?>
  </tbody>
</table>
</div>