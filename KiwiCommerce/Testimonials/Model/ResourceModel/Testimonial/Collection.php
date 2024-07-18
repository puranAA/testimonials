<?php
namespace KiwiCommerce\Testimonials\Model\ResourceModel\Testimonial;
 
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'testimonial_id';
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            'KiwiCommerce\Testimonials\Model\Testimonial',
            'KiwiCommerce\Testimonials\Model\ResourceModel\Testimonial'
        );
    }
}