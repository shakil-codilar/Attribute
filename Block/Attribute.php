<?php

namespace Codilar\Attribute\Block;

use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ProductRepository;
use Codilar\Attribute\Model\BrandFactory as ModelFactory;
use Codilar\Attribute\Model\ResourceModel\Brand as ResourceModel;
use Codilar\Attribute\Model\ResourceModel\Brand\CollectionFactory;

class Attribute extends Template
{
    protected  $_registry;
    protected $productFactory;
    protected $modelFactory;

    /**
     * @var ResourceModel
     */
    protected $resourceModel;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        ProductFactory $productFactory,
        ModelFactory                $modelFactory,
        ResourceModel               $resourceModel,
        CollectionFactory           $collectionFactory,
        array $data = []
    )
    {
        $this->collectionFactory = $collectionFactory;
        $this->modelFactory = $modelFactory;
        $this->resourceModel = $resourceModel;

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
//    public function getAttributeValue()
//    {
//        $attributeCode='brand';
//        $currentProduct=$this->getCurrentProduct();
//        $text=$currentProduct->getAttributeText('brand');
//        $product = $this->productFactory->create();
//        $isAttrExist = $product->getResource()->getAttribute($attributeCode);
//        $optId = '';
//        if ($isAttrExist && $isAttrExist->usesSource()) {
//            $optId = $isAttrExist->getSource()->getAllOptions($text);
//        }
//        return $optId;
//    }
    public function getBrandDetails()
    {
        $id = $this->getAttributeId();
        $details = [];
        $collection = $this->collectionFactory->create();
        $datas = $collection->getItems();
        foreach ($datas as $data) {
            if ($data->getBrandId() == $id) {
                array_push($details, $data->getIsActive());
                array_push($details, $data->getInfo());
                return $details;
            }
        }
    }

}
