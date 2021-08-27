<?php

namespace Omnipro\Blogger\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Setup\Declaration\Schema\Db\MySQL\Definition\Columns\Timestamp;
use Omnipro\Blogger\Api\Data\PostInterface;

/**
 * Post view
 * @package Omnipro\Blogger\Model
 */
class Post extends AbstractModel implements PostInterface, IdentityInterface
{

    const CACHE_TAG = "omnipro_blogger_post";

    protected function _construct()
    {
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
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . "_" . $this->getId()];
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

    public function setId($post_id)
    {
        $this->setData(self::POST_ID, $post_id);
    }

    /**
     * @param string $title 
     * @return $this
     */
    public function setTitle($title)
    {
        $this->setData(self::POST_TITLE, $title);
    }

    /**
     * @param string $content 
     * @return $this
     */
    public function setContent($content)
    {
        $this->setData(self::POST_CONTENT, $content);
    }

    /**
     * @param string $image_url 
     * @return $this
     */
    public function setImage($image_url)
    {
        $this->setData(self::POST_IMAGE, $image_url);
    }

    /**
     * @param string $author_email 
     * @return $this
     */
    public function setAuthor($author_email)
    {
        $this->setData(self::POST_AUTHOR, $author_email);
    }

    /**
     * @param Timestamp $date 
     * @return $this
     */
    public function setPublicationDate($date)
    {
        $this->setData(self::POST_AUTHOR, $date);
    }
}
