<?php
namespace Omnipro\Blogger\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface PostSearchResultInterface extends SearchResultsInterface
{
    /**
     * getPosts
     * @return PostInterface[]
     */
    public function getPosts();

    /**
     * setPosts
     * @param PostInterface[] $posts 
     * @return void
     */
    public function setPosts(array $posts);
}
