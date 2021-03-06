<?php

/**
 * View helper for a unordered list "tree" of pages in an exhibit.
 *
 * @package ExhibitBuilder\View\Helper
 */
class ExhibitBuilder_View_Helper_ExhibitPageTree extends Zend_View_Helper_Abstract
{
    /**
     * @var Exhibit
     */
    protected $_exhibit;

    /**
     * Pages, indexed by parent ID, for current exhibit
     *
     * @var array
     */
    protected $_pages;

    /**
     * Return the tree of pages.
     *
     * @param Exhibit $exhibit
     * @param ExhibitPage|null $currentPage
     * @param string $class
     * @return string
     */
    public function exhibitPageTree($exhibit, $currentPage = null, $class = null)
    {
        $pages = $exhibit->PagesByParent;
        if (!($pages && isset($pages[0]))) {
            return '';
        }

        $this->_exhibit = $exhibit;
        $this->_pages = $pages;

        $ancestorIds = $this->_getAncestorIds($currentPage);

        $html = $this->_renderListOpening($class);
        foreach ($pages[0] as $topPage) {
            $html .= $this->_renderPageBranch($topPage, $currentPage, $ancestorIds);
        }
        $html .= '</ul>';
        return $html;
    }

    /**
     * Recursively create the HTML for a "branch" (a page and its descendants)
     * of the tree.
     *
     * @param ExhibitPage $page
     * @param ExhibitPage|null $currentPage
     * @param array $ancestorIds
     * @return string
     */
    protected function _renderPageBranch($page, $currentPage, $ancestorIds)
    {
        if ($currentPage && $page->id === $currentPage->id) {
            $html = '<li class="active" role="presentation">';
        } else if ($ancestorIds && isset($ancestorIds[$page->id])) {
            $html = '<li class="active parent" role="presentation">';
        } else {
            $html = '<li role="presentation">';
        }

        $html .= '<a href="' . exhibit_builder_exhibit_uri($this->_exhibit, $page) . '">'
              . metadata($page, 'title') .'</a>';
        if (isset($this->_pages[$page->id])) {
            $html .= '<ul class="dropdown">';
            foreach ($this->_pages[$page->id] as $childPage) {
                $html .= $this->_renderPageBranch($childPage, $currentPage, $ancestorIds);
            }
            $html .= '</li>';
        }
        return $html;
    }

    /**
     * Get the opening tag for the outermost list element.
     *
     * @param string $class
     * @return string
     */
    protected function _renderListOpening($class = null)
    {
        $html = '<ul class="' . $class . '">';
        return $html;
    }

    /**
     * Get the IDs of all pages that are ancestors of the current page.
     *
     * @param ExhibitPage $currentPage
     * @return array
     */
    protected function _getAncestorIds($currentPage)
    {
        $ancestorIds = array();
        if ($currentPage) {
            $pagesById = $this->_exhibit->PagesById;
            $currentId = $currentPage->parent_id;
            while ($currentId) {
                $currentPage = $pagesById[$currentId];
                $ancestorIds[$currentPage->id] = $currentPage->id;
                $currentId = $currentPage->parent_id;
            }
        }

        return $ancestorIds;
    }
}
