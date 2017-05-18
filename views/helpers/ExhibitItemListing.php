<?php

/**
 * View helper for a single item listing in the attachment selection dialog.
 * @package ExhibitBuilder\View\Helper
 */
class ExhibitBuilder_View_Helper_ExhibitItemListing extends Zend_View_Helper_Abstract
{
    /**
     * Return the form for showing an item to be attached.
     *
     * @param Item $item
     * @return string
     */
    public function exhibitItemListing($item)
    {
        $html = '<div class="item-listing" data-item-id="' . $item->id . '">';
        if (($record_name = metadata($item, array('Item Type Metadata', 'Record Name'))) && ($record_id = metadata($item, array('Item Type Metadata', 'Record ID')))) {
          $html .= '<div class="item-file">'
              . '<img src="https://fitdil.fitnyc.edu/media/thumb/' . $record_id . '/' . $record_name . '/?square" class="responsive">'
              . '</div>';

        }
        $private = '';
        if (!metadata($item, 'public')) {
            $private = ' ' . __('(Private)');
        }
        $html .= '<h4 class="title">'
              . metadata($item, array('Dublin Core', 'Title'))
              . $private
              . '</h4>';
        $html .= '<button type="button" class="select-item">' . __('Select Item') . '</button>';
        $html .= '</div>';
        return $html;
    }
}
