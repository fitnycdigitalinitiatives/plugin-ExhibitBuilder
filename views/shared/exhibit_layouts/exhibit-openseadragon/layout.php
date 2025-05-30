  <div class="row">
    <div class="col-sm-3" id="text">
      <h1><?php echo metadata('exhibit_page', 'title'); ?></h1>
      <div class="text-justify">
        <?php echo $text; ?>
      </div>
    </div>
    <div class="col-sm-9" id="image">
      <?php $count = count($attachments); ?>
      <?php if ($count == 1): ?>
        <div id="viewer">
          <?php foreach ($attachments as $attachment): ?>
            <?php
            $item = $attachment->getItem();
            $s3_path = metadata($item, array('Item Type Metadata', 's3_path'));
            $parsed_url = parse_url($s3_path);
            $key = ltrim($parsed_url["path"], '/');
            $iiifEndpoint = get_theme_option('iiif_endpoint');
            $info_json_url = $iiifEndpoint . str_replace("/", "%2F", substr($key, 0, -4)) . "/info.json";
            ?>
            <div class="openseadragon-frame">
              <div class="loader"></div>
              <div class="openseadragon" id="openseadragon_single" data-iiif-endpoint="<?php echo $info_json_url; ?>">
              </div>
            </div>
            <?php $caption = $attachment['caption']; ?>
            <div class="caption single">
              <small><?php echo $caption; ?></small>
              <!-- Modal button -->
              <button class="info" type="button" name="button" data-toggle="modal" data-target="#record-modal">
                <i class="fas fa-info-circle"></i><span class="sr-only">Information</span>
              </button>
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
              <?php
              $item = $attachment->getItem();
              $s3_path = metadata($item, array('Item Type Metadata', 's3_path'));
              $parsed_url = parse_url($s3_path);
              $key = ltrim($parsed_url["path"], '/');
              $iiifEndpoint = get_theme_option('iiif_endpoint');
              $info_json_url = $iiifEndpoint . str_replace("/", "%2F", substr($key, 0, -4)) . "/info.json";
              ?>
              <div role="tabpanel" class="tab-pane fade<?php echo ($id == 1) ? " in active" : ""; ?>" id="tab<?php echo $id; ?>">
                <div class="openseadragon-frame">
                  <div class="loader"></div>
                  <div class="openseadragon" id="openseadragon<?php echo $id; ?>" data-iiif-endpoint="<?php echo $info_json_url; ?>">
                  </div>
                </div>
                <?php $caption = $attachment['caption']; ?>
                <div class="caption">
                  <small><?php echo $caption; ?></small>
                  <!-- Modal button -->
                  <i class="fas fa-info-circle info" aria-hidden="true" data-toggle="modal" data-target="#record-modal<?php echo $id; ?>"></i><span class="sr-only">Information</span>
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
                  <?php echo mdid_thumbnail_tag($item, 'img-responsive') ?>
                </a>
                </li>
                <?php $tab_id++; ?>
              <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>
    </div>
  </div>