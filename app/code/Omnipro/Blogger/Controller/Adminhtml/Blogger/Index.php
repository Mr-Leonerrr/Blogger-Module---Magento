<?php

declare(strict_types=1);

namespace Omnipro\Blogger\Controller\Adminhtml\Blogger;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(Context $context, PageFactory $pageFactory) 
    {
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->_pageFactory->create();
        $resultPage->setActiveMenu("Omnipro::top_level");
        $resultPage->addBreadcrumb(__("Blogger"), __("Blogger"));
        $resultPage->addBreadcrumb(__("Manage Blogger"), __("Manage Blogger"));
        $resultPage->getConfig()->getTitle()->prepend(__("Manage Blogger"));
        return $resultPage;
    }

    /**
     * Is the user allowed to view the page.
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(static::ADMIN_RESOURCE);
    }
}
