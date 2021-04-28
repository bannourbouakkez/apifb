<?php
include_once("inc/facebook.php"); //include facebook SDK
 
######### edit details ##########
$appId = '124334834389554'; //Facebook App ID
$appSecret = 'e5314fa10cba04e8e2e0a0150dd50af9'; // Facebook App Secret
$return_url = 'http://bannour.alwaysdata.net/statut/status_update.php';  //return url (url to script)
$homeurl = 'http://bannour.alwaysdata.net/statut/';  //return to home
//$fbPermissions = 'publish_stream,manage_pages';  //Required facebook permissions
$fbPermissions = 'user_events,user_location,user_notes,user_status,publish_actions,user_actions:status_emotions,user_about_me,user_activities,user_games_activity,friends_about_me,friends_activities,friends_games_activity,publish_stream,user_photos,publish_stream,read_stream,export_stream,status_update,offline_access,create_event,rsvp_event,read_mailbox,read_page_mailboxes,read_friendlists,read_requests,read_insights,user_online_presence,photo_upload,video_upload,share_item,friends_online_presence,manage_pages,publish_checkins,sms,manage_friendlists,xmpp_login,manage_notifications,ads_management,create_note';  //Required facebook permissions

##################################

//Call Facebook API
$facebook = new Facebook(array(
  'appId'  => $appId,
  'secret' => $appSecret,
  'fileUpload' => true,
  'cookie' => true
));

$fbuser = $facebook->getUser();
?>