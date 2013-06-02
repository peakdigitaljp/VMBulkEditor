<?php
/**
 * @author net+ - netplus.jp
 * @date: 12.11.12
 *
 * @copyright  Copyright (C) 2008 - 2012 netplus.jp . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

if (!class_exists( 'VmConfig' )) require JPATH_ADMINISTRATOR.'/components/com_virtuemart/helpers/config.php';
VmConfig::loadConfig();

jimport('joomla.application.component.helper');
$view = JRequest::getVar('view','default');
require_once(JPATH_COMPONENT.DS.'controller'.DS.$view.'.php');
$ControllerClass = ucfirst($view).'Controller';

//print_r($ControllerClass); exit;
$controller = new $ControllerClass;
$controller->execute(JRequest::getVar('task')); 					//, null, 'default', 'cmd'));
$controller->redirect();