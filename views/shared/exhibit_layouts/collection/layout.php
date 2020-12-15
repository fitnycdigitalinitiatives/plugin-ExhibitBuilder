<div class="row">
  <div class="col-sm-3" id="text">
    <h1>
      <?php if ($pageParent = get_current_record('exhibit_page')->getParent()): ?>
        <small class="text-muted">
          <?php echo metadata($pageParent, 'title'); ?>
        </small></br>
      <?php endif; ?>
      <?php echo metadata('exhibit_page', 'title'); ?>
    </h1>
    <?php echo $text; ?>
    <?php $collection = get_record_by_id('Collection', $options['collection-id']); ?>
    <?php if (metadata($collection, 'total_items') > 30): ?>
      <p data-barba-prevent="all">
        <?php echo link_to_items_browse('View all items in this Collection <i class="fas fa-external-link-alt"></i>', array('collection' => metadata($collection, 'id')), array('class' => 'text-dark font-weight-bold', 'target' => "_blank")); ?>
      </p>
    <?php endif; ?>
  </div>
  <?php if (isset($options['collection-id'])): ?>
    <div class="col-sm-9" id="image">
      <div class="row row-cols-2 row-cols-sm-3 row-cols-lg-4 row-cols-xl-5 row-cols-xxl-6 g-4 align-items-center justify-content-start" id="collection-api" data-collection-id="<?php echo $options['collection-id']; ?>">
      </div>
      <?php if (metadata($collection, 'total_items') > 30): ?>
        <div class="row justify-content-center mt-3">
          <button id="load-collection" type="button" class="btn btn-dark d-none">Load Additional Images</button>
        </div>
      <?php endif; ?>
    </div>

  <?php endif; ?>

</div>
