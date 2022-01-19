<?php

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
