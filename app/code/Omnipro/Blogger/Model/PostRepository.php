<?php

declare(strict_types=1);

namespace Omnipro\Blogger\Model;

use Omnipro\Blogger\Api\PostRepositoryInterface;
use Omnipro\Blogger\Api\Data\PostInterfaceFactory;
use Omnipro\Blogger\Api\Data\PostSearchResultInterfaceFactory;
use Omnipro\Blogger\Model\ResourceModel\Post as ResourcePost;
use Omnipro\Blogger\Model\ResourceModel\Publication\CollectionFactory as PostCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\Search\SearchResultFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;
use Omnipro\Blogger\Api\Data\PostInterface;
use Omnipro\Blogger\Api\Data\PostSearchResultInterface;
use Omnipro\Blogger\Model\ResourceModel\Publication\Collection;

class PostRepository implements PostRepositoryInterface
{

    /** @var CollectionProcessorInterface */
    private $_collectionProcessor;

    /** @var DataObjectHelper */
    protected $_dataObjectHelper;

    /** @var JoinProcessorInterface */
    protected $_extensionAttributeJoinProcessor;

    /** @var PostCollectionFactory */
    protected $_postCollectionFactory;

    /** @var PostFactory   */
    protected $_postFactory;

    /** @var SearchResultFactory */
    protected $_searchResultsFactory;

    /** @var DataObjectProcessor */
    protected $_dataObjectProcessor;

    /** @var ExtensibleDataObjectConverter */
    protected $_extensibleDataObjectConverter;

    /** @var ResourcePost */
    protected $_postResource;

    protected $_dataPostFactory;

    /** @var StoreManagerInterface */
    protected $_storeManager;

    /**
     * @param PostFactory $postFactory
     * @param Post $postResource
     * @param Collection $postCollectionFactory
     * @param PostSearchResultInterface $searchResultFactory
     */
    public function __construct(
        ResourcePost $resource,
        PostFactory $postFactory,
        PostInterfaceFactory $dataPostFactory,
        PostCollectionFactory $postCollectionFactory,
        PostSearchResultInterfaceFactory $searchResultFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributeJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->_postResource = $resource;
        $this->_postFactory = $postFactory;
        $this->_postCollectionFactory = $postCollectionFactory;
        $this->_searchResultsFactory = $searchResultFactory;
        $this->_dataObjectHelper = $dataObjectHelper;
        $this->_dataPostFactory = $dataPostFactory;
        $this->_dataObjectProcessor = $dataObjectProcessor;
        $this->_storeManager = $storeManager;
        $this->_collectionProcessor = $collectionProcessor;
        $this->_extensionAttributeJoinProcessor = $extensionAttributeJoinProcessor;
        $this->_extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * Save post
     * {@inheritDoc} 
     */
    public function save(PostInterface $post)
    {
        $postData = $this->_extensibleDataObjectConverter->toNestedArray($post, [], \Omnipro\Blogger\Api\Data\PostInterface::class);
        $postModel = $this->_postFactory->create()->setData($postData);

        try {
            $this->_postResource->save($postModel);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__("Could not save the post: %1", $e->getMessage()));
        }
        return $postModel->getDataModel();
    }

    /**
     * {@inheritDoc}
     */
    public function getById($post_id)
    {
        $post = $this->_postFactory->create();
        $this->_postResource->load($post, $post_id);
        if (!$post->getId()) {
            throw new NoSuchEntityException(__("Unable to find custom data with ID %1", $post_id));
        }
        return $post->getDataModel();
    }

    /**
     * {@inheritDoc}
     */
    public function delete(PostInterface $post)
    {
        try {
            $postModel = $this->_postFactory->create();
            $this->_postResource->load($postModel, $post->getId());
            $this->_postResource->delete($postModel);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__("Could not delete the post: %1", $e->getMessage()));
        }
    }

    /**
     * {@inheritDoc}
     */
    public function deleteById($post_id)
    {
        return $this->delete($this->getById($post_id));
    }

    /**
     * {@inheritDoc}
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->_postCollectionFactory->create();
        //$this->_extensionAttributeJoinProcessor->process($collection, \Omnipro\Blogger\Api\Data\PostInterface::class); //Necesita ser interfaz

       $this->addFiltersToCollection($searchCriteria, $collection);
       $this->addSortOrdersToCollection($searchCriteria, $collection);
       $this->addPagingToCollection($searchCriteria, $collection);

       $collection->load();

       return $this->buildSearchResult($searchCriteria, $collection);
    }

    private function addFiltersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            $fields = $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $fields[] = $filter->getField();
                $conditions[] = [$filter->getConditionType() => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }
    }

    private function addSortOrdersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ((array) $searchCriteria->getSortOrders() as $sortOrder) {
            $direction = $sortOrder->getDirection() === SortOrder::SORT_ASC ? 'asc' : 'desc';
            $collection->addOrder($sortOrder->getField(), $direction);
        }
    }

    private function addPagingToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->setCurPage($searchCriteria->getCurrentPage());
    }

    private function buildSearchResult(SearchCriteriaInterface $searchCriteria, Collection $collection) {
        $searchResults = $this->_searchResultsFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}
