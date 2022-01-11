<?php

namespace Codilar\Attribute\Block;

use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ProductRepository;

class Attribute extends Template
{
    protected  $_registry;
    protected $productFactory;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        ProductFactory $productFactory,

        array $data = []
    )
    {

        parent::__construct($context, $data);
        $this->_registry = $registry;
        $this->productFactory = $productFactory;
    }

    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    public function getCurrentProduct()
    {
        return $this->_registry->registry('current_product');
    }
    public function getBrandUrl(){
        return $this->getUrl('attribute/attribute/index');
    }


    public function getAttributeId()
    {
        $attributeCode='brand';
        $currentProduct=$this->getCurrentProduct();
        $text=$currentProduct->getAttributeText('brand');
        $product = $this->productFactory->create();
        $isAttrExist = $product->getResource()->getAttribute($attributeCode);
        $optId = '';
        if ($isAttrExist && $isAttrExist->usesSource()) {
            $optId = $isAttrExist->getSource()->getOptionId($text);
        }
        return $optId;
    }
    public function getAttributeValue()
    {
        $attributeCode='brand';
        $currentProduct=$this->getCurrentProduct();
        $text=$currentProduct->getAttributeText('brand');
        $product = $this->productFactory->create();
        $isAttrExist = $product->getResource()->getAttribute($attributeCode);
        $optId = '';
        if ($isAttrExist && $isAttrExist->usesSource()) {
            $optId = $isAttrExist->getSource()->getAllOptions($text);
        }
        return $optId;
    }

}
