<?php
namespace KiwiCommerce\Testimonials\Model;

use Magento\Framework\Model\AbstractModel;

class Testimonial extends AbstractModel
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('KiwiCommerce\Testimonials\Model\ResourceModel\Testimonial');
    }
}