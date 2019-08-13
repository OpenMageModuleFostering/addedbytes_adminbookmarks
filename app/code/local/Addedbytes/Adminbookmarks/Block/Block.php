<?php
class Addedbytes_Adminbookmarks_Block_Block extends Mage_Catalog_Block_Product_Abstract
{

    public function getBookmarkCollection()
    {
        if (!$this->_bookmarkCollection) {
            $this->_bookmarkCollection = Mage::getModel('addedbytesadminbookmarks/bookmark')
                ->getCollection()
                ->addFieldToFilter('user_id', array('eq' => Mage::getSingleton('admin/session')->getUser()->getUserId()))
                ->setOrder('bookmark_id', 'ASC')
                ->addIsActiveFilter();
        }

        return $this->_bookmarkCollection;
    }
}
