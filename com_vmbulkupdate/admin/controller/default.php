<?php
/**
 * @author net+ - netplus.jp
 * @date: 12.11.12
 *
 * @copyright  Copyright (C) 2008 - 2012 netplus.jp . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

class DefaultController extends JController {

    /**
     * Display the view
     */
    function getCombodata() {
        $db = JFactory::getDBO();
        $query = "SELECT virtuemart_product_id,product_name FROM `#__virtuemart_products_" . VMLANG;
        $db->setQuery($query);
        $customFileds = $db->loadObjectList();
        echo '<select name="cmb">';
        foreach ($customFileds as $customFiled):
            ?>
            <option value="<?php echo $customFiled->virtuemart_product_id; ?>"><?php echo $customFiled->product_name; ?></option>
            <?php
        endforeach;
        echo '</select>';
    }

    function suggesstionCat() {
        $post = JRequest::get('post');
        $keyword = $post['keyword'];
        $model = JModel::getinstance('default', 'defaultModel');
        $catlist = $model->sgetCategorylist('prodcat', $keyword);
        print($catlist);
    }

    function catname() {
        $db = JFactory::getDBO();
        $post = JRequest::get('post');
        $query = "select category_name from #__virtuemart_categories_" . VMLANG . " where virtuemart_category_id=" . $post['catid'];
        $db->setQuery($query);
        $catname = $db->loadObjectList();
        $catname = $catname[0]->category_name;
        echo $catname;
    }

    function getCustomBox() {
        $post = JRequest::get('post');
        $db = JFactory::getDBO();
        $query = "select custom_title,custom_tip,	custom_value,custom_field_desc,	field_type,is_cart_attribute from #__virtuemart_customs where virtuemart_custom_id=" . $post['customid'];
        $db->setQuery($query);
        $customs = $db->loadObjectList();
        $customs = $customs[0];
        echo $customs->custom_title . ',' . $customs->custom_tip . ',' . $customs->custom_value . ',' . $customs->custom_field_desc . ',' . $customs->field_type . ',' . $customs->is_cart_attribute;
    }

    function display() {
        $document = & JFactory::getDocument();
        $view = JRequest::getVar('view', 'default');
        switch ($view) {
            case 'products':
                $viewName = 'products';
                break;

            default:
                $viewName = 'default';
                break;
        }
        $viewType = $document->getType();
        $view = &$this->getView($viewName, $viewType);
        $view->display();
    }

    function getrelatedcategories() {
        require_once(JPATH_COMPONENT_ADMINISTRATOR . DS . 'templates/products.html.php');
        $post = JRequest::get('post');
        $db = JFactory::getDBO();
        if ($post['cname']):

            $query = "SELECT cat.virtuemart_category_id,cat.category_name as file_title, media.file_url, media.file_url_thumb FROM #__virtuemart_medias AS media INNER JOIN (#__virtuemart_category_medias AS vmprod inner join #__virtuemart_categories_" . VMLANG . " as cat on vmprod.virtuemart_category_id = cat.virtuemart_category_id) ON media.`virtuemart_media_id` = vmprod.virtuemart_media_id WHERE cat.category_name LIKE '%" . $post['cname'] . "%'";

            $db->setQuery($query);
            $relcat = $db->loadObjectList();
            $producthtml = new CLProductHTML();
            $producthtml->getrelatedcategories($relcat);
        endif;
    }

    function getrelatedproducts() {
        require_once(JPATH_COMPONENT_ADMINISTRATOR . DS . 'templates/products.html.php');
        $post = JRequest::get('post');
        $db = JFactory::getDBO();
        if ($post['cname']):
            $query = "SELECT vmprod.virtuemart_product_id,media.file_title, media.file_url, media.file_url_thumb FROM #__virtuemart_medias AS media INNER JOIN #__virtuemart_product_medias AS vmprod ON media.`virtuemart_media_id` = vmprod.virtuemart_media_id WHERE media.file_title LIKE '%" . $post['cname'] . "%'";
            $db->setQuery($query);
            $relcat = $db->loadObjectList();
            $producthtml = new CLProductHTML();
            $producthtml->getrelatedproducts($relcat);
        endif;
    }

    function fetchItems() {
        require_once(JPATH_COMPONENT_ADMINISTRATOR . DS . 'templates/products.html.php');
        $producthtml = new CLProductHTML();
        $document = & JFactory::getDocument();
        $post = JRequest::get('post');
        $catids = $post['cids'];

        if ($catids):
            $catids = substr($catids, 1);
            $query = "SELECT DISTINCT prod.virtuemart_product_id, prod.*,price.product_price,prodsku.product_sku,prodsku.published,curr.currency_symbol  FROM `#__virtuemart_product_categories` AS prodcat INNER JOIN ((#__virtuemart_products_" . VMLANG . " AS prod inner join #__virtuemart_products as prodsku on prod.virtuemart_product_id=prodsku.virtuemart_product_id)  inner join (#__virtuemart_product_prices as price inner join #__virtuemart_currencies as curr on price.product_currency = curr.virtuemart_currency_id) on prod.virtuemart_product_id=price.virtuemart_product_id) ON prodcat.`virtuemart_product_id` = prod.virtuemart_product_id WHERE prodcat.`virtuemart_category_id` in (" . $catids . "); ";
            //  print($query); exit;  
            $db = JFactory::getDBO();
            $db->setQuery($query);
            $products = $db->loadObjectList();
            $producthtml->producthtml($products);
        endif;
    }

    function pubcategory() {
        $post = JRequest::get('post');
        $pid = $post['pid'];
        $pubcat = $post['pubcat'];
        $db = JFactory::getDBO();
        $query = "update #__virtuemart_products set published=";
    }

    function productCategorySave($prodid, $post, $db) {
        $order = 0;
        $cateselectsarray = $post['selectedcatidsarray'];
        $cateselects = substr($cateselectsarray, 9);

        $cateselects = explode(',', $cateselects);
        if (count($cateselects) > 1) {
            $query = "delete from #__virtuemart_product_categories where virtuemart_product_id=" . $prodid;
//	print($query ); 
            $db->setQuery($query);
            $db->query();
            foreach ($cateselects as $cateselect):
                $order++;
                if ($cateselect) {
                    $query = "insert into #__virtuemart_product_categories set virtuemart_product_id=" . $prodid . ",
	                                                              virtuemart_category_id=" . $cateselect . ",
																  ordering=" . $order;
                    $db->setQuery($query);
                    $db->query();
                }

            endforeach;
        }
    }

    function saveproducts() {

        $post = JRequest::get('post');
        $prods = $post['prod'];
        $fgcprices = $post['fgcprices'];

        $prods = explode(',', $prods);
        $fgcprices = explode(',', $fgcprices);

        $db = JFactory::getDBO();
        $i = 0;
        foreach ($prods as $prod):
            $post['proprices'] = $fgcprices[$i];
            $this->product_publish($prod, $post, $db);
            $this->productCategorySave($prod, $post, $db);
            $this->productprice($prod, $post, $db);
            $this->productstatus($prod, $post, $db);
            $this->productdimension($prod, $post, $db);
            $this->productpricerules($prod, $post, $db);
            $this->customidarray($prod, $post, $db);
            $i = $i + 1;
        endforeach;
    }

    function customidarray($prod, $post, $db) {
        $customidarray = $post['customidarray'];
        $customvaluearray = $post['customvaluearray'];
        $pricearray = $post['pricearray'];
        $relcatarray = $post['relcat'];
        $relcategoryarray1 = $post['relprod'];

        $customids = substr($customidarray, 9);
        $customvalue = substr($customvaluearray, 9);
        $price = substr($pricearray, 9);
        $relcat = substr($relcatarray, 9);
        $relcat1 = substr($relcategoryarray1, 9);


        $customids = explode(',', $customids);
        $customvalue = explode(',', $customvalue);
        $price = explode(',', $price);
        $relcat = explode(',', $relcat);
        $relcat1 = explode(',', $relcat1);
        /*
         * Khong cho xoa cac customerfield da co
         *
          $query = "delete from #__virtuemart_product_customfields where virtuemart_product_id=" . $prod;
          $db->setQuery($query);
          $db->query();
          /*
         * 
         */
        $i = 0;
//	  print_r($relcat); exit;
        foreach ($relcat1 as $relatedcat1):
            if ($relatedcat1) {
                $query = "insert into #__virtuemart_product_customfields set virtuemart_product_id=" . $prod . ",virtuemart_custom_id=2,custom_value='" . $relatedcat1 . "'";
                $db->setQuery($query);
                $db->query();
            }
        endforeach;

        foreach ($relcat as $relatedcat):
            if ($relatedcat) {
                $query = "insert into #__virtuemart_product_customfields set virtuemart_product_id=" . $prod . ",virtuemart_custom_id=1,custom_value='" . $relatedcat . "'";
                //	   print($query); exit;
                $db->setQuery($query);
                $db->query();
            }
        endforeach;

        foreach ($customids as $customid):
            $p = '';
            if ($customid) {
                $newprice = explode('_', $price[$i]);
                if ($newprice[0] == $customid) {
                    if ($newprice[1])
                        $p = $newprice[1];
                    else
                        $p = '';
                }
                $query = "insert into #__virtuemart_product_customfields set virtuemart_product_id=" . $prod . " , virtuemart_custom_id=" . $customid . ",custom_value='" . $customvalue[$i] . "',custom_price='" . $p . "'";

                $db->setQuery($query);
                $db->query();
            }
            $i++;
        endforeach;
    }

    function productpricerules($prod, $post, $db) {
        $query = "update #__virtuemart_product_prices set product_override_price=" . $post['fprice'] . ",product_discount_id=" . $post['discount'] . ",override=1,product_tax_id=" . $post['tax'] . " where virtuemart_product_id=" . $prod;

        $db->setQuery($query);
        $db->query();
    }

    function productdimension($prod, $post, $db) {


//    print_r($post); exit;
        $query = "update #__virtuemart_products set ";

        if ($post['prodweight'] != '')
            $query .= "product_weight=" . $post['prodweight'] . ",";

        if ($post['prodlength'] != '')
            $query .= "product_length=" . $post['prodlength'] . ",";

        if ($post['prodwidth'] != '')
            $query .= "product_width=" . $post['prodwidth'] . ",";

        if ($post['prodheight'] != '')
            $query .= "product_height=" . $post['prodheight'] . ",";

        if ($post['produnit'] != '')
            $query .= "product_unit='" . $post['produnit'] . "',";

        if ($post['prodweightunit'] != '')
            $query .= "product_weight_uom='" . $post['prodweightunit'] . "',";

        if ($post['prodlengthunit'] != '')
            $query .= "product_lwh_uom='" . $post['prodlengthunit'] . "',";

        if ($post['prodpackaging'] != '')
            $query .= "product_packaging=" . $post['prodpackaging'] . ",";

        $query1 = substr($query, 0, -1);

        $query1 .= " where virtuemart_product_id =" . $prod;


        $db->setQuery($query1);
        $db->query();
    }

    function productstatus($prod, $post, $db) {
        if ($post['pstock'] != '' || $post['availabledate'] != '' || $post['pavailable'] != '') {
            $param = 'min_order_level="' . $post["pminpurchacequantity"] . '"|max_order_level="' . $post["pmaxpurchacequantity"] . '"';
            $query = "update #__virtuemart_products set ";
            if ($post['pstock'])
                $query .= "product_in_stock=" . $post['pstock'] . ",";

            if ($post['orderprod'])
                $query .= "product_ordered=" . $post['orderprod'] . ",";

            if ($post['availabledate'])
                $query .= "product_available_date='" . $post['availabledate'] . "',";

            if ($post['low_stock_notification'])
                $query .= "low_stock_notification='" . $post['low_stock_notification'] . "',";

            if ($param)
                $query .= "product_params='" . $param . "',";

            if ($post['pavailable'])
                $query .= "product_availability='" . $pavailable . "',";


            $query1 = substr($query, 0, -1);
            $query1 .= " where virtuemart_product_id=" . $prod;


            $db->setQuery($query1);
            $db->query();
        }
    }

    function productprice($prod, $post, $db) {
        $price = $post['productprice'];
        $currency = $post['currency'];
        /*
         * Trong Thang
         */
        $proprices = $post['proprices'];
        if ($currency != '') {
            if ($price != "") {
                $query = "update #__virtuemart_product_prices set product_price=" . $price . ",
		                                                  product_currency=" . $currency . " where virtuemart_product_id=" . $prod;
            } else if ($proprices != '') {
                $query = "update #__virtuemart_product_prices set product_price=" . $proprices . ",
		                                                  product_currency=" . $currency . " where virtuemart_product_id=" . $prod;
            }
        } else if ($proprices != '') {
            $query = "update #__virtuemart_product_prices set product_price=" . $proprices . " where virtuemart_product_id=" . $prod;
        }
        if ($query) {
            $db->setQuery($query);
            $db->query();
        }
        /*
         * End
         */
    }

    function product_publish($prod, $post, $db) {
        $query = "update #__virtuemart_products set published=" . $post['publish'] . " where virtuemart_product_id=" . $prod;
//	print($query);
        $db->setQuery($query);
        $db->query();
    }

    function productpricechange() {
        $prod = $_REQUEST['prod'];
        $price = $_REQUEST['price'];
        $db = JFactory::getDbo();
        if ($price != '' && $prod != '') {
            $query = "update #__virtuemart_product_prices set product_price=" . $price . " where virtuemart_product_id=" . $prod;
            $db->setQuery($query);
            if ($db->query()) {
                echo "true";
            } else {
                echo "flase";
            }
        }
    }

}
?>