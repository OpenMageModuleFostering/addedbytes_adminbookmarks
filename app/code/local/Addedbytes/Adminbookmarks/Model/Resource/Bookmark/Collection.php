<?php
class Addedbytes_Adminbookmarks_Model_Resource_Bookmark_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('addedbytesadminbookmarks/bookmark', 'bookmark_name');
        $this->_map['fields']['bookmark_id'] = 'main_table.bookmark_id';
    }

    public function addIsActiveFilter()
    {
        $this->addFilter('is_active', 1);

        return $this;
    }
}
