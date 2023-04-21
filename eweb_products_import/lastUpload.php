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


//----------------------------------------[ Get Last Uploaded Time ]------------------------------------------


//Use the authentication class, and pass to the soap call
$params = array(
    "AuthenticationInfo" => $auth
);

//Optional way to call SOAP service
$response = $client->__soapCall("GetLastUploadDateTime", array($params));

?>
<h2>Get Last Upload DateTime Test</h2>
<table class="table table-striped">
    <tr>
        <th>Function</th>
        <th>Sent data</th>
        <th>Returned Data</th>
    </tr>
    <tr>
        <td>GetLastUploadDateTime</td>
        <td>Authentication Details</td>
        <td><?php print $response->GetLastUploadDateTimeResult; ?></td>
    </tr>
</table>

<?php
require 'footer.php';
