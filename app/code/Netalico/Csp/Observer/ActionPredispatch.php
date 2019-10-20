<?php


namespace Netalico\Csp\Observer;

use \Netalico\Csp\Helper\Data;

class ActionPredispatch implements \Magento\Framework\Event\ObserverInterface
{

	private $response;

	private $helper;

	protected $_urlInterface;


    public function __construct(
    	Data $helper,
			\Magento\Framework\App\ResponseInterface $response,
			\Magento\Framework\UrlInterface $urlInterface
    )
		{
			$this->response = $response;
			$this->helper = $helper;
			$this->_urlInterface = $urlInterface;
		}


   	/**
     * Execute observer
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */


    public function execute(
        \Magento\Framework\Event\Observer $observer
    ) {

		if (!$this->helper->isEnabled()) {
			return;
		}

     	if (!$this->helper->getOnlyCheckout()) {
	 		$this->_enforcePolicy();
	 		return;
     	} else {
	     	if (strpos($this->_urlInterface->getCurrentUrl(), $this->helper->getCheckoutUrl()) !== false) {
		 		$this->_enforcePolicy();
		 		return;
			}
     	}
     }
     	private function _enforcePolicy()
	    {

		    switch ($this->helper->getMode()) {
				case "0": // Wizard
					$this->response->setHeader(
						'Content-Security-Policy-Report-Only',
						$this->helper->getPolicy() . $this->helper->getReportUri() . 'wizard', true
					);
					break;
				case "1": // Reporting
					$this->response->setHeader(
						'Content-Security-Policy-Report-Only',
						$this->helper->getPolicy() . $this->helper->getReportUri() . 'reporting', true
					);
					break;
				case "2": // Enforce
					$this->response->setHeader(
						'Content-Security-Policy',
						$this->helper->getPolicy() . $this->helper->getReportUri() . 'enforce', true
					);
					break;
				case "3": // No Reporting
					$this->response->setHeader(
						'Content-Security-Policy',
						$this->helper->getPolicy(), true
					);
					break;

			}
    }

}
