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
      <i class="fas fa-chevron-left"></i><span class="sr-only">Previous</span>
    </button>
    <div class="owl-carousel">
      <?php
      $attachment_count = count($attachments);
      $id = 1;
      foreach ($attachments as $attachment) {
        $item = $attachment->getItem();
        $title = metadata($item, array('Dublin Core', 'Title'));
        $image_url = mdid_medium_image_url($item);
        $s3_path = metadata($item, array('Item Type Metadata', 's3_path'));
        $parsed_url = parse_url($s3_path);
        $key = ltrim($parsed_url["path"], '/');
        $iiifEndpoint = get_theme_option('iiif_endpoint');
        $info_json_url = $iiifEndpoint . str_replace("/", "%2F", substr($key, 0, -4)) . "/info.json";
        $html = '<div class="card count-' . $attachment_count . '">';
        $html .= '<img class="card-img-top openseadragon-popup" id="openseadragon' . $id . '" src="' . $image_url . '" alt="' . $title . '" data-iiif-endpoint="' . $info_json_url . '" />';
        $html .= '<div class="card-footer gallery-caption">';
        if ($attachment['caption']) {
          $html .= '<small>' . $attachment['caption'] . '</small>';
        }
        $html .= '
            <button class="info" type="button" name="button" data-toggle="modal" data-target="#record-modal' . $id . '">
              <i class="fas fa-info-circle"></i><span class="sr-only">Information</span>
            </button>
            ';
        $modals .= '
            <!-- Record Modal -->
            <div class="modal fade" id="record-modal' . $id . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel' . $id . '">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel' . $id . '">Item Information</h4>
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
      <i class="fas fa-chevron-right"></i><span class="sr-only">Next</span>
    </button>
  </div>
  <?php echo $modals; ?>
</div>