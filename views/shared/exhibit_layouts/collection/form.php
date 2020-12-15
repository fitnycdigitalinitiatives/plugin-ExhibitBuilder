<?php
$formStem = $block->getFormStem();
$options = $block->getOptions();
?>

<div class="block-text">
    <h4><?php echo __('Text'); ?></h4>
    <?php echo $this->exhibitFormText($block); ?>
</div>

<div id="collection-form" class="field">
  <?php echo $this->formLabel($formStem . '[options][collection-id]', __('Collection'));?>
  <div class="inputs">
      <?php
          echo $this->formSelect(
    $formStem . '[options][collection-id]',
    @$options['collection-id'],
    array('id' => 'collection-id'),
    get_table_options('Collection')
);
      ?>
  </div>
</div>
