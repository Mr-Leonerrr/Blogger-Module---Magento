<?php

declare(strict_types=1);

namespace Omnipro\Blogger\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Setup\Declaration\Schema\Db\MySQL\Definition\Columns\Timestamp;
use Omnipro\Blogger\Api\Data\PostInterface;
use Omnipro\Blogger\Api\Data\PostInterfaceFactory;
use Omnipro\Blogger\Model\ResourceModel\Publication\Collection;
use Omnipro\Blogger\Model\ResourceModel\Post as PostModel;

/**
 * Post view
 * @package Omnipro\Blogger\Model
 */
class Post extends AbstractModel
{

    protected $_eventPrefix = "omnipro_blogger";

    protected $_dataObjectHelper;

    protected $_postFactory;

    const CACHE_TAG = "omnipro_blogger_post";

    /**
     * @param Context $context 
     * @param Registry $registry 
     * @param PostInterfaceFactory $postInterfaceFactory 
     * @param DataObjectHelper $dataObjectHelper 
     * @param PostModel $postResource 
     * @param Collection $postCollection 
     * @param array $data 
     */
    public function __construct(
        Context $context,
        Registry $registry,
        PostInterfaceFactory $postFactory,
        DataObjectHelper $dataObjectHelper,
        PostModel $postResource,
        Collection $postCollection,
        array $data = []
    ) {
        $this->_postFactory = $postFactory;
        $this->_dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $postResource, $postCollection, $data);
    }

    /**
     * Retrieve post model with post data
     * @return PostInterface
     */
    public function getDataModel()
    {
        $postData = $this->getData();

        $postDataObject = $this->_postFactory->create();
        $this->_dataObjectHelper->populateWithArray($postDataObject, $postData, PostInterface::class);

        return $postDataObject;
    }
}
