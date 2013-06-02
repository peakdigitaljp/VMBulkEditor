<?php
/**
 * @author net+ - netplus.jp
 * @date: 12.11.12
 *
 * @copyright  Copyright (C) 2008 - 2012 netplus.jp . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');


class com_vmbulkupdateInstallerScript
{
    protected $extension = 'com_vmbulkupdate';

    function preflight( $type, $parent ) {
		$this->parent = $parent;
        $filename = JPATH_ADMINISTRATOR.'/components/com_virtuemart/helpers/config.php';
        if (!file_exists($filename)) {
            $this->loadLanguage();
            Jerror::raiseWarning(null, JText::sprintf('COM_VMBULKUPDATE_VM_NOT_INSTALLED'));
            return false;
        }
    }
	
	
	public function loadLanguage()
    {
        $extension = $this->extension;
        $jlang =& JFactory::getLanguage();
        $path = $this->parent->getParent()->getPath('source') . '/admin';
        $jlang->load($extension, $path, 'en-GB', true);
        $jlang->load($extension, $path, $jlang->getDefault(), true);
        $jlang->load($extension, $path, null, true);
        $jlang->load($extension . '.sys', $path, 'en-GB', true);
        $jlang->load($extension . '.sys', $path, $jlang->getDefault(), true);
        $jlang->load($extension . '.sys', $path, null, true);
    }

}