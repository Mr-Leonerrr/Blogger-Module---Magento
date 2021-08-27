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
class Post extends AbstractModel implements PostInterface
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
     * @param Post $postResource 
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
     * @return void
     */
    public function _construct()
    {
        $this->_init(\Omnipro\Blogger\Model\ResourceModel\Post::class);
    }

    public function getDataModel()
    {
        $postData = $this->getData();

        $postDataObject = $this->_postFactory->create();
        $this->_dataObjectHelper->populateWithArray($postDataObject, $postData, "\\Omnipro\\Blogger\\Api\\Data\\PostInterface");

        return $postDataObject;
    }

    /**
     * Get Title
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->getData(self::POST_TITLE);
    }

    /**
     * Get Content
     *
     * @return string|null
     */
    public function getContent()
    {
        return $this->getData(self::POST_CONTENT);
    }

    /**
     * Get Created At
     *
     * @return Timestamp|null
     */
    public function getPublicationDate()
    {
        return $this->getData(self::PUBLICATION_DATE);
    }

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData(self::POST_ID);
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->getData(self::POST_AUTHOR);
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->getData(self::POST_IMAGE);
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        return $this->setData(self::POST_TITLE, $title);
    }

    /**
     * @param string $content
     * @return $this
     */
    public function setContent($content)
    {
        return $this->setData(self::POST_CONTENT, $content);
    }

    /**
     * @param string $image_url 
     * @return $this
     */
    public function setImage($image_url)
    {
        return $this->setData(self::POST_IMAGE, $image_url);
    }

    /**
     * @param string $author_email 
     * @return $this
     */
    public function setAuthor($author_email)
    {
        return $this->setData(self::POST_AUTHOR, $author_email);
    }

    /**
     * Set Created At
     *
     * @param Timestamp $createdAt
     * @return $this
     */
    public function setPublicationDate($createdAt)
    {
        return $this->setData(self::PUBLICATION_DATE, $createdAt);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        return $this->setData(self::POST_ID, $id);
    }
}
