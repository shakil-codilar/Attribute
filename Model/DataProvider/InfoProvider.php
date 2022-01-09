<?php
//
//namespace Codilar\HelloWorld\Model\DataProvide;
//
//use Codilar\Employee\Model\ResourceModel\Employee\Collection as Collection;
//use Codilar\Employee\Model\ResourceModel\Employee\CollectionFactory as CollectionFactory;
//use Magento\Framework\App\RequestInterface;
//use Magento\Ui\DataProvider\AbstractDataProvider;
//
//class InfoProvider extends AbstractDataProvider
//{
//    protected $loadedData;
//
//    private $request;
//
//    /**
//     * @var Collection
//     */
//    private $collectionFactory;
//
//    /**
//     * DataProvider constructor.
//     * @param string $name
//     * @param string $primaryFieldName
//     * @param string $requestFieldName
//     * @param CollectionFactory $collectionFactory
//     * @param RequestInterface $request
//     * @param array $meta
//     * @param array $data
//     */
//    public function __construct(
//        $name,
//        $primaryFieldName,
//        $requestFieldName,
//        CollectionFactory $collectionFactory,
//        RequestInterface $request,
//        array $meta = [],
//        array $data = []
//    ) {
//        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
//        $this->collection = $collectionFactory->create();
//        $this->request = $request;
//        $this->collectionFactory = $collectionFactory;
//    }
//
//    /**
//     * @return array
//     */
//    public function getData()
//    {
//        if (isset($this->loadedData)) {
//            return $this->loadedData;
//        }
//        $id = $this->request->getParam('entity_id');
//        $items = $this->collectionFactory->create()->addFieldToFilter('entity_id', $id)->getItems();
//        foreach ($items as $item) {
//            $info = $item->getData();
//            $this->loadedData[$item->getId()] = $info;
//        }
//        return $this->loadedData;
//    }
//}
//


namespace Codilar\Attribute\Model\DataProvider;

use Codilar\Attribute\Model\ResourceModel\Brand\CollectionFactory;
use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Codilar\Attribute\Model\BrandFactory as ModelFactory;

class InfoProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        ModelFactory $modelFactory,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    //to show datas in edit form
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        $this->loadedData = array();
        /** @var \Codilar\Attribute\Model\Brand $brand */
        foreach ($items as $brand) {
            $this->loadedData[$brand->getBrandId()] = $brand->getData();
        }

        return $this->loadedData;
    }
}
