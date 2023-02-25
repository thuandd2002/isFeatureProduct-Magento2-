<?php
namespace AHT\IsFeatureProduct\Block;

use Magento\Catalog\Helper\Image;
use Magento\Catalog\Model\ProductFactory;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $imageHelper;
    protected $productFactory;
    protected $_productCollectionFactory;
    protected $_storeManager;
    protected $_urlInterface;
    protected $_productRepository;
    public function __construct(
        Image $imageHelper, ProductFactory $productFactory,
        \Magento\Backend\Block\Template\Context $context,        
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,           
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\UrlInterface $urlInterface,  
        array $data = []
    )
    {   $this->imageHelper = $imageHelper;
        $this->productFactory = $productFactory;
        $this->_productCollectionFactory = $productCollectionFactory;    
        $this->_storeManager = $storeManager;
        $this->_urlInterface = $urlInterface;
        parent::__construct($context, $data);
    }
    
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
    public function getProductImageUrl($id)
    {
        try 
        {
            $product = $this->productFactory->create()->load($id);
        } 
        catch (NoSuchEntityException $e) 
        {
            return 'Data not found';
        }
        $url = $this->imageHelper->init($product, 'product_thumbnail_image')->getUrl();
        return $url;
    }
    public function getStoreManagerData()
    {    
        echo $this->_storeManager->getStore()->getId() . '<br />';
        
        // by default: URL_TYPE_LINK is returned
        echo $this->_storeManager->getStore()->getBaseUrl() . '<br />';        
        
        echo $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_WEB) . '<br />';
        echo $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_DIRECT_LINK) . '<br />';
        echo $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . '<br />';
        echo $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_STATIC) . '<br />';
        
        echo $this->_storeManager->getStore()->getUrl('product/33') . '<br />';
        
        echo $this->_storeManager->getStore()->getCurrentUrl(false) . '<br />';
            
        echo $this->_storeManager->getStore()->getBaseMediaDir() . '<br />';
            
        echo $this->_storeManager->getStore()->getBaseStaticDir() . '<br />';    
    }
    
    /**
     * Prining URLs using URLInterface
     */
    public function getUrlInterfaceData()
    {
        echo $this->_urlInterface->getCurrentUrl() . '<br />';
        
        echo $this->_urlInterface->getUrl() . '<br />';
        
        echo $this->_urlInterface->getUrl('helloworld/general/enabled') . '<br />';
        
        echo $this->_urlInterface->getBaseUrl() . '<br />';
    }
    
    public function getProductCollection()
    {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->setPageSize(15); // fetching only 3 products
        return $collection;
    }

    public function getTitle()
    {
        echo "Is Product Features";
    }
    public function getProduct($id)
    {
        // die('abc');
    return $this->_productCollectionFactory->getById($id);
    }
}
