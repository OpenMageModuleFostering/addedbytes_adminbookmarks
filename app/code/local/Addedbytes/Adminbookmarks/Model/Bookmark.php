<?php
class Addedbytes_Adminbookmarks_Model_Bookmark extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('addedbytesadminbookmarks/bookmark', 'bookmark_name');
    }

    /**
     * For a specific bookmark, the secret key portion of the URL must be
     * generated using the controller and action they represent. The controller
     * and action are both stored in the database. This method returns an admin
     * key for the specific bookmark.
     * @return string Admin secret key for the bookmark.
     */
    public function getBookmarkSecretKey()
    {
        $adminSecretKey = Mage::getSingleton('adminhtml/url')->getSecretKey();
        if (strpos($this->getBookmarkRoute(), '/') != false) {
            $bookmarkRoute = explode('/', $this->getBookmarkRoute());
            $bookmarkController = $bookmarkRoute[0];
            $bookmarkAction = $bookmarkRoute[1];
            $adminSecretKey = Mage::getSingleton('adminhtml/url')->getSecretKey($bookmarkController, $bookmarkAction);
        }
        return $adminSecretKey;
    }
}
