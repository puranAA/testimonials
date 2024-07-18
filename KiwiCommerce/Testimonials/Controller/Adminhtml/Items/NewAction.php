<?php
namespace KiwiCommerce\Testimonials\Controller\Adminhtml\Items;

class NewAction extends \KiwiCommerce\Testimonials\Controller\Adminhtml\Items
{

    public function execute()
    {
        $this->_forward('edit');
    }
}
