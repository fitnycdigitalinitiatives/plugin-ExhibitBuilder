<div class="row">
  <div class="col-sm-7">
    <h1><?php echo metadata('exhibit_page', 'title'); ?></h1>
    <div class="text-justify">
      <?php echo $text; ?>
    </div>
  </div>
  <div class="col-sm-5">
      <?php foreach ($attachments as $attachment): ?>
        <?php $item = $attachment->getItem(); ?>
        <div id="viewer">
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
        </div>
      <?php endforeach; ?>
  </div>
</div>
<div class="row exhibit-nav">
  <div class="col-xs-12">
        <?php if ($prevLink = exhibit_builder_link_to_previous_page('<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span><span class="sr-only">Previous</span>', array('type' => 'button', 'class' => 'btn btn-default btn-lg btn-round previous'))): ?>
          <?php echo $prevLink; ?>
        <?php else: ?>
          <?php echo exhibit_builder_link_to_exhibit(null, '<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span><span class="sr-only">Previous</span>', array('type' => 'button', 'class' => 'btn btn-default btn-lg btn-round previous')); ?>
        <?php endif; ?>
        <?php if ($nextLink = exhibit_builder_link_to_next_page('<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span><span class="sr-only">Next</span>', array('type' => 'button', 'class' => 'btn btn-default btn-lg btn-round next'))): ?>
          <?php echo $nextLink; ?>
        <?php endif; ?>
  </div>
</div>
