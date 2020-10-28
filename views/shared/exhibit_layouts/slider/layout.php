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
  </div>
  <div class="col-sm-9" id="image">
    <button type="button" class="btn btn-secondary btn-circle" id="previous-slide">
      <i class="fa fa-chevron-left"></i>
      <span class="sr-only">Previous</span>
    </button>
    <div class="owl-carousel">
      <?php
        $attachment_count = count($attachments);
        $id = 1;
        foreach ($attachments as $attachment) {
            $item = $attachment->getItem();
            $title = metadata($item, array('Dublin Core', 'Title'));
            $image_url = mdid_medium_image_url($item);
            $record_id = metadata($item, array('Item Type Metadata', 'Record ID'));
            $record_name = metadata($item, array('Item Type Metadata', 'Record Name'));
            $html = '<div class="card count-' . $attachment_count . '">';
            $html .= '<img class="card-img openseadragon-popup" id="openseadragon' . $id. '" src="' . $image_url. '" alt="' . $title . '" data-record_id="' . $record_id . '" data-record_name="' . $record_name . '" />';
            $html .= '<div class="card-footer gallery-caption">';
            if ($attachment['caption']) {
                $html .= '<small>' . $attachment['caption'] . '</small>';
            }
            $html .= '
            <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="modal" data-target="#record-modal' . $id . '"></span>
            ';
            $modals .= '
            <!-- Record Modal -->
            <div class="modal fade" id="record-modal' . $id . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Item Information</h4>
                  </div>
                  <div class="modal-body">
                    ' . all_element_texts($item) . '
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    ' . link_to_item('View full record', $props = array('class' => 'btn btn-primary', 'role' => 'button'), $action = 'show', $item) . '
                  </div>
                </div>
              </div>
            </div>
            ';
            $html .= '</div>';
            $html .= '</div>';
            echo $html;
            $id++;
        };
      ?>
    </div>

    <button type="button" class="btn btn-secondary btn-circle" id="next-slide">
      <i class="fa fa-chevron-right"></i>
      <span class="sr-only">Next</span>
    </button>
  </div>
  <?php echo $modals; ?>
</div>
