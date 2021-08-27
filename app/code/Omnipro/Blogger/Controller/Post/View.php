<?php
namespace Omnipro\Blogger\Controller\Post;

use Magento\Config\Model\Config\Backend\Locale;
use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;

class View extends Action
{
    const REGISTRY_KEY_POST_ID = "omnipro_blogger_post_id";

    /** @var Registry */
    protected $_registry;

    /** @var PageFactory */
    protected $_pageFactory;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param PageFactory $pageFactory
     */
    public function __construct(
       Context $context,
       Registry $registry,
       PageFactory $pageFactory
    )
    {
        parent::__construct($context);
        $this->_registry = $registry;
        $this->_pageFactory = $pageFactory;
    }
    /**
     * View page action
     *
     * @return Page
     * @throws LocalizedException
     */
    public function execute()
    {
        $this->_registry->register(self::REGISTRY_KEY_POST_ID, (int)$this->_request->getParam("id"));
        $resultPage = $this->_pageFactory->create();
        return $resultPage;
    }
}
