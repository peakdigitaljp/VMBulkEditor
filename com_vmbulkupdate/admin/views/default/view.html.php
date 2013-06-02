<?php
/**
 * @author net+ - netplus.jp
 * @date: 12.11.12
 *
 * @copyright  Copyright (C) 2008 - 2012 netplus.jp . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

jimport ( 'joomla.application.component.view' );

class defaultViewdefault extends JView
{
	function display($tpl = null)
	{
        $model = JModel::getinstance('default','defaultModel');
        JToolBarHelper::title( JText::_( 'Bulk Update' ),'' );

		$catlist = $model->sgetCategorylist('catname',$key = NULL);
		$prodcatlist = $model->sgetCategorylist('prodcat',$key = NULL);
		$prodcatlistInBox = $model->sgetCategorylist('prodcatinbox',$key = NULL);
		$tax = $model->tax();
		$currencies = $model->currencies();
		$vendorCurrency = $model->vendorcurrency();
		$getCustomFields = $model->getCustomFields();
		
		$this->assignRef('getCustomFields',$getCustomFields);		
		$this->assignRef('prodcatlist',$prodcatlist);
		$this->assignRef('prodcatlistInBox',$prodcatlistInBox);
		
		$this->assignRef('catlist',$catlist);
		$this->assignRef('currencies',$currencies);
		$this->assignRef('vendorCurrency',$vendorCurrency);		
		
		$this->assignRef('tax',$tax);
		
		parent::display($tpl);
		
	}
			
  

}
?>