<?php 

$config = __DIR__ . "/config/config.ini";
$configData = parse_ini_file($config);

$settingsconfig = __DIR__ . "/config/portalsettings.ini";
$settingconfigData = parse_ini_file($settingsconfig);

$infoconfig = __DIR__ . "/config/infoandalerts.ini";
$infoconfigData = parse_ini_file($infoconfig);

error_reporting(E_ALL);
ini_set("display_errors", $configData['display_errors']);

include_once('utils/functions.php');

/* Importing Chargebee's PHP library */
require_once("lib/ChargeBee.php");


/* Environment Configuration of your Chargebee site */
ChargeBee_Environment::configure($configData['SITE_NAME'], $configData['SITE_API_KEY']);

/* Including servicePortal class */
include_once("ServicePortal.php");

/* If you have your own authentication module, add comments to the below code and use your own authentication.  */

/*
 * ***** Authentication code starts here *****
 */
include_once('Auth.php');
$authObj = new Auth();

$successMessage = isset($_GET['success']) ? filter_input(INPUT_GET, 'success') : null;
$doAction = isset($_GET['do']) ? filter_input(INPUT_GET, 'do') : null;
if( $doAction == "logout") { 
    $authObj->logout($configData);
}    

if(isset($_GET['auth_session_id']) && isset($_GET['auth_session_token'])){
    $params = array(
        'cb_auth_session_id' => filter_input(INPUT_GET,'auth_session_id'),  
        'cb_auth_session_token' => filter_input(INPUT_GET, 'auth_session_token')
    );
    $authObj->authenticateSession($params, $configData);
} 


if (!$authObj->isLoggedIn()) {
    header('Location: ' . getPortalLoginUrl($configData));
    exit;
}
/* 
 * **** Authentication code ends here **** 
 */

/*
 * If you're using your own authentication module, then the particular subscription ID should be passed 
 * in the constructor of ServicePortal object. 
 * This subscription ID will be used throughout the portal.
 */

$sub_id =  $_GET['s_id'];
if($sub_id){
  setcookie("now_id", $sub_id, time()+60*60*2);  
  $servicePortal = new ServicePortal($sub_id);
}else if($_COOKIE['now_id']){
  $servicePortal = new ServicePortal($_COOKIE['now_id']);
}else{
  if($sub_id){
    $servicePortal = new ServicePortal($sub_id);
  }else{
    $servicePortal = new ServicePortal($authObj->getSessionSubscriptionId());
  }
}

$result = ChargeBee_PortalSession::retrieve($_COOKIE['cb_portal_session_id']);
$portalSession = $result->portalSession();
$account_count = count($portalSession->linkedCustomers);

$now_url = strstr($_SERVER['REQUEST_URI'],'switch_account.php');
if($now_url == 'switch_account.php'){
   setcookie('navgate_was','true',time()+60*60*2); 
}else if($now_url != 'switch_account.php' && $account_count > 1 ){
  if(!$_COOKIE['navgate_was']){
    header('Location: ' . $configData['SITE_URL']."/".$configData['APP_PATH'].'switch_account.php');
  }
}

?>
