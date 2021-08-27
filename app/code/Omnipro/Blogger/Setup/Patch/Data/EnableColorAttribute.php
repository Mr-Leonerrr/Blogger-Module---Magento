<?php

namespace Omnipro\Blogger\Setup\Patch\Data;

use Magento\Catalog\Model\Product;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;

class EnableColorAttribute implements DataPatchInterface
{

    /** @var ModuleDataSetupInterface */
    protected $_dataSetup;

    /** @var EavSetupFactory  */
    protected $_setupFactory;

    /**
     * @param ModuleDataSetupInterface $dataSetup 
     * @param EavSetupFactory $setupFactory 
     */
    public function __construct(ModuleDataSetupInterface $dataSetup, EavSetupFactory $setupFactory)
    {
        $this->_dataSetup = $dataSetup;
        $this->_setupFactory = $setupFactory;
    }

    /**
     * {@inheritDoc}
     */
    public function apply()
    {
        /** @var EavSetup $setup  */
        $setup = $this->_setupFactory->create(["setup" => $this->_dataSetup]);

        $setup->addAttribute(Product::ENTITY, "enable_color", [
            "type" => "int",
            "backend" => "",
            "frontend" => "",
            "label" => "Enable Color",
            "input" => "select",
            "class" => "",
            "source" => \Magento\Catalog\Model\Product\Attribute\Source\Boolean::class,
            "global" => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            "visible" => true,
            "required" => true,
            "user_defined" => false,
            "default" => "",
            "searchable" => false,
            "filterable" => false,
            "comparable" => false,
            "visible_on_front" => false,
            "used_in_product_listing" => true,
            "unique" => false
        ]);

    }
    
    /**
     * {@inheritDoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    public function getAliases()
    {
        return [];
    }

}
