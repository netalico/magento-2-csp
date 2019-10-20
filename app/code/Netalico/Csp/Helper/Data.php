<?php

namespace Netalico\Csp\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{

	protected $_scopeConfig;
	
	public function __construct(\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
	{
	  $this->_scopeConfig = $scopeConfig;
	}

	public function getCurrentStoreInfo()
	{
		return $this->_storeManager->getStore()->getId();
	}

	public function isEnabled()
  {
		return (bool) $this->_scopeConfig->getValue('csp/general/enabled');
  }

    public function getPolicy()
    {
	    if ($this->_scopeConfig->getValue('csp/general/policy')) {
		    if ($this->_scopeConfig->getValue('csp/general/easy_policy')) {
			    return $this->convertToEasyPolicy($this->_scopeConfig->getValue('csp/general/policy'));
		    }

			return $this->_scopeConfig->getValue('csp/general/policy');
	    } else {
		    return "default-src 'none'; form-action 'none'; frame-ancestors 'none';";
	    }
    }

    public function getReportUri()
    {
	    return "; report-uri " . 'https://' . $this->_scopeConfig->getValue('csp/general/report_uri') . '.report-uri.com/r/d/csp/';
    }

    public function getMode()
    {
        return $this->_scopeConfig->getValue('csp/general/mode');
    }

    public function getOnlyCheckout()
    {
        return $this->_scopeConfig->getValue('csp/general/only_checkout');
    }

    public function getCheckoutUrl()
    {
        return $this->_scopeConfig->getValue('csp/general/checkout_url');
    }

    public function convertToEasyPolicy($policy) {

	    $replacements = array(
		    'connect-src',
		    'default-src',
		    'font-src',
		    'frame-src',
		    'font-src',
		    'img-src',
		    'media-src',
		    'script-src-attr',
		    'script-src-elem',
		    'style-src-attr',
		    'style-src-elem',
		    'form-action',
		    'frame-ancestors',
		    ';'
	    );
	    $policy = str_replace($replacements, '', $policy);
	    $policy = 'default-src ' . $policy;

	    return $policy;

    }

}
