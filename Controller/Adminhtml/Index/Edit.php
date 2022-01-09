<?php
namespace Codilar\Attribute\Controller\Adminhtml\Index;

use Codilar\Attribute\Model\BrandFactory as ModelFactory;
use Codilar\Attribute\Model\ResourceModel\Brand as ResourceModel;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * @var ModelFactory
     */

    protected $modelFactory;

    /**
     * @var ResourceModel
     */
    protected $resourceModel;

    //protected $_coreRegistry;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $coreRegistry,
        ModelFactory   $modelFactory,
        ResourceModel  $resourceModel
    )
    {
        $this->modelFactory = $modelFactory;
        $this->resourceModel = $resourceModel;
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $coreRegistry;

        parent::__construct($context);
    }

    public function execute()
    {
        //getting the data
        $id = $this->getRequest()->getParam('brand_id');
        $model = $this->modelFactory->create();
        //loading data using model
        if ($id) {
            $model = $this->modelFactory->create()->load($id);
            if (!$model->getBrandId()) {
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/listing');
            }
        }

        //save model data to registry variable
        $this->_coreRegistry->register('Attribute',$model);
        $resultPage = $this->resultPageFactory->create();
        //set page title
        $resultPage->getConfig()->getTitle()->prepend(__('Attribute Module'));
        $pageTitle = __('Edit Page for %1',$model->getId() ? $model->getName() : __('New Entry'));
        $resultPage->getConfig()->getTitle()->prepend($pageTitle);
        return $resultPage;
    }

}
