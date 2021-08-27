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
   * @return void
   */
  public function setId($post_id);

    /**
     * @return int
     */
   public function getId();

   /**
    * @param string $title
    * @return void
    */
   public function setTitle($title);

   /**
    * @return string
    */
   public function getTitle();

   /**
    * @param string $content
    * @return void
    */
   public function setContent($content);

   /**
    * @return string
    */
   public function getContent();

   /**
    * @param string $image_url
    * @return void
    */
   public function setImage($image_url);

   /**
    * @return string
    */
   public function getImage();

   /**
    * @param string $author_email 
    * @return void
    */
   public function setAuthor($author_email);

   /**
    * @return string
    */
   public function getAuthor();

   /**
    * @param Timestamp $date 
    * @return void
    */
   public function setPublicationDate($date);

   /**
    * @return int
    */
   public function getPublicationDate();
}
