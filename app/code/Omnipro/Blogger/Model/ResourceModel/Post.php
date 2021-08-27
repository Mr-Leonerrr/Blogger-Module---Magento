<?php
namespace Omnipro\Blogger\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Post extends AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('omnipro_blogger', 'post_id');
    }
}
