<?php

namespace Codilar\Attribute\Controller\Attribute;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\HttpPostActionInterface as HttpPostActionInterface;
use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;

class Listing extends Action
{
    /**
     * @var PageFactory
     */
    protected $pageFactory;
    /**
     * @var \Magento\Framework\Controller\Result\ForwardFactory
     */
    protected $resultForwardFactory;

    public function __construct(
        Context                                             $context,
        PageFactory                                         $pageFactory,
        \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory,
        \Codilar\Attribute\Helper\Data                      $helperData
    )
    {
        parent::__construct($context);
        $this->resultForwardFactory = $resultForwardFactory;
        $this->pageFactory = $pageFactory;
        $this->helperData = $helperData;
    }

    protected function noProductRedirect()
    {
        $store = $this->getRequest()->getQuery('store');
        if (isset($store) && !$this->getResponse()->isRedirect()) {
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('');
        } elseif (!$this->getResponse()->isRedirect()) {
            $resultForward = $this->resultForwardFactory->create();
            $resultForward->forward('noroute');
            return $resultForward;
        }
    }

    /**
     * Execute action based on request and return result
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {

        if ($this->helperData->isEnable()) {
            return $this->pageFactory->create();
        } else {
            return $this->noProductRedirect();
        }
    }
}

//    public function execute()
//    {
//
//        if($this->helperData->isEnable()) {
//            return $this->pageFactory->create();
//        }
//        else{
//            return $this->resultRedirectFactory->create()->setPath('cms/noroute/index');
//        }
//    }

