<?php echo('<?xml version="1.0" encoding="UTF-8"?>'); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<!--responsive or smartphone-->
<meta name="format-detection" content="telephone=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<?php
	// set viewport by user agent.
	require_once 'ua.class.php';
	$ua = new UserAgent();
	if($ua->set() === 'tablet') :
		// set width when you use the tablet
		$width = '1024px';
?>
<meta content="width=<?php echo $width; ?>" name="viewport">
<?php else: ?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
<?php endif; ?>
<!--responsive or smartphone-->

<?php include(APP_PATH."libs/argument.php"); ?>
<title><?php echo $titlepage; ?></title>
<meta name="description" content="<?php echo $desPage; ?>">
<meta name="keywords" content="<?php echo $keyPage; ?>">

<!--facebook-->
<meta property="og:title" content="<?php echo $titlepage; ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo 'http://';echo $_SERVER["SERVER_NAME"];echo $_SERVER["SCRIPT_NAME"];echo $_SERVER["QUERY_STRING"]; ?>">
<meta property="og:image" content="<?php echo APP_URL; ?>common/img/other/fb_image.jpg">
<meta property="og:site_name" content="">
<meta property="og:description" content="<?php echo $desPage; ?>">
<meta property="fb:app_id" content="">
<!--/facebook-->

<!--css-->
<link rel="stylesheet" href="<?php echo APP_URL; ?>common/css/base.css" media="all">
<link rel="stylesheet" href="<?php echo APP_URL; ?>common/css/style.css" media="all">
<link rel="stylesheet" href="<?php echo APP_URL; ?>common/css/media.css" media="all">
<link rel='stylesheet' href='https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/wtf-forms.css'>
<!--/css-->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700,700i,900" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<!--favicons-->
<link rel="icon" href="<?php echo APP_URL; ?>common/img/icon/favicon.ico" type="image/vnd.microsoft.icon">
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo APP_URL; ?>common/img/icon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?php echo APP_URL; ?>common/img/icon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo APP_URL; ?>common/img/icon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo APP_URL; ?>common/img/icon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo APP_URL; ?>common/img/icon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo APP_URL; ?>common/img/icon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo APP_URL; ?>common/img/icon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo APP_URL; ?>common/img/icon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo APP_URL; ?>common/img/icon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo APP_URL; ?>common/img/icon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo APP_URL; ?>common/img/icon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?php echo APP_URL; ?>common/img/icon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo APP_URL; ?>common/img/icon/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

