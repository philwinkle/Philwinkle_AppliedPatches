<?php
/**
 * AppliedPatches model - parses and returns the list of patches applied
 *
 * @category  Mage
 * @package   Philwinkle_AppliedPatches
 * @author    Phillip Jackson
 * @copyright Copyright (c) 2015 Philwinkle LLC
 */
class Philwinkle_AppliedPatches_Model_Patches extends Mage_Core_Model_Abstract
{
    /**
     * File path to applied.patches.list
     * @var string
     */
    private $_patchFile;

    /**
     * Container for patch information
     * @var array
     */
    protected $_appliedPatches  = array();
    protected $_revertedPatches = array();
    protected $_allPatches      = array();

    /**
     * Set the path to the patch file and call the load method
     */
    protected function _construct()
    {
        $this->_patchFile = Mage::getBaseDir('etc') . DS . 'applied.patches.list';
        $this->_loadPatchFile();
    }

    /**
     * Return a formatted string of patches applied
     * @return string
     */
    public function getPatches()
    {
        return implode(', ', $this->_appliedPatches);
    }

    /**
     * Load the patches file, parse the contents and append patch names to the
     * appropriate array for applied, reverted and all
     * @return self
     */
    protected function _loadPatchFile()
    {
        $ioAdapter = new Varien_Io_File();

        if (!$ioAdapter->fileExists($this->_patchFile)) {
            return $this;
        }

        $ioAdapter->open(array('path' => $ioAdapter->dirname($this->_patchFile)));
        $ioAdapter->streamOpen($this->_patchFile, 'r');

        while ($buffer = $ioAdapter->streamRead()) {
            if (stristr($buffer, '|') && stristr($buffer, 'SUPEE')) {
                list($date, $patch) = array_map('trim', explode('|', $buffer));
                $this->_allPatches[$patch] = $patch;
                        
                if (stristr($buffer, 'REVERTED')) {
                    $this->_revertedPatches[$patch] = $patch;
                }
            }
        }
                
        $this->_appliedPatches = array_diff($this->_allPatches, $this->_revertedPatches);
        $ioAdapter->streamClose();

        return $this;
    }
}
