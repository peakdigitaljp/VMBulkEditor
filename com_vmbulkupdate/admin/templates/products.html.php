<?php
/**
 * @author net+ - netplus.jp
 * @date: 12.11.12
 *
 * @copyright  Copyright (C) 2008 - 2012 netplus.jp . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

class CLProductHTML {

    function getrelatedproducts($prods) {
        ?> <?php
        foreach ($prods as $prod):
            ?>
            <a href="javascript:void('<?php echo $prod->virtuemart_product_id ?>')" onclick="getprodid('<?php echo $prod->file_title ?>','<?php echo $prod->virtuemart_product_id ?>','<?php echo $prod->file_url_thumb ?>');">
                <div class="vm_thumb_image">
                    <img src="<?php echo JURI::root() . $prod->file_url_thumb; ?>" border="0" />
                    <?php echo $prod->file_title; ?><?php echo $prod->virtuemart_product_id ?>
                </div>
            </a>
        <?php endforeach; ?>
        <input type="hidden" id="fileurl" value="" />
        <input type="hidden" id="prodid" value="" />
        <?php
    }

    function getrelatedcategories($prods) {
        foreach ($prods as $prod):
            ?>  
            <a href="javascript:void(0);" onclick="getcatid('<?php echo $prod->file_title ?>','<?php echo $prod->virtuemart_category_id ?>','<?php echo $prod->file_url_thumb ?>');">                
                <div class="vm_thumb_image_cat">
                    <img src="<?php echo JURI::root() . $prod->file_url_thumb; ?>" border="0" />
                    <?php echo $prod->file_title; ?>
                </div>
            </a>
        <?php endforeach; ?>
        <input type="hidden" id="fileurl" value="" />
        <input type="hidden" id="prodid" value="" />
        <?php
    }

    function producthtml($prods) {
        $post = JRequest::get('post');
        foreach ($prods as $prod):
            $k = '100';
            $img = '';
            if ($prod->published) {
                $src = 'tick.png';
            } else {
                $src = 'publish_x.png';
            }
            $fullsrc = JURI::root() . 'administrator/templates/bluestork/images/admin/' . $src;
            if (!class_exists('CurrencyDisplay'))
                require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'currencydisplay.php');
            $currency = CurrencyDisplay::getInstance();
            ?>
            <tr>
                <td><?php echo $prod->product_name; ?></td>
                <td align="center"><?php echo $prod->product_sku; ?></td>
                <td align="center"><?php echo $this->getProductCategory($prod->virtuemart_product_id); ?></td>
                <td align="center"><span style="display:none;"><?php echo $prod->published; ?></span><img src="<?php echo $fullsrc; ?>" border="0" /></td>
                <td class="center">
                    <?php echo $prod->currency_symbol; ?><span class="pricehidden" style="display: none;"> <?php echo number_format($prod->product_price, 2, '.', ','); ?></span>
                    <input id="fgcprices" name="fgcprices" class="fgcPrice" productid="<?php echo $prod->virtuemart_product_id; ?>" type="text" value="<?php echo number_format($prod->product_price, 2, '.', ','); ?>"  size="5"/>
                    <span class="inconloading"></span>
                </td>
                <td><input onclick="showform('<?php echo $prod->virtuemart_product_id; ?>')" type="checkbox" value="<?php echo $prod->virtuemart_product_id; ?>" id="products" name="products" />
                    <input type="hidden" id="pubdecision" value="" />
                </td>
            </tr>
            <?php
        endforeach;
        ?>
        <?php
    }

    function getProductCategory($prodid) {
        $catlist = '';
        $db = JFactory::getDBO();
        $query = "SELECT * FROM `#__virtuemart_product_categories` as prodcat_con inner join #__virtuemart_categories_" . VMLANG . " as cat on prodcat_con.virtuemart_category_id=cat.virtuemart_category_id WHERE prodcat_con.`virtuemart_product_id` =" . $prodid;
        $db->setQuery($query);
        $categories = $db->loadObjectList();

        foreach ($categories as $category):
            $catlist .= $category->category_name . ',';
        endforeach;
        return $catlist;
    }

}
?>