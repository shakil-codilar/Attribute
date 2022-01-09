<?php

namespace Codilar\Attribute\Model;

use Magento\Framework\Model\AbstractModel;
use Codilar\Attribute\Model\ResourceModel\Brand as ResourceModel;

class Brand extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
