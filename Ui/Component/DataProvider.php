<?php

namespace Codilar\Attribute\Ui\Component;
use Codilar\Attribute\Model\ResourceModel\Brand\CollectionFactory;
use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Codilar\Attribute\Model\BrandFactory as ModelFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
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
}
