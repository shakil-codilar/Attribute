<?php
namespace Codilar\Attribute\Block\Adminhtml\Edit\Form;
use Codilar\Attribute\Model\BrandFactory as ModelFactory;
use Magento\Framework\Exception\NoSuchEntityException;

class GenericButton
{
    protected $modelFactory;

    protected  $context;


    public  function  __construct(
        \Magento\Backend\Block\Widget\Context $context,
        ModelFactory   $modelFactory
    )
    {
        $this->modelFactory= $modelFactory;
        $this->context =$context;
    }
    public function getId()
    {
        if ($this->context->getRequest()->getParam('brand_id')){
            $modelFactory = $this->modelFactory->create();
            $modelFactory->load($this->context->getRequest()->getParam('brand_id'));
            return $modelFactory->getEntityId();
        }
        return false;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
    public function getUrlBuilder(){
        return $this->context->getUrlBuilder();
    }
}

