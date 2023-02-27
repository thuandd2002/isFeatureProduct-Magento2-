<?php
namespace AHT\IsFeatureProduct\Observer;

use Magento\Framework\Event\ObserverInterface;

class IsFeatureProduct implements \Magento\Framework\Event\ObserverInterface
{
    protected $_options;
    public function __construct(
        \Magento\Catalog\Model\Product\Option $options
    ) {
        $this->_options = $options;
    }
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        // $product = $observer->getData('mp_text');
		// echo $product->getText() . " - Event </br>";
		// $product->setText('Execute event successfully.');
		// return $this;
        $product = $observer->getProduct();
        $product->setData('is_feature_product',1);
        // $options = [];
        // $options = [
        //     '0' => [  
        //             'is_feature_product' => '0',
        //             'values' => [
        //                 '0' =>[  
        //                         'is_feature_product' => '1',
        //                 ]
        //             ]
        //         ]
        //     ];
        // foreach ($options as $arrayOption) {
        //     $option = $this->_options
        //                     ->setProductId($product->getId())
        //                     ->setStoreId($product->getStoreId())
        //                     ->addData($arrayOption);
        //     $option->save();
        //     $product->addOption();
        // } 
        $product->save();
        return $product;

    }
}