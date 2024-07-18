<?php
namespace KiwiCommerce\Testimonials\Controller\Adminhtml\Items;

class Index extends \KiwiCommerce\Testimonials\Controller\Adminhtml\Items
{
    /**
     * Items list.
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('KiwiCommerce_Testimonials::testimonial');
        $resultPage->getConfig()->getTitle()->prepend(__('Testimonials'));
        $resultPage->addBreadcrumb(__('KiwiCommerce'), __('KiwiCommerce'));
        $resultPage->addBreadcrumb(__('Testimonials'), __('Testimonials'));
        return $resultPage;
    }
}