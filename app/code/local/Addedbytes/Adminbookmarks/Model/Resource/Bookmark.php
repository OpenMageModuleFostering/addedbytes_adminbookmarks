<?php
class Addedbytes_Adminbookmarks_Model_Resource_Bookmark extends Mage_Core_Model_Resource_Db_Abstract
{

    protected function _construct()
    {
        $this->_init('addedbytesadminbookmarks/bookmark', 'bookmark_id');
    }

    /**
     * Load an object using bookmark_id field
     */
    public function load(Mage_Core_Model_Abstract $object, $value, $field = null)
    {
        if (!is_numeric($value) && is_null($field)) {
            $field = 'bookmark_id';
        }

        return parent::load($object, $value, $field);
    }
}
