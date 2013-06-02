<?php
/**
 * @author net+ - netplus.jp
 * @date: 12.11.12
 *
 * @copyright  Copyright (C) 2008 - 2012 netplus.jp . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');
$doc = JFactory::getDocument();


$csspath = JURI::base() . 'components/com_vmbulkupdate/css/';
$jspath = JURI::root() . 'administrator/components/com_vmbulkupdate/js/';
$doc->addScript($jspath . 'jquery-1.4.4.min.js');
$jspath = JURI::root() . 'administrator/components/com_vmbulkupdate/views/default/js/';
$doc->addScript($jspath . 'jquery.tablesorter.js');
$doc->addStyleSheet($jspath . 'style.css');
$jspath = JURI::root() . 'administrator/components/com_vmbulkupdate/js/';
$doc->addScript($jspath . 'vmbulkupdate.js');
$doc->addStyleSheet($csspath . 'test.css');
$front = JURI::root(true) . '/components/com_virtuemart/assets/';
$admin = JURI::base() . 'components/com_virtuemart/assets/';


//loading defaut admin CSS
$doc->addStyleSheet($admin . 'css/admin_ui.css');
$doc->addStyleSheet($admin . 'css/admin_menu.css');
$doc->addStyleSheet($admin . 'css/admin.styles.css');
$doc->addStyleSheet($admin . 'css/toolbar_images.css');
$doc->addStyleSheet($admin . 'css/menu_images.css');
$doc->addStyleSheet($front . 'css/chosen.css');
$doc->addStyleSheet($front . 'css/vtip.css');
$doc->addStyleSheet($front . 'js/fancybox/jquery.fancybox-1.3.4.css');
?>
<script type="text/javascript">
    setdomain('<?php echo JURI::root(); ?>');
</script>

<form name="adminForm" id="adminForm">
    <div class="field_wrapper">
        <div id="overall_heading" class="acc_header">
            <span>
                <div class="bg">
                    <legend><?php echo JText::_('COM_VMBULKUPDATE_PRODUCT_SELECT'); ?></legend>
                </div>
            </span>
        </div>

        <div class="indent" style="display:block;position:relative;">

            <div class="toolbar-list" id="toolbar" style="position:absolute;top:-48px;right:0;">
                <ul>
                    <li class="button" id="toolbar-apply">
                        <a href="#message" onclick="bulksave();" class="toolbar">
                            <span class="icon-32-apply">
                            </span>
                            <?php echo JText::_('COM_VMBULKUPDATE_SAVE'); ?>
                        </a>
                    </li>
                    <li class="button" id="toolbar-cancel">
                        <a href="#message" onclick="deselectallcat();reset_button();" class="toolbar">
                            <span class="icon-32-cancel">
                            </span>
                            <?php echo JText::_('COM_VMBULKUPDATE_CANCEL'); ?>
                        </a>
                    </li>
                </ul>
            </div>

            <div id="message" style="display:none;color:#FF0000; font-size:14px; font-weight:bold;"  align="center"></div>
            <div id="messageproccess" style="display:none;"><?php echo JText::_('COM_VMBULKUPDATE_PROCCESS') ?></div>
            <div id="messagesuccess" style="display:none;"><?php echo JText::_('COM_VMBULKUPDATE_SUCCESS') ?></div>
            <div id="messageselectproduct" style="display:none;"><?php echo JText::_('COM_VMBULKUPDATE_SELECT_PRODUCT') ?></div>
            <div id="messageSelectcate" style="display:none;"><?php echo JText::_('COM_VMBULKUPDATE_SELECT_CAT') ?></div>
            <div class="select_wrapper" style="width:16%;float:left;">
                <div>
                    <button type="button" class="action_button" onclick="selectallcat();" style="margin-right:5px;"><?php echo JText::_('COM_VMBULKUPDATE_ALL'); ?></button>
                    <button type="button" class="action_button" onclick="deselectallcat();"><?php echo JText::_('COM_VMBULKUPDATE_CLEAR'); ?></button>
                </div>
                <div><?php echo JText::_('COM_VMBULKUPDATE_CATEGORIES'); ?></div>
                <div  id="cattable"> <?php echo $this->catlist; ?> </div>
                <div><button type="button" class="action_button" id="loaddatatable" style="margin-top:10px;"><?php echo JText::_('COM_VMBULKUPDATE_LOADITEMS'); ?></button></div>
                <br />
            </div>

            <div id="showproduct" style="width:82%;float:left;"> <button type="button" class="action_button" onClick="selectCheckAll('products')"><?php echo JText::_('COM_VMBULKUPDATE_CKECKALL'); ?></button><button type="button" class="action_button" onClick="clearCheckAll('products')"><?php echo JText::_('COM_VMBULKUPDATE_CLEAR'); ?></button>
                <div style="height:350px;overflow:auto;margin-bottom:10px;">
                    <table id="myTable" class="tablesorter" cellspacing="1" width="100%">
                        <thead>
                            <tr bgcolor="#999999">
                                <th  class="header"><?php echo JText::_('COM_VMBULKUPDATE_PRODUCTNAME'); ?></th>
                                <th  class="header"><?php echo JText::_('COM_VMBULKUPDATE_SKU'); ?></th>
                                <th class="header"><?php echo JText::_('COM_VMBULKUPDATE_PRODUCRCATE'); ?></th>
                                <th class="header"><?php echo JText::_('COM_VMBULKUPDATE_PUBLISH'); ?></th>
                                <th class="header"><?php echo JText::_('COM_VMBULKUPDATE_PRICE'); ?></th>
                                <th class="header">#</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <?php echo $this->loadTemplate('categerypublish'); ?>
        <?php echo $this->loadTemplate('productpricing'); ?>
        <?php echo $this->loadTemplate('pricingrules'); ?>
        <?php echo $this->loadTemplate('productstatus'); ?>
        <?php echo $this->loadTemplate('customfields'); ?>
        <?php echo $this->loadTemplate('dimensionweight'); ?>
    </div>
</div>
</form>
<div class="toolbar-list" id="toolbar">
    <ul>
        <li class="button" id="toolbar-apply">
            <a href="#message" onclick="bulksave();" class="toolbar">
                <span class="icon-32-apply">
                </span>
                <?php echo JText::_('COM_VMBULKUPDATE_SAVE'); ?>
            </a>
        </li>
        <li class="button" id="toolbar-cancel">
            <a href="#message" onclick="deselectallcat();reset_button();" class="toolbar">
                <span class="icon-32-cancel">
                </span>
                <?php echo JText::_('COM_VMBULKUPDATE_CANCEL'); ?>
            </a>
        </li>
    </ul>
</div>
