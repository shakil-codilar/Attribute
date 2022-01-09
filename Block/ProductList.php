<?php
/**
 *
 * @package     magento2
 * @author      Codilar Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        https://www.codilar.com/
 */

namespace Codilar\Attribute\Block;

use Magento\Framework\View\Element\Template;

class ProductList extends Template
{
    protected $_productCollectionFactory;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Codilar\Attribute\Model\ResourceModel\Brand\CollectionFactory $productCollectionFactory,
        \Magento\Framework\ObjectManagerInterface $objectmanager,

        array $data = []
    )
    {
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_objectManager = $objectmanager;
        parent::__construct($context, $data);
    }

    public function getText() {

        $collection = $this->_productCollectionFactory->create();
        $collection->getItems();
        return $collection;

    }

    public function getBrandUrl(){
        return $this->getUrl('attribute/attribute/index');
    }
}
