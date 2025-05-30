<div class="row">
  <div class="col-sm-7" id="text">
    <h1><?php echo metadata('exhibit_page', 'title'); ?></h1>
    <div class="text-justify">
      <?php echo $text; ?>
    </div>
  </div>
  <div class="col-sm-5" id="image">
    <?php
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
      $html = '<div class="card">';
      $html .= '<img class="card-img-top openseadragon-popup" id="openseadragon' . $id . '" src="' . $image_url . '" alt="' . $title . '" data-iiif-endpoint="' . $info_json_url . '" />';
      $html .= '<div class="card-footer gallery-caption">';
      if ($attachment['caption']) {
        $html .= '<small>' . $attachment['caption'] . '</small>';
      }
      $html .= '
          <button class="info" type="button" name="button" data-toggle="modal" data-target="#record-modal' . $id . '">
            <i class="fas fa-info-circle"></i><span class="sr-only">Information</span>
          </button>
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
</div>