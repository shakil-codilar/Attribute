<?php

namespace Codilar\Attribute\Controller\Adminhtml\Index;
use Codilar\Attribute\Model\BrandFactory as ModelFactory;
use Codilar\Attribute\Model\ResourceModel\Brand as ResourceModel;
use Magento\Backend\App\Action\Context;

class Save  extends \Magento\Backend\App\Action
{
    /**
     * @var ModelFactory
     */

    protected $modelFactory;

    /**
     * @var ResourceModel
     */
    protected $resourceModel;

    public function __construct(
        Context $context,
        ModelFactory   $modelFactory,
        ResourceModel  $resourceModel
    )
    {
        $this->modelFactory = $modelFactory;
        $this->resourceModel = $resourceModel;
        parent::__construct($context);
    }

    public  function  execute()
    {
        $resultRedirect= $this->resultRedirectFactory->create();
        $emptyBrands = $this->modelFactory->create();
        $data = $this->getRequest()->getParams();
        $id =$this->getRequest()->getParam('brand_id');
        $updateBrand=$emptyBrands->load($data['brand_id']);
        $updateBrand->setName($data['name'] );
        $updateBrand->setInfo($data['info'] );
        $updateBrand->setIsActive($data['is_active'] );
        $updateBrand->setUpdatedAt($data['updated_at'] );

        $this->resourceModel->save($updateBrand);
        $this->messageManager->addSuccessMessage(__('Record Successfuly Updated'));

        return $resultRedirect->setPath('*/*/edit',['brand_id='>$id]);
    }
}
