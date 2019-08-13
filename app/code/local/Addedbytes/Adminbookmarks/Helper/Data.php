<?php
class Addedbytes_Adminbookmarks_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getRecommendedTitle()
    {
        $_currentTitle = $this->getLayout()->getBlock('head')->getTitle();
        // Get first section of title before "/" separator
        $_currentTitleParts = explode('/', $_currentTitle);
        $_recommendedTitle = trim($_currentTitleParts[0]);
        return $_recommendedTitle;
    }
}
