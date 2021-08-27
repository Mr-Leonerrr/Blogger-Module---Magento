<?php

declare(strict_types=1);

namespace Omnipro\Blogger\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Model\AbstractExtensibleModel;
use Magento\Framework\Setup\Declaration\Schema\Db\MySQL\Definition\Columns\Timestamp;
use Omnipro\Blogger\Api\Data\PostExtensionInterface;
use Omnipro\Blogger\Api\Data\PostInterface;
use Omnipro\Blogger\Api\Data\PostInterfaceFactory;
use Omnipro\Blogger\Model\ResourceModel\Publication\Collection;
use Omnipro\Blogger\Model\ResourceModel\Post as PostModel;

/**
 * Post view
 * @package Omnipro\Blogger\Model
 */
class Post extends AbstractExtensibleModel implements PostInterface
{
    public function _construct() {
        $this->_init(\Omnipro\Blogger\Model\ResourceModel\Post::class);
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->getData(self::POST_ID);
    }

    /**
     * @return PostExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * @return string|null
     */
    public function getTitle()
    {
        return $this->getData(self::POST_TITLE);
    }

    /**
     * @return string|null
     */
    public function getContent()
    {
        return $this->getData(self::POST_CONTENT);
    }

    /**
     * @return string|null
     */
    public function getImage()
    {
        return $this->getData(self::POST_IMAGE);
    }

    /**
     * @return string|null
     */
    public function getPublicationDate()
    {
        return $this->getData(self::PUBLICATION_DATE);
    }

    /**
     * @return string|null
     */
    public function getAuthor()
    {
        return $this->getData(self::POST_AUTHOR);
    }

    /**
     * Set Post ID
     * @param int $post_id 
     * @return PostInterface
     */
    public function setId($post_id)
    {
        $this->setData(self::POST_ID, $post_id);
    }

    /**
     * @param PostExtensionInterface $extensionAttributes 
     * @return $this
     */
    public function setExtensionAttributes(PostExtensionInterface $extensionAttributes)
    {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * @param string $title 
     * @return PostInterface
     */
    public function setTitle($title)
    {
        $this->setData(self::POST_TITLE, $title);
    }

    /**
     * @param string $content 
     * @return PostInterface
     */
    public function setContent($content)
    {
        $this->setData(self::POST_CONTENT, $content);
    }

    /**
     * @param string $image_url 
     * @return PostInterface
     */
    public function setImage($image_url)
    {
        $this->setData(self::POST_IMAGE, $image_url);
    }

    /**
     * @param string $author_email 
     * @return PostInterface
     */
    public function setAuthor($author_email)
    {
        $this->setData(self::POST_AUTHOR, $author_email);
    }

    /**
     * @param Timestamp $date 
     * @return PostInterface
     */
    public function setPublicationDate($date)
    {
        $this->setData(self::POST_AUTHOR, $date);
    }
}
