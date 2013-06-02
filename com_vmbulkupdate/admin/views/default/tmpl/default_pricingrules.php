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
<div id="pricingrules_heading" class="acc_header">
    <span>
        <div class="bg">
            <legend><?php echo JText::_('COM_VMBULKUPDATE_PRICE_RULE_OVERRIDE'); ?><input type="checkbox" name="pricingrule_adjustval" onclick="pricingrule_adjust(this);" /></legend></legend>
        </div>
    </span>
</div>

<div id="pricingrules" class="indent">
    <fieldset>
        <table width="100%" border="0" id="pricingruletable">
            <tr>
                <td  width="21%" ><div style="text-align:right;font-weight:bold;">
                        <?php echo JText::_('COM_VMBULKUPDATE_TAX') ?></div>
                </td>
                <td width="79%">
                    <fieldset class="radio">
                        <select name="tax" id="tax">
                            <option value="0"><?php echo JText::_('COM_VMBULKUPDATE_APPLY_RULE'); ?></option>
                            <?php foreach ($this->tax as $tax): ?>
                                <option value="<?php echo $tax->virtuemart_calc_id; ?>"><?php echo $tax->calc_name; ?></option>
                            <?php endforeach; ?>
                        </select>

                    </fieldset>
                </td>
            </tr>
            <tr>
                <td  width="21%" ><div style="text-align:right;font-weight:bold;">
                        <?php echo JText::_('COM_VMBULKUPDATE_DISCOUNT_TYPE') ?></div>
                </td>
                <td width="79%">
                    <fieldset class="radio">
                        <select name="discount" id="discount" class="chzn-done">
                            <option value="-1"><?php echo JText::_('COM_VMBULKUPDATE_APPLY_RULE'); ?></option>
                            <option value="0"><?php echo JText::_('COM_VMBULKUPDATE_APPLY_GANERIC_RULE'); ?></option>
                            <option value="2"><?php echo JText::_('COM_VMBULKUPDATE_DISCOUNT_HAND_TOOL'); ?></option>
                        </select>
                    </fieldset>
                </td>
            </tr>

            <tr>
                <td  width="21%" ><div style="text-align:right;font-weight:bold;">
                        <?php echo JText::_('COM_VMBULKUPDATE_DISCOUNT_PRICE') ?></div>
                </td>
                <td width="79%">
                    <fieldset class="radio">
                        <input type="text" name="fprice" id="fprice" value="0.00000" />
                    </fieldset>
                </td>
            </tr>


        </table>
    </fieldset>	   
</div>