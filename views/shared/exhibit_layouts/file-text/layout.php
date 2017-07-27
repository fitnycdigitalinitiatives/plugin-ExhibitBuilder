<?php
$position = isset($options['file-position'])
    ? html_escape($options['file-position'])
    : 'left';
$size = isset($options['file-size'])
    ? html_escape($options['file-size'])
    : 'fullsize';
$captionPosition = isset($options['captions-position'])
    ? html_escape($options['captions-position'])
    : 'center';
?>
<div class="exhibit-items <?php echo $position; ?> <?php echo $size; ?> captions-<?php echo $captionPosition; ?>">
    <?php foreach ($attachments as $attachment): ?>
      <?php $item = $attachment->getItem(); ?>
        <?php echo mdid_image_tag($item, 'img-responsive'); ?>
        <?php $caption = $attachment['caption']; ?>
        <div class="caption">
          <small><?php echo $caption; ?></small>
          <!-- Modal button -->
          <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="modal" data-target="#record-modal<?php echo $id; ?>"></span>
          <!-- Record Modal -->
          <div class="modal fade" id="record-modal<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Item Information</h4>
                </div>
                <div class="modal-body">
                  <?php echo all_element_texts($item); ?>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <?php echo link_to_item('View full record', $props = array('class' => 'btn btn-primary', 'role' => 'button'), $action = 'show', $item); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
    <?php endforeach; ?>
</div>
<h1><?php echo metadata('exhibit_page', 'title'); ?></h1>
<div class="text-justify">
  <?php echo $text; ?>
</div>
