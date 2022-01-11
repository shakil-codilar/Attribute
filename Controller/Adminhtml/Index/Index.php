<?php

namespace Codilar\Attribute\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{

    protected $helperData;
    /**
     * @var PageFactory
     */
    private $pageFactory;

    private $redirectfactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        \Codilar\Attribute\Helper\Data $helperData
    )
    {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
        $this->helperData=$helperData;
    }


    public function execute()
    {
//        if($this->helperData->isEnable()) {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__("Brand Mangement"));
            return $this->pageFactory->create();
//        }
//        else{
//            return $this->resultRedirectFactory->create()->setPath('cms/noroute/index');
//        }

    }
}
