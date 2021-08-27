<?php
namespace Omnipro\Blogger\Model\ResourceModel\Publication;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = "id";

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Omnipro\Blogger\Model\Post::class, \Omnipro\Blogger\Model\ResourceModel\Post::class);
        $this->_map["fields"]["id"] = "main_table.id";
    }
}
