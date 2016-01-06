<div class="row">	
		<div class="col-sm-9">
			<h1><?php echo metadata('exhibit_page', 'title'); ?></h1>
			<div class="text-justify">
				<?php echo $text; ?>
			</div>
			<nav>
				<?php if ($prevLink = exhibit_builder_link_to_previous_page('<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Prev', array('type' => 'button', 'class' => 'btn btn-default pull-left previous'))): ?>
					<?php echo $prevLink; ?>
				<?php endif; ?>
				<?php if ($nextLink = exhibit_builder_link_to_next_page('Next <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>', array('type' => 'button', 'class' => 'btn btn-default pull-right next'))): ?>
					<?php echo $nextLink; ?>
				<?php endif; ?>
			</nav>
		</div>
</div>