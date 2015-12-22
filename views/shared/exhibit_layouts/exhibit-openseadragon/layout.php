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
	<div class="row">	
		<div class="col-sm-3">
		<h1><?php echo metadata('exhibit_page', 'title'); ?></h1>
		<?php echo $text; ?>
		<nav>
			<ul class="pager">
				<?php if ($prevLink = exhibit_builder_link_to_previous_page('&laquo; Prev')): ?>
				<li class="previous">
					<?php echo $prevLink; ?>
				</li>
				<?php endif; ?>
				<?php if ($nextLink = exhibit_builder_link_to_next_page('Next &raquo;')): ?>
				<li class="next">
					<?php echo $nextLink; ?>
				</li>
				<?php endif; ?>			
			</ul>
		</nav>
		</div>
		<div class="col-sm-9">
			<div id="gallery">
				<div class="tab-content">
					<?php $id = 1; ?>
					<?php foreach ($attachments as $attachment): ?>
						<?php $file = $attachment->getFile(); ?>
						<div role="tabpanel" class="tab-pane" id="tab<?=$id?>">
							<?php echo $this->openseadragon($file); ?>
							<div class="caption">
								<?php echo $attachment['caption']; ?>
							</div>
						</div>
						<?php $id++; ?>
					<?php endforeach; ?>
				</div>
				<ul class="nav nav-tabs" role="tablist">
					<?php $tab_id = 1; ?>
					<?php foreach ($attachments as $attachment): ?>
						<?php $file = $attachment->getFile(); ?>
						<li role="presentation">
							<a href="#tab<?=$tab_id?>" aria-controls="home" role="tab" data-toggle="tab">
								<?php echo file_image('square_thumbnail', array(), $file) ?>
							</a>
						</li>
						<?php $tab_id++; ?>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
