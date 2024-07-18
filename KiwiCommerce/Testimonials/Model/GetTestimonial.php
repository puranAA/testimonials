<?php
namespace KiwiCommerce\Testimonials\Model;
use KiwiCommerce\Testimonials\Api\GetTestimonialInterface;

class GetTestimonial implements GetTestimonialInterface
{

/**
 * @var \KiwiCommerce\Testimonials\Model\TestimonialFactory
 */
protected $testimonialFactory;


public function __construct(
    \KiwiCommerce\Testimonials\Model\TestimonialFactory $testimonialFactory
) {
    $this->testimonialFactory = $testimonialFactory;
}

 /**
 * {@inheritdoc}
 */

public function getTestimonials()
{  
   $collection = $this->testimonialFactory->create()->getCollection();
   $collection->addFieldToFilter('status',1);

   return $collection->getData();
}

}