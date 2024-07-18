<?php
namespace KiwiCommerce\Testimonials\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Catalog\Helper\ImageFactory as HelperFactory;
use Magento\Framework\View\Asset\Repository;

class Thumbnail extends \Magento\Ui\Component\Listing\Columns\Column
{
    const NAME = 'profile_pic';
    const ALT_FIELD = 'name';

    /**
     * @var HelperFactory
     */
    protected $helperFactory;

    /**
     * @var Repository
     */
    protected $assetRepos;

    protected $storeManager;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param \Magento\Catalog\Helper\Image $imageHelper
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        StoreManagerInterface $storeManager,
        HelperFactory $helperFactory,
        Repository $repository,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->storeManager  = $storeManager;
        $this->assetRepos    = $repository;
        $this->helperFactory = $helperFactory;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            $path = $this->storeManager->getStore()->getBaseUrl(
                        \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
                    );
            foreach ($dataSource['data']['items'] as & $item) {
                if ($item['profile_pic']) {
                    $item[$fieldName . '_src'] = $path.$item['profile_pic'];
                    $item[$fieldName . '_alt'] = $item['profile_pic'];
                    $item[$fieldName . '_orig_src'] = $path.$item['profile_pic'];
                }else{
                    $item[$fieldName . '_src'] = $this->getPlaceHolderImage();
                    $item[$fieldName . '_alt'] = 'Place Holder';
                    $item[$fieldName . '_orig_src'] = $this->getPlaceHolderImage();
                }
            }
        }

        return $dataSource;
    }

    public function getPlaceHolderImage()
    {
        /** @var \Magento\Catalog\Helper\Image $helper */
        $helper = $this->helperFactory->create();
        return $this->assetRepos->getUrl($helper->getPlaceholder('image'));
    }
}