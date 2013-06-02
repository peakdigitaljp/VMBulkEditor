<?php
/**
 * @author net+ - netplus.jp
 * @date: 12.11.12
 *
 * @copyright  Copyright (C) 2008 - 2012 netplus.jp . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');
?>
<div id="customfield_heading" class="acc_header">
<span>
<div class="bg">
<legend><?php echo JText::_('COM_VMBULKUPDATE_RELATE_CUSTOM_FIELD') ?><input type="checkbox" name="customfields_adjustval" onclick="customfields_adjust(this);" /></legend>
</div>
</span>
</div>
<div id="customfield" class="indent">
  <fieldset>
  <div id="customfieldstable">
    <fieldset>
    <legend><?php echo JText::_('COM_VMBULKUPDATE_RELATE_CATE') ?>  </legend>
    <?php echo JText::_('COM_VMBULKUPDATE_SEARCH_RELATE_CAT') ?>
    <div style="width: auto;" >
      <input type="text" value=""  onblur="closerelcat()" onkeyup="relatedcategoriesSearch(this);" id="relcat" name="rel_category" />
    </div>
    <div style="clear:both; height:0;"> </div>
    <div id="vm_image_cat" style="padding:16px;background:#FFFFFF;border:2px solid #2266AA; margin-top:0px; display:none; float:left; width:900px;z-index:100; position:absolute;"> </div>
    <div id="custom_categories_cat"></div>
    </fieldset>
    <fieldset>
    <legend><?php echo JText::_('COM_VMBULKUPDATE_RELATE_PRODUCT') ?> </legend>
    <?php echo JText::_('COM_VMBULKUPDATE_EARCH_RELATE_PRODUCT') ?>
    <div style="width: auto;" >
      <input type="text" value="" onblur="closerelprod()" onkeyup="relatedproductSearch(this);" id="relprod" name="rel_category" />
    </div>
    <div style="clear:both; height:0;"> </div>
    <div id="vm_image" style="padding:16px;background:#FFFFFF;border:2px solid #2266AA; margin-top:0px; display:none; float:left; width:900px;z-index:100; position:absolute;"> </div>
    <div id="custom_categories"></div>
    </fieldset>
    <fieldset>
    <legend><?php echo JText::_('COM_VMBULKUPDATE_CUSTOM_FIELD_TYPE') ?></legend>
    <select name="custom_fieldbox" class="custom_box">
	  <option value="0"><?php echo JText::_('COM_VMBULKUPDATE_SELECT_CUSTOM_FIELD_TYPE') ?></option>
      <?php
		   foreach($this->getCustomFields as $getCustomField):
		    ?>
      <option value="<?php echo $getCustomField->virtuemart_custom_id; ?>"><?php echo $getCustomField->custom_title; ?></option>
      <?php
		   endforeach;
		  ?>
    </select>
    <table cellspacing="0" cellpadding="0" class="adminlist" id="custom_fields">
      <thead>
        <tr class="row1">
          <th><?php echo JText::_('COM_VMBULKUPDATE_TITLE') ?></th>
          <th><?php echo JText::_('COM_VMBULKUPDATE_TOOLTIP') ?></th>
          <th><?php echo JText::_('COM_VMBULKUPDATE_VALUE') ?></th>
          <th><?php echo JText::_('COM_VMBULKUPDATE_PRICE') ?> </th>
          <th><?php echo JText::_('COM_VMBULKUPDATE_TYPE') ?></th>
          <!--						<th>Cart Attribute</th>-->
          <th><?php echo JText::_('COM_VMBULKUPDATE_DELETE') ?></th>
        </tr>
      </thead>
      <tbody id="custom_field" class="ui-sortable">
      </tbody>
    </table>
    </fieldset>
  </div>
  </fieldset>
</div>
