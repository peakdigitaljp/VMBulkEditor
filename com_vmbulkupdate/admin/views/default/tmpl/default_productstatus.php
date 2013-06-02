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
<div id="productstatus_heading" class="acc_header">
    <span>
        <div class="bg">
            <legend><?php echo JText::_('COM_VMBULKUPDATE_PRICE_RULE_OVERRIDE'); ?><input type="checkbox" name="productstatus_adjustval" onclick="productstatus_adjust(this);" /></legend>
        </div>
    </span>
</div>

<div id="productstatus" class="indent">
    <fieldset>
        <table id="productstatustable">
            <tr>
                <td  width="21%" ><div style="text-align:right;font-weight:bold;">
                        <?php echo JText::_('COM_VMBULKUPDATE_ST0CK') ?></div>
                </td>
                <td width="79%">
                    <fieldset class="radio">
                        <input type="text" name="pstock" value="" />
                    </fieldset>
                </td>
            </tr>
            <tr>
                <td  width="21%" ><div style="text-align:right;font-weight:bold;">
                        <?php echo JText::_('COM_VMBULKUPDATE_BOOK_ORDER_PRODUCT') ?></div>
                </td>
                <td width="79%">
                    <fieldset class="radio">
                        <input type="text" name="orderprod" value="" />
                    </fieldset>
                </td>
            </tr>
            <tr>
                <td  width="21%" ><div style="text-align:right;font-weight:bold;">
                        <?php echo JText::_('COM_VMBULKUPDATE_LOW_STOCK_NOTIFI') ?></div>
                </td>
                <td width="79%">
                    <fieldset class="radio">
                        <input type="text" name="low_stock_notification" value="" />
                    </fieldset>
                </td>
            </tr>				
            <tr>
                <td  width="21%" ><div style="text-align:right;font-weight:bold;">
                        <?php echo JText::_('COM_VMBULKUPDATE_MINIMUM_PURCHASE_QUATITY') ?></div>
                </td>
                <td width="79%">
                    <fieldset class="radio">
                        <input type="text" name="pminpurchacequantity" value="" />
                    </fieldset>
                </td>
            </tr>				
            <tr>
                <td  width="21%" ><div style="text-align:right;font-weight:bold;">
                        <?php echo JText::_('COM_VMBULKUPDATE_MAXIIMUM_PURCHASE_QUATITY') ?></div>
                </td>
                <td width="79%">
                    <fieldset class="radio">
                        <input type="text" name="pmaxpurchacequantity" value="" />
                    </fieldset>
                </td>
            </tr>				
            <tr>
                <td  width="21%" ><div style="text-align:right;font-weight:bold;">
                        <?php echo JText::_('COM_VMBULKUPDATE_DATE') ?></div>
                </td>
                <td width="79%">
                    <fieldset class="radio">
                        <?php JHTML::_('behavior.calendar'); ?>
                        <input class="inputbox" name="availabledate" type="text" id="availabledate" size="18" maxlength="20" value="" />
                        <img src="templates/bluestork/images/admin/publish_x.png" onclick="nodate();" />
                        <script type="text/javascript">
                            var startDate = new Date(2008, 8, 7);
                            Calendar.setup({
                                inputField : "availabledate",
                                ifFormat : "%Y-%m-%d %I:%M",
                                button : "availabledate",
                                range : [2011,2100],
                                date : startDate
                            });
                        </script>

                    </fieldset>
                </td>
            </tr>		
            <tr>
                <td  width="21%" ><div style="text-align:right;font-weight:bold;">
                        <?php echo JText::_('COM_VMBULKUPDATE_AVAILABILITY') ?></div>
                </td>
                <td width="79%"><input type="text" name="pavailable" value="" /> </td>
            </tr>
            <tr>
                <td>
                    <select name="availablepics" onchange="availablepic(this)">
                        <?php
                        if ($handle = opendir(JPATH_ROOT . DS . 'components/com_virtuemart/assets/images/availability/')) {
                            /* This is the correct way to loop over the directory. */
                            while (false !== ($entry = readdir($handle))) {
                                if ($entry == '.' || $entry == '..' || $entry == 'index.html')
                                    continue;
                                echo '<option value="' . $entry . '">' . $entry . '</option>';
                            }

                            closedir($handle);
                        }
                        ?>
                    </select><br />
                    <div id="showpic"></div>
                </td>
            </tr>


        </table>

    </fieldset>	   
</div>