<?php
namespace AHT\IsFeatureProduct\Model\ResourceModel\IsFeatureProduct;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected $_eventPrefix = 'aht_isfeatureproduct_is_feature_product_collection';
    protected $_eventObject = 'is_feature_product_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('AHT\IsFeatureProduct\Model\IsFeatureProduct', 'AHT\IsFeatureProduct\Model\ResourceModel\IsFeatureProduct');
    }
}
