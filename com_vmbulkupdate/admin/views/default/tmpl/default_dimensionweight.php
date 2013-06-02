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
<div id="dimensionweight_heading" class="acc_header">
    <span>
        <div class="bg">
            <legend><?php echo JText::_('COM_VMBULKUPDATE_DIMENSION_WEIGHT'); ?><input type="checkbox" name="dimensionweight_adjustval" onclick="dimensionweight_adjust(this);" /></legend>
        </div>
    </span>
</div>

<div id="dimensionweight" class="indent">
    <fieldset>
        <table width="100%" border="0" id="dimensionweighttable">
            <tr>
                <td  width="21%" ><div style="text-align:right;font-weight:bold;">
                        <?php echo JText::_('COM_VMBULKUPDATE_PRODUCT_LENGHT') ?></div>
                </td>
                <td width="79%">
                    <fieldset class="radio">
                        <input type="text" name="prodlength" value="" />
                        <select size="1" name="product_lwh_uom" id="product_lwh_uom" class="inputbox chzn-done">
                            <option selected="selected" value="M"><?php echo JText::_('COM_VMBULKUPDATE_METERS'); ?></option>
                            <option value="CM"><?php echo JText::_('COM_VMBULKUPDATE_CM'); ?></option>
                            <option value="MM"><?php echo JText::_('COM_VMBULKUPDATE_MM'); ?></option>
                            <option value="YD"><?php echo JText::_('COM_VMBULKUPDATE_YARDS'); ?></option>
                            <option value="FT"><?php echo JText::_('COM_VMBULKUPDATE_FOOT'); ?></option>
                            <option value="IN"><?php echo JText::_('COM_VMBULKUPDATE_INCHES'); ?></option>
                        </select>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <td  width="21%" ><div style="text-align:right;font-weight:bold;">
                        <?php echo JText::_('COM_VMBULKUPDATE_PRODUCT_WIDTH') ?></div>
                </td>
                <td width="79%">
                    <fieldset class="radio">
                        <input type="text" name="prodwidth" value="" />
                    </fieldset>
                </td>
            </tr>

            <tr>
                <td  width="21%" ><div style="text-align:right;font-weight:bold;">
                        <?php echo JText::_('COM_VMBULKUPDATE_PRODUCT_HEIGHT') ?></div>
                </td>
                <td width="79%">
                    <fieldset class="radio">
                        <input type="text" name="prodheight" value="" />
                    </fieldset>
                </td>
            </tr>

            <tr>
                <td  width="21%" ><div style="text-align:right;font-weight:bold;">
                        <?php echo JText::_('COM_VMBULKUPDATE_PRODUCT_WEIGHT') ?></div>
                </td>
                <td width="79%">
                    <fieldset class="radio">
                        <input type="text" name="prodweight" value="" />
                        <select name="product_weight_uom" id="product_weight_uom" class="chzn-done">
                            <option selected="selected" value="KG"><?php echo JText::_('COM_VMBULKUPDATE_KG'); ?></option>
                            <option value="GR"><?php echo JText::_('COM_VMBULKUPDATE_G'); ?></option>
                            <option value="MG"><?php echo JText::_('COM_VMBULKUPDATE_MG'); ?></option>
                            <option value="LB"><?php echo JText::_('COM_VMBULKUPDATE_POUDS'); ?></option>
                            <option value="OZ"><?php echo JText::_('COM_VMBULKUPDATE_OUNCE'); ?></option>
                        </select>
                    </fieldset>
                </td>
            </tr>

            <tr>
                <td  width="21%" ><div style="text-align:right;font-weight:bold;">
                        <?php echo JText::_('COM_VMBULKUPDATE_PRODUCT_UNIT') ?></div>
                </td>
                <td width="79%">
                    <fieldset class="radio">
                        <input type="text" name="produnit" value="" />
                    </fieldset>
                </td>
            </tr>
            <tr>
                <td  width="21%" ><div style="text-align:right;font-weight:bold;">
                        <?php echo JText::_('COM_VMBULKUPDATE_PRODUCT_PACK') ?></div>
                </td>
                <td width="79%">
                    <fieldset class="radio">
                        <input type="text" name="prodpackaging" value="" />
                    </fieldset>
                </td>
            </tr>		
            <tr>
                <td  width="21%" ><div style="text-align:right;font-weight:bold;">
                        <?php echo JText::_('COM_VMBULKUPDATE_UNIT_BOX') ?></div>
                </td>
                <td width="79%">
                    <fieldset class="radio">
                        <input type="text" name="unitsbox" value="" />
                    </fieldset>
                </td>
            </tr>								
        </table>
    </fieldset>	   
</div>