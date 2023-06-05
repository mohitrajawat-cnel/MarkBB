<?php
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
$response = $client->GetAllDeletedItems($params);

// print_r($response);
 //die("fdgdfg");
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


<?php
$response_get_active_item = $client->GetActiveItems($params);
foreach($response->GetAllDeletedItemsResult->DeletedItem as $key => $valu_deleted_item)
{
	// $valu_sku_hwe = "001-019-04422";
   
    foreach($response_get_active_item->GetActiveItemsResult->ActiveItem as $key_active_item => $valu)
    {

		// $valu_deleted_item->SKU
        if($valu_deleted_item->SKU != $valu->SKU)
        {
            echo "offer not created for this sku : ".$valu->SKU."<br><br>";
            continue;
        }
		
		  $select ="SELECT * from `product_import` where product_id='".$valu->SKU."'";
						  $row =$conn->query($select);
						$result=mysqli_fetch_assoc($row);
						if($result['type']!="offer")
						{
							continue;	
						}



    //if($valu->SKU == '001-020-02336')
    //  if($valu->SKU == '001-019-04166')

    // {
        

        
    // 	echo "<pre>";
    // 	print_r($valu);
    // 	echo "</pre>";
    // 	die("fgffg");
    // }

			$Catch_sub_cats=$valu->ID4;
            if($Catch_sub_cats =='' || is_numeric(trim($Catch_sub_cats)))
			{
                
              continue;
			}
            echo "<hr>";
            echo "DesignNum:".$valu->DesignNum;
            echo "<br>";
			echo "Barcode:".$valu->Barcode;
            echo "<br>";
            echo "CategoryID:".$Catch_sub_cats.' - '.$category_name;
            echo "<hr>";


					 if($valu->Barcode != '' && is_numeric(trim($valu->Barcode)) == 12)
					 {
						$barcode_not_set =$valu->Barcode;
						$product_ref_type='sku';
					 }
					 else if($valu->Barcode != '' && is_numeric(trim($valu->Barcode)) == 13)
					 {
						$barcode_not_set =$valu->Barcode;
						$product_ref_type='ean';
					 }
					else
                     {
						$barcode_not_set =$valu->DesignNum;
						$product_ref_type='sku';
					 }
                    //$news_sku = '001-019-04147';

                    //$sku_imported =str_replace('-', '', $news_sku); 

            //    echo SITEURL;

		    //         $curl = curl_init();
			// 		curl_setopt_array($curl, array(
			// 		  CURLOPT_URL => SITEURL."products/?product_references=EAN|".$news_sku,
			// 		  CURLOPT_RETURNTRANSFER => true,
			// 		  CURLOPT_ENCODING => "",
			// 		  CURLOPT_MAXREDIRS => 10,
			// 		  CURLOPT_TIMEOUT => 30,
			// 		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			// 		  CURLOPT_CUSTOMREQUEST => "GET",
			// 		  CURLOPT_HTTPHEADER => array(
			// 			"accept: application/json",
			// 			"authorization: ".trim(APIKEY)
			// 		  ),
			// 		));
			// 		$response = curl_exec($curl);
			// 		$err = curl_error($curl);
			// 		curl_close($curl);
			// 		$responsejsondecode=json_decode($response,true);

   

                    // if($responsejsondecode['total_count'] == 0)
                    // {
                    //     $curl = curl_init();
                    //     curl_setopt_array($curl, array(
                    //     CURLOPT_URL => SITEURL."products/?product_references=UPC|".$news_sku,
                    //     CURLOPT_RETURNTRANSFER => true,
                    //     CURLOPT_ENCODING => "",
                    //     CURLOPT_MAXREDIRS => 10,
                    //     CURLOPT_TIMEOUT => 30,
                    //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    //     CURLOPT_CUSTOMREQUEST => "GET",
                    //     CURLOPT_HTTPHEADER => array(
                    //         "accept: application/json",
                    //         "authorization: ".trim(APIKEY)
                    //     ),
                    //     ));
                    //     $response = curl_exec($curl);
                    //     $err = curl_error($curl);
                    //     curl_close($curl);
                    //     $responsejsondecode=json_decode($response,true);

                    //     print_r($responsejsondecode);

                    //     die("rohit");
                    // }
             
					//   if($responsejsondecode['total_count']!= 0)
					//   {
echo "<br>";
						  $startdate=date("Y-m-d");
				          $enddate=date("Y-m-d",strtotime('+1 months'));
						
                         
							$remove_sku_hifans =str_replace('-', '', $valu->SKU); 
							//if(mysqli_num_rows($row) ==0)
							//{
								$Barcode =$valu->Barcode;
								$remove_spaces =str_replace(' ', '', $Barcode);
								$remove_hifans =str_replace('-', '', $remove_spaces); 
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
									$product_ref_type='sku';
								 }
								
                            $create_offer_array=

												array (
												  'offers' => 
												  array (
													0 => 
													array (
													  'allow_quote_requests' => false,
													  'available_ended' => $enddate.'T22:00:00Z',
													  'available_started' => $startdate.'T00:00:00Z',
													  'description' => $valu->Description,
													  /*'discount' => 
													  array (
														'end_date' => '2019-05-31T22:00:00Z',
														'price' => 49
														),
														'start_date' => '2019-03-31T22:00:00Z',
													  ),*/
													  'internal_description' => $valu->Description,
													  'leadtime_to_ship' => 8,
													  'logistic_class' => 'FLAT',
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
													  'price' => $valu->RetailPrice,
													 // 'price_additional_info' => 'Apply Discount prices',
													  'all_prices' => 
													  array (
														0 => 
														array (
														  'channel_code' => 'US',
														  'discount_end_date' => $enddate.'T22:00:00Z',
														  'discount_start_date' => $startdate.'T00:00:00Z',
														  'unit_discount_price' => (int)$valu->SpecialPrice,
														  'unit_origin_price' => (int)$valu->RetailPrice
														  
														  
														),
													  ),
													   'product_id' => $barcode_not_set,
													   'product_id_type' => strtoupper($product_ref_type),
													   'product_tax_code' => 'tax',
													   'quantity' => (int)$valu->TotalAvailQOH,
													   'shop_sku' => 'Offer_SKU_'.$remove_sku_hifans,
													   'state_code' => '11',
													   'update_delete' => 'delete',
													),
												  ),
												);
    
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
							echo $response = curl_exec($curl);
							$err = curl_error($curl);
							curl_close($curl);
							if ($err)
							 {
							  echo "cURL Error #:" . $err;
							 } 
							else
							 {
                                //print_r($create_offer_array);
								echo "offer";
							  print_r($response);
								 $offerresponse=json_decode($response,true);
								 $importid=$offerresponse['import_id'];

                                 echo $delete ="DELETE from `product_import` where `product_id`='".$valu->SKU."'"; 
							    mysqli_query($conn,$delete);  

                                echo "<br></hr>";
							}
							// $select_sku2="SELECT * from product_import where product_id='".$valu->SKU."'";
							// $row_sku2=$conn->query($select_sku2);
							// if(mysqli_num_rows($row_sku2) > 0)
							// {
							// 	echo $update ="UPDATE `product_import` set
							// 									   `product_id`='".$valu->SKU."',
                            //                                         `barcode` ='".$barcode_not_set."',
							// 									   `status`= 0,
							// 									   `date` = now(),
							// 									   import_id='$importid',
							// 									   `type`='offer' where `product_id`='".$valu->SKU."'
							// 									"; 
							//    mysqli_query($conn,$update);  
							// }
							// else
							// {
							// 	echo $update ="INSERT into `product_import` set
							// 	`product_id`='".$valu->SKU."',
							// 	 `barcode` ='".$barcode_not_set."',
							// 	`status`= 0,
							// 	`date` = now(),
							// 	import_id='$importid',
							// 	`type`='offer'
							//  "; 
							// 	mysqli_query($conn,$update);  

							// }
								 
							//}  
					//}

    }
                    die();

        
				
}
require 'footer.php';