<?php

declare(strict_types=1);

namespace Omnipro\Blogger\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Omnipro\Blogger\Api\Data\PostInterface;
use Omnipro\Blogger\Api\Data\PostSearchResultInterface;

interface PostRepositoryInterface
{
  /**
   * Save post
   * @param PostInterface $post
   * @return PostInterface
   * @throws LocalizedException
   */
  public function save(PostInterface $post);

  /**
   * Retrieve post matching the specified criteria
   * @param SearchCriteriaInterface $searchCriteria
   * @return PostSearchResultInterface
   * @throws LocalizedException
   */
  public function getList(SearchCriteriaInterface $searchCriteria);


  /**
   * Retrieve post
   * @param int $post_id
   * @return PostInterface
   * @throws LocalizedException
   */
  public function getById($post_id);

  /**
   * Delete post
   * @param PostInterface $post 
   * @return bool true on success
   * @throws LocalizedException
   */
  public function delete(PostInterface $post);

  /**
   * Delete post by ID
   * @param int $post_id
   * @return bool true on success
   * @throws NoSuchEntityException
   * @throws LocalizedException
   */
  public function deleteById($post_id);
}
