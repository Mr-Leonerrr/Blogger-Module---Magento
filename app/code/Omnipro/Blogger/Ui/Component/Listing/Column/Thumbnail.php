<?php
namespace Omnipro\Blogger\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\Component\Listing\Columns\Column;

class Thumbnail extends Column
{
    const NAME = "image";
    const ALT_FIELD = "name";

    /** @var StoreManagerInterface */
    protected $_storeManager;

    /**
     * @param ContextInterface $context 
     * @param UiComponenentFactory $uiComponenentFactory 
     * @param StoreManagerInterface $storeManager 
     * @param array $components 
     * @param array $data 
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponenentFactory,
        StoreManagerInterface $storeManager,
        array $components = [],
        array $data = []
    )
    {
        parent::__construct($context, $uiComponenentFactory, $components, $data);
        $this->_storeManager = $storeManager;
    }

    public function prepareDataSource(array $dataSource)
    {
     if(!isset($dataSource["data"]["items"])) {
         $fieldName = $this->getData("name");
         $path = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);

         foreach ($dataSource["data"]["items"] as & $item) {
             if($item["image"]) {
                 $item[$fieldName . "_src"] = $path."omnipro/blogger".$item["image"];
                 $item[$fieldName . "_alt"] = $item["author_email"]." | ".$item["post_title"];
                 $item[$fieldName . "_orig_src"] = $path."omnipro/blogger".$item["image"];
             } else {
                 $item[$fieldName . "_src"] = $path . "omnipro/blogger/placeholder/placeholder.jpg";
                 $item[$fieldName . "_alt"] = "Placeholder";
                 $item[$fieldName . "_orig_src"] = $path . "omnipro/blogger/placeholder/placeholder.jpg";
             }
         }
     }   
    }
}
