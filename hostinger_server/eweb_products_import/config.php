<?php
date_default_timezone_set('Australia/Sydne');
//ready server site database connection
/*$host ="localhost";
$username ="ccrdskmy_markbb";
$password ="ccrdskmy_markbb";
$dbname ="ccrdskmy_markbb";*/

//live site database connection
// $host ="localhost";
// $username ="burrows";
// $password ="Jj34tfFc49Rf";
// $dbname ="burrows";

$host ="localhost";
$username ="u688797554_markbb_user";
$password ="[|[x5+p8J";
$dbname ="u688797554_markbb_db";

$conn =mysqli_connect($host,$username,$password,$dbname);
//$conn =mysqli_connect("localhost","burrows","76bWD3$SGAxE","burrows");


if($conn)
{
  //echo "success ";
}
else
{
print_r(mysqli_connect_error());
 // echo " error 145654 ";

}

//catch site site url
define("SITEURL","https://marketplace.catch.com.au/api/");

//catch site api key
define("APIKEY","1260a7e9-5906-46d6-ad0f-08fcb63d99c3");

//client site url
// define('Client_site_url','http://3.24.235.118/api');

define('Client_site_url','https://readyforyourreview.com/MarkBB');

//$api_url ="https://marketplace.catch.com.au/api/products/imports";
//$auth_key = "1260a7e9-5906-46d6-ad0f-08fcb63d99c3";

//define("SITEURL","https://catch-dev.mirakl.net/api/");
//define("APIKEY","ee0204b1-a58f-4ac1-a73e-b168a9d429c4");

//$api_url ="https://catch-dev.mirakl.net/api/products/imports";
//$auth_key = "ee0204b1-a58f-4ac1-a73e-b168a9d429c4";

?>