<?php
namespace KiwiCommerce\Testimonials\Block\Adminhtml\Items\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;

class Main extends Generic implements TabInterface
{
    protected $_wysiwygConfig;
 
    public function __construct(
        \Magento\Backend\Block\Template\Context $context, 
        \Magento\Framework\Registry $registry, 
        \Magento\Framework\Data\FormFactory $formFactory,  
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig, 
        array $data = []
    ) 
    {
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getTabLabel()
    {
        return __('Testimonial');
    }

    /**
     * {@inheritdoc}
     */
    public function getTabTitle()
    {
        return __('Testimonial');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Prepare form before rendering HTML
     *
     * @return $this
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('current_kiwi_commerce_testimonials_items');
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('item_');
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Testimonial')]);
        if ($model->getId()) {
            $fieldset->addField('testimonial_id', 'hidden', ['name' => 'testimonial_id']);
        }
        $fieldset->addField(
            'company_name',
            'text',
            ['name' => 'company_name', 'label' => __('Company Name'), 'title' => __('Company Name'), 'required' => true]
        );
        $fieldset->addField(
            'manufacturer_name',
            'text',
            ['name' => 'manufacturer_name', 'label' => __('Manufacturer Name'), 'title' => __('Manufacturer Name'), 'required' => true]
        );
        $fieldset->addField(
            'post',
            'text',
            ['name' => 'post', 'label' => __('Post'), 'title' => __('Post'), 'required' => true]
        );
        $fieldset->addField(
            'profile_pic',
            'image',
            [
                'name' => 'profile_pic',
                'label' => __('Profile Pic'),
                'title' => __('Profile Pic'),
                'required'  => false
            ]
        );
        $fieldset->addField(
            'status',
            'select',
            ['name' => 'status', 'label' => __('Status'), 'title' => __('Status'),  'options'   => [0 => 'Disable', 1 => 'Enable'], 'required' => true]
        );
        $fieldset->addField(
            'message',
            'editor',
            [
                'name' => 'message',
                'label' => __('Message'),
                'title' => __('Message'),
                'style' => 'height:26em;',
                'required' => true,
                'config'    => $this->_wysiwygConfig->getConfig(),
                'wysiwyg' => true
            ]
        );
        
        $form->setValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
