<?php
namespace Codilar\Attribute\Model\Config\Source;



class Options extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{

    protected $collections;

    public function __construct(
        \Codilar\Attribute\Model\ResourceModel\Brand\Collection $collections
    ) {
        $this->collections = $collections;
    }

    public function getAllOptions()
    {

        if (null === $this->_options) {
            foreach($this->collections as $collection) {
                if ($collection->getIsActive()) {
                    $this->_options[] = [
                        'label' => $collection->getName(),
                        'value' => $collection->getBrandId()
                    ];
                }
            }
        }
        return $this->_options;
    }
}

