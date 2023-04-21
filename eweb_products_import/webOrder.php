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


//----------------------------------------[ Creating a Web Order ]------------------------------------------

//Set up a test web order with minimal details
//A single order may have multiple WebOrderLines
class WebOrderLine
{
    public function __construct()
    {
        $this->LineNum          = 1;
        $this->CategoryID       = 1;
        $this->StockNum         = 934;
        $this->Quantity         = 1;
        $this->UnitFullPrice    = 449;
        $this->UnitFullTax      = 0;
        $this->UnitSellPrice    = 449;
        $this->UnitSellTax      = 0;
        $this->IsNote           = false;
    }
}

class WebOrder
{
    public function __construct()
    {
        $this->OrderID              = time();       //needs to be unique - created by web application
        $this->StoreID              = 1;
        $this->CustomerID           = '12345674896';
        $this->CustomerFirstName    = 'Fred';
        $this->CustomerLastName     = 'Flintstone';
        $this->DeliveryType         = 'Pickup';
        $this->ShippingPrice        = 449;
        $this->ShippingPriceExTax   = 449;
        $this->ShippingTax          = 0;
        $this->TotalFullPrice       = 449;
        $this->TotalFullPriceExTax  = 449;
        $this->TotalFullTax         = 0;
        $this->TotalSellPrice       = 449;
        $this->TotalSellPriceExTax  = 449;
        $this->TotalSellTax         = 0;
        $this->Lines                = array(new WebOrderLine());
    }
}
$order = new WebOrder();

//Add order to parameters
$params = array(
    "AuthenticationInfo"  => $auth,
    "OrderToUpload"       => $order
);

//Include try catch to manage errors, if any
try {
    $response = $client->__soapCall("UploadTestWebOrder", array($params));
} catch (Exception $err) {
    //Handle the response appropriately
    echo 'Caught exception: ',  $err->getMessage(), "\n";
    die();
}
?>

<h2>Upload Web Order Test</h2>
<table class="table table-striped">
    <tr>
        <th>Function</th>
        <th>Sent data</th>
        <th>Returned Data</th>
    </tr>
    <tr>
        <td>UploadTestWebOrder</td>
        <td>Authentication Details & Order Details</td>
        <td>
            <?php
            print 'No response = Success. Try/catch should handle any errors';
            ?>
        </td>
    </tr>
</table>

<?php
require 'footer.php';
