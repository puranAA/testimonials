<?php
namespace KiwiCommerce\Testimonials\Block;

use Magento\Store\Model\StoreManagerInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;


class Testimonial extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \KiwiCommerce\Testimonials\Model\TestimonialFactory
     */
    protected $testimonialFactory;

    protected $storeManager;

    protected $_scopeConfig;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \KiwiCommerce\Testimonials\Model\TestimonialFactory $testimonialFactory,
        StoreManagerInterface $storeManager,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->testimonialFactory = $testimonialFactory;
        $this->storeManager       = $storeManager;
        $this->scopeConfig        = $scopeConfig;
        parent::__construct($context);
    }

    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('KiwiCommerce Testimonials'));
        
        return parent::_prepareLayout();
    }

    public function getTestimonials()
    {
        $collection = $this->testimonialFactory->create()->getCollection();
        $collection->addFieldToFilter('status', 1);
        return $collection;
    }

    public function getMediaPath()
    {
        $path = $this->storeManager->getStore()->getBaseUrl(
                        \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
                    );
        return $path;
    }

    public function getConfig($config_path)
    {
        return $this->scopeConfig->getValue(
            $config_path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
