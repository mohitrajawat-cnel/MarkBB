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
require_once('config.php');
require 'head.php';

?>


<div class="card" style="">
    <div class="card-header">
        Example eWeb SOAP Service Calls
    </div>
    <ul class="list-group list-group-flush">

        <li class="list-group-item">
            <a href="test.php">Test</a>: A basic request to verify that the connection is valid and working. This does not require authentication.
        </li>
        <li class="list-group-item">
            <a href="lastUpload.php">Last Uploaded</a>: A basic request that does require authentication.
        </li>

        <li class="list-group-item">
            <a href="allActive.php">All Active</a>: Return all active items. No <strong>Search</strong> parameters required.
        </li>

        <li class="list-group-item">
            <a href="searchBySKU.php">Search By SKU</a>: Fetch specific item by SKU. Basic <strong>Search</strong> parameter required.
        </li>

        <li class="list-group-item">
            <a href="searchByText.php">Search By Text</a>: Search for items by String. Complex <strong>Search</strong> parameter required.
        </li>

        <li class="list-group-item">
            <a href="searchByPrice.php">Search By Price</a>: Search for items by Decimal. Complex <strong>Search</strong> parameter required.
        </li>

        <li class="list-group-item">
            <a href="webOrder.php">Web Order</a>: Create a Web Order.
        </li>
    </ul>
</div>


<?php
require 'footer.php';
