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


//----------------------------------------[ Search For Item By Price ]------------------------------------------
//Set the search parameters
$searchData = array(
    "SearchField" => "Price",
    "SearchOp" => 'EqualsOp',
    "Value" => 299
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
        "SearchBaseParam" => new SoapVar($parm, SOAP_ENC_OBJECT, "ns1:SearchDecimalParam")
    )
);

//Call the SOAP webservice
$response = $client->GetActiveItems($params);
?>
<h2>Get Items by Search (Decimal: Price)</h2>
<table class="table table-striped">
    <tr>
        <th>Function</th>
        <th>Sent data</th>
        <th>Returned Data</th>
    </tr>
    <tr>
        <td>GetActiveItems</td>
        <td>Authentication Details,<br />Search Parameter:<br /><br /><?php print_r($searchData) ?></td>
        <td>
            <?php
            $total = count($response->GetActiveItemsResult->ActiveItem);
            print $total . ' Items Returned<br />';
            print '<strong>Last Item--------------------------------------------------</strong><br />';
            print '<strong>Description:</strong> ' . $response->GetActiveItemsResult->ActiveItem[$total - 1]->Description . '<br />';
            print '<strong>Price: $</strong>' . $response->GetActiveItemsResult->ActiveItem[$total - 1]->Price . '<br />';
            print '<img src="' . $response->GetActiveItemsResult->ActiveItem[$total- 1]->Images->ItemImage->URL . '" style="width: 80px; height: 80px;"/>';

            ?>
        </td>
    </tr>
</table>

<?php
require 'footer.php';
