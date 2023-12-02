<?php

namespace Impact\Theme\Helper;

use Magento\Catalog\Model\Product as ModelProduct;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Catalog\Api\CategoryRepositoryInterface;


class ImpactHelper extends \Magento\Framework\Url\Helper\Data
{

    /**
     * @var TimezoneInterface
     */
    protected $localeDate;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Magento\Directory\Model\CurrencyFactory
     */
    protected $currencyFactory;

    /**
     * @var rate
     */
    protected $rateCurrency = 1;
    protected $currentCurrency = 'EUR';
    protected $baseCurrency = 'EUR';

    protected $categoryRepository;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Directory\Model\CurrencyFactory $currencyFactory,
        TimezoneInterface $localeDate,
        CategoryRepositoryInterface $categoryRepository
    )
    {
        $this->localeDate = $localeDate;
        $this->storeManager = $storeManager;
        $this->currencyFactory = $currencyFactory;

        $this->currentCurrency = $storeManager->getStore()->getCurrentCurrency()->getCode();
        $this->baseCurrency = $storeManager->getStore()->getBaseCurrency()->getCode();
        $this->categoryRepository = $categoryRepository;


        parent::__construct($context);
    }


    public function isProductPromo(ModelProduct $product)
    {
        return $product->getData('promo');
    }


    public function isShippingFree(ModelProduct $product)
    {
       return true;
    }

    /*
    * Get store identifier
    *
    * @return  int
    */
    public function getStoreId()
    {
        return $this->storeManager->getStore()->getId();
    }

    /*
     * Get website identifier
     *
     * @return string|int|null
     */
    public function getWebsiteId()
    {
        return $this->storeManager->getStore()->getWebsiteId();
    }

    /*
     * Get store group identifier
     *
     * @return int
     */
    public function getStoreGroupId()
    {
        return $this->storeManager->getStore()->getGroupId();

    }

    /*
     * Get Store code
     *
     * @return string
     */
    public function getStoreCode()
    {
        return $this->storeManager->getStore()->getCode();
    }

    /*
     * Get Store name
     *
     * @return string
     */
    public function getStoreName()
    {
        return $this->storeManager->getStore()->getName();
    }

    /*
     * Get current url for store
     *
     * @param bool|string $fromStore Include/Exclude from_store parameter from URL
     * @return string
     */
    public function getStoreUrl($fromStore = true)
    {
        return $this->storeManager->getStore()->getCurrentUrl($fromStore);
    }

    /*
     * Check if store is active
     *
     * @return boolean
     */
    public function isStoreActive()
    {
        return $this->storeManager->getStore()->isActive();
    }

    public function getStoreCurrencySymbol() {
        return $this->storeManager->getStore()->getCurrentCurrency()->getCode();
    }

}
