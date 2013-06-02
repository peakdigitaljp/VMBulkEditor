domain_name='';
function setdomain(domain){
    domain_name=domain;
}
function delcatselect(catid){
    delcatdiv = document.getElementById('category_'+catid);
    selectedcatid = document.getElementById('selectedcatid'+catid);
    selectedcatid.removeAttribute('value','');
    document.getElementById(catid).style.display = 'inline';
    $('#catid').addclass = 'search-choice';
	 

    //     delcatdiv.removeAttribute('id','');
    delcatdiv.style.display = 'none';

}



function showsuggestion(val){
    if(val == 'Select Some Options'){	
        document.getElementById('cat_multiselects').value = '';	
    }
    document.getElementById('scat').style.display = 'inline'
    $('.chzn-results').slideDown('fast');
    var showcatsinbox = document.getElementsByName('selectedcatid');
    for(var d=0; d<showcatsinbox.length; d++)
    {
        //		 if(catid != showcatsinbox[d].value)
        document.getElementById('selectedcatid'+showcatsinbox[d].value).style.display = 'inline'
    }

  
  
}
	
	
function suggestcat()	
{
    var keyword = $('.cat_multiselect').val(); 
    var suggcat = document.getElementById('suggcat');
    if(keyword != ''){
        if(suggcat.innerHTML != ''){  
            $.post('index.php','option=com_vmbulkupdate&task=suggesstionCat&no_html=1&keyword='+keyword,
                function(data){
                    //   alert(data);
                    selectedcatid = document.getElementsByName('selectedcatid');

                    suggcat.innerHTML = data;
                    for(var i=0; i<selectedcatid.length; i++){
                        if(document.getElementById(selectedcatid[i].value))
                            document.getElementById(selectedcatid[i].value).style.display = 'none';
						 
                    }

                });			
        }
    }

}


/*$('body').live('click',function() {
   $('.chzn-results').hide();
});
 */
function reset_button()
{
    $('#adminForm').find(':input').each(function() {
        switch(this.type) {
            case 'password':
            case 'select-multiple':
            case 'select-one':
            case 'text':
            case 'textarea':
                $(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
                catpub_adjust(this);
                productpricing_adjust(this);
                customfields_adjust(this);
                pricingrule_adjust(this);
                dimensionweight_adjust(this);
                productstatus_adjust(this);
        }
    });
}

function catpub_adjust(obj)
{
    if(obj.checked == true)
    {
        $('#catnpub').slideDown("fast");
        $('#catnpub_heading').addClass("active");	
    }
    if(obj.checked == false){
        $('#catnpub').slideUp("fast");	
        $('#catnpub_heading').removeClass("active");	
    }
}
function productpricing_adjust(obj)
{
    if(obj.checked == true)
    {
        $('#productpricing').slideDown("fast");
        $('#productpricing_heading').addClass("active");		
    }
    if(obj.checked == false){
        $('#productpricing').slideUp("fast");
        $('#productpricing_heading').removeClass("active");	
    }
}


/*function hidesuggestion()
{
   document.getElementById('scat').style.display = 'none';							  
	  }
 */
function customfields_adjust(obj)
{
    if(obj.checked == true)
    {
        $('#customfield').slideDown("fast");	
        $('#customfield_heading').addClass("active");
    }
    if(obj.checked == false){
        $('#customfield').slideUp("fast");	
        $('#customfield_heading').removeClass("active");
    }
}


function pricingrule_adjust(obj)
{
    if(obj.checked == true)
    {
        $('#pricingrules').slideDown("fast");
        $('#pricingrules_heading').addClass("active");	
    }
    if(obj.checked == false){
        $('#pricingrules').slideUp("fast");
        $('#pricingrules_heading').removeClass("active");	
    }
}


function dimensionweight_adjust(obj) {
    if(obj.checked == true)
    {
        $('#dimensionweight').slideDown("fast");
        $('#dimensionweight_heading').addClass("active");	
    }
    if(obj.checked == false){
        $('#dimensionweight').slideUp("fast");
        $('#dimensionweight_heading').removeClass("active");	
    }
}

function productstatus_adjust(obj) {
    if(obj.checked == true)
    {
        $('#productstatus').slideDown("fast");
        $('#productstatus_heading').addClass("active");		
    }
    if(obj.checked == false){
        $('#productstatus').slideUp("fast");
        $('#productstatus_heading').removeClass("active");		
    }
}

function clearselectOptions(id)
{
    var ref = document.getElementById(id);
    for(i=0; i<ref.options.length; i++)
        ref.options[i].selected = false;
}

function selectCheckAll(id)
{
    var ref = document.adminForm.products;
    for(i=0; i<ref.length; i++)
        ref[i].checked = true;
}

function clearCheckAll(id){
    var ref = document.adminForm.products;
    for(i=0; i<ref.length; i++)
        ref[i].checked = false;
}

function selectAllOptions(id)
{
    var ref = document.getElementById(id);
    for(i=0; i<ref.options.length; i++)
        ref.options[i].selected = true;
}

function sortdata(field){
    alert(field);
}


function addpubval(pubval)
{
    document.getElementById('pubvalidate').value= pubval;
}



function bulksave()
{
	 
    prodarray = Array();
    fgcpricearray = Array();
    prodvalidation = Array();
    selectedcats = Array();
    var j = 0;
    var v = 0;
    var c = 0;
    var url = '';
    var ref = document.adminForm.products;
    var refPrices = document.adminForm.fgcprices;
    var catnpub_adjust = document.adminForm.catnpub_adjustval;
    var pricingrule_adjustval = document.adminForm.pricingrule_adjustval;
    var productpricing_adjust = document.adminForm.productpricing_adjustval;
    var productstatus_adjustval = document.adminForm.productstatus_adjustval;
    var dimensionweight_adjustval = document.adminForm.dimensionweight_adjustval;
    var customfields_adjustval = document.adminForm.customfields_adjustval;
    var publish = document.getElementById('pub');
		
    var pub;
    var selectedcatidsarray;
    if(catnpub_adjust.checked == true){
        pub = document.getElementById('pubvalidate').value;
        var selectedcatids = document.getElementsByName('selectedcatid');

        for(var i=0; i<selectedcatids.length; i++){
            selectedcatidsarray += selectedcatids[i].value+',';
        }
		  
        if(pub)
            url = '&publish='+pub;
        if(selectedcatids.length > 0)
            url += '&selectedcatidsarray='+selectedcatidsarray;
		 
    }
		
		
    if(productpricing_adjust.checked == true){
        var productprice = document.adminForm.productprice.value;	
        var currency = document.adminForm.currency.value;	
        if(productprice)
            url += '&productprice='+productprice;
		 
        if(currency)
            url +='&currency='+currency;;
    }
		
    if(dimensionweight_adjustval.checked == true){
        var prodlength = document.adminForm.prodlength.value;
        var prodlengthunit = document.adminForm.product_lwh_uom.value;
        var prodwidth = document.adminForm.prodwidth.value;
        var prodheight = document.adminForm.prodheight.value;
        var prodweight = document.adminForm.prodweight.value;
        var prodweightunit = document.adminForm.product_weight_uom.value;			 
        var produnit = document.adminForm.produnit.value;
        var prodpackaging = document.adminForm.prodpackaging.value;
        var unitsbox = document.adminForm.unitsbox.value;	
			 
			 
        url += '&prodlength='+prodlength+'&prodlengthunit='+prodlengthunit+'&prodwidth='+prodwidth+'&prodheight='+prodheight+'&prodweight='+prodweight+'&prodweightunit='+prodweightunit+'&produnit='+produnit+'&prodpackaging='+prodpackaging+'&unitsbox='+unitsbox
			 
    }


    //alert(url); return false;
    if(customfields_adjustval.checked == true){
        var customidarray;
        var customvaluearray;
        var pricearray;
        var relcat;
        var relcal1s;
        var relcal1 = document.getElementsByName('filename1');
        var relCats = document.getElementsByName('filename');
        for(var i=0; i<relCats.length; i++){
            //				 alert(relCats[i].style.display);
            if(relCats[i].value) 
                relcat += relCats[i].value+',';
        }
        for(var i=0; i<relcal1.length; i++){
            //				 alert(relCats[i].style.display);
            if(relcal1[i].value) 
                relcal1s += relcal1[i].value+',';
        }
				 
        //				 alert(relcal1s);
        var customids = document.getElementsByName('hidcustom');
        for(var i=0; i<customids.length; i++){
            //				 alert(relCats[i].style.display);
            //                  customvaluearray += customvalue[i].value;
            console.log(customids[i].value)
            if(customids[i].value != '' || customids[i].value != 'undefined' || customids[i].value != 'null'){ 
                if(document.getElementById('customvalue'+i+customids[i].value) != 'null'){
                    if(document.getElementById('price'+i+customids[i].value) != null){

                        var price = document.getElementById('price'+i+customids[i].value).value;
                        pricearray += customids[i].value+'_'+price+','	  ;
                    }else{
                        //Truong hop neu customer field khong co gia chung ta phai gan no rong
                        //neu khong gan thi insert vao database error
                        pricearray += customids[i].value+'_'+''+','	  ;
                    }
                }

                if(document.getElementById('customvalue'+i+customids[i].value))
                    customvaluearray += document.getElementById('customvalue'+i+customids[i].value).value+',';
                customidarray += customids[i].value+',';
            }
				  
        }	

        if(customidarray)	 
            url += '&customidarray='+customidarray;
			  
        if(relcal1s)
            url +='&relprod='+relcal1s;
			  
        if(relcat)
            url +='&relcat='+relcat;
			  
        if(customvaluearray)
            url +='&customvaluearray='+customvaluearray;
			  
        if(pricearray)
            url +='&pricearray='+pricearray;				 
    // alert(customids.length);
			 
    }
		
    if(productstatus_adjustval.checked == true){
        var pstock = document.adminForm.pstock.value;	
        var orderprod = document.adminForm.orderprod.value;	
        var pminpurchacequantity = document.adminForm.pminpurchacequantity.value;	
        var pmaxpurchacequantity = document.adminForm.pmaxpurchacequantity.value;	
        var availabledate = document.adminForm.availabledate.value;				 
        var pavailable = document.adminForm.pavailable.value;
        var low_stock_notification = document.adminForm.low_stock_notification.value;
        var availablepics = document.adminForm.availablepics.value;
        if(pstock)
            url += '&pstock='+pstock+'&orderprod='+orderprod+'&pminpurchacequantity='+pminpurchacequantity+'&pmaxpurchacequantity='+pmaxpurchacequantity+'&pavailable='+pavailable+'&availablepics='+availablepics+'&availabledate='+availabledate+'&low_stock_notification='+low_stock_notification;
			
    }

    if(pricingrule_adjustval.checked == true){
        var tax = document.getElementById('tax').value;
        var discount = document.getElementById('discount').value;
        var fprice = document.getElementById('fprice').value;			   
			    
        if(fprice)
            url += '&fprice='+fprice;
        if(tax)
            url += '&tax='+tax;
        if(discount)	
            url += '&discount='+discount;
			   
    } 
    if (ref && ref.length) {

        for(i=0; i<ref.length; i++){
            if(ref[i].checked == true){
                prodarray[j] = ref[i].value;
                fgcpricearray[j] = refPrices[i].value;
                j++;
            } else {
                prodvalidation[v]	= ref[i].value;	
                v++;
            }
        }
    }
    if(typeof ref == 'undefined'){
        //cMiniWindowShow('', 'Warning', 450, 100);   
        //cWindowAddContent('Please select a product')
        document.getElementById('message').innerHTML = document.getElementById('messageselectproduct').innerHTML;
        $('#message').show('fast');
        return false;
    }
    if(prodvalidation.length == ref.length){
        //cMiniWindowShow('', 'Warning', 450, 100);   
        //cWindowAddContent('Please select a product')
        document.getElementById('message').innerHTML = document.getElementById('messageselectproduct').innerHTML;
        $('#message').show('fast');
        return false;
    }
		
    /*var prodcat = document.getElementById('prodcat');
		for(i=0; i<prodcat.options.length; i++){
			 if(prodcat.options[i].selected == true){
			  c++;
			  selectedcats[c] = prodcat.options[i].value;
			 } 
		}
        if(selectedcats.length > 0)		
		  url += '&cateselect='+selectedcats;*/
		
    document.getElementById('message').style.align="center";
    document.getElementById('message').innerHTML = document.getElementById('messageproccess').innerHTML;

    $.post('index.php','option=com_vmbulkupdate&task=saveproducts&prod='+prodarray+'&fgcprices='+fgcpricearray+'&view=default&no_html=1&'+url,
        function(data){

            if(catnpub_adjust.checked == true || productpricing_adjust.checked == true)
                /*			   var field = document.getElementById('field').value;
			   var orderby = document.getElementById('orderby').value;
             */			   loaddatatable();
            $('#message').show('fast');
            //               document.getElementById('message').style.display = 'inline';
            document.getElementById('message').innerHTML = document.getElementById('messagesuccess').innerHTML;
        //cMiniWindowShow('', 'Message', 450, 100);   
        //cWindowAddContent('Saved Successfully')

        });
// window.location.reload();

}



function nodate()
{
    document.getElementById('availabledate').value = '-Never-';
}

function closecats(val)
{
    alert(val);
}
	   
	   
function cats(obj)
{
    catid = obj.value;
    $.post('index.php','option=com_vmbulkupdate&task=catname&catid='+catid+'&view=default&no_html=1',
        function(data){
            $('#'+obj.value).hide('fast');
            //     document.getElementById(obj.value).style.display = 'none';
            var element_ul = document.createElement("ul");
            element_ul.setAttribute("class", 'holder');
            element_ul.setAttribute("id", "s"+obj.value);
	 
            var element_li = document.createElement("li");
            element_li.setAttribute("class", 'bit-box');
            element_li.innerHTML = data+'<img onclick="closecat('+obj.value+')" style="float:right; margin:2px -3px 0 0;" src="images/closebtn.jpg" border="0" />';
            element_ul.appendChild(element_li);
 
 
            var foo = document.getElementById("soption");
	
            foo.appendChild(element_ul);
        });	
}
   
function showselect()
{
    //    document.getElementById('sbox').style.display = 'inline';
    $('#sbox').show('slow');
	
}
  

   
function closecat(obj){
     
    var child = document.getElementById("s"+obj);
    var parent = document.getElementById('soption');
    parent.removeChild(child);
    document.getElementById(obj).style.display = 'block';
}


// Custom Fields

 
$(".custom_box").live('change',function () {
    var customID = $('.custom_box').val();
    $.post('index.php','option=com_vmbulkupdate&task=getCustomBox&no_html=1&customid='+customID,
        function(data){
            //  alert(data);
            var inputtype;
            var field = data.split(',');

            var Isprice =   field[5];
            var hidcustom_element = document.createElement('input');	 
            hidcustom_element.setAttribute('type','hidden');
            hidcustom_element.setAttribute('name','hidcustom');
            hidcustom_element.setAttribute('id','hidcustom'+customID);
            hidcustom_element.setAttribute('value',customID);
            
            /*Thuc hien them mot the input an de gan id = 0,1,...*/
            var fgchidcustom = document.getElementById('fgchidcustom');  
            var valuefgchidcustom = 0
            var fgchidcustom_element = document.createElement('input');	 
            fgchidcustom_element.setAttribute('type','hidden');
            fgchidcustom_element.setAttribute('name','fgchidcustom');
            fgchidcustom_element.setAttribute('id','fgchidcustom');
            fgchidcustom_element.setAttribute('value',0);
            /*End*/
				  
            var outerTbody = document.getElementById('custom_field');  
            var outerTr = document.createElement('tr');
            outerTr.setAttribute('class','removable');
            outerTr.setAttribute('id','r_'+customID);
            var td1 = document.createElement('td');
            var txt1 = document.createTextNode(field[0]);
            td1.appendChild(txt1);
            td1.appendChild(hidcustom_element);
            /*Thuc hien tang gia tri cua id*/
            if(fgchidcustom == null){
                td1.appendChild(fgchidcustom_element);
            }else if(customID!=0){
                valuefgchidcustom = parseInt(fgchidcustom.value) + 1;
                fgchidcustom.value = valuefgchidcustom;
            }
            /*End*/
            var td2 = document.createElement('td');
            var txt2 = document.createTextNode(field[1]);
            td2.appendChild(txt2);

            var td3 = document.createElement('td');
            if(field[4] == 'T' || field[4] == 'M' || field[4] == 'V' || field[4] == 'S' ){
                var inputtype = document.createElement('input');
                inputtype.setAttribute('type','text');
                inputtype.setAttribute('name','customvalue');
                //inputtype.setAttribute('id','customvalue'+customID);						 
                inputtype.setAttribute('id','customvalue'+valuefgchidcustom+customID);						 
                inputtype.setAttribute('value',field[2]);
            }
            if(field[4] == 'M'){
                var inputtype = document.createElement('select');
                //inputtype.setAttribute('name','customvalue'+customID);
                //inputtype.setAttribute('id','customvalue'+customID);
                inputtype.setAttribute('name','customvalue'+valuefgchidcustom+customID);
                inputtype.setAttribute('id','customvalue'+valuefgchidcustom+customID);						
                var option = document.createElement('option');
                option.setAttribute('value','greenShovel');
						 
                var txt6 = document.createTextNode('drill');
                option.appendChild(txt6);
                inputtype.appendChild(option);
            }
					
            if(field[4] == 'P'){
                var txt5 = document.createTextNode('Parent'); 
                var inputtype = document.createTextNode(field[2]);
            }
					
					
            td3.appendChild(inputtype);
					
					
            var td4 = document.createElement('td');
            if(Isprice == 1){
                var inputprice = document.createElement('input');
                inputprice.setAttribute('name','price');				
                //inputprice.setAttribute('id','price'+customID);
                inputprice.setAttribute('id','price'+valuefgchidcustom+customID);
                inputprice.setAttribute('value','0');
                td4.appendChild(inputprice);
            }

					
            var txt4 = document.createTextNode(field[3]);
            td2.appendChild(txt4);

            var td5 = document.createElement('td');									 
            if(field[4] == 'S')
                var txt5 = document.createTextNode('String');
            if(field[4] == 'M')
                var txt5 = document.createTextNode('Image');

            if(field[4] == 'T')
                var txt5 = document.createTextNode('Time');

            if(field[4] == 'I')
                var txt5 = document.createTextNode('Integer');
					 
            if(field[4] == 'B')
                var txt5 = document.createTextNode('Boolean');

            if(field[4] == 'D')
                var txt5 = document.createTextNode('Date');
					 
            if(field[4] == 'V')
                var txt5 = document.createTextNode('Variant');

            if(field[4] == 'E')
                var txt5 = document.createTextNode('Plugins');


            td5.appendChild(txt5);

            var td6 = document.createElement('td');
            var td7 = document.createElement('td');
            var img1 = document.createElement('img');
            img1.setAttribute('src','components/com_vmbulkupdate/css/images/closebtn.jpg');
            img1.setAttribute('onclick','closeThem("'+customID+'")');
            td7.appendChild(img1);
                     
					 
            outerTr.appendChild(td1);
            outerTr.appendChild(td2);
            outerTr.appendChild(td3);
            outerTr.appendChild(td4);
            outerTr.appendChild(td5);					
            /*					outerTr.appendChild(td6);*/
            outerTr.appendChild(td7);					
            outerTbody.appendChild(outerTr);					
					
        });
});




$('.reset-value-cat').live('click',function(){
    document.getElementById('relcat').value = '';	
    $('#vm_image_cat').hide('fast');
//     document.getElementById('vm_image').style.display = 'none';
});


$('.reset-value').live('click',function(){
    document.getElementById('relprod').value = '';	
    $('#vm_image').hide('slow');
//     document.getElementById('vm_image').style.display = 'none';
});

function getcatid(title,pid,furl){

    $('#vm_image_cat').hide('slow');
    //	 document.getElementById('vm_image').style.display = 'none';
    document.getElementById('fileurl').value = furl;
    var outerdiv = document.getElementById('custom_categories_cat');

    var div_element = document.createElement('div');
    var linktoimg   = document.createElement('a');	 
    linktoimg.setAttribute('href',domain_name+'administrator/index.php?option=com_virtuemart&view=category&task=edit&virtuemart_category_id='+pid);
    var hid_element = document.createElement('input');	 
    hid_element.setAttribute('type','hidden');
    hid_element.setAttribute('name','filename1');
    hid_element.setAttribute('id','filename1'+pid);
    hid_element.setAttribute('value',pid);
    div_element.setAttribute('class','vm_thumb_image_cat');
    div_element.setAttribute('id','vm_'+pid);
    var img_eleement1 = document.createElement('img');
    var img_eleement = document.createElement('img');
    img_eleement.setAttribute('src',domain_name+furl);
    img_eleement.setAttribute('border','0');

    img_eleement1.setAttribute('src',domain_name+'administrator/components/com_vmbulkupdate/css/images/closebtn.jpg');
    img_eleement1.setAttribute('border','0');
    img_eleement1.setAttribute('onclick','closeCunstomCat("vm_'+pid+'",'+pid+')');	 

    var txt = document.createTextNode(title);
    linktoimg.appendChild(txt);
    div_element.appendChild(img_eleement);
    div_element.appendChild(img_eleement1);
    div_element.appendChild(linktoimg);
    div_element.appendChild(hid_element);
    outerdiv.appendChild(div_element);
	 
	 
	 

}


function testss(a)
{
    alert(a);
}

function getprodid(title,pid,furl){

    $('#vm_image').hide('slow');
    //	 document.getElementById('vm_image').style.display = 'none';
    document.getElementById('fileurl').value = furl;
    var outerdiv = document.getElementById('custom_categories');

    var div_element = document.createElement('div');
    var linktoimg   = document.createElement('a');	 
    linktoimg.setAttribute('href',domain_name+'administrator/index.php?option=com_virtuemart&view=category&task=edit&virtuemart_category_id='+pid);
    var hid_element = document.createElement('input');	 
    hid_element.setAttribute('type','hidden');
    hid_element.setAttribute('name','filename');
    hid_element.setAttribute('id','filename'+pid);
    hid_element.setAttribute('value',pid);
    div_element.setAttribute('class','vm_thumb_image');
    div_element.setAttribute('id','vm_'+pid);
    var img_eleement1 = document.createElement('img');
    var img_eleement = document.createElement('img');
    img_eleement.setAttribute('src',domain_name+furl);
    img_eleement.setAttribute('border','0');
    img_eleement1.setAttribute('src',domain_name+'administrator/components/com_vmbulkupdate/css/images/closebtn.jpg');
    img_eleement1.setAttribute('border','0');
    img_eleement1.setAttribute('onclick','closeCunstom("vm_'+pid+'",'+pid+')');	 

    var txt = document.createTextNode(title);
    linktoimg.appendChild(txt);
    div_element.appendChild(img_eleement);
    div_element.appendChild(img_eleement1);
    div_element.appendChild(linktoimg);
    div_element.appendChild(hid_element);
    outerdiv.appendChild(div_element);
	 
	 
	 

}



function closeThem(id){
    //   $('#'+id).hide('slow');
   
    document.getElementById('r_'+id).style.display = 'none';
    var hidcustom = document.getElementById('hidcustom'+id);
    hidcustom.removeAttribute('value','');

}

function closeCunstomCat(id,pid)
{
    /*	 alert(id);
	 alert(pid);
 */	  $('#'+id).hide('slow');
    var div = document.getElementById(id);
    var filename = document.getElementById('filename1'+pid);
   
   
   
    filename.removeAttribute('value','');
    div.removeAttribute('id','');
    div.removeAttribute('value','');
   
   
}

function closeCunstom(id,pid)
{
    $('#'+id).hide('slow');
    var div = document.getElementById(id);
    var filename = document.getElementById('filename'+pid);
   
   
   
    filename.removeAttribute('value','');
    div.removeAttribute('id','');
    div.removeAttribute('value','');
   
   
   
   
//   document.getElementById(id).style.display = 'none';
}

function placecat(catname,catid){
   
    //   document.getElementById('cat_multiselects').value = ''; // Changed this NOTSURE
    document.getElementById('scat').style.display = 'none';
    var catinbox = document.getElementById('catinbox');
    var hiddencatid = document.createElement("input");
    hiddencatid.setAttribute("type", 'hidden');
    hiddencatid.setAttribute("id", 'selectedcatid'+catid);
    hiddencatid.setAttribute("name", 'selectedcatid');
    hiddencatid.setAttribute("value", catid);
    catids = document.getElementById('catids');
    catids.appendChild(hiddencatid);
	
    document.getElementById(catid).style.display = 'none';
    $('#category_'+catid).fadeIn('slow');
}

function relatedcategoriesSearch(obj)
{
    $('#vm_image_cat').show('slow') 
    // 	 document.getElementById('vm_image').style.display = 'inline';
    if(obj.value == '')
    {
        $('#vm_image_cat').hide('slow') 
    }
    $.post('index.php','option=com_vmbulkupdate&no_html=1&task=getrelatedcategories&cname='+obj.value,
        function(data){

            document.getElementById('vm_image_cat').innerHTML = data;	 

        });
}


function relatedproductSearch(obj)
{
    $('#vm_image').show('slow') ;
    if(obj.value == '')
    {
        $('#vm_image').hide('slow') ;
    }
    // 	 document.getElementById('vm_image').style.display = 'inline';
    $.post('index.php','option=com_vmbulkupdate&no_html=1&task=getrelatedproducts&cname='+obj.value,
        function(data){
            document.getElementById('vm_image').innerHTML = data;
        });
}

function showform(val)
{
//   alert(val);
}

function test11()
{
    alert('Test');
}



function closerelcat()
{
    $('#vm_image_cat').hide('slow');
}



function closerelprod()
{
    $('#vm_image').hide('slow');
}

$(function() {
    $("body").click(function(e) {
        if (e.target.id == "cat_multiselects") { 
            document.getElementById('scat').style.display = 'inline';	
        } else {
            document.getElementById('scat').style.display = 'none';	

        }
    });
})
 
 
 
function closescat(){
// document.getElementById('scat').style.display = 'none';
//	 $('#scat').hide('slow');
} 


function loaddatatable(){
    $('#showproduct').fadeIn("fast");
    var selectedcats = new Array();
    var c = 0;
    var ref = document.getElementById('catname');
    for(i=0; i<ref.options.length; i++){
        if(ref.options[i].selected == true){
            c++;
            selectedcats[c] = ref.options[i].value;
        } 
    }
	   
    $.post('index.php','option=com_vmbulkupdate&task=fetchItems&view=default&no_html=1&cids='+selectedcats,
        function(data){	 
            $("tbody > tr > td", "#myTable").remove();
            $("#myTable tbody").append(data); 
            $("#myTable").trigger("update"); 
            // set sorting column and direction, this will sort on the first and third column 
            var sorting = [[0,0]]; 
            // sort on the first column 
            $("#myTable").trigger("sorton",[sorting]); 
            //document.getElmentByid('catnpub').style.display='inline'
            $("#myTable tr").each(
                function() {
                    var elem = $(this);
                    if (elem.children().length == 0) {
                        elem.remove();
                    }
                }
                );
						
        }); 
}


$("#loaddatatable1").click(function() { 
    $('#showproduct').fadeIn("fast");
    var selectedcats = new Array();
    var c = 0;
    var ref = document.getElementById('catname');
    for(i=0; i<ref.options.length; i++){
        if(ref.options[i].selected == true){
            c++;
            selectedcats[c] = ref.options[i].value;
        } 
    }
	   
    $.post('index.php','option=com_vmbulkupdate&task=fetchItems&view=default&no_html=1&cids='+selectedcats,
        function(data){	 
            $("#myTable tbody").empty();
            $("#myTable tbody").append(data); 
            $("#myTable").trigger("update"); 
            // set sorting column and direction, this will sort on the first and third column 
            var sorting = [[0,0]]; 
            // sort on the first column 
            $("#myTable").trigger("sorton",[sorting]); 
        //document.getElmentByid('catnpub').style.display='inline'
				 
			
			
        }); 
}); 




$(document).ready(function() { 
    $("#myTable").tablesorter(); 
    $("#loaddatatable").click(function() { 
        $('#showproduct').fadeIn("fast");
        var selectedcats = new Array();
        var c = 0;
        var ref = document.getElementById('catname');
        for(i=0; i<ref.options.length; i++){
            if(ref.options[i].selected == true){
                c++;
                selectedcats[c] = ref.options[i].value;
            } 
        }
        if(c==0){
            $('#message').show('fast');
            $('html,body').animate({
                scrollTop: 100+'px'
            },700);
            document.getElementById('message').innerHTML = document.getElementById('messageSelectcate').innerHTML; 
        }
        //  $("#myTable tbody").empty();
        $.post('index.php','option=com_vmbulkupdate&task=fetchItems&view=default&no_html=1&cids='+selectedcats,
            function(data){	 
                $("tbody > tr > td", "#myTable").remove();
                $("#myTable tbody").append(data); 
                $("#myTable").trigger("update"); 
                // set sorting column and direction, this will sort on the first and third column 
                var sorting = [[0,0]]; 
                // sort on the first column 
                $("#myTable").trigger("sorton",[sorting]); 
                //document.getElmentByid('catnpub').style.display='inline'
                $("#myTable tr").each(function() {
                    var elem = $(this);
                    if (elem.children().length == 0) {
                        elem.remove();
                    }
                });
			
            }); 
    }); 
}); 

function deselectallcat(){
    clearselectOptions('catname');
    $('#showproduct').fadeOut("fast");
    $('#catnpub').fadeOut("fast");
    $('#productpricing').fadeOut("fast");
    $('#customfield').fadeOut("fast");  
  
    $('#pricingrules').fadeOut("fast");		   
    $('#productstatus').fadeOut("fast");		
    $('#dimensionweight').fadeOut("fast");		  
    document.getElementById('custom_categories_cat').innerHTML = '';
    document.getElementById('relcat').value = '';
  
    document.getElementById('custom_categories').innerHTML = '';
    document.getElementById('relprod').value = '';
  
    document.getElementById('custom_field').innerHTML = '';
  
    document.adminForm.prodlength.value = '0.00000';
    document.adminForm.prodwidth.value = '0.00000';  
    document.adminForm.prodheight.value = '0.00000';  
    document.adminForm.prodweight.value = '0.00000';  
    document.adminForm.produnit.value = '0.00000';    
    document.adminForm.prodpackaging.value = '0.00000';  
    document.adminForm.unitsbox.value = '0.00000';    

  
    document.adminForm.pstock.value = '';    
    document.adminForm.orderprod.value = '';    
    document.adminForm.low_stock_notification.value = '';    
    document.adminForm.pminpurchacequantity.value = '';    
    document.adminForm.pmaxpurchacequantity.value = ''; 
    document.adminForm.availabledate.value = '';   
    document.adminForm.pavailable.value = '';     
    
    document.adminForm.productprice.value = '';  
  
  
/*  if(document.getElementsByName('selectedcatid') != 'null'){
	  var closeselectedcategory = document.getElementsByName('selectedcatid');
	   for(var i=0; i<closeselectedcategory.length; i++){
		     document.getElementById('selectedcatid'+closeselectedcategory.value).style.display = 'none';
		   }
		   
		  document.getElementById('catids').innerHTML = '';
	  }
 */  
  
  
  
  
  
  
  
}

function selectallcat(){
    selectAllOptions('catname');
}

function availablepic(obj){
    document.getElementById('showpic').innerHTML = '<img src="'+domain_name+'components/com_virtuemart/assets/images/availability/'+obj.value+'" border="0">';
    document.adminForm.pavailable.value = obj.value;
}
/*
jQuery(document).ready(function($){
    $(".fgcPrice").live("keyup", function(){
        var price = $(this).val();
        var productid = $(this).attr("productid")
        me = $(this);
        me.next('.inconloading').removeClass('success').addClass('loading');
        $.ajax({
            url: 'index.php?option=com_vmbulkupdate&task=productpricechange&prod='+productid+'&price='+price+'&view=default&no_html=1&',
            type: 'post',
            dataType: 'html',
            success: function(){
                me.prev(".pricehidden").text(price);
                me.next('.inconloading').removeClass('loading').addClass('success');
                //update table for sort
                $("#myTable").trigger("update"); 
                    
                if (window.timeout) clearTimeout(window.timeout);
                window.timeout = window.setTimeout(function(){
                    me.next('.inconloading').removeClass('success');    
                }, 5000);
            }
        })
    })
})
*/