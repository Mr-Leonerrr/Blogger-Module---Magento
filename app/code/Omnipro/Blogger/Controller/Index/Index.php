<?php
namespace Omnipro\Blogger\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;
use Magento\Framework\Exception\LocalizedException;

class Index extends Action
{
    /**
     * @var PageFactory
     */
    protected $_pageFactory;

    /**
     * @param Context $context
     * @param PageFactory $name
     */
    public function __construct(Context $context, PageFactory $pageFactory)
    {
        parent::__construct($context);
        $this->_pageFactory = $pageFactory;
    }
    /**
     * Prints the blog from informed order id
     * @return Page
     * @throws LocalizedException
     */
    public function execute()
    {
        $resultPage = $this->_pageFactory->create();
        return $resultPage;
    }
}
