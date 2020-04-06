  <div class="row">
		<div class="col-sm-3">
		<h1><?php echo metadata('exhibit_page', 'title'); ?></h1>
		<div class="text-justify">
			<?php echo $text; ?>
		</div>
		</div>
		<div class="col-sm-9">
		<?php $count = count($attachments); ?>
		<?php if ($count == 1): ?>
			<div id="viewer">
				<?php foreach ($attachments as $attachment): ?>
					<?php $item = $attachment->getItem(); ?>
          <div class="openseadragon-frame">
            <div class="loader"></div>
            <div class="openseadragon" id="openseadragon_single" data-record_id="<?php echo metadata($item, array('Item Type Metadata', 'Record ID')); ?>" data-record_name="<?php echo metadata($item, array('Item Type Metadata', 'Record Name')); ?>">
            </div>
          </div>
					<?php $caption = $attachment['caption']; ?>
					<div class="caption single">
						<small><?php echo $caption; ?></small>
            <!-- Modal button -->
            <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="modal" data-target="#record-modal"></span>
            <!-- Record Modal -->
            <div class="modal fade" id="record-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
		<?php else: ?>
			<div id="viewer">
				<div class="tab-content">
					<?php $id = 1; ?>
					<?php foreach ($attachments as $attachment): ?>
						<?php $item = $attachment->getItem(); ?>        
						<div role="tabpanel" class="tab-pane fade<?php echo ($id == 1) ? " in active" : ""; ?>" id="tab<?php echo $id; ?>">
              <div class="openseadragon-frame">
                <div class="loader"></div>
                <div class="openseadragon" id="openseadragon<?php echo $id; ?>" data-record_id="<?php echo metadata($item, array('Item Type Metadata', 'Record ID')); ?>" data-record_name="<?php echo metadata($item, array('Item Type Metadata', 'Record Name')); ?>">
                </div>
              </div>
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
						<?php $id++; ?>
					<?php endforeach; ?>
				</div>
				<ul class="nav nav-tabs" role="tablist">
					<?php $tab_id = 1; ?>
					<?php foreach ($attachments as $attachment): ?>
						<?php $item = $attachment->getItem(); ?>
						<?php if ($tab_id == 1): ?>
						<li class="active" role="presentation">
						<?php else: ?>
						<li role="presentation">
						<?php endif; ?>
							<a href="#tab<?php echo $tab_id; ?>" aria-controls="home" role="tab" data-toggle="tab">
								<?php echo mdid_square_thumbnail_tag($item, 'img-responsive') ?>
							</a>
						</li>
						<?php $tab_id++; ?>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>
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
