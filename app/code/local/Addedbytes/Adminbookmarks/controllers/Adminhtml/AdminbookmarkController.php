<?php
class Addedbytes_Adminbookmarks_Adminhtml_AdminbookmarkController extends Mage_Adminhtml_Controller_Action
{

    protected function _initAction()
    {
        $this->_usedModuleName = 'addedbytes_adminbookmarks';
        $this->loadLayout()->_setActiveMenu('settings/adminbookmarks');

        return $this;
    }

    public function addLinkAction()
    {

        $result = array(
            'success' => true,
            'message' => false
        );

        // Extract variables from POST
        $bookmarkTitle = $_POST['title'];
        $bookmarkUrl = $_POST['url'];
        $bookmarkController = $_POST['controller'];
        $bookmarkAction = $_POST['action'];

        // Validate
        if (trim($bookmarkTitle) == '') {
            $result['success'] = false;
            $result['message'] = 'Please enter a bookmark title.';
        }
        if ((trim($bookmarkUrl) == '') || (filter_var($bookmarkUrl, FILTER_VALIDATE_URL) === false)) {
            $result['success'] = false;
            $result['message'] = 'Your bookmark was not added because of a problem with the URL.';
        } else {
            // Strip key
            $bookmarkUrl = preg_replace('~(/key/[a-z0-9]{32,})~', '', $bookmarkUrl);
            // Strip host
            $bookmarkUrlParts = parse_url($bookmarkUrl);
            $bookmarkUrl = $bookmarkUrlParts['path'];
            if ((isset($bookmarkUrlParts['query'])) && ($bookmarkUrlParts['query'] != '')) {
                $bookmarkUrl .= '?' . $bookmarkUrlParts['query'];
            }
        }

        // If no errors, add the bookmark
        if ($result['success']) {
            $bookmark = Mage::getModel('addedbytesadminbookmarks/bookmark');
            $bookmark->setBookmarkName($bookmarkTitle)
                ->setBookmarkUrl($bookmarkUrl)
                ->setBookmarkRoute($bookmarkController . '/' . $bookmarkAction)
                ->setUserId(Mage::getSingleton('admin/session')->getUser()->getUserId())
                ->setCreatedAt(Varien_Date::now())
                ->setIsActive(1);
            $bookmark->save();
            $result['bookmark_html'] = '<span id="bookmark' . $bookmark->getId() . '"><a href="' . htmlspecialchars($bookmarkUrl) . '">' . htmlspecialchars($bookmarkTitle) . '</a> ( <a style="text-decoration: none;" href="#" onclick="deleteLink(' . $bookmark->getId() . '); return false;">&ndash;</a> ) &nbsp; | &nbsp; </span>';
        }

        $result['message'] = 'Your bookmark has been added.';

        $this->getResponse()->setHeader('Content-type', 'application/json');
        $this->getResponse()->setBody(json_encode($result));
    }

    /**
     * Action that does the actual saving process and redirects back to overview
     */
    public function deleteAction()
    {

        $result = array(
            'success' => true,
            'message' => false
        );

        // check if we know what should be deleted
        if ($bookmark_id = $this->getRequest()->getParam('bookmark_id')) {
            try {
                // init model and delete
                $bookmark = Mage::getModel('addedbytesadminbookmarks/bookmark');
                $bookmark->load($bookmark_id);
                $bookmark->delete();
            } catch (Exception $e) {
                $result['success'] = false;
                $result['message'] = 'We were unable to delete the bookmark. It may have already been deleted.';
            }
        }

        $result['message'] = 'Your bookmark has been deleted.';

        $this->getResponse()->setHeader('Content-type', 'application/json');
        $this->getResponse()->setBody(json_encode($result));
    }
}
