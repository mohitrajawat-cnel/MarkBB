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

    //Set up client details
    $ClientNum      = '7056';                 // <-- Change to the client number
    $Password       = 'E7303576';             // <-- Change to the supplied password
    $SecurityCode   = 'C39542A06A4117 ';        // <-- Change to the supplied security code

    //---------------------------------------[ Basic Webservice Requirements ]------------------------------------------
    //Webservice Requirements
    $webserviceUrl  = 'http://eweb.retailedgeconsultants.com/eWebService.svc?singleWsdl';


    //Create Authentication Class
    class AuthInfo
    {
        public function __construct($ClientNum, $Password, $SecurityCode)
        {
            $this->ClientNum = $ClientNum;
            $this->Password = $Password;
            $this->SecurityCode = $SecurityCode;
        }
    }

    //Create New instance using supplied credentials
    $auth = new AuthInfo($ClientNum, $Password, $SecurityCode);

    //Prepare the webservice
    $client = new SoapClient($webserviceUrl);
