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


//---------------------------------------[ Test Call - No Authentication Required ]-------------------------------------------


//First Test, does webservice respond with no authentication
$params = array(
    "EchoString" => "If you see this twice all tested ok"
);

//Call the Test webservice
$response = $client->Test($params);

?>
<h2>Webservice Test</h2>
<table class="table table-striped">
    <tr>
        <th>Function</th>
        <th>Sent data</th>
        <th>Returned Data</th>
    </tr>
    <tr>
        <td>Test</td>
        <td><?php print $params['EchoString']; ?></td>
        <td><?php print $response->TestResult; ?></td>
    </tr>
</table>

<?php
require 'footer.php';
