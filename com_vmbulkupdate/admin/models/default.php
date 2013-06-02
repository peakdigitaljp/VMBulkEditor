<?php
/**
 * @author net+ - netplus.jp
 * @date: 12.11.12
 *
 * @copyright  Copyright (C) 2008 - 2012 netplus.jp . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

class defaultModeldefault extends JModel {

    function currencies() {
        $db = JFactory::getDBO();
        $query = "select * from #__virtuemart_currencies ORDER BY currency_name ASC";
        $db->setQuery($query);
        $currencies = $db->loadObjectList();
        return $currencies;
    }

    function vendorcurrency() {
        $db = JFactory::getDBO();
        $query = "select vendor_currency,vendor_accepted_currencies  from #__virtuemart_vendors";
        $db->setQuery($query);
        $currency = $db->loadObjectList();
        $currency = $currency[0]->vendor_currency;
        return $currency;
    }

    function getCustomFields() {
        $db = JFactory::getDBO();
        $query = "SELECT * FROM #__virtuemart_customs WHERE `custom_parent_id` =0 AND virtuemart_custom_id NOT IN ( 1, 2 )";
        $db->setQuery($query);
        $customFileds = $db->loadObjectList();
        return $customFileds;
    }

    function sgetCategorylist($selectboxname, $keyword) {
        $db = JFactory::getDBO();
        $extraCondition = '';
        if ($keyword)
            $extraCondition = " and catname.category_name like '%" . $keyword . "%'";
        else
            $keyword = '';


        $query = "SELECT * FROM #__virtuemart_category_categories as con inner join #__virtuemart_categories_" . VMLANG . " as catname on con.category_child_id=catname.virtuemart_category_id where con.category_parent_id=0" . $extraCondition;
//print($query);
        $db->setQuery($query);
        $tree = "";     // Clear the directory <strong class="highlight">tree</strong>
        $depth = 1;     // Child level depth.
        $top_level_on = 1;   // What top-level category are we on?
        $exclude = array();   // Define the exclusion array
        array_push($exclude, 0); // Put a starting value <strong class="highlight">in</strong> it
        $cats = $db->loadObjectList();
        if ($selectboxname == 'catname')
            $tree .= '<select  style="width:130px; height:300px;" id="' . $selectboxname . '" name="' . $selectboxname . '[]" multiple="multiple">';

        foreach ($cats as $cat):
            /* while ( $nav_row = mysql_fetch_array($nav_query) )
              {
             */ $goOn = 1;   // Resets variable to allow us to continue building out the <strong class="highlight">tree</strong>.
            for ($x = 0; $x < count($exclude); $x++) {  // Check to see if the new item has been used
                if ($exclude[$x] == $cat->virtuemart_category_id) {
                    $goOn = 0;
                    break;    // Stop looking b/c we already found that it's <strong class="highlight">in</strong> the exclusion list and we can't continue to process this node
                }
            }

            if ($goOn == 1) {
                $func = "placecat('" . $cat->category_name . "','" . $cat->virtuemart_category_id . "')";
                if ($selectboxname == 'prodcat')
                    $tree .='<li class="chnz-active-result" id="' . $cat->virtuemart_category_id . '"><a href="javascript:void(0);" onclick="' . $func . '">' . $cat->category_name . '</a></li>';

                if ($selectboxname == 'prodcatinbox') {
                    $delcatselect = "delcatselect(" . $cat->virtuemart_category_id . ")";
                    $tree .='<li id="category_' . $cat->virtuemart_category_id . '" style="display:none;" class="search-choice"><span>' . $cat->category_name . '</span><a onclick="' . $delcatselect . '" href="javascript:void(0)" class="closebutton"></a></li>';
                }
                if ($selectboxname == 'catname')
                    $tree .= '<option value="' . $cat->virtuemart_category_id . '">' . $cat->category_name . '</option>';

                array_push($exclude, $cat->virtuemart_category_id);  // Add to the exclusion list
                if ($cat->virtuemart_category_id < 1) {
                    $top_level_on = $cat->virtuemart_category_id;
                }
                $tree .= $this->build_child($cat->virtuemart_category_id, $exclude, $depth, $selectboxname, $keyword);  // Start the recursive function of building the child <strong class="highlight">tree</strong>
            }
        endforeach;
        if ($selectboxname != 'prodcat')
            $tree .= '</select>';
        return $tree;
    }

    function build_child($oldID, $exclude, $depth, $selectboxname, $keyword) {   // Recursive function to get all of the children...unlimited depth
        $levels = '';
        $db = JFactory::getDBO();
        $tempTree = '';
        $extraCondition = '';
        if (!$exclude)
            $exclude = array();

        if ($keyword)
            $extraCondition = " and catname.category_name like '%" . $keyword . "%'";
        else
            $keyword = '';

        $query = "SELECT * FROM #__virtuemart_category_categories as con inner join #__virtuemart_categories_" . VMLANG . " as catname on con.category_child_id=catname.virtuemart_category_id WHERE con.category_parent_id =" . $oldID . $extraCondition;

        $db->setQuery($query);
        $childs = $db->loadObjectList();

        foreach ($childs as $child):
            if ($child->category_child_id != $child->category_parent_id) {

                for ($c = 1; $c < $depth; $c++) {   // Indent over so that there is distinction between levels
                    $tempTree .= "&nbsp;";
                    $levels .= "&nbsp;-";
                }
//				if($depth == 0)
                $func = "placecat('" . $child->category_name . "','" . $child->category_child_id . "')";

                if ($selectboxname == 'prodcat')
                    $tempTree .= '<li class="chnz-active-result" id="' . $child->category_child_id . '">&nbsp;<a href="javascript:void(0);" onclick="' . $func . '">' . $child->category_name . '</a></li>';

                if ($selectboxname == 'prodcatinbox') {
                    $delcatselect = "delcatselect(" . $child->category_child_id . ")";
                    $tempTree .= '<li id="category_' . $child->category_child_id . '" style="display:none;" class="search-choice"><span>&nbsp;' . $child->category_name . '</span><a href="javascript:void(0)" onclick="' . $delcatselect . '" class="closebutton"></a></li>';
                }

                if ($selectboxname == 'catname')
                    $tempTree .= '<option value="' . $child->category_child_id . '">&nbsp;' . $levels . ' ' . $child->category_name . '</option>';
                $depth++;  // Incriment depth b/c we're building this child's child <strong class="highlight">tree</strong>  (complicated yet???)
                $tempTree .= $this->build_child($child->virtuemart_category_id, $exclude, $depth, $selectboxname, $keyword);  // Add to the temporary local <strong class="highlight">tree</strong>
                $depth--;  // Decrement depth b/c we're done building the child's child <strong class="highlight">tree</strong>.
                array_push($exclude, $child->virtuemart_category_id);   // Add the item to the exclusion list
            }
        endforeach;
        return $tempTree;  // Return the entire child <strong class="highlight">tree</strong>
    }

    function tax() {
        $db = JFactory::getDBO();
        $query = "select * from #__virtuemart_calcs where published=1";
        $db->setQuery($query);
        $tax = $db->loadObjectList();
        return $tax;
    }

    function getcatid($keyword) {
        $db = JFactory::getDBO();
        $query = "select virtuemart_category_id from #__virtuemart_categories_" . VMLANG . " where category_name like '%" . $keyword . "%'";
        $db->setQuery($query);
        $catids = $db->loadObjectList();
        $catarray = '';
        foreach ($catids as $catid):
            $catarray .= $catid->virtuemart_category_id . ',';
        endforeach;
        echo $catarray;
    }

}

?>