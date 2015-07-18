<?php 

/******************************/
//	Cron tab information
// For every 30 min
// */30 * * * * php filelocation /dev/null 2>&1>
/******************************/

$host = "localhost";
$username = "root";
$password = "root";
$dbname = "Funfest";

$db = mysql_connect($host,$username,$password);

if(!$db){
  echo 'error in db';
}

$db_sel = mysql_select_db($dbname);

if(!$db_sel){
  echo 'error in db';
}

$query = 'select order_id,vendor_id from orders where status = "neworder" and created_at like '.date('Y-m-d',time()).'%"';//"2014-11-03%"';//

$res = mysql_query($query);

while ($temp = mysql_fetch_array($res))
{
   $q = 'select email from users where id = '.$temp['vendor_id'];
   $oid = $temp['order_id'];
   $r = mysql_query($q);
   while ($t = mysql_fetch_array($r)) {
   		$message = "
			<h4>Order reminder</h4><br/>

			Dear vendor,<p/>
					This is a reminder mail to notify you that your order number ".$oid." is still not yet initiated.<br/>
					Please can you check and verify the order details at Funfest.com and initiate the process.<br/><br/>

			Happy vendoring with Funfest.<br/>

			Thanks,<br/>
			care@Funfest.com <br/>";
   		mail($t['email'], 'New order reminder', $message);
   }
}

?>
