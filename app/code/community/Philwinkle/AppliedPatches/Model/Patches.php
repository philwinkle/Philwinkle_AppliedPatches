<?php

class Philwinkle_AppliedPatches_Model_Patches extends Mage_Core_Model_Abstract
{
	public $appliedPatches = array();
	private $patchFile;

	protected function _construct()
	{
		$this->patchFile = Mage::getBaseDir('etc') . DS . 'applied.patches.list';
		$this->_loadPatchFile();
	}

	public function getPatches()
	{
		return implode(', ',$this->appliedPatches);
	}

	protected function _loadPatchFile()
	{
		$ioAdapter = new Varien_Io_File();

		if (!$ioAdapter->fileExists($this->patchFile)) {
		    return;
		}

		$ioAdapter->open(array('path' => $ioAdapter->dirname($this->patchFile)));
		$ioAdapter->streamOpen($this->patchFile, 'r');

		while ($buffer = $ioAdapter->streamRead()) {
		    if(stristr($buffer,'|') && stristr($buffer,'SUPEE')){
		    	list($date, $patch) = array_map('trim', explode('|', $buffer));
		    	$this->appliedPatches[] = $patch;
		    }
		}
		$ioAdapter->streamClose();
	}
}