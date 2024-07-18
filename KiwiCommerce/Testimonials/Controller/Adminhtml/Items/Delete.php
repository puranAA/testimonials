<?php
namespace KiwiCommerce\Testimonials\Controller\Adminhtml\Items;

class Delete extends \KiwiCommerce\Testimonials\Controller\Adminhtml\Items
{

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                $model = $this->testimonialFactory->create();
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('You deleted the testimonial.'));
                $this->_redirect('kiwi_commerce_testimonials/*/');
                return;
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addError(
                    __('We can\'t delete testimonial right now. Please review the log and try again.')
                );
                $this->_objectManager->get('Psr\Log\LoggerInterface')->critical($e);
                $this->_redirect('kiwi_commerce_testimonials/*/edit', ['id' => $this->getRequest()->getParam('id')]);
                return;
            }
        }
        $this->messageManager->addError(__('We can\'t find a testimonial to delete.'));
        $this->_redirect('kiwi_commerce_testimonials/*/');
    }
}
