<div class="row">
		<div class="col-sm-9">
			<h1><?php echo metadata('exhibit_page', 'title'); ?></h1>
			<div class="text-justify">
				<?php echo $text; ?>
			</div>
		</div>
</div>
<div class="row exhibit-nav">
	<div class="col-xs-12">
		<?php if ($prevLink = exhibit_builder_link_to_previous_page('<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>', array('type' => 'button', 'class' => 'btn btn-default btn-lg btn-round previous'))): ?>
			<?php echo $prevLink; ?>
		<?php else: ?>
			<?php echo exhibit_builder_link_to_exhibit(null, '<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>', array('type' => 'button', 'class' => 'btn btn-default btn-lg btn-round previous')); ?>
		<?php endif; ?>
		<?php if ($nextLink = exhibit_builder_link_to_next_page('<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>', array('type' => 'button', 'class' => 'btn btn-default btn-lg btn-round next'))): ?>
			<?php echo $nextLink; ?>
		<?php endif; ?>
	</div>
</div>
