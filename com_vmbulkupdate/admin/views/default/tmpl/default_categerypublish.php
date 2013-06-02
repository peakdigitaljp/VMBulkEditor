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
<div id="catnpub_heading" class="acc_header">
<span>
<div class="bg">
<legend><?php echo JText::_('COM_VMBULKUPDATE_CATEANDPUBLISH'); ?><input type="checkbox" name="catnpub_adjustval" id="catnpub_adjust" onclick="catpub_adjust(this);" />
</legend>
</div>
</span>
</div>
<div id="catnpub" class="indent">
<fieldset>
<div >
<table width="100%" border="0" id="catpubtable">
  <tr>
    <td  width="21%" ><div style="text-align:right;font-weight:bold;"> <?php echo JText::_('Publish') ?></div></td>
    <td width="79%"><fieldset class="radio"><p>
      <input type="radio" name="pub" onclick="addpubval(this.value);" id="pub" value="1" />
      <?php echo JText::_('COM_VMBULKUPDATE_YES'); ?> </p><p>
      <input type="radio" name="pub" onclick="addpubval(this.value);" id="pub" value="0" />
      <?php echo JText::_('COM_VMBULKUPDATE_NO'); ?>
      <input type="hidden" id="pubvalidate" value="" /></p>
      </fieldset></td>
  </tr>
  <tr>
    <td  width="21%" ><div style="text-align:right;font-weight:bold;"> <?php echo JText::_('COM_VMBULKUPDATE_PRODUCRCATE') ?></div></td>
	
    <td width="71%">
	
	<?php 
	// echo $this->catlist;
	?>
	
      <div id="categories_chzn" class="chzn-container chzn-container-multi" style="width: 198px;">
        <ul class="chzn-choices" id="catinbox">
           <?php echo $this->prodcatlistInBox; ?>  
          <li class="search-field">
            <input type="text" value="<?php echo JText::_('COM_VMBULKUPDATE_SELECT_OPTION') ?>" onblur="closescat();" id="cat_multiselects" onkeyup="suggestcat();" class="cat_multiselect"  onclick="showsuggestion(this.value);"/>
          </li>
        </ul>
        <div style="left: -9000px; width: 196px; top: 53px;" id="scat">
          <ul class="chzn-results" id="suggcat" style="padding:16px;background:#FFFFFF;border:2px solid #2266AA; margin-top:0px; display:none; float:left; width:160px;z-index:100; position:absolute;">
		    <?php echo $this->prodcatlist; ?>
          </ul>
        </div>
      </div>
	  <div id="catids"></div>
	  </td>
  </tr>
  
</table>
</div>
</fieldset>
</div>
