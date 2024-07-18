<?php
namespace KiwiCommerce\Testimonials\Model\ResourceModel;

class Testimonial extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('kiwi_commerce_testimonials', 'testimonial_id');
    }
}