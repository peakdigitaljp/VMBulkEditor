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
<div id="productpricing_heading" class="acc_header">
    <span>
        <div class="bg">
            <legend><?php echo JText::_('COM_VMBULKUPDATE_PRODUCT_PRICING'); ?><input type="checkbox" name="productpricing_adjustval" onclick="productpricing_adjust(this);" /></legend>
        </div>
    </span>
</div>
<div id="productpricing" class="indent">
    <fieldset>
        <table width="100%" border="0" id="productpricetable">
            <tr>
                <td  width="21%" ><div style="text-align:right;font-weight:bold;">
                        <?php echo JText::_('COM_VMBULKUPDATE_COST_PRICE') ?></div>
                </td>
                <td width="79%">
                    <fieldset class="radio">
                        <input type="text" name="productprice" />
                        <select name="currency" id="currency">
                            <?php
                            foreach ($this->currencies as $currency):
                                ?><option value="<?php echo $currency->virtuemart_currency_id; ?>" <?php if ($this->vendorCurrency == $currency->virtuemart_currency_id)
                                echo 'selected'; ?>><?php echo $currency->currency_name; ?></option><?php
                        endforeach;
                            ?>

                        </select>

                    </fieldset>
                </td>
            </tr>				
        </table>
    </fieldset>	   
</div>