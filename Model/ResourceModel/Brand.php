<?php

namespace Codilar\Attribute\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Brand extends AbstractDb
{

    const TABLE_NAME = 'codilar_brand';
    const ID_FIELD_NAME = 'brand_id';

    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, self::ID_FIELD_NAME);
    }
}
