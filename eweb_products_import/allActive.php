<?php
//database connection file include
include 'config.php';

/**
 * eWeb Soap Service Calls
 * 2019-03-27
 * 
 * (c) Retail Edge Consultants 2019
 * 
 * See eWeb Programmer's Interface.pdf for available methods and interface details
 * 
 * */
require 'setup.php';
require 'head.php';
//Call the SOAP webservice
//---------------------------------------[ Fetching All Active Items ]-------------------------------------------
//Use the authentication class, and pass to the soap call
$searchData = array(
    "SearchField" => 'WebOptionBoolean5',
    "SearchOp" => 'EqualsOp',
    "Value" => '1',
);
//Set the Soap Variables
$parm = array();
$parm[] = new SoapVar($searchData["SearchField"], XSD_STRING, null, null, 'SearchField', 'http://schemas.datacontract.org/2004/07/eWeb');
$parm[] = new SoapVar($searchData["SearchOp"], XSD_STRING, null, null, 'SearchOp', 'http://schemas.datacontract.org/2004/07/eWeb');
$parm[] = new SoapVar($searchData["Value"], XSD_STRING, null, null, 'Value', 'http://schemas.datacontract.org/2004/07/eWeb');
//Use the authentication class and Search Parameters, and pass to the soap call
$params = array(
    "AuthenticationInfo" => $auth,
    "SearchBy" => array(
        "SearchBaseParam" => new SoapVar($parm, SOAP_ENC_OBJECT, "ns1:SearchStringParam")
    )
);


//Call the SOAP webservice
$response = $client->GetActiveItems($params);

//Call the SOAP webservice
//$response = $client->__soapCall("GetAllActiveItems", array($params));
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<style>
      table{
    width:100%;
}
#example_filter{
    float:right;
}
#example_paginate{
    float:right;
}
label {
    display: inline-flex;
    margin-bottom: .5rem;
    margin-top: .5rem;
   
}

</style>
<script>
// datatable records show functionality
$(document).ready(function() {
    $('#example').DataTable(
        
         {     

      "aLengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
        "iDisplayLength": 50
       } 
        );
} );

//check all checkbox functionality
function checkAll(bx) {
  var cbs = document.getElementsByTagName('input');
  for(var i=0; i < cbs.length; i++) {
    if(cbs[i].type == 'checkbox') {
      cbs[i].checked = bx.checked;
    }
  }
}

function resetall(bx) {
  var cbs = document.getElementsByClassName('resetall');
  for(var i=0; i < cbs.length; i++) {
    if(cbs[i].type == 'checkbox') {
      cbs[i].checked = bx.checked;
    }
  }
}

//reimport product functionality
jQuery(document).ready(function(){
  jQuery("body").on("click",".re_import",function(){

	if(confirm('Are you sure you want to re-import this item?'))
	{
		var get_id  = jQuery(this).attr("data-id");

		jQuery(".checkex_checkornot_"+get_id).removeAttr('disabled');
		jQuery("#import_product").submit();
		jQuery("#import_product").trigger('click');
		//location.reload(true);
	}
	
  });


});

jQuery(document).ready(function(){

	  jQuery("body").on("click","#reimport_bulk_items",function(){


				jQuery(".itemcheckbox").removeAttr('disabled');
				//location.reload(true);
			
		});

		// jQuery("#reimport_bulk_items").on("click",function(){

		// alert("52345")
		// 	jQuery(".itemcheckbox").removeAttr('disabled');
		// 	//location.reload(true);
		
		// });

		// jQuery("body").delegate("#reimport_bulk_items","click",function(){

		// alert("324sdf")
		// 	jQuery(".itemcheckbox").removeAttr('disabled');
		// 	//location.reload(true);

		// });


	});
</script>



<form method="post">
<h2>Get All Active Items Test</h2>  
<div class="row col-md-12" style="justify-content: right;">
 	<button class="btn btn-primary" id="import_product" name="import" type="submit">Import</button> 
	&nbsp;&nbsp;&nbsp;&nbsp;
	 <button class="btn btn-primary" class="reimport_bulk_items" id="reimport_bulk_items" name="reimport_bulk_items" type="button">Reset</button> 
</div>
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th><input type="checkbox" onclick="checkAll(this)"></th>
            <th>SKU</th>
			<th>Option</th>
		
            
           
        </tr>
    </thead>
    <tbody>

<?php
// print_r($response->GetActiveItemsResult->ActiveItem);

// die("gfhfg");
//get active items data for items checkbox checked or not
$count_start_hwe =1;
foreach($response->GetActiveItemsResult->ActiveItem as $key => $valu1)
{
    
	 //check items checkbox checked or not for catch from retail edge when show checkboxchecked or not
     $Catch_sub_cats_hwe=$valu1->ID4;
	 if($Catch_sub_cats_hwe =='' || is_numeric(trim($Catch_sub_cats_hwe)))
	 {
	  continue;
	 }
     $sku_checkbox=$valu1->SKU;


	 //show checkbox selected or not(items import or not) option in table
	 echo "<tr>";
     $select_sku="SELECT * from product_import where product_id='".$sku_checkbox."'";
	 $row_sku=$conn->query($select_sku);
     $checked_sku='';
	 $disabled_sku='';
     if(mysqli_num_rows($row_sku) > 0)
	 {
         $checked_sku="checked";
         $disabled_sku="disabled";
	 }
	?>
	
	<td><input type="checkbox" class="itemcheckbox checkex_checkornot_<?php echo $count_start_hwe; ?>" name="offer[]" <?php echo $checked_sku; ?> value='<?php echo $sku_checkbox;?>' <?php echo $disabled_sku; ?>></td>
	<td><?php echo $valu1->SKU; ?></td>
	<td><button class="btn btn-primary re_import" data-id="<?php echo $count_start_hwe; ?>" name="re_import" type="button">Re-Import</button></td>
	
	
	<?php
   echo "</tr>";	
   $count_start_hwe++;

}
?>


	</tbody>
</table>
</form>
<?php
/// item import after click import button
if(isset($_POST['import']))
{

	$product_hwe =$_POST['offer'];
	echo dirname(__DIR__).'/eweb_products_import/csv/product_import.csv';

	//csv file column create
	$fp =fopen(dirname(__DIR__).'/eweb_products_import/csv/product_import.csv', 'w');
	fputcsv($fp, array('Category', 'Internal SKU','Product title','Product reference value', 'Product reference type','Description','Brand','Condition','Quantity multiplier', 'Colour','Keywords','Gender','Material','Variant ID','Variant Colour Value','Variant Size Value', 'Image Size Chart', 'Image 1', 'Image 2', 'Image 3','Image 4', 'Image 5', 'Image 6', 'Image 7', 'Image 8','Image 9', 'Image 10', 'Variant Image 1', 'Variant Image 2', 'Variant Image 3','Variant Image 4', 'Variant Image 5','Variant Image 6','Variant Image 7','Variant Image 8','Variant Image 9','Variant Image 10','Weight','Weight unit','Width','Width unit','Length','Length unit','Height','Height unit','Model number','Season','Adult','Restriction','Gift Type','Accessories Material','Occasion','Underwear Style','Bag Style','Luggage Type','Luggage Size','Stone Type','Metal Type','Bra Style','Number of Pieces','Costume Theme','Frame Shape','Hat Type','Tie Type','Watch Case Diameter','Watch Shape','Display Type','Water Resistance','Watch Case Diameter unit','Bracelet Type','Earring Style','Necklace Type','General Size','Body Part','Contains Button Cell Batteries','Compliance Sunglasses','Wallet Type','Hat Size'));
		

	unset($productidarray);
	// get active items data
	foreach($response->GetActiveItemsResult->ActiveItem as $key => $valu)
	{


        //import only checkbox check items another items continue
		if(!in_array($valu->SKU,$product_hwe))
		{
			continue;
		}

			////check items checkbox checked or not for catch from retail edge when items import
			$Catch_sub_cats=$valu->ID4;
            if($Catch_sub_cats =='' || is_numeric(trim($Catch_sub_cats)))
			{
              continue;
			}

			//print items data for test
            echo "<hr>";
            echo "DesignNum:".$valu->DesignNum;
            echo "<br>";
			echo "Barcode:".$valu->Barcode;
            echo "<br>";
            echo "CategoryID:".$Catch_sub_cats.' - '.$category_name;
            echo "<hr>";

			
			if($valu->Barcode != '' && is_numeric(trim($valu->Barcode)) == 12)
			{
				//check if barcode numeric value 12 then product reference type sku and reference is barcode for search item on catch
				$barcode_not_set =$valu->Barcode;
				$product_ref_type='upc';
			}
			else if($valu->Barcode != '' && is_numeric(trim($valu->Barcode)) == 13)
			{
				//check if barcode numeric value 13 then product reference type ean and reference is barcode for search item on catch
				$barcode_not_set =$valu->Barcode;
				$product_ref_type='ean';
			}
			else
			{
				//reference type sku and item reference is design number for search item on catch
				$barcode_not_set =$valu->DesignNum;
				$product_ref_type='mpn';
			}

			//check product already imported on catch with product reference EAN
			$curl = curl_init();
			curl_setopt_array($curl, array(
			CURLOPT_URL => SITEURL."products/?product_references=EAN|".$barcode_not_set,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
			"accept: application/json",
			"authorization: ".trim(APIKEY)
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		$responsejsondecode=json_decode($response,true);

		if($responsejsondecode['total_count'] == 0)
		{
			
			//check product already imported on catch with product reference UPC
			$curl = curl_init();
			curl_setopt_array($curl, array(
			CURLOPT_URL => SITEURL."products/?product_references=UPC|".$barcode_not_set,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"accept: application/json",
				"authorization: ".trim(APIKEY)
			),
			));
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
			$responsejsondecode=json_decode($response,true);
		}
              
		if($responsejsondecode['total_count']!= 0)
		{
			///////offer create /////////
			echo "<br>";

			$startdate=date("Y-m-d");
			//$enddate=date("Y-m-d",strtotime('+1 months'));
			$enddate=date("Y-m-d",strtotime('+3 years'));
			

			$select ="SELECT * from `product_import` where product_id='".$valu->SKU."'";
			$row =$conn->query($select);
		
			//remove hifuns from item sku
			$remove_sku_hifans =str_replace('-', '', $valu->SKU); 

			//remove spaces and hifuns from item barcode
			$Barcode =$valu->Barcode;
			$remove_spaces =str_replace(' ', '', $Barcode);
			$remove_hifans =str_replace('-', '', $remove_spaces);

			if(is_numeric($remove_hifans))
			{        
				$count_barcode_digit=strlen($remove_hifans);
			}

			
			if($valu->Barcode != '' && $count_barcode_digit == 12)
			{
				//check numeric barcode valueis 12 then product ref type upc and reference is barcode
				$barcode_not_set =$valu->Barcode;
				$product_ref_type='upc';
			}
			else if($valu->Barcode != '' && $count_barcode_digit == 13)
			{
				//check numeric barcode valueis 12 then product ref type ean and reference is barcode
				$barcode_not_set =$valu->Barcode;
				$product_ref_type='ean';
			}
			else
			{
				//else product ref type sku and reference is sku
				$barcode_not_set =$valu->SKU;
				$product_ref_type='mpn';
			}
			
			//array for offer create
			$create_offer_array= array(
									'offers' => 
									array (
									0 => 
									array (
										'allow_quote_requests' => false,
										'available_ended' => $enddate.'T22:00:00Z',
										'available_started' => $startdate.'T00:00:00Z',
										'description' => $valu->Description,
										'internal_description' => $valu->Description,
										'leadtime_to_ship' => 2,
										'logistic_class' => 'FREE',
										'max_order_quantity' => 1,
										'min_order_quantity' => 1,
										'min_quantity_alert' => 1,
										'offer_additional_fields' => 
										array (
												0 => 
													array(
													'code' => 'tax-au',
													'value' => '10',
												),
												1 => 
													array(
													'code' => 'club-catch-eligible',
													'value' => true,
												),
										),
										'package_quantity' =>(int)$valu->TotalAvailQOH,
										'price' => $valu->RetailPrice2,
										'all_prices' => 
										array (
										0 => 
										array (
											'channel_code' => 'US',
											'discount_end_date' => $enddate.'T22:00:00Z',
											'discount_start_date' => $startdate.'T00:00:00Z',
											'unit_discount_price' => (int)$valu->SpecialPrice,
											'unit_origin_price' => (int)$valu->RetailPrice2
											
											
										),
										),
										'product_id' => $barcode_not_set,
										'product_id_type' => strtoupper($product_ref_type),
										'product_tax_code' => 'tax',
										'quantity' => (int)$valu->TotalAvailQOH,
										'shop_sku' => 'Offer_SKU_'.$remove_sku_hifans,
										'state_code' => '11',
										'update_delete' => 'update',
									),
									),
								);

			///api call for create offer
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => SITEURL."/offers",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => json_encode($create_offer_array),
				CURLOPT_HTTPHEADER => array(
				"accept: application/json",
				"authorization: ".APIKEY,								
				"content-type: application/json",
				),
			));
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
			if ($err)
			{
				//eresponse error in offer create
				echo "cURL Error #:" . $err;
			} 
			else
			{
				//response success for offer create
				echo "offer";
				print_r($response);
				$offerresponse=json_decode($response,true);
				$importid=$offerresponse['import_id'];
			}

			$select_sku2="SELECT * from product_import where product_id='".$valu->SKU."'";
			$row_sku2=$conn->query($select_sku2);
			if(mysqli_num_rows($row_sku2) > 0)
			{
				//update product id ,import id of catch,barcode in datbase if already exist
				echo $update ="UPDATE `product_import` set
													`product_id`='".$valu->SKU."',
													`barcode` ='".$barcode_not_set."',
													`status`= 0,
													`date` = now(),
													import_id='$importid',
													`type`='offer' where `product_id`='".$valu->SKU."'
												"; 
				mysqli_query($conn,$update);  
			}
			else
			{
				//insert product id ,import id of catch,barcode in datbase if already exist
				echo $update ="INSERT into `product_import` set
				`product_id`='".$valu->SKU."',
					`barcode` ='".$barcode_not_set."',
				`status`= 0,
				`date` = now(),
				import_id='$importid',
				`type`='offer'
				"; 
				mysqli_query($conn,$update);  

			}
						
		}
		else
		{ 
			///////item or product create /////////

			$params_hwe = array(
			"AuthenticationInfo" => $auth,
			"CategoryID" =>$valu->CategoryID
			);
			$response_hwe = $client->GetCategoryByID($params_hwe);
			foreach($response_hwe as $category)
			{
				$category_name = $category->Name;
			}
			
			$params_hwe_hwe = array(
				"AuthenticationInfo" => $auth,
				"BrandID" =>$valu->BrandID
				);

			//get brand name by brand id
			$response_hwe_hwe = $client->GetBrandByID($params_hwe_hwe);
			foreach($response_hwe_hwe as $brand)
			{
				$brand_name='';
				if($brand->Name =='')
				{
					
					$brand_name ='unbranded';
				}
				else
				{
					$brand_name = $brand->Name;
				}
			}
			echo "brand id : ".$valu->BrandID.'end'.$brand_name;
			
			unset($img_url);

			$img_url = array();
			
			//images url save in array
			foreach($valu->Images as $key_hwe => $item_image)
			{

				foreach($item_image as $key_hwe => $image_data_hwe)
				{
				
					$img_url1 = $image_data_hwe;
					$img_url[] = $img_url1->URL;
					

				}
			
			}

			$colour ='';
			$gender='';
			$TotStnWeight='';

			//
			foreach($valu->ISDs->ItemISD as $isd_value)
			{
				if( $isd_value->Name == 'Metal Colour') 
				{
					$colour =$isd_value->Value;
				}
				if($isd_value->Name =='Gender') 
				{
					$gender =$isd_value->Value;
				}
				if($isd_value->Name == 'TotStnWeight') 
				{
					$TotStnWeight =$isd_value->Value;
				} 
				if($isd_value->Name == 'Metal Type') 
				{
					$Metal_type =$isd_value->Value;
				} 
				
			}
			$Catch_sub_cats=$valu->ID4;

			if($img_url[0] =='') 
			{
				$img_url[0]=Client_site_url.'/eweb_products_import/img/product_image.jpg';
				
			}  
				
			$Barcode =$valu->Barcode;
			$remove_spaces =str_replace(' ', '', $Barcode);
			$remove_hifans =str_replace('-', '', $remove_spaces); 

			if(isset($brand_name) && $brand_name !='' && $valu->Barcode != '')
			{
				$barcode_not_set =$valu->Barcode;
				$product_ref_type='mpn';
			}

			if(is_numeric($remove_hifans))
			{        
				$count_barcode_digit=strlen($remove_hifans);
			}
			if($valu->Barcode != '' && $count_barcode_digit == 12)
			{
				$barcode_not_set =$valu->Barcode;
				$product_ref_type='upc';
			}
			else if($valu->Barcode != '' && $count_barcode_digit == 13)
			{
				$barcode_not_set =$valu->Barcode;
				$product_ref_type='ean';
			}
			else
			{
				$barcode_not_set =$valu->SKU;
				$product_ref_type='mpn';
			}
				
		

			$Catch_cell_battery_check =$valu->ID2;
			if($Catch_cell_battery_check == 'BCBYes')
			{
			$cell_battery_value = 'Yes';
			}
			else
			{
			$cell_battery_value = 'No';
			}
			echo "Catch_sub_cats : ".$Catch_sub_cats.'<br>';

			//array for product import
			$data = array (
							$Catch_sub_cats,
							$valu->SKU,
							$valu->ShortMarketingDescription,  
							$barcode_not_set,
							$product_ref_type,
							$valu->MarketingDescription.'<br>'.$colour.'\n'.$gender.'\n'.$Metal_type,      
							$brand_name,
							'11',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							$img_url[0],
							$img_url[1],
							$img_url[2],
							$img_url[3],
							$img_url[4],
							$img_url[5],
							$img_url[6],
							$img_url[7],
							$img_url[8],
							$img_url[9],   
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							$TotStnWeight, 
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							$valu->DesignNum,
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'', 
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							$cell_battery_value,
							'',
							'',
							''
							
							);

						
							fputcsv($fp, $data);
							$productidarray[] =$valu->SKU;	
							$barcodearray[] =$barcode_not_set;	

							//prooduct import update data  import id ,product id etc
							$select_sku3="SELECT * from product_import where product_id='".$valu->SKU."'";
							$row_sku3=$conn->query($select_sku3);
							if(mysqli_num_rows($row_sku3) > 0)
							{
							$update ="UPDATE `product_import` set
															`product_id`='".$valu->SKU."',
															`status`= 0,
															`barcode`='".$barcode_not_set."',
															`date` = now() where `product_id`='".$valu->SKU."'
														"; 
							mysqli_query($conn,$update); 
							}
							else
							{

									//prooduct import save data  import id ,product id etc
								$update ="INSERT into `product_import` set
																`product_id`='".$valu->SKU."',
																`status`= 0,
																`barcode`='".$barcode_not_set."',
																`date` = now()
															"; 
								mysqli_query($conn,$update);  
							}  
				
		}
		 	  
}
if(fclose($fp))
{
	echo "created";
}
else
{
	echo "error";
}
	if(count( $productidarray)>0)
	{
				$implode_product_id =implode(',',$productidarray);
                $implode_barcode =implode(',',$barcodearray);
				echo "file url :-".$file_name_with_full_path=dirname(__DIR__).'/eweb_products_import/csv/product_import.csv';
	
				if (function_exists('curl_file_create')) 
				{ // php 5.5+
				  $cFile = curl_file_create($file_name_with_full_path);
				}
				else 
				{ 
				  $cFile = '@' . realpath($file_name_with_full_path);
				}
				$postData = array(
					'file' => $cFile,
					'operator_format'=>''
				);
				///imoprt product on catch by api
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => SITEURL."/products/imports",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS => $postData,
				  CURLOPT_HTTPHEADER => array(
								"authorization: ".APIKEY								
				  ),
				));
				$response = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				if ($err) {
				  echo "cURL Error #:" . $err;
				} else {
				  echo "not file import-".$response;
				}
				 $import_id_hwe =json_decode($response,true);
				 $import_id =$import_id_hwe['import_id'];
				 $update_hwe ="UPDATE `product_import` set
													   `import_id`='".$import_id."',
														`barcode`='".$implode_barcode."',
													   `status`= 0,
													   `date` = now()
													   where product_id IN('".$implode_product_id."')
													";  
				 mysqli_query($conn,$update_hwe);
				//product count query
				 $select_count_hwe ="SELECT COUNT(*) as total_count from `product_limit`";
				 $row_count_hwe =$conn->query($select_count_hwe);
				 $result_count_hwe=mysqli_fetch_assoc($row_count_hwe);
				$count_total = $result_count_hwe['total_count'];
				if($count_total >0)
				{
					$update_hwe_hwe ="UPDATE `product_limit` set
													   `count`='".$break_point."',
													   `created` = now()
													   where id=1
													";  
				   mysqli_query($conn,$update_hwe_hwe);
				}
				else
				{
					$update_hwe_hwe ="UPDATE `product_limit` set
													   `count`=0,
													   `created` = now()
													  where id=1 
													";  
				   mysqli_query($conn,$update_hwe_hwe);   
				} 
	}

	?>
	 <script>
        window.location.replace('allActive.php');
    </script>
     <?php

}
require 'footer.php';