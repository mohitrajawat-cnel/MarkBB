<?php

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


//----------------------------------------[ Search For Item by SKU ]------------------------------------------

//Create SKU
$sku = '001-019-00496';

//Use the authentication class, and pass to the soap call
$params = array(
    "AuthenticationInfo" => $auth,
    "SKU" => $sku
);

//Call the SOAP webservice
$response = $client->__soapCall("GetActiveItemBySKU", array($params));
?>
<h2>Get Items by SKU</h2>
<table class="table table-striped">
    <tr>
        <th>Function</th>
        <th>Sent data</th>
        <th>Returned Data</th>
    </tr>
    <tr>
        <td>GetActiveItemBySKU</td>
        <td>Authentication Details,<br />SKU:<br /><?php print_r($sku) ?></td>
        <td><b>Raw Detail at bottom of page</b><br><br><?php
			print '<strong>SKU:</strong> ' . ($sku) . '<br />';
			print '<strong>Short Marketing Description:</strong> ' . $response->GetActiveItemBySKUResult->ShortMarketingDescription . '<br />';
            print '<strong>Description:</strong> ' . $response->GetActiveItemBySKUResult->Description . '<br />';
			print '<strong>Marketing Description:</strong> ' . $response->GetActiveItemBySKUResult->MarketingDescription . '<br />';
			print '<strong>Custom/Meta Title:</strong> ' . $response->GetActiveItemBySKUResult->CustomTitle . '<br />';
			print '<strong>Custom/Meta Description:</strong> ' . $response->GetActiveItemBySKUResult->CustomDescription . '<br />';
            print '<strong>Price: $</strong>' . $response->GetActiveItemBySKUResult->Price . '<br />';
			print '<strong>Web Option Boolean 1:</strong> ' . $response->GetActiveItemBySKUResult->WebOptionBoolean1 . '<br />';
			print '<strong>Web Option Boolean 2:</strong> ' . $response->GetActiveItemBySKUResult->WebOptionBoolean2 . '<br />';
			print '<strong>Web Option Boolean 3:</strong> ' . $response->GetActiveItemBySKUResult->WebOptionBoolean3 . '<br />';
			print '<strong>Web Option Boolean 4:</strong> ' . $response->GetActiveItemBySKUResult->WebOptionBoolean4 . '<br />';
			print '<strong>Web Option Boolean 5:</strong> ' . $response->GetActiveItemBySKUResult->WebOptionBoolean5 . '<br />';
			print '<strong>Web Option Boolean 6:</strong> ' . $response->GetActiveItemBySKUResult->WebOptionBoolean6 . '<br />';
			print '<strong>Web Menu Code:</strong> ' . $response->GetActiveItemBySKUResult->WebMenuCode . '<br />';
			print '<strong>ISD1 (' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{0}->Name . '):</strong> ' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{0}->Value . '<br />';
			print '<strong>ISD2 (' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{1}->Name . '):</strong> ' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{1}->Value . '<br />';
			print '<strong>ISD3 (' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{2}->Name . '):</strong> ' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{2}->Value . '<br />';
			print '<strong>ISD4 (' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{3}->Name . '):</strong> ' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{3}->Value . '<br />';
			print '<strong>ISD5 (' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{4}->Name . '):</strong> ' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{4}->Value . '<br />';
			print '<strong>ISD6 (' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{5}->Name . '):</strong> ' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{5}->Value . '<br />';
			print '<strong>ISD7 (' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{6}->Name . '):</strong> ' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{6}->Value . '<br />';
			print '<strong>ISD8 (' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{7}->Name . '):</strong> ' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{7}->Value . '<br />';
			print '<strong>ISD9 (' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{8}->Name . '):</strong> ' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{8}->Value . '<br />';
			print '<strong>ISD10 (' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{9}->Name . '):</strong> ' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{9}->Value . '<br />';
			print '<strong>ISD11 (' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{10}->Name . '):</strong> ' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{10}->Value . '<br />';
			print '<strong>ISD12 (' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{11}->Name . '):</strong> ' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{11}->Value . '<br />';
			print '<strong>ISD13 (' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{12}->Name . '):</strong> ' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{12}->Value . '<br />';
			print '<strong>ISD14 (' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{13}->Name . '):</strong> ' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{13}->Value . '<br />';
			print '<strong>ISD15 (' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{14}->Name . '):</strong> ' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{14}->Value . '<br />';
			print '<strong>ISD16 (' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{15}->Name . '):</strong> ' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{15}->Value . '<br />';
			print '<strong>ISD17 (' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{16}->Name . '):</strong> ' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{16}->Value . '<br />';
			print '<strong>ISD18 (' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{17}->Name . '):</strong> ' . $response->GetActiveItemBySKUResult->ISDs->ItemISD{17}->Value . '<br />';
            print '<img src="' . $response->GetActiveItemBySKUResult->Images->ItemImage->URL . '" style="width: 80px; height: 80px;"/>';
            ?>
        </td>
    </tr>
</table>
<?php
	            print_r($response->GetActiveItemBySKUResult) . '<br />';?>
<?php
require 'footer.php';
