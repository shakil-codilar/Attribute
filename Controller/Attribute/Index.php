<?php

namespace Codilar\Attribute\Controller\Attribute;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    /**
     * @var PageFactory
     */
    protected $pageFactory;

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

    /**
     * Execute action based on request and return result
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        if($this->helperData->isEnable()) {
            return $this->pageFactory->create();
        }
        else{
            return $this->resultRedirectFactory->create()->setPath('cms/noroute/index');
        }
    }
}
