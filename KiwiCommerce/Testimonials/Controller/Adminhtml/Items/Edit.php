<?php
namespace KiwiCommerce\Testimonials\Controller\Adminhtml\Items;

class Edit extends \KiwiCommerce\Testimonials\Controller\Adminhtml\Items
{

    public function execute()
    {
        $id    = $this->getRequest()->getParam('id');
        $model = $this->testimonialFactory->create();

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This testimonial no longer exists.'));
                $this->_redirect('kiwi_commerce_testimonials/*');
                return;
            }
        }
        // set entered data if was error when we do save
        $data = $this->adminSession->getPageData(true);
        if (!empty($data)) {
            $model->addData($data);
        }
        $this->_coreRegistry->register('current_kiwi_commerce_testimonials_items', $model);
        $this->_initAction();
        $this->_view->getLayout()->getBlock('items_items_edit');
        $this->_view->renderLayout();
    }
}
