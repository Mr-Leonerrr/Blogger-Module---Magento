<?php
namespace Omnipro\Blogger\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Omnipro\Blogger\Model\ResourceModel\Publication\Collection as ViewCollection;
use Omnipro\Blogger\Model\ResourceModel\Publication\CollectionFactory as ViewCollectionFactory;
use Omnipro\Blogger\Model\Post;

/**
 * Building unit for layout
 *
 * License notice...
 */

class Posts extends Template
{

    /**
     * @var null|CollectionFactory
     */
    protected $_postCollectionFactory = null;

    /**
     * @param Context $context
     * @param ViewCollectionFactory $collectionFactory
     * @param array $data
     */
    public function __construct(Context $context, ViewCollectionFactory $collectionFactory, array $data = []) {
        $this->_postCollectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    public function _prepareLayout() {
        $this->pageConfig->getTitle()->set(__("Omnipro Blogger - Posts"));
        return parent::_prepareLayout();
    }

    /**
     * @return Post[]
     */
    public function getPosts() {
        /** @var ViewCollection $viewCollection */
        $viewCollection = $this->_postCollectionFactory->create();
        $viewCollection->addFieldToSelect("*")->load();
        return $viewCollection->getItems();
    }

    /**
     * @param Post $post
     * @return void
     */
    public function getPostUrl(Post $post) {
        return "/blogger/post/view/id/" . $post->getId();
    }

    public function getFormAction() {
        return $this->getUrl('Omnipro_Blogger/Blogger', ["_secure" => true]);
    }
}
