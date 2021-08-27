<?php

namespace Omnipro\Blogger\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface PostSearchResultInterface extends SearchResultsInterface
{
    /**
     * getPosts
     * @return \Omnipro\Blogger\Api\Data\PostInterface[]
     */
    public function getPosts();

    /**
     * setPosts
     * @param \Omnipro\Blogger\Api\Data\PostInterface[] $posts 
     * @return void
     */
    public function setPosts(array $posts);
}
