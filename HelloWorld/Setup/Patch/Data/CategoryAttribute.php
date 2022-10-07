<?php

declare (strict_types = 1);
namespace Arjun\HelloWorld\Setup\Patch\Data;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Catalog\Model\Category;

class CategoryAttribute implements DataPatchInterface {
   
    private $moduleDataSetup;
   
    private $eavSetupFactory;
    
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }
   
    public function apply() {
        
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $eavSetup->addAttribute(Category::ENTITY, 'rh_cat_attr', [
            'type' => 'text',
            'label' => 'Customer age',
            'input' => 'text',
            'default' => 0,
            'sort_order' => 5,
            'global' => ScopedAttributeInterface::SCOPE_STORE,
            'group' => 'General Information',
            'visible_on_front' => true
        ]);
    }
    
    public static function getDependencies() {
        return [];
    }
   
    public function getAliases() {
        return [];
    }
}