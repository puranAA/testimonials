<?php
namespace KiwiCommerce\Testimonials\Controller\Adminhtml;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Image\AdapterFactory;
use Magento\Framework\Filesystem;
use Magento\MediaStorage\Model\File\UploaderFactory;
/**
 * Items controller
 */
abstract class Items extends \Magento\Backend\App\Action
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @var \Magento\Backend\Model\View\Result\ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    protected $uploaderFactory;
    protected $adapterFactory;
    protected $filesystem;

    /**
     * @var \KiwiCommerce\Testimonials\Model\TestimonialFactory
     */
    protected $testimonialFactory;

    /**
     * Initialize Group Controller
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \KiwiCommerce\Testimonials\Model\TestimonialFactory $testimonialFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        DirectoryList $directoryList,
        UploaderFactory $uploaderFactory,
        AdapterFactory $adapterFactory,
        Filesystem $filesystem,
        \Magento\Framework\Filesystem\Driver\File $file,
        \KiwiCommerce\Testimonials\Model\TestimonialFactory $testimonialFactory,
        \Magento\Backend\Model\Auth\Session $adminSession
    ) {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
        $this->resultForwardFactory = $resultForwardFactory;
        $this->resultPageFactory    = $resultPageFactory;
        $this->directoryList        = $directoryList;
        $this->uploaderFactory      = $uploaderFactory;
        $this->adapterFactory       = $adapterFactory;
        $this->filesystem           = $filesystem;
        $this->_file                = $file;
        $this->testimonialFactory   = $testimonialFactory;
        $this->adminSession         = $adminSession;
    }

    /**
     * Initiate action
     *
     * @return this
     */
    protected function _initAction()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu('KiwiCommerce_Testimonials::items')->_addBreadcrumb(__('Testimonials'), __('Testimonials'));
        return $this;
    }

    /**
     * Determine if authorized to perform group actions.
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('KiwiCommerce_Testimonials::items');
    }
}