<?php

namespace Omnipro\Blogger\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;
use Magento\Framework\Setup\Declaration\Schema\Db\MySQL\Definition\Columns\Timestamp;

interface PostInterface extends ExtensibleDataInterface
{
  const POST_ID = "post_id";
  const POST_TITLE = "post_title";
  const POST_CONTENT = "post_content";
  const POST_IMAGE = "image_url";
  const POST_AUTHOR = "author_email";
  const PUBLICATION_DATE = "created_at";

  /**
   * @param int $post_id
   * @return $this
   */
  public function setId($post_id);

  /**
   * @return int|null
   */
  public function getId();

  /**
   * @param string $title
   * @return $this
   */
  public function setTitle($title);

  /**
   * @return string|null
   */
  public function getTitle();

  /**
   * @param string $content
   * @return $this
   */
  public function setContent($content);

  /**
   * @return string|null
   */
  public function getContent();

  /**
   * @param string $image_url
   * @return $this
   */
  public function setImage($image_url);

  /**
   * @return string
   */
  public function getImage();

  /**
   * @param string $author_email 
   * @return $this
   */
  public function setAuthor($author_email);

  /**
   * @return string
   */
  public function getAuthor();

  /**
   * @param Timestamp $date 
   * @return $this
   */
  public function setPublicationDate($date);

  /**
   * @return Timestamp|null
   */
  public function getPublicationDate();

  /**
   * setExtensionAttributes
   * @param \Omnipro\Blogger\Api\Data\PostExtensionInterface $extensionAttributes 
   * @return void
   */
  public function setExtensionAttributes(\Omnipro\Blogger\Api\Data\PostExtensionInterface $extensionAttributes);

  /**
   * @return \Omnipro\Blogger\Api\Data\PostExtensionInterface|null
   */
  public function getExtensionAttributes();
}
