<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>WebSpeaks.in | Upload images to Facebook</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style>
html{
	font-family: "lucida grande",tahoma,verdana,arial,sans-serif;
}
.main{
	width:400px;
	margin:auto;
	border:2px solid #0066CC;
	color:#3B5998;
	padding:20px;
	font-size: 11px;
    -moz-border-radius: 4px 4px 4px 4px;
    border-radius: 4px 4px 4px 4px;
    -moz-box-shadow: 1px 1px 0 #d5d5d5;
	background: none repeat scroll 0 0 #F2F2F2;
}
.text{
	color: #777777;
	border: 1px solid #BDC7D8;
	font-size: 11px;
	height: 15px;
}
.post_but {
    background: none repeat scroll 0 0 #EEEEEE;
    border-color: #999999 #999999 #888888;
    border-style: solid;
    border-width: 1px;
    color: #333333;
    cursor: pointer;
    display: inline-block;
    font-size: 11px;
    font-weight: bold;
    padding: 2px 6px;
    text-align: center;
    text-decoration: none;
}
a{
	color:#3B5998;
}
</style>
</head>

<body>
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once 'library/facebook.php';
$facebook = new Facebook(array(
	'appId'  => '124334834389554',
	'secret' => 'e5314fa10cba04e8e2e0a0150dd50af9',
	'fileUpload' => true
));


#It can be found at https://developers.facebook.com/tools/access_token/
#Change to your token.
$access_token = 'AAABxFPWjEjIBAO4MnFf8094SlrYb5JDSW2WGBZApO7ujZAwJZBWAxMgsca6zRyZCBZAVi0KOIw68WYhIvi4NLKq1RCDcYM5vDubhZBEc8ECvfMZBUPhxuKS';

$params = array('access_token' => $access_token);

#The id of the fanpage
$fanpage = '184529821590793';

#The id of the album
$params1 = array(
	    'method' => 'fql.query',
	    'query' => "SELECT aid FROM album WHERE owner =$fanpage AND  type='wall'",
	);
	$result = $facebook->api($params1);
	
//print_r($result);
//$album_id ='184529821590793_40096';
$album_id=$result[0]['aid'];
//$album_id="'".$album_id."'";
//echo "---".$album_id."---";
//$album_id ='184579051585870';

$accounts = $facebook->api('/me/accounts', 'GET', $params);

foreach($accounts['data'] as $account) {
//echo "$accounts['d']['name']"."<br>";
	if( $account['id'] == $fanpage || $account['name'] == $fanpage ){
		$fanpage_token = $account['access_token'];
	}
}




$valid_files = array('image/jpeg', 'image/png', 'image/gif');

if(isset($_FILES) && !empty($_FILES)){
	if( !in_array($_FILES['pic']['type'], $valid_files ) ){
		echo 'Only jpg, png and gif image types are supported!';
	}else{
		$img = realpath($_FILES["pic"]["tmp_name"]);

		$args = array(
			'message' => 'test',
			//'image' => '@' . $img,
			'image' => '@' ."facebook-login.png",
			'aid' => $album_id,
			'access_token' => $fanpage_token
		);
		
		//'no_story' => 1,

		$photo = $facebook->api($album_id . '/photos', 'post', $args);
		if( is_array( $photo ) && !empty( $photo['id'] ) ){
			echo '<p><a target="_blank" href="http://www.facebook.com/photo.php?fbid='.$photo['id'].'">Click here to watch this photo on Facebook.</a></p>';
		}
	}
}

?>
	<div class="main">
		<p>Select a photo to upload on Facebook Fan Page</p>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
		<p>Select the image: <input type="file" name="pic" /></p>
		<p><input class="post_but" type="submit" value="Upload to my album" /></p>
		</form>
	</div>

</body>
</html>
