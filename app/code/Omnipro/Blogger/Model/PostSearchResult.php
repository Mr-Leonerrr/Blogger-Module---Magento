<?php
namespace Omnipro\Blogger\Model;

use Magento\Framework\Api\SearchResults;
use Omnipro\Blogger\Api\Data\PostInterface;
use Omnipro\Blogger\Api\Data\PostSearchResultInterface;

class PostSearchResult extends SearchResults implements PostSearchResultInterface
{
    /**
     * @return PostInterface[]
     */
    public function getPosts()
    {
        return $this->getItems();
    }

    /**
     * @param PostInterface[] $posts
     * @return void;
     */
    public function setPosts(array $posts)
    {
        $this->setItems($posts);
    }
}
