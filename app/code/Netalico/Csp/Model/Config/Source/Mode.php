<?php

namespace Netalico\Csp\Model\Config\Source;
class Mode implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
      return array(
        array('value' => 0, 'label' =>'Wizard'),
        array('value' => 1, 'label' => 'Report Only'),
        array('value' => 2, 'label' =>'Enforce'),
        array('value' => 3, 'label' =>'No Reporting'),
      );
    }
}
