<?php

namespace Omnipro\Blogger\Block;


use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Registry;
use Omnipro\Blogger\Model\Post;
use Omnipro\Blogger\Model\PostFactory;
use Omnipro\Blogger\Controller\Post\View as ViewAction;

class View extends Template
{

    /** @var Registry */
    protected $_registry;

    /** @var Post */
    protected $_post = null;

    /** @var PostFactory */
    protected $_postFactory = null;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param PostFactory $postFactory
     * @param array $data
     */
    public function __construct(Context $context, Registry $registry, PostFactory $postFactory, array $data = [])
    {
        $this->_postFactory = $postFactory;
        $this->_registry = $registry;
        parent::__construct($context, $data);
    }

    public function getPost() 
    {
        if($this->_post === null) {
            $post = $this->_postFactory->create();
            $post->load($this->_getPostId());

            if(!$post->getId()) {
                throw new LocalizedException(__("Post not found"));
            }

            $this->_post = $post;
        }
        return $this->_post;
    }

    public function _getPostId() 
    {
        return (int) $this->_registry->registry(ViewAction::REGISTRY_KEY_POST_ID);
    }
}
