<?php
/**
 * AppliedPatches helper
 *
 * @category  Mage
 * @package   Philwinkle_AppliedPatches
 * @author    Phil Winkle
 * @copyright Copyright (c) 2015 Philwinkle LLC
 */
class Philwinkle_AppliedPatches_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Return a formatted list of applied patches
     * @return string
     */
    public function getPatches()
    {
        return Mage::getModel('appliedpatches/patches')->getPatches();
    }
}
