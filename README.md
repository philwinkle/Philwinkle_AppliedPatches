# Philwinkle_AppliedPatches
See a list of all applied patches from within the Magento admin panel

Installation
--

Install using modman or copy files to your Magento installation. No configuration needed - as soon as the module is installed you will immediately see the list of patches in your Magento version:

<img src="http://i.imgur.com/LgbZFeh.png"/>

Requirements
--

This module utilizes the `applied.patches.list` file to aggregate a list of applied patches. If you do not retain this file or commit to source control, or the file is not readable by the web server user, then nothing will display.
