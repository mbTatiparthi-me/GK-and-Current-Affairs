<?php
/**
 * @author Mahesh Babu <info@godigitally.co.in>
 * @copyright Go Digitally 2020
 * @package current-affairs-quiz
 * 
 * 
 * Created using IMA BuildeRz v3
 */


/** site **/
$config["app-name"]			= "Current Affairs Quiz" ; //Write the name of your website
$config["app-desc"]			= "Current Affairs GK Quiz App" ; //Write a brief description of your website
$config["utf8"]				= true; 
$config["background"]		= "https://cdn.jsdelivr.net/wp/themes/twentyseventeen/1.1/assets/images/coffee.jpg"; 
$config["logo"]		= "https://placehold.it/200x200"; 
$config["timezone"]		= "Asia/Kolkata" ; // check this site: http://php.net/manual/en/timezones.php
$config["color"]			= "blue"; 
$config["debug"]			= false; 
$config["gzip"]			= false; //compressed page 

/** mysql **/
$config["db_host"]				= "us-cdbr-east-02.cleardb.com" ; //host
$config["db_user"]				= "b56cb747d9962d" ; //Username SQL
$config["db_pwd"]				= "fa7a108a" ; //Password SQL
$config["db_name"]			= "heroku_978ed889cbdaeea" ; //Database

/** onesignal **/
$config["onesignal_app_id"]				= "224c013a-e790-4809-a736-f9f6e38820cd" ; //Your OneSignal AppId, available in OneSignal https://documentation.onesignal.com/docs/generate-a-google-server-api-key
$config["onesignal_api_key"]			= "NjI1OWFjMDEtZmFmNi00NjlhLWE2MjEtZWYxODJhYTgzZWU2" ; //Your OneSignal ApiKey, required for push notification sender


/** DON'T EDIT THE CODE BELLOW **/
session_start();
if($config["gzip"]==true){
	ob_start("ob_gzhandler");
}
ini_set("internal_encoding", "utf-8");
date_default_timezone_set($config["timezone"]);
if(!isset($_SESSION["IS_LOGIN"])){
	$_SESSION["IS_LOGIN"] = false;
}
$app_name = $config["app-name"];
$app_desc = $config["app-desc"];
$page_title = "Welcome";
$content = $body_class = "";

if(!isset($_GET["page"])){
	$_GET["page"] = "home";
}
if($_GET["page"]==""){
	$_GET["page"] = "home";
}
if(!isset($_GET["action"])){
	$_GET["action"] = "list";
}
if($config["debug"]==true){
	error_reporting(E_ALL);
}else{
	error_reporting(0);
}

/** connect to mysql **/
$mysql = new mysqli($config["db_host"], $config["db_user"], $config["db_pwd"], $config["db_name"]);
if (mysqli_connect_errno()){
	die(mysqli_connect_error());
}

if($config["utf8"]==true){
	$mysql->set_charset("utf8");
}

switch($_GET["page"]){
	// TODO: PAGE - HOME
	case "home":
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		$page_title = "Dashboard";
		$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";
		$current_user = $_SESSION["CURRENT_USER"];
		$content = null;
		$content .= '<div class="wrapper">';
		$content .= '<header class="main-header">';
		$content .= '<a href="?" class="logo">';
		$content .= '<span class="logo-mini"><b>PN</b>L</span>';
		$content .= '<span class="logo-lg"><b>'.$app_name.'</b> Panel</span>';
		$content .= '</a>';
		$content .= '<nav class="navbar navbar-static-top">';
		$content .= '<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">';
		$content .= '<span class="sr-only">Toggle navigation</span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '</a>';
		$content .= '<div class="navbar-custom-menu">';
		$content .= '<ul class="nav navbar-nav">';
		$content .= '<li class="dropdown user user-menu">';
		$content .= '<a href="?" class="dropdown-toggle" data-toggle="dropdown">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="user-image" alt="User Image">';
		$content .= '<span class="hidden-xs">' . htmlentities(stripslashes($current_user['user_name'])).'</span>';
		$content .= '</a>';
		$content .= '<ul class="dropdown-menu">';
		$content .= '<li class="user-header">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="User Image">';
		$content .= '<p>';
		$content .= '' . htmlentities(stripslashes($current_user['user_name'])).'';
		$content .= '<small>' . htmlentities(stripslashes($current_user['user_level'])).'</small>';
		$content .= '</p>';
		$content .= '</li>';
		$content .= '<li class="user-footer">';
		$content .= '<div class="pull-left">';
		$content .= '<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>';
		$content .= '</div>';
		$content .= '<div class="pull-right">';
		$content .= '<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>';
		$content .= '</div>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '</div>';
		$content .= '</nav>';
		$content .= '</header>';
		$content .= '<aside class="main-sidebar">';
		$content .= '<section class="sidebar">';
		$content .= '<div class="user-panel">';
		$content .= '<div class="pull-left image">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="'.htmlentities(stripslashes($current_user['user_name'])).'">';
		$content .= '</div>';
		$content .= '<div class="pull-left info">';
		$content .= '<p>'.htmlentities(stripslashes($current_user['user_name'])).'</p>';
		$content .= '<a href="?"><i class="fa fa-circle text-success"></i> '.htmlentities(stripslashes($current_user['user_level'])).'</a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<ul class="sidebar-menu" data-widget="tree">';
		$content .= '<li class="header">DATA MANAGER</li>';
		$content .= '<li class="treeview active">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-sitemap"></i> <span>Categories</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=categories&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=categories&amp;action=list"><i class="fa fa-list-ul"></i> All Categories</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-book"></i> <span>Chapters</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=chapters&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=chapters&amp;action=list"><i class="fa fa-list-ul"></i> All Chapters</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-newspaper-o"></i> <span>Daily Current Affairs</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=daily&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=daily&amp;action=list"><i class="fa fa-list-ul"></i> All Daily Current Affairs</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-lightbulb-o"></i> <span>GK</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=gk&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=gk&amp;action=list"><i class="fa fa-list-ul"></i> All GK</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-briefcase"></i> <span>Jobs</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=jobs&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=jobs&amp;action=list"><i class="fa fa-list-ul"></i> All Jobs</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="header">TOOLS</li>';
		$content .= '<li><a href="?page=onesignal-sender"><i class="fa fa-send"></i> <span>OneSignal Sender</span></a></li>';
		$content .= '<li class="header">USERS</li>';
		$content .= '<li><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>';
		$content .= '</ul>';
		$content .= '</section>';
		$content .= '</aside>';
		$content .= '<div class="content-wrapper">';
		/** breadcrumb **/
		$content .= '<section class="content-header">';
		$content .= '<h1>Dashboard</h1>';
		$content .= '<ol class="breadcrumb">';
		$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
		$content .= '<li class="active">Dashboard</li>';
		$content .= '</ol>';
		$content .= '</section>';
		/** content **/
		$content .= '<section class="content">';
		$content .= '<div class="box">';
		$content .= '<div class="box-header with-border">';
		$content .= '<h3 class="box-title">Welcome</h3>';
		$content .= '<div class="box-tools pull-right">';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="box-body">';
		$content .= '<div class="well">';
		$content .= '<h2>Welcome to</h2><h1>'.$app_name.'!</h1>';
		$content .= '<p class="lead">'.$app_desc.'</p>';
		$content .= '</div>';
		$content .= '<div class="row">';
		
		/** count categories data **/
		$sql_query = "SELECT COUNT(*) AS `total` FROM `categories` LIMIT 0,1" ;
		$result = $mysql->query($sql_query);
		$count = $result->fetch_array();
		$content .= '<div class="col-lg-3 col-xs-6">';
		$content .= '<div class="small-box bg-blue">';
		$content .= '<div class="inner">';
		$content .= '<h3>'.$count["total"].'<sup style="font-size: 20px">items</sup></h3>';
		$content .= '<p>Categories</p>';
		$content .= '</div>';
		$content .= '<div class="icon">';
		$content .= '<i class="fa fa-sitemap"></i>';
		$content .= '</div>';
		$content .= '<a href="?page=categories&amp;action=list" class="small-box-footer">';
		$content .= 'More <i class="fa fa-arrow-circle-right"></i>';
		$content .= '</a>';
		$content .= '</div>';
		$content .= '</div>';
		
		/** count chapters data **/
		$sql_query = "SELECT COUNT(*) AS `total` FROM `chapters` LIMIT 0,1" ;
		$result = $mysql->query($sql_query);
		$count = $result->fetch_array();
		$content .= '<div class="col-lg-3 col-xs-6">';
		$content .= '<div class="small-box bg-yellow">';
		$content .= '<div class="inner">';
		$content .= '<h3>'.$count["total"].'<sup style="font-size: 20px">items</sup></h3>';
		$content .= '<p>Chapters</p>';
		$content .= '</div>';
		$content .= '<div class="icon">';
		$content .= '<i class="fa fa-book"></i>';
		$content .= '</div>';
		$content .= '<a href="?page=chapters&amp;action=list" class="small-box-footer">';
		$content .= 'More <i class="fa fa-arrow-circle-right"></i>';
		$content .= '</a>';
		$content .= '</div>';
		$content .= '</div>';
		
		/** count daily data **/
		$sql_query = "SELECT COUNT(*) AS `total` FROM `daily` LIMIT 0,1" ;
		$result = $mysql->query($sql_query);
		$count = $result->fetch_array();
		$content .= '<div class="col-lg-3 col-xs-6">';
		$content .= '<div class="small-box bg-green">';
		$content .= '<div class="inner">';
		$content .= '<h3>'.$count["total"].'<sup style="font-size: 20px">items</sup></h3>';
		$content .= '<p>Daily Current Affairs</p>';
		$content .= '</div>';
		$content .= '<div class="icon">';
		$content .= '<i class="fa fa-newspaper-o"></i>';
		$content .= '</div>';
		$content .= '<a href="?page=daily&amp;action=list" class="small-box-footer">';
		$content .= 'More <i class="fa fa-arrow-circle-right"></i>';
		$content .= '</a>';
		$content .= '</div>';
		$content .= '</div>';
		
		/** count gk data **/
		$sql_query = "SELECT COUNT(*) AS `total` FROM `gk` LIMIT 0,1" ;
		$result = $mysql->query($sql_query);
		$count = $result->fetch_array();
		$content .= '<div class="col-lg-3 col-xs-6">';
		$content .= '<div class="small-box bg-purple">';
		$content .= '<div class="inner">';
		$content .= '<h3>'.$count["total"].'<sup style="font-size: 20px">items</sup></h3>';
		$content .= '<p>GK</p>';
		$content .= '</div>';
		$content .= '<div class="icon">';
		$content .= '<i class="fa fa-lightbulb-o"></i>';
		$content .= '</div>';
		$content .= '<a href="?page=gk&amp;action=list" class="small-box-footer">';
		$content .= 'More <i class="fa fa-arrow-circle-right"></i>';
		$content .= '</a>';
		$content .= '</div>';
		$content .= '</div>';
		
		/** count jobs data **/
		$sql_query = "SELECT COUNT(*) AS `total` FROM `jobs` LIMIT 0,1" ;
		$result = $mysql->query($sql_query);
		$count = $result->fetch_array();
		$content .= '<div class="col-lg-3 col-xs-6">';
		$content .= '<div class="small-box bg-blue">';
		$content .= '<div class="inner">';
		$content .= '<h3>'.$count["total"].'<sup style="font-size: 20px">items</sup></h3>';
		$content .= '<p>Jobs</p>';
		$content .= '</div>';
		$content .= '<div class="icon">';
		$content .= '<i class="fa fa-briefcase"></i>';
		$content .= '</div>';
		$content .= '<a href="?page=jobs&amp;action=list" class="small-box-footer">';
		$content .= 'More <i class="fa fa-arrow-circle-right"></i>';
		$content .= '</a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</section>';
		$content .= '</div>';
		$content .= '<footer class="main-footer">';
		$content .= '<div class="pull-right hidden-xs">';
		$content .= '<b>Version</b> 01.01.01';
		$content .= '</div>';
		$content .= '<strong>Copyright &copy; '.date("Y").' <a href="http://godigitally.co.in">Go Digitally</a>.</strong> All rights reserved.';
		$content .= '</footer>';
		$content .= '</div>';
		break;
	// TODO: PAGE - LOGIN
	case "login":
		$page_title = "Login";
		$body_class = "hold-transition login-page";
		$notification = '<p class="login-box-msg text-success">Sign in to start your session</p>';
		if(isset($_POST["submit"])){
			if(filter_var($_POST["user"]["email"], FILTER_VALIDATE_EMAIL)) {
				$user_email = addslashes($_POST["user"]["email"]);
				$user_password = sha1("imabuilder" . $_POST["user"]["password"]);
				$sql_query = "SELECT * FROM `users` WHERE `user_email` = '{$user_email}' AND `user_password` = '{$user_password}' AND `user_level` = 'admin' AND `user_status` = 'active'" ;
				$result = $mysql->query($sql_query);
				$current_user = $result->fetch_array();
				if(isset($current_user["user_email"])){
					$_SESSION["IS_LOGIN"] = true;
					$_SESSION["CURRENT_USER"]["user_id"] = $current_user["user_id"];
					$_SESSION["CURRENT_USER"]["user_name"] = $current_user["user_name"];
					$_SESSION["CURRENT_USER"]["user_first_name"] = $current_user["user_first_name"];
					$_SESSION["CURRENT_USER"]["user_last_name"] = $current_user["user_last_name"];
					$_SESSION["CURRENT_USER"]["user_email"] = $current_user["user_email"];
					$_SESSION["CURRENT_USER"]["user_level"] = $current_user["user_level"];
					header("Location: ?page=home");
				}else{
					$notification =  '<p class="login-box-msg text-danger">Incorrect email or password, please try again</p>';
				}
			}else{
				$notification =  '<p class="login-box-msg text-danger">Incorrect email or password, please try again!</p>';
			}
		}
		$content = null;
		$content .= '<div class="login-box">';
		$content .= '<div class="login-logo">';
		$content .= '<img src="'.$config["logo"].'?1603369358" />';
		$content .= '<br/><a href="?"><b>'. $app_name .'</b> Panel</a>';
		$content .= '</div>';
		$content .= '<div class="login-box-body">';
		$content .= '<h4 class="text-center">Admin</h4>';
		$content .= $notification;
		$content .= '<form action="" method="post" autocomplete="off">';
		$content .= '<div class="form-group has-feedback">';
		$content .= '<input type="email" name="user[email]" class="form-control" placeholder="Email" autocomplete="off">';
		$content .= '<span class="glyphicon glyphicon-envelope form-control-feedback"></span>';
		$content .= '</div>';
		$content .= '<div class="form-group has-feedback">';
		$content .= '<input type="password" name="user[password]" class="form-control" placeholder="Password" autocomplete="off">';
		$content .= '<span class="glyphicon glyphicon-lock form-control-feedback"></span>';
		$content .= '</div>';
		$content .= '<div class="row">';
		$content .= '<div class="col-xs-8">';
		$content .= '</div>';
		$content .= '<div class="col-xs-4">';
		$content .= '<button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</form>';
		$content .= '</div>';
		$content .= '</div>';
		break;
	// TODO: PAGE - LOGOUT
	case "logout":
		unset($_SESSION["IS_LOGIN"]);
		unset($_SESSION["CURRENT_USER"]);
		//session_destroy();
		header("Location: ?page=login");
		break;
	// TODO: PAGE - CATEGORIES
	case "categories":
		$notification = null;
		if(isset($_GET["notice"])){
			switch($_GET["notice"]){
				case "success-delete":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully deleted the item of the <strong>Categories data</strong>';
					$notification .= '</div>';
					break;
				case "success-edit":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully update the item of the <strong>Categories data</strong>';
					$notification .= '</div>';
					break;
				case "success-add":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully add new item to the <strong>Categories data</strong>';
					$notification .= '</div>';
					break;
				case "wrong-id":
					$notification .= '<div id="notification" class="alert alert-danger">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You did not find ID of this item in <strong>Categories</strong>';
					$notification .= '</div>';
					break;
			}
		}
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		$page_title = "Categories";
		$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";
		$current_user = $_SESSION["CURRENT_USER"];
		$content = null;
		$content .= '<div class="wrapper">';
		$content .= '<header class="main-header">';
		$content .= '<a href="?" class="logo">';
		$content .= '<span class="logo-mini"><b>PN</b>L</span>';
		$content .= '<span class="logo-lg"><b>'.$app_name.'</b> Panel</span>';
		$content .= '</a>';
		$content .= '<nav class="navbar navbar-static-top">';
		$content .= '<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">';
		$content .= '<span class="sr-only">Toggle navigation</span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '</a>';
		$content .= '<div class="navbar-custom-menu">';
		$content .= '<ul class="nav navbar-nav">';
		$content .= '<li class="dropdown user user-menu">';
		$content .= '<a href="?" class="dropdown-toggle" data-toggle="dropdown">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="user-image" alt="User Image">';
		$content .= '<span class="hidden-xs">' . htmlentities(stripslashes($current_user['user_name'])).'</span>';
		$content .= '</a>';
		$content .= '<ul class="dropdown-menu">';
		$content .= '<li class="user-header">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="User Image">';
		$content .= '<p>';
		$content .= '' . htmlentities(stripslashes($current_user['user_name'])).'';
		$content .= '<small>' . htmlentities(stripslashes($current_user['user_level'])).'</small>';
		$content .= '</p>';
		$content .= '</li>';
		$content .= '<li class="user-footer">';
		$content .= '<div class="pull-left">';
		$content .= '<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>';
		$content .= '</div>';
		$content .= '<div class="pull-right">';
		$content .= '<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>';
		$content .= '</div>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '<li>';
		$content .= '</ul>';
		$content .= '</div>';
		$content .= '</nav>';
		$content .= '</header>';
		$content .= '<aside class="main-sidebar">';
		$content .= '<section class="sidebar">';
		$content .= '<div class="user-panel">';
		$content .= '<div class="pull-left image">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="'.htmlentities(stripslashes($current_user['user_name'])).'">';
		$content .= '</div>';
		$content .= '<div class="pull-left info">';
		$content .= '<p>'.htmlentities(stripslashes($current_user['user_name'])).'</p>';
		$content .= '<a href="?"><i class="fa fa-circle text-success"></i> '.htmlentities(stripslashes($current_user['user_level'])).'</a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<ul class="sidebar-menu" data-widget="tree">';
		$content .= '<li class="header">DATA MANAGER</li>';
		$content .= '<li class="treeview active">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-sitemap"></i> <span>Categories</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=categories&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=categories&amp;action=list"><i class="fa fa-list-ul"></i> All Categories</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-book"></i> <span>Chapters</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=chapters&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=chapters&amp;action=list"><i class="fa fa-list-ul"></i> All Chapters</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-newspaper-o"></i> <span>Daily Current Affairs</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=daily&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=daily&amp;action=list"><i class="fa fa-list-ul"></i> All Daily Current Affairs</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-lightbulb-o"></i> <span>GK</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=gk&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=gk&amp;action=list"><i class="fa fa-list-ul"></i> All GK</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-briefcase"></i> <span>Jobs</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=jobs&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=jobs&amp;action=list"><i class="fa fa-list-ul"></i> All Jobs</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="header">TOOLS</li>';
		$content .= '<li><a href="?page=onesignal-sender"><i class="fa fa-send"></i> <span>OneSignal Sender</span></a></li>';
		$content .= '<li class="header">USERS</li>';
		$content .= '<li><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>';
		$content .= '</ul>';
		$content .= '</section>';
		$content .= '</aside>';
		$content .= '<div class="content-wrapper">';
		switch($_GET["action"]){
			case "list":
				// TODO: PAGE - CATEGORIES - LIST
				/** breadcrumb **/
				$content .= '<section class="content-header">';
				$content .= '<h1>Categories<small></small></h1>';
				$content .= '<ol class="breadcrumb">';
				$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
				$content .= '<li><a href="?page=jobs&amp;action=list">Categories</a></li>';
				$content .= '<li class="active">List</li>';
				$content .= '</ol>';
				$content .= '</section>';
				/** content **/
				$content .= '<section class="content">';
				$content .= $notification;
				$content .= '<div class="box box-danger">';
				$content .= '<div class="box-header with-border">';
				$content .= '<h3 class="box-title">All Categories</h3>';
				$content .= '<div class="box-tools pull-right">';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-body">';
				$content .= '<div class="table-responsive">';
				$content .= '<table class="datatable table table-striped table-hover">';
				$content .= '<thead>';
				$content .= '<tr>';
				$content .= '<th>Category Name</th>';
				$content .= '<th>Category Image</th>';
				$content .= '<th style="width:100px;">#</th>';
				$content .= '</tr>';
				$content .= '</thead>';
				$content .= '<tbody>';
				/** fetch data from mysql **/
				$sql_query = "SELECT * FROM `categories` ORDER BY `cat_id` DESC" ;
				if($result = $mysql->query($sql_query)){
					while ($data = $result->fetch_array()){
						$content .= '<tr>';
						
						/** cat_id **/
						
						/** category_name **/
						$content .= '<td>' . htmlentities(stripslashes(substr(strip_tags($data["category_name"]),0,64))) . '</td>';
						
						/** category_image **/
						if($data["category_image"] ==""){
							$data["category_image"] ="https://placehold.it/80x80";
						}
						$content .= '<td><img class="img-thumbnail" width="80" height="80" src="' . htmlentities(stripslashes(strip_tags($data["category_image"]))) . '" class="img-thumbnail" alt="..."/></td>';
						$content .= '<td>';
						$content .= '<a href="?page=categories&amp;action=edit&amp;id='.$data["cat_id"].'" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i></a>';
						$content .= '<a class="btn btn-danger btn-flat btn-sm" href="#" onClick="doModal(\'Delete Category\',\'<div class=\\\'row\\\'><div class=\\\'col-md-3 text-center text-primary\\\'><i class=\\\'fa fa-5x fa-sitemap\\\'></i></div><div class=\\\'col-md-9\\\'>You are about to permanently delete these items from your site. <br/>This action cannot be undo, `Cancel` to stop, `OK` to delete.</div></div>\',\'Ok\',\'danger\',\'window.location=\\\'?page=categories&amp;action=delete&amp;id='.$data["cat_id"].'\\\'\');"><i class="fa fa-trash"></i></a>';
						$content .= '</td>';
						$content .= '</tr>';
					}
				}
				$content .= '</tbody>';
				$content .= '</table>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</section>';
				break;
			case "edit":
				// TODO: PAGE - CATEGORIES - EDIT
				if(isset($_GET["id"])){
					$entry_id= (int)$_GET["id"];
					/** fetch current data **/
					$sql_query = "SELECT * FROM `categories` WHERE `cat_id`=$entry_id LIMIT 0,1" ;
					$result = $mysql->query($sql_query);
					$rowdata = $result->fetch_array();
					if(isset($rowdata["cat_id"])){
						/** default value **/
						$postdata["category-name"] = "" ;
						$postdata["category-image"] = "" ;
						/** response postdata **/
						if(isset($_POST["submit"])){
							if(isset($_POST["postdata"]["category-name"])){
								$postdata["category-name"] = addslashes($_POST["postdata"]["category-name"]);
							}
							if(isset($_POST["postdata"]["category-image"])){
								$postdata["category-image"] = addslashes($_POST["postdata"]["category-image"]);
							}
							$sql_query = "UPDATE `categories` SET `category_name` = '{$postdata["category-name"]}' ,`category_image` = '{$postdata["category-image"]}'  WHERE `cat_id`=$entry_id" ;
							$stmt = $mysql->prepare($sql_query);
							$stmt->execute();
							$stmt->close();
							header("Location: ?page=categories&action=edit&id=".$entry_id."&notice=success-edit");
						}
						/** init variable field **/
						$postdata["category-name"] = '';
						if(isset($rowdata["category_name"])){
							$postdata["category-name"] = stripslashes($rowdata["category_name"]);
						}
						$postdata["category-image"] = '';
						if(isset($rowdata["category_image"])){
							$postdata["category-image"] = stripslashes($rowdata["category_image"]);
						}
						/** breadcrumb **/
						$content .= '<section class="content-header">';
						$content .= '<h1>Categories <small></small></h1>';
						$content .= '<ol class="breadcrumb">';
						$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
						$content .= '<li><a href="?">Categories</a></li>';
						$content .= '<li class="active">Edit</li>';
						$content .= '</ol>';
						$content .= '</section>';
						/** content **/
						$content .= '<section class="content">';
						$content .= $notification;
						$content .= '<form action="" method="post">';
						$content .= '<div class="box box-primary">';
						$content .= '<div class="box-header with-border">';
						$content .= '<h3 class="box-title">Edit Category</h3>';
						$content .= '<div class="box-tools pull-right">';
						$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
						$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="box-body">';
						$content .= '<div class="row">';
						/** field cat_id:id **/
						/** field category_name:varchar **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Category Name</label>';
						$content .= '<input maxlength="128" name="postdata[category-name]" id="postdata-category-name" type="text" class="form-control" placeholder="Category Name" value="'.htmlentities(stripslashes($postdata['category-name'])).'" />';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field category_image:thumbnail **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Category Image</label>';
						$content .= '<div class="input-group">';
						$content .= '<input name="postdata[category-image]" id="postdata-category-image" type="text" class="form-control" placeholder="image.jpg" value="'.htmlentities(stripslashes($postdata['category-image'])).'" />';
						$content .= '<span class="input-group-btn">';
						$content .= '<button type="button" data-type="file-picker" class="btn btn-default btn-flat" data-target="#postdata-category-image">';
						$content .= '<i class="fa fa-folder-open"></i>';
						$content .= '</button>';
						$content .= '<a class="btn btn-default btn-flat" target="_blank" href="'.htmlentities(stripslashes($postdata['category-image'])).'" ><i class="fa fa-eye"></i></a>';
						$content .= '</span>';
						$content .= '</div>';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="box-footer">';
						$content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit"><i class="fa fa-floppy-o"></i> Update</button>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</form>';
						$content .= '</section>';
					}else{
						header("Location: ?page=categories&notice=wrong-id");
					}
				}else{
					header("Location: ?page=categories&notice=wrong-id");
				}
				break;
			case "add":
				// TODO: PAGE - CATEGORIES - ADD
				/** default value **/
				$postdata["category-name"] = "" ;
				$postdata["category-image"] = "" ;
				/** response postdata **/
				if(isset($_POST["submit"])){
					if(isset($_POST["postdata"]["category-name"])){
						$postdata["category-name"] = addslashes($_POST["postdata"]["category-name"]);
					}
					if(isset($_POST["postdata"]["category-image"])){
						$postdata["category-image"] = addslashes($_POST["postdata"]["category-image"]);
					}
					$sql_query = "INSERT INTO `categories` (`category_name`,`category_image`) VALUES ('{$postdata['category-name']}','{$postdata['category-image']}')" ;
					$mysql->query($sql_query);
					$last_id = $mysql->insert_id;
					header("Location: ?page=categories&notice=success-add&action=edit&id=".$last_id);
				}
				/** breadcrumb **/
				$content .= '<section class="content-header">';
				$content .= '<h1>Categories <small></small></h1>';
				$content .= '<ol class="breadcrumb">';
				$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
				$content .= '<li><a href="?">Categories</a></li>';
				$content .= '<li class="active">Add</li>';
				$content .= '</ol>';
				$content .= '</section>';
				/** content **/
				$content .= '<section class="content">';
				$content .= $notification;
				$content .= '<form action="" method="post">';
				$content .= '<div class="box box-success">';
				$content .= '<div class="box-header with-border">';
				$content .= '<h3 class="box-title">Add new Category</h3>';
				$content .= '<div class="box-tools pull-right">';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-body">';
				$content .= '<div class="row">';
				/** field cat_id:id **/
				/** field category_name:varchar **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Category Name</label>';
				$content .= '<input maxlength="128" name="postdata[category-name]" id="postdata-category-name" type="text" class="form-control" placeholder="Category Name" value="'.htmlentities(stripslashes($postdata['category-name'])).'" />';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field category_image:thumbnail **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Category Image</label>';
				$content .= '<div class="input-group">';
				$content .= '<input name="postdata[category-image]" id="postdata-category-image" type="text" class="form-control" placeholder="image.jpg" value="'.htmlentities(stripslashes($postdata['category-image'])).'" />';
				$content .= '<span class="input-group-btn">';
				$content .= '<button type="button" data-type="file-picker" class="btn btn-primary btn-flat" data-target="#postdata-category-image">';
				$content .= '<i class="fa fa-folder-open"></i>';
				$content .= '</button>';
				$content .= '</span>';
				$content .= '</div>';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-footer">';
				$content .= '<button type="submit" class="btn btn-flat btn-success" name="submit"><i class="fa fa-plus"></i> Add new Category</button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</form>';
				$content .= '</section>';
				break;
			case "delete":
				// TODO: PAGE - CATEGORIES - DELETE
				if(isset($_GET["id"])){
					$entry_id= (int)$_GET["id"];
					/** fetch current data **/
					$sql_query = "SELECT * FROM `categories` WHERE `cat_id`=$entry_id LIMIT 0,1" ;
					$result = $mysql->query($sql_query);
					$rowdata = $result->fetch_array();
					if(isset($rowdata["cat_id"])){
						$sql_query = "DELETE FROM `categories` WHERE `cat_id`=$entry_id";
						$stmt = $mysql->prepare($sql_query);
						$stmt->execute();
						$stmt->close();
						header("Location: ?page=categories&notice=success-delete");
					}else{
						header("Location: ?page=categories&notice=wrong-id");
					}
				}
				break;
			}
			$content .= '</div>';
			$content .= '<footer class="main-footer">';
			$content .= '<div class="pull-right hidden-xs">';
			$content .= '<b>Version</b> 01.01.01';
			$content .= '</div>';
			$content .= '<strong>Copyright &copy; '.date("Y").' <a href="http://godigitally.co.in">Go Digitally</a>.</strong> All rights reserved.';
			$content .= '</footer>';
			$content .= '</div>';
			break;
	// TODO: PAGE - CHAPTERS
	case "chapters":
		$notification = null;
		if(isset($_GET["notice"])){
			switch($_GET["notice"]){
				case "success-delete":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully deleted the item of the <strong>Chapters data</strong>';
					$notification .= '</div>';
					break;
				case "success-edit":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully update the item of the <strong>Chapters data</strong>';
					$notification .= '</div>';
					break;
				case "success-add":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully add new item to the <strong>Chapters data</strong>';
					$notification .= '</div>';
					break;
				case "wrong-id":
					$notification .= '<div id="notification" class="alert alert-danger">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You did not find ID of this item in <strong>Chapters</strong>';
					$notification .= '</div>';
					break;
			}
		}
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		$page_title = "Chapters";
		$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";
		$current_user = $_SESSION["CURRENT_USER"];
		$content = null;
		$content .= '<div class="wrapper">';
		$content .= '<header class="main-header">';
		$content .= '<a href="?" class="logo">';
		$content .= '<span class="logo-mini"><b>PN</b>L</span>';
		$content .= '<span class="logo-lg"><b>'.$app_name.'</b> Panel</span>';
		$content .= '</a>';
		$content .= '<nav class="navbar navbar-static-top">';
		$content .= '<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">';
		$content .= '<span class="sr-only">Toggle navigation</span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '</a>';
		$content .= '<div class="navbar-custom-menu">';
		$content .= '<ul class="nav navbar-nav">';
		$content .= '<li class="dropdown user user-menu">';
		$content .= '<a href="?" class="dropdown-toggle" data-toggle="dropdown">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="user-image" alt="User Image">';
		$content .= '<span class="hidden-xs">' . htmlentities(stripslashes($current_user['user_name'])).'</span>';
		$content .= '</a>';
		$content .= '<ul class="dropdown-menu">';
		$content .= '<li class="user-header">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="User Image">';
		$content .= '<p>';
		$content .= '' . htmlentities(stripslashes($current_user['user_name'])).'';
		$content .= '<small>' . htmlentities(stripslashes($current_user['user_level'])).'</small>';
		$content .= '</p>';
		$content .= '</li>';
		$content .= '<li class="user-footer">';
		$content .= '<div class="pull-left">';
		$content .= '<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>';
		$content .= '</div>';
		$content .= '<div class="pull-right">';
		$content .= '<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>';
		$content .= '</div>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '<li>';
		$content .= '</ul>';
		$content .= '</div>';
		$content .= '</nav>';
		$content .= '</header>';
		$content .= '<aside class="main-sidebar">';
		$content .= '<section class="sidebar">';
		$content .= '<div class="user-panel">';
		$content .= '<div class="pull-left image">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="'.htmlentities(stripslashes($current_user['user_name'])).'">';
		$content .= '</div>';
		$content .= '<div class="pull-left info">';
		$content .= '<p>'.htmlentities(stripslashes($current_user['user_name'])).'</p>';
		$content .= '<a href="?"><i class="fa fa-circle text-success"></i> '.htmlentities(stripslashes($current_user['user_level'])).'</a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<ul class="sidebar-menu" data-widget="tree">';
		$content .= '<li class="header">DATA MANAGER</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-sitemap"></i> <span>Categories</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=categories&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=categories&amp;action=list"><i class="fa fa-list-ul"></i> All Categories</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview active">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-book"></i> <span>Chapters</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=chapters&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=chapters&amp;action=list"><i class="fa fa-list-ul"></i> All Chapters</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-newspaper-o"></i> <span>Daily Current Affairs</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=daily&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=daily&amp;action=list"><i class="fa fa-list-ul"></i> All Daily Current Affairs</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-lightbulb-o"></i> <span>GK</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=gk&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=gk&amp;action=list"><i class="fa fa-list-ul"></i> All GK</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-briefcase"></i> <span>Jobs</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=jobs&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=jobs&amp;action=list"><i class="fa fa-list-ul"></i> All Jobs</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="header">TOOLS</li>';
		$content .= '<li><a href="?page=onesignal-sender"><i class="fa fa-send"></i> <span>OneSignal Sender</span></a></li>';
		$content .= '<li class="header">USERS</li>';
		$content .= '<li><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>';
		$content .= '</ul>';
		$content .= '</section>';
		$content .= '</aside>';
		$content .= '<div class="content-wrapper">';
		switch($_GET["action"]){
			case "list":
				// TODO: PAGE - CHAPTERS - LIST
				/** breadcrumb **/
				$content .= '<section class="content-header">';
				$content .= '<h1>Chapters<small></small></h1>';
				$content .= '<ol class="breadcrumb">';
				$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
				$content .= '<li><a href="?page=jobs&amp;action=list">Chapters</a></li>';
				$content .= '<li class="active">List</li>';
				$content .= '</ol>';
				$content .= '</section>';
				/** content **/
				$content .= '<section class="content">';
				$content .= $notification;
				$content .= '<div class="box box-danger">';
				$content .= '<div class="box-header with-border">';
				$content .= '<h3 class="box-title">All Chapters</h3>';
				$content .= '<div class="box-tools pull-right">';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-body">';
				$content .= '<div class="table-responsive">';
				$content .= '<table class="datatable table table-striped table-hover">';
				$content .= '<thead>';
				$content .= '<tr>';
				$content .= '<th>Chapter Name</th>';
				$content .= '<th>Chapter Category</th>';
				$content .= '<th>Chapter Image</th>';
				$content .= '<th style="width:100px;">#</th>';
				$content .= '</tr>';
				$content .= '</thead>';
				$content .= '<tbody>';
				/** fetch data from mysql **/
				$sql_query = "SELECT * FROM `chapters` ORDER BY `chapter_id` DESC" ;
				if($result = $mysql->query($sql_query)){
					while ($data = $result->fetch_array()){
						$content .= '<tr>';
						
						/** chapter_id **/
						
						/** chapter_name **/
						$content .= '<td>' . htmlentities(stripslashes(substr(strip_tags($data["chapter_name"]),0,64))) . '</td>';
						
						/** chapter_category **/
						$categories_text = htmlentities(stripslashes($data["chapter_category"]));
						$sql_categories_query = "SELECT * FROM `categories` WHERE `cat_id`='{$categories_text}'" ;
						$categories_result = $mysql->query($sql_categories_query);
						if($categories_result){
							$categories_result_data = $categories_result->fetch_array();
							if(isset($categories_result_data["category_name"])){
								$content .= '<td><span class="label label-success">' . htmlentities(stripslashes($categories_result_data["category_name"])) . '</span></td>';
							}else{
							$content .= '<td><span class="label label-danger">deleted</span></td>';
							}
						}else{
							$content .= '<td><span class="label label-danger">Not existing table</span></td>';
						}
						
						/** chapter_image **/
						if($data["chapter_image"] ==""){
							$data["chapter_image"] ="https://placehold.it/80x80";
						}
						$content .= '<td><img class="img-thumbnail" width="80" height="80" src="' . htmlentities(stripslashes(strip_tags($data["chapter_image"]))) . '" class="img-thumbnail" alt="..."/></td>';
						
						/** chapter_content **/
						$content .= '<td>';
						$content .= '<a href="?page=chapters&amp;action=edit&amp;id='.$data["chapter_id"].'" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i></a>';
						$content .= '<a class="btn btn-danger btn-flat btn-sm" href="#" onClick="doModal(\'Delete Chapter\',\'<div class=\\\'row\\\'><div class=\\\'col-md-3 text-center text-primary\\\'><i class=\\\'fa fa-5x fa-book\\\'></i></div><div class=\\\'col-md-9\\\'>You are about to permanently delete these items from your site. <br/>This action cannot be undo, `Cancel` to stop, `OK` to delete.</div></div>\',\'Ok\',\'danger\',\'window.location=\\\'?page=chapters&amp;action=delete&amp;id='.$data["chapter_id"].'\\\'\');"><i class="fa fa-trash"></i></a>';
						$content .= '</td>';
						$content .= '</tr>';
					}
				}
				$content .= '</tbody>';
				$content .= '</table>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</section>';
				break;
			case "edit":
				// TODO: PAGE - CHAPTERS - EDIT
				if(isset($_GET["id"])){
					$entry_id= (int)$_GET["id"];
					/** fetch current data **/
					$sql_query = "SELECT * FROM `chapters` WHERE `chapter_id`=$entry_id LIMIT 0,1" ;
					$result = $mysql->query($sql_query);
					$rowdata = $result->fetch_array();
					if(isset($rowdata["chapter_id"])){
						/** default value **/
						$postdata["chapter-name"] = "" ;
						$postdata["chapter-category"] = "" ;
						$postdata["chapter-image"] = "" ;
						$postdata["chapter-content"] = "" ;
						/** response postdata **/
						if(isset($_POST["submit"])){
							if(isset($_POST["postdata"]["chapter-name"])){
								$postdata["chapter-name"] = addslashes($_POST["postdata"]["chapter-name"]);
							}
							if(isset($_POST["postdata"]["chapter-category"])){
								$postdata["chapter-category"] = addslashes($_POST["postdata"]["chapter-category"]);
							}
							if(isset($_POST["postdata"]["chapter-image"])){
								$postdata["chapter-image"] = addslashes($_POST["postdata"]["chapter-image"]);
							}
							if(isset($_POST["postdata"]["chapter-content"])){
								$postdata["chapter-content"] = addslashes($_POST["postdata"]["chapter-content"]);
							}
							$sql_query = "UPDATE `chapters` SET `chapter_name` = '{$postdata["chapter-name"]}' ,`chapter_category` = '{$postdata["chapter-category"]}' ,`chapter_image` = '{$postdata["chapter-image"]}' ,`chapter_content` = '{$postdata["chapter-content"]}'  WHERE `chapter_id`=$entry_id" ;
							$stmt = $mysql->prepare($sql_query);
							$stmt->execute();
							$stmt->close();
							header("Location: ?page=chapters&action=edit&id=".$entry_id."&notice=success-edit");
						}
						/** init variable field **/
						$postdata["chapter-name"] = '';
						if(isset($rowdata["chapter_name"])){
							$postdata["chapter-name"] = stripslashes($rowdata["chapter_name"]);
						}
						$postdata["chapter-category"] = '';
						if(isset($rowdata["chapter_category"])){
							$postdata["chapter-category"] = stripslashes($rowdata["chapter_category"]);
						}
						$postdata["chapter-image"] = '';
						if(isset($rowdata["chapter_image"])){
							$postdata["chapter-image"] = stripslashes($rowdata["chapter_image"]);
						}
						$postdata["chapter-content"] = '';
						if(isset($rowdata["chapter_content"])){
							$postdata["chapter-content"] = stripslashes($rowdata["chapter_content"]);
						}
						/** breadcrumb **/
						$content .= '<section class="content-header">';
						$content .= '<h1>Chapters <small></small></h1>';
						$content .= '<ol class="breadcrumb">';
						$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
						$content .= '<li><a href="?">Chapters</a></li>';
						$content .= '<li class="active">Edit</li>';
						$content .= '</ol>';
						$content .= '</section>';
						/** content **/
						$content .= '<section class="content">';
						$content .= $notification;
						$content .= '<form action="" method="post">';
						$content .= '<div class="box box-primary">';
						$content .= '<div class="box-header with-border">';
						$content .= '<h3 class="box-title">Edit Chapter</h3>';
						$content .= '<div class="box-tools pull-right">';
						$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
						$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="box-body">';
						$content .= '<div class="row">';
						/** field chapter_id:id **/
						/** field chapter_name:varchar **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Chapter Name</label>';
						$content .= '<input maxlength="128" name="postdata[chapter-name]" id="postdata-chapter-name" type="text" class="form-control" placeholder="Chapter Name" value="'.htmlentities(stripslashes($postdata['chapter-name'])).'" />';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field chapter_category:select-table **/
						$options["chapter_category"] = array();
						$sql_option_query = "SELECT * FROM `categories`" ;
						$option_result = $mysql->query($sql_option_query);
						if($option_result){
							while ($option_data = $option_result->fetch_array()){
								$options["chapter_category"][] = array("val"=> $option_data["cat_id"],"label"=>$option_data["category_name"]);
							}
						}else{
							$options["chapter_category"][] = array("val"=> "","label"=>"Not existing table");
						}
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Chapter Category</label>';
						$content .= '<select class="form-control" name="postdata[chapter-category]" id="postdata-chapter-category">';
						foreach($options["chapter_category"] as $option) {
							$selected ="";
							if($option["val"] == $postdata['chapter-category'] ){
								$selected ="selected";
							}
							$content .= '<option value="'.htmlentities($option["val"]).'" '.$selected.'>'.htmlentities($option["label"]).'</option>';
						}
						$content .= '</select>';
						$content .= '<p class="help-block">please select a value</p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field chapter_image:thumbnail **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Chapter Image</label>';
						$content .= '<div class="input-group">';
						$content .= '<input name="postdata[chapter-image]" id="postdata-chapter-image" type="text" class="form-control" placeholder="image.jpg" value="'.htmlentities(stripslashes($postdata['chapter-image'])).'" />';
						$content .= '<span class="input-group-btn">';
						$content .= '<button type="button" data-type="file-picker" class="btn btn-default btn-flat" data-target="#postdata-chapter-image">';
						$content .= '<i class="fa fa-folder-open"></i>';
						$content .= '</button>';
						$content .= '<a class="btn btn-default btn-flat" target="_blank" href="'.htmlentities(stripslashes($postdata['chapter-image'])).'" ><i class="fa fa-eye"></i></a>';
						$content .= '</span>';
						$content .= '</div>';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field chapter_content:longtext **/
						$content .= '<div class="col-md-12">';
						$content .= '<div class="form-group">';
						$content .= '<label>Chapter Content</label>';
						$content .= '<textarea name="postdata[chapter-content]" id="postdata-chapter-content" class="form-control" data-type="html5" >'.htmlentities(stripslashes($postdata['chapter-content'])).'</textarea>';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="box-footer">';
						$content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit"><i class="fa fa-floppy-o"></i> Update</button>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</form>';
						$content .= '</section>';
					}else{
						header("Location: ?page=chapters&notice=wrong-id");
					}
				}else{
					header("Location: ?page=chapters&notice=wrong-id");
				}
				break;
			case "add":
				// TODO: PAGE - CHAPTERS - ADD
				/** default value **/
				$postdata["chapter-name"] = "" ;
				$postdata["chapter-category"] = "" ;
				$postdata["chapter-image"] = "" ;
				$postdata["chapter-content"] = "" ;
				/** response postdata **/
				if(isset($_POST["submit"])){
					if(isset($_POST["postdata"]["chapter-name"])){
						$postdata["chapter-name"] = addslashes($_POST["postdata"]["chapter-name"]);
					}
					if(isset($_POST["postdata"]["chapter-category"])){
						$postdata["chapter-category"] = addslashes($_POST["postdata"]["chapter-category"]);
					}
					if(isset($_POST["postdata"]["chapter-image"])){
						$postdata["chapter-image"] = addslashes($_POST["postdata"]["chapter-image"]);
					}
					if(isset($_POST["postdata"]["chapter-content"])){
						$postdata["chapter-content"] = addslashes($_POST["postdata"]["chapter-content"]);
					}
					$sql_query = "INSERT INTO `chapters` (`chapter_name`,`chapter_category`,`chapter_image`,`chapter_content`) VALUES ('{$postdata['chapter-name']}','{$postdata['chapter-category']}','{$postdata['chapter-image']}','{$postdata['chapter-content']}')" ;
					$mysql->query($sql_query);
					$last_id = $mysql->insert_id;
					header("Location: ?page=chapters&notice=success-add&action=edit&id=".$last_id);
				}
				/** breadcrumb **/
				$content .= '<section class="content-header">';
				$content .= '<h1>Chapters <small></small></h1>';
				$content .= '<ol class="breadcrumb">';
				$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
				$content .= '<li><a href="?">Chapters</a></li>';
				$content .= '<li class="active">Add</li>';
				$content .= '</ol>';
				$content .= '</section>';
				/** content **/
				$content .= '<section class="content">';
				$content .= $notification;
				$content .= '<form action="" method="post">';
				$content .= '<div class="box box-success">';
				$content .= '<div class="box-header with-border">';
				$content .= '<h3 class="box-title">Add new Chapter</h3>';
				$content .= '<div class="box-tools pull-right">';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-body">';
				$content .= '<div class="row">';
				/** field chapter_id:id **/
				/** field chapter_name:varchar **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Chapter Name</label>';
				$content .= '<input maxlength="128" name="postdata[chapter-name]" id="postdata-chapter-name" type="text" class="form-control" placeholder="Chapter Name" value="'.htmlentities(stripslashes($postdata['chapter-name'])).'" />';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field chapter_category:select-table **/
				$options["chapter_category"] = array();
				$sql_option_query = "SELECT * FROM `categories`" ;
				$option_result = $mysql->query($sql_option_query);
				if($option_result){
					while ($option_data = $option_result->fetch_array()){
						$options["chapter_category"][] = array("val"=> $option_data["cat_id"],"label"=>$option_data["category_name"]);
					}
				}else{
					$options["chapter_category"][] = array("val"=> "","label"=>"Not existing table");
				}
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Chapter Category</label>';
				$content .= '<select class="form-control" name="postdata[chapter-category]" id="postdata-chapter-category">';
				foreach($options["chapter_category"] as $option) {
					$selected ="";
					if($option["val"] == $postdata['chapter-category'] ){
						$selected ="selected";
					}
					$content .= '<option value="'.htmlentities($option["val"]).'" '.$selected.'>'.htmlentities($option["label"]).'</option>';
				}
				$content .= '</select>';
				$content .= '<p class="help-block">please select a value</p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field chapter_image:thumbnail **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Chapter Image</label>';
				$content .= '<div class="input-group">';
				$content .= '<input name="postdata[chapter-image]" id="postdata-chapter-image" type="text" class="form-control" placeholder="image.jpg" value="'.htmlentities(stripslashes($postdata['chapter-image'])).'" />';
				$content .= '<span class="input-group-btn">';
				$content .= '<button type="button" data-type="file-picker" class="btn btn-primary btn-flat" data-target="#postdata-chapter-image">';
				$content .= '<i class="fa fa-folder-open"></i>';
				$content .= '</button>';
				$content .= '</span>';
				$content .= '</div>';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field chapter_content:longtext **/
				$content .= '<div class="col-md-12">';
				$content .= '<div class="form-group">';
				$content .= '<label>Chapter Content</label>';
				$content .= '<textarea name="postdata[chapter-content]" id="postdata-chapter-content" class="form-control" data-type="html5" >'.htmlentities(stripslashes($postdata['chapter-content'])).'</textarea>';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-footer">';
				$content .= '<button type="submit" class="btn btn-flat btn-success" name="submit"><i class="fa fa-plus"></i> Add new Chapter</button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</form>';
				$content .= '</section>';
				break;
			case "delete":
				// TODO: PAGE - CHAPTERS - DELETE
				if(isset($_GET["id"])){
					$entry_id= (int)$_GET["id"];
					/** fetch current data **/
					$sql_query = "SELECT * FROM `chapters` WHERE `chapter_id`=$entry_id LIMIT 0,1" ;
					$result = $mysql->query($sql_query);
					$rowdata = $result->fetch_array();
					if(isset($rowdata["chapter_id"])){
						$sql_query = "DELETE FROM `chapters` WHERE `chapter_id`=$entry_id";
						$stmt = $mysql->prepare($sql_query);
						$stmt->execute();
						$stmt->close();
						header("Location: ?page=chapters&notice=success-delete");
					}else{
						header("Location: ?page=chapters&notice=wrong-id");
					}
				}
				break;
			}
			$content .= '</div>';
			$content .= '<footer class="main-footer">';
			$content .= '<div class="pull-right hidden-xs">';
			$content .= '<b>Version</b> 01.01.01';
			$content .= '</div>';
			$content .= '<strong>Copyright &copy; '.date("Y").' <a href="http://godigitally.co.in">Go Digitally</a>.</strong> All rights reserved.';
			$content .= '</footer>';
			$content .= '</div>';
			break;
	// TODO: PAGE - DAILY
	case "daily":
		$notification = null;
		if(isset($_GET["notice"])){
			switch($_GET["notice"]){
				case "success-delete":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully deleted the item of the <strong>Daily Current Affairs data</strong>';
					$notification .= '</div>';
					break;
				case "success-edit":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully update the item of the <strong>Daily Current Affairs data</strong>';
					$notification .= '</div>';
					break;
				case "success-add":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully add new item to the <strong>Daily Current Affairs data</strong>';
					$notification .= '</div>';
					break;
				case "wrong-id":
					$notification .= '<div id="notification" class="alert alert-danger">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You did not find ID of this item in <strong>Daily Current Affairs</strong>';
					$notification .= '</div>';
					break;
			}
		}
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		$page_title = "Daily Current Affairs";
		$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";
		$current_user = $_SESSION["CURRENT_USER"];
		$content = null;
		$content .= '<div class="wrapper">';
		$content .= '<header class="main-header">';
		$content .= '<a href="?" class="logo">';
		$content .= '<span class="logo-mini"><b>PN</b>L</span>';
		$content .= '<span class="logo-lg"><b>'.$app_name.'</b> Panel</span>';
		$content .= '</a>';
		$content .= '<nav class="navbar navbar-static-top">';
		$content .= '<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">';
		$content .= '<span class="sr-only">Toggle navigation</span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '</a>';
		$content .= '<div class="navbar-custom-menu">';
		$content .= '<ul class="nav navbar-nav">';
		$content .= '<li class="dropdown user user-menu">';
		$content .= '<a href="?" class="dropdown-toggle" data-toggle="dropdown">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="user-image" alt="User Image">';
		$content .= '<span class="hidden-xs">' . htmlentities(stripslashes($current_user['user_name'])).'</span>';
		$content .= '</a>';
		$content .= '<ul class="dropdown-menu">';
		$content .= '<li class="user-header">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="User Image">';
		$content .= '<p>';
		$content .= '' . htmlentities(stripslashes($current_user['user_name'])).'';
		$content .= '<small>' . htmlentities(stripslashes($current_user['user_level'])).'</small>';
		$content .= '</p>';
		$content .= '</li>';
		$content .= '<li class="user-footer">';
		$content .= '<div class="pull-left">';
		$content .= '<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>';
		$content .= '</div>';
		$content .= '<div class="pull-right">';
		$content .= '<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>';
		$content .= '</div>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '<li>';
		$content .= '</ul>';
		$content .= '</div>';
		$content .= '</nav>';
		$content .= '</header>';
		$content .= '<aside class="main-sidebar">';
		$content .= '<section class="sidebar">';
		$content .= '<div class="user-panel">';
		$content .= '<div class="pull-left image">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="'.htmlentities(stripslashes($current_user['user_name'])).'">';
		$content .= '</div>';
		$content .= '<div class="pull-left info">';
		$content .= '<p>'.htmlentities(stripslashes($current_user['user_name'])).'</p>';
		$content .= '<a href="?"><i class="fa fa-circle text-success"></i> '.htmlentities(stripslashes($current_user['user_level'])).'</a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<ul class="sidebar-menu" data-widget="tree">';
		$content .= '<li class="header">DATA MANAGER</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-sitemap"></i> <span>Categories</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=categories&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=categories&amp;action=list"><i class="fa fa-list-ul"></i> All Categories</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-book"></i> <span>Chapters</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=chapters&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=chapters&amp;action=list"><i class="fa fa-list-ul"></i> All Chapters</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview active">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-newspaper-o"></i> <span>Daily Current Affairs</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=daily&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=daily&amp;action=list"><i class="fa fa-list-ul"></i> All Daily Current Affairs</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-lightbulb-o"></i> <span>GK</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=gk&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=gk&amp;action=list"><i class="fa fa-list-ul"></i> All GK</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-briefcase"></i> <span>Jobs</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=jobs&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=jobs&amp;action=list"><i class="fa fa-list-ul"></i> All Jobs</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="header">TOOLS</li>';
		$content .= '<li><a href="?page=onesignal-sender"><i class="fa fa-send"></i> <span>OneSignal Sender</span></a></li>';
		$content .= '<li class="header">USERS</li>';
		$content .= '<li><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>';
		$content .= '</ul>';
		$content .= '</section>';
		$content .= '</aside>';
		$content .= '<div class="content-wrapper">';
		switch($_GET["action"]){
			case "list":
				// TODO: PAGE - DAILY - LIST
				/** breadcrumb **/
				$content .= '<section class="content-header">';
				$content .= '<h1>Daily Current Affairs<small></small></h1>';
				$content .= '<ol class="breadcrumb">';
				$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
				$content .= '<li><a href="?page=jobs&amp;action=list">Daily Current Affairs</a></li>';
				$content .= '<li class="active">List</li>';
				$content .= '</ol>';
				$content .= '</section>';
				/** content **/
				$content .= '<section class="content">';
				$content .= $notification;
				$content .= '<div class="box box-danger">';
				$content .= '<div class="box-header with-border">';
				$content .= '<h3 class="box-title">All Daily Current Affairs</h3>';
				$content .= '<div class="box-tools pull-right">';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-body">';
				$content .= '<div class="table-responsive">';
				$content .= '<table class="datatable table table-striped table-hover">';
				$content .= '<thead>';
				$content .= '<tr>';
				$content .= '<th>Chapter Name</th>';
				$content .= '<th>Published On</th>';
				$content .= '<th>Chapter Image</th>';
				$content .= '<th style="width:100px;">#</th>';
				$content .= '</tr>';
				$content .= '</thead>';
				$content .= '<tbody>';
				/** fetch data from mysql **/
				$sql_query = "SELECT * FROM `daily` ORDER BY `chaper_id` DESC" ;
				if($result = $mysql->query($sql_query)){
					while ($data = $result->fetch_array()){
						$content .= '<tr>';
						
						/** chaper_id **/
						
						/** chapter_name **/
						$content .= '<td>' . htmlentities(stripslashes(substr(strip_tags($data["chapter_name"]),0,64))) . '</td>';
						
						/** published_date **/
						$content .= '<td>' . htmlentities(stripslashes($data["published_date"])) . '</td>';
						
						/** chapter_image **/
						if($data["chapter_image"] ==""){
							$data["chapter_image"] ="https://placehold.it/80x80";
						}
						$content .= '<td><img class="img-thumbnail" width="80" height="80" src="' . htmlentities(stripslashes(strip_tags($data["chapter_image"]))) . '" class="img-thumbnail" alt="..."/></td>';
						
						/** chapter_content **/
						$content .= '<td>';
						$content .= '<a href="?page=daily&amp;action=edit&amp;id='.$data["chaper_id"].'" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i></a>';
						$content .= '<a class="btn btn-danger btn-flat btn-sm" href="#" onClick="doModal(\'Delete Daily Current Affairs\',\'<div class=\\\'row\\\'><div class=\\\'col-md-3 text-center text-primary\\\'><i class=\\\'fa fa-5x fa-newspaper-o\\\'></i></div><div class=\\\'col-md-9\\\'>You are about to permanently delete these items from your site. <br/>This action cannot be undo, `Cancel` to stop, `OK` to delete.</div></div>\',\'Ok\',\'danger\',\'window.location=\\\'?page=daily&amp;action=delete&amp;id='.$data["chaper_id"].'\\\'\');"><i class="fa fa-trash"></i></a>';
						$content .= '</td>';
						$content .= '</tr>';
					}
				}
				$content .= '</tbody>';
				$content .= '</table>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</section>';
				break;
			case "edit":
				// TODO: PAGE - DAILY - EDIT
				if(isset($_GET["id"])){
					$entry_id= (int)$_GET["id"];
					/** fetch current data **/
					$sql_query = "SELECT * FROM `daily` WHERE `chaper_id`=$entry_id LIMIT 0,1" ;
					$result = $mysql->query($sql_query);
					$rowdata = $result->fetch_array();
					if(isset($rowdata["chaper_id"])){
						/** default value **/
						$postdata["chapter-name"] = "" ;
						$postdata["published-date"] = "" ;
						$postdata["chapter-image"] = "" ;
						$postdata["chapter-content"] = "" ;
						/** response postdata **/
						if(isset($_POST["submit"])){
							if(isset($_POST["postdata"]["chapter-name"])){
								$postdata["chapter-name"] = addslashes($_POST["postdata"]["chapter-name"]);
							}
							if(isset($_POST["postdata"]["published-date"])){
								$postdata["published-date"] = addslashes($_POST["postdata"]["published-date"]);
							}
							if(isset($_POST["postdata"]["chapter-image"])){
								$postdata["chapter-image"] = addslashes($_POST["postdata"]["chapter-image"]);
							}
							if(isset($_POST["postdata"]["chapter-content"])){
								$postdata["chapter-content"] = addslashes($_POST["postdata"]["chapter-content"]);
							}
							$sql_query = "UPDATE `daily` SET `chapter_name` = '{$postdata["chapter-name"]}' ,`published_date` = '{$postdata["published-date"]}' ,`chapter_image` = '{$postdata["chapter-image"]}' ,`chapter_content` = '{$postdata["chapter-content"]}'  WHERE `chaper_id`=$entry_id" ;
							$stmt = $mysql->prepare($sql_query);
							$stmt->execute();
							$stmt->close();
							header("Location: ?page=daily&action=edit&id=".$entry_id."&notice=success-edit");
						}
						/** init variable field **/
						$postdata["chapter-name"] = '';
						if(isset($rowdata["chapter_name"])){
							$postdata["chapter-name"] = stripslashes($rowdata["chapter_name"]);
						}
						$postdata["published-date"] = '';
						if(isset($rowdata["published_date"])){
							$postdata["published-date"] = stripslashes($rowdata["published_date"]);
						}
						$postdata["chapter-image"] = '';
						if(isset($rowdata["chapter_image"])){
							$postdata["chapter-image"] = stripslashes($rowdata["chapter_image"]);
						}
						$postdata["chapter-content"] = '';
						if(isset($rowdata["chapter_content"])){
							$postdata["chapter-content"] = stripslashes($rowdata["chapter_content"]);
						}
						/** breadcrumb **/
						$content .= '<section class="content-header">';
						$content .= '<h1>Daily Current Affairs <small></small></h1>';
						$content .= '<ol class="breadcrumb">';
						$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
						$content .= '<li><a href="?">Daily Current Affairs</a></li>';
						$content .= '<li class="active">Edit</li>';
						$content .= '</ol>';
						$content .= '</section>';
						/** content **/
						$content .= '<section class="content">';
						$content .= $notification;
						$content .= '<form action="" method="post">';
						$content .= '<div class="box box-primary">';
						$content .= '<div class="box-header with-border">';
						$content .= '<h3 class="box-title">Edit Daily Current Affairs</h3>';
						$content .= '<div class="box-tools pull-right">';
						$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
						$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="box-body">';
						$content .= '<div class="row">';
						/** field chaper_id:id **/
						/** field chapter_name:varchar **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Chapter Name</label>';
						$content .= '<input maxlength="128" name="postdata[chapter-name]" id="postdata-chapter-name" type="text" class="form-control" placeholder="Chapter Name" value="'.htmlentities(stripslashes($postdata['chapter-name'])).'" />';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field published_date:date **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Published On</label>';
						$content .= '<div class="input-group date">';
						$content .= '<div class="input-group-addon"><i class="fa fa-calendar"></i></div>';
						$content .= '<input name="postdata[published-date]" id="postdata-published-date" type="text" class="form-control" placeholder="'.date("Y-m-d").'" value="'.htmlentities(stripslashes($postdata['published-date'])).'" data-type="date" />';
						$content .= '</div>';
						$content .= '<p class="help-block">Filled with date</p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field chapter_image:thumbnail **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Chapter Image</label>';
						$content .= '<div class="input-group">';
						$content .= '<input name="postdata[chapter-image]" id="postdata-chapter-image" type="text" class="form-control" placeholder="image.jpg" value="'.htmlentities(stripslashes($postdata['chapter-image'])).'" />';
						$content .= '<span class="input-group-btn">';
						$content .= '<button type="button" data-type="file-picker" class="btn btn-default btn-flat" data-target="#postdata-chapter-image">';
						$content .= '<i class="fa fa-folder-open"></i>';
						$content .= '</button>';
						$content .= '<a class="btn btn-default btn-flat" target="_blank" href="'.htmlentities(stripslashes($postdata['chapter-image'])).'" ><i class="fa fa-eye"></i></a>';
						$content .= '</span>';
						$content .= '</div>';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field chapter_content:longtext **/
						$content .= '<div class="col-md-12">';
						$content .= '<div class="form-group">';
						$content .= '<label>Chapter Content</label>';
						$content .= '<textarea name="postdata[chapter-content]" id="postdata-chapter-content" class="form-control" data-type="html5" >'.htmlentities(stripslashes($postdata['chapter-content'])).'</textarea>';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="box-footer">';
						$content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit"><i class="fa fa-floppy-o"></i> Update</button>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</form>';
						$content .= '</section>';
					}else{
						header("Location: ?page=daily&notice=wrong-id");
					}
				}else{
					header("Location: ?page=daily&notice=wrong-id");
				}
				break;
			case "add":
				// TODO: PAGE - DAILY - ADD
				/** default value **/
				$postdata["chapter-name"] = "" ;
				$postdata["published-date"] = "" ;
				$postdata["chapter-image"] = "" ;
				$postdata["chapter-content"] = "" ;
				/** response postdata **/
				if(isset($_POST["submit"])){
					if(isset($_POST["postdata"]["chapter-name"])){
						$postdata["chapter-name"] = addslashes($_POST["postdata"]["chapter-name"]);
					}
					if(isset($_POST["postdata"]["published-date"])){
						$postdata["published-date"] = addslashes($_POST["postdata"]["published-date"]);
					}
					if(isset($_POST["postdata"]["chapter-image"])){
						$postdata["chapter-image"] = addslashes($_POST["postdata"]["chapter-image"]);
					}
					if(isset($_POST["postdata"]["chapter-content"])){
						$postdata["chapter-content"] = addslashes($_POST["postdata"]["chapter-content"]);
					}
					$sql_query = "INSERT INTO `daily` (`chapter_name`,`published_date`,`chapter_image`,`chapter_content`) VALUES ('{$postdata['chapter-name']}','{$postdata['published-date']}','{$postdata['chapter-image']}','{$postdata['chapter-content']}')" ;
					$mysql->query($sql_query);
					$last_id = $mysql->insert_id;
					header("Location: ?page=daily&notice=success-add&action=edit&id=".$last_id);
				}
				/** breadcrumb **/
				$content .= '<section class="content-header">';
				$content .= '<h1>Daily Current Affairs <small></small></h1>';
				$content .= '<ol class="breadcrumb">';
				$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
				$content .= '<li><a href="?">Daily Current Affairs</a></li>';
				$content .= '<li class="active">Add</li>';
				$content .= '</ol>';
				$content .= '</section>';
				/** content **/
				$content .= '<section class="content">';
				$content .= $notification;
				$content .= '<form action="" method="post">';
				$content .= '<div class="box box-success">';
				$content .= '<div class="box-header with-border">';
				$content .= '<h3 class="box-title">Add new Daily Current Affairs</h3>';
				$content .= '<div class="box-tools pull-right">';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-body">';
				$content .= '<div class="row">';
				/** field chaper_id:id **/
				/** field chapter_name:varchar **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Chapter Name</label>';
				$content .= '<input maxlength="128" name="postdata[chapter-name]" id="postdata-chapter-name" type="text" class="form-control" placeholder="Chapter Name" value="'.htmlentities(stripslashes($postdata['chapter-name'])).'" />';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field published_date:date **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Published On</label>';
				$content .= '<div class="input-group date">';
				$content .= '<div class="input-group-addon"><i class="fa fa-calendar"></i></div>';
				$content .= '<input name="postdata[published-date]" id="postdata-published-date" type="text" class="form-control" placeholder="'.date("Y-m-d").'" value="'.htmlentities(stripslashes($postdata['published-date'])).'" data-type="date" />';
				$content .= '</div>';
				$content .= '<p class="help-block">Filled with date</p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field chapter_image:thumbnail **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Chapter Image</label>';
				$content .= '<div class="input-group">';
				$content .= '<input name="postdata[chapter-image]" id="postdata-chapter-image" type="text" class="form-control" placeholder="image.jpg" value="'.htmlentities(stripslashes($postdata['chapter-image'])).'" />';
				$content .= '<span class="input-group-btn">';
				$content .= '<button type="button" data-type="file-picker" class="btn btn-primary btn-flat" data-target="#postdata-chapter-image">';
				$content .= '<i class="fa fa-folder-open"></i>';
				$content .= '</button>';
				$content .= '</span>';
				$content .= '</div>';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field chapter_content:longtext **/
				$content .= '<div class="col-md-12">';
				$content .= '<div class="form-group">';
				$content .= '<label>Chapter Content</label>';
				$content .= '<textarea name="postdata[chapter-content]" id="postdata-chapter-content" class="form-control" data-type="html5" >'.htmlentities(stripslashes($postdata['chapter-content'])).'</textarea>';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-footer">';
				$content .= '<button type="submit" class="btn btn-flat btn-success" name="submit"><i class="fa fa-plus"></i> Add new Daily Current Affairs</button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</form>';
				$content .= '</section>';
				break;
			case "delete":
				// TODO: PAGE - DAILY - DELETE
				if(isset($_GET["id"])){
					$entry_id= (int)$_GET["id"];
					/** fetch current data **/
					$sql_query = "SELECT * FROM `daily` WHERE `chaper_id`=$entry_id LIMIT 0,1" ;
					$result = $mysql->query($sql_query);
					$rowdata = $result->fetch_array();
					if(isset($rowdata["chaper_id"])){
						$sql_query = "DELETE FROM `daily` WHERE `chaper_id`=$entry_id";
						$stmt = $mysql->prepare($sql_query);
						$stmt->execute();
						$stmt->close();
						header("Location: ?page=daily&notice=success-delete");
					}else{
						header("Location: ?page=daily&notice=wrong-id");
					}
				}
				break;
			}
			$content .= '</div>';
			$content .= '<footer class="main-footer">';
			$content .= '<div class="pull-right hidden-xs">';
			$content .= '<b>Version</b> 01.01.01';
			$content .= '</div>';
			$content .= '<strong>Copyright &copy; '.date("Y").' <a href="http://godigitally.co.in">Go Digitally</a>.</strong> All rights reserved.';
			$content .= '</footer>';
			$content .= '</div>';
			break;
	// TODO: PAGE - GK
	case "gk":
		$notification = null;
		if(isset($_GET["notice"])){
			switch($_GET["notice"]){
				case "success-delete":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully deleted the item of the <strong>GK data</strong>';
					$notification .= '</div>';
					break;
				case "success-edit":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully update the item of the <strong>GK data</strong>';
					$notification .= '</div>';
					break;
				case "success-add":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully add new item to the <strong>GK data</strong>';
					$notification .= '</div>';
					break;
				case "wrong-id":
					$notification .= '<div id="notification" class="alert alert-danger">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You did not find ID of this item in <strong>GK</strong>';
					$notification .= '</div>';
					break;
			}
		}
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		$page_title = "GK";
		$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";
		$current_user = $_SESSION["CURRENT_USER"];
		$content = null;
		$content .= '<div class="wrapper">';
		$content .= '<header class="main-header">';
		$content .= '<a href="?" class="logo">';
		$content .= '<span class="logo-mini"><b>PN</b>L</span>';
		$content .= '<span class="logo-lg"><b>'.$app_name.'</b> Panel</span>';
		$content .= '</a>';
		$content .= '<nav class="navbar navbar-static-top">';
		$content .= '<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">';
		$content .= '<span class="sr-only">Toggle navigation</span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '</a>';
		$content .= '<div class="navbar-custom-menu">';
		$content .= '<ul class="nav navbar-nav">';
		$content .= '<li class="dropdown user user-menu">';
		$content .= '<a href="?" class="dropdown-toggle" data-toggle="dropdown">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="user-image" alt="User Image">';
		$content .= '<span class="hidden-xs">' . htmlentities(stripslashes($current_user['user_name'])).'</span>';
		$content .= '</a>';
		$content .= '<ul class="dropdown-menu">';
		$content .= '<li class="user-header">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="User Image">';
		$content .= '<p>';
		$content .= '' . htmlentities(stripslashes($current_user['user_name'])).'';
		$content .= '<small>' . htmlentities(stripslashes($current_user['user_level'])).'</small>';
		$content .= '</p>';
		$content .= '</li>';
		$content .= '<li class="user-footer">';
		$content .= '<div class="pull-left">';
		$content .= '<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>';
		$content .= '</div>';
		$content .= '<div class="pull-right">';
		$content .= '<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>';
		$content .= '</div>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '<li>';
		$content .= '</ul>';
		$content .= '</div>';
		$content .= '</nav>';
		$content .= '</header>';
		$content .= '<aside class="main-sidebar">';
		$content .= '<section class="sidebar">';
		$content .= '<div class="user-panel">';
		$content .= '<div class="pull-left image">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="'.htmlentities(stripslashes($current_user['user_name'])).'">';
		$content .= '</div>';
		$content .= '<div class="pull-left info">';
		$content .= '<p>'.htmlentities(stripslashes($current_user['user_name'])).'</p>';
		$content .= '<a href="?"><i class="fa fa-circle text-success"></i> '.htmlentities(stripslashes($current_user['user_level'])).'</a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<ul class="sidebar-menu" data-widget="tree">';
		$content .= '<li class="header">DATA MANAGER</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-sitemap"></i> <span>Categories</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=categories&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=categories&amp;action=list"><i class="fa fa-list-ul"></i> All Categories</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-book"></i> <span>Chapters</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=chapters&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=chapters&amp;action=list"><i class="fa fa-list-ul"></i> All Chapters</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-newspaper-o"></i> <span>Daily Current Affairs</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=daily&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=daily&amp;action=list"><i class="fa fa-list-ul"></i> All Daily Current Affairs</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview active">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-lightbulb-o"></i> <span>GK</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=gk&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=gk&amp;action=list"><i class="fa fa-list-ul"></i> All GK</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-briefcase"></i> <span>Jobs</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=jobs&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=jobs&amp;action=list"><i class="fa fa-list-ul"></i> All Jobs</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="header">TOOLS</li>';
		$content .= '<li><a href="?page=onesignal-sender"><i class="fa fa-send"></i> <span>OneSignal Sender</span></a></li>';
		$content .= '<li class="header">USERS</li>';
		$content .= '<li><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>';
		$content .= '</ul>';
		$content .= '</section>';
		$content .= '</aside>';
		$content .= '<div class="content-wrapper">';
		switch($_GET["action"]){
			case "list":
				// TODO: PAGE - GK - LIST
				/** breadcrumb **/
				$content .= '<section class="content-header">';
				$content .= '<h1>GK<small></small></h1>';
				$content .= '<ol class="breadcrumb">';
				$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
				$content .= '<li><a href="?page=jobs&amp;action=list">GK</a></li>';
				$content .= '<li class="active">List</li>';
				$content .= '</ol>';
				$content .= '</section>';
				/** content **/
				$content .= '<section class="content">';
				$content .= $notification;
				$content .= '<div class="box box-danger">';
				$content .= '<div class="box-header with-border">';
				$content .= '<h3 class="box-title">All GK</h3>';
				$content .= '<div class="box-tools pull-right">';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-body">';
				$content .= '<div class="table-responsive">';
				$content .= '<table class="datatable table table-striped table-hover">';
				$content .= '<thead>';
				$content .= '<tr>';
				$content .= '<th>GK Title</th>';
				$content .= '<th>GK Image</th>';
				$content .= '<th style="width:100px;">#</th>';
				$content .= '</tr>';
				$content .= '</thead>';
				$content .= '<tbody>';
				/** fetch data from mysql **/
				$sql_query = "SELECT * FROM `gk` ORDER BY `gk_id` DESC" ;
				if($result = $mysql->query($sql_query)){
					while ($data = $result->fetch_array()){
						$content .= '<tr>';
						
						/** gk_id **/
						
						/** gk_title **/
						$content .= '<td>' . htmlentities(stripslashes(substr(strip_tags($data["gk_title"]),0,64))) . '</td>';
						
						/** gk_image **/
						if($data["gk_image"] ==""){
							$data["gk_image"] ="https://placehold.it/80x80";
						}
						$content .= '<td><img class="img-thumbnail" width="80" height="80" src="' . htmlentities(stripslashes(strip_tags($data["gk_image"]))) . '" class="img-thumbnail" alt="..."/></td>';
						
						/** gk_content **/
						$content .= '<td>';
						$content .= '<a href="?page=gk&amp;action=edit&amp;id='.$data["gk_id"].'" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i></a>';
						$content .= '<a class="btn btn-danger btn-flat btn-sm" href="#" onClick="doModal(\'Delete GK\',\'<div class=\\\'row\\\'><div class=\\\'col-md-3 text-center text-primary\\\'><i class=\\\'fa fa-5x fa-lightbulb-o\\\'></i></div><div class=\\\'col-md-9\\\'>You are about to permanently delete these items from your site. <br/>This action cannot be undo, `Cancel` to stop, `OK` to delete.</div></div>\',\'Ok\',\'danger\',\'window.location=\\\'?page=gk&amp;action=delete&amp;id='.$data["gk_id"].'\\\'\');"><i class="fa fa-trash"></i></a>';
						$content .= '</td>';
						$content .= '</tr>';
					}
				}
				$content .= '</tbody>';
				$content .= '</table>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</section>';
				break;
			case "edit":
				// TODO: PAGE - GK - EDIT
				if(isset($_GET["id"])){
					$entry_id= (int)$_GET["id"];
					/** fetch current data **/
					$sql_query = "SELECT * FROM `gk` WHERE `gk_id`=$entry_id LIMIT 0,1" ;
					$result = $mysql->query($sql_query);
					$rowdata = $result->fetch_array();
					if(isset($rowdata["gk_id"])){
						/** default value **/
						$postdata["gk-title"] = "" ;
						$postdata["gk-image"] = "" ;
						$postdata["gk-content"] = "" ;
						/** response postdata **/
						if(isset($_POST["submit"])){
							if(isset($_POST["postdata"]["gk-title"])){
								$postdata["gk-title"] = addslashes($_POST["postdata"]["gk-title"]);
							}
							if(isset($_POST["postdata"]["gk-image"])){
								$postdata["gk-image"] = addslashes($_POST["postdata"]["gk-image"]);
							}
							if(isset($_POST["postdata"]["gk-content"])){
								$postdata["gk-content"] = addslashes($_POST["postdata"]["gk-content"]);
							}
							$sql_query = "UPDATE `gk` SET `gk_title` = '{$postdata["gk-title"]}' ,`gk_image` = '{$postdata["gk-image"]}' ,`gk_content` = '{$postdata["gk-content"]}'  WHERE `gk_id`=$entry_id" ;
							$stmt = $mysql->prepare($sql_query);
							$stmt->execute();
							$stmt->close();
							header("Location: ?page=gk&action=edit&id=".$entry_id."&notice=success-edit");
						}
						/** init variable field **/
						$postdata["gk-title"] = '';
						if(isset($rowdata["gk_title"])){
							$postdata["gk-title"] = stripslashes($rowdata["gk_title"]);
						}
						$postdata["gk-image"] = '';
						if(isset($rowdata["gk_image"])){
							$postdata["gk-image"] = stripslashes($rowdata["gk_image"]);
						}
						$postdata["gk-content"] = '';
						if(isset($rowdata["gk_content"])){
							$postdata["gk-content"] = stripslashes($rowdata["gk_content"]);
						}
						/** breadcrumb **/
						$content .= '<section class="content-header">';
						$content .= '<h1>GK <small></small></h1>';
						$content .= '<ol class="breadcrumb">';
						$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
						$content .= '<li><a href="?">GK</a></li>';
						$content .= '<li class="active">Edit</li>';
						$content .= '</ol>';
						$content .= '</section>';
						/** content **/
						$content .= '<section class="content">';
						$content .= $notification;
						$content .= '<form action="" method="post">';
						$content .= '<div class="box box-primary">';
						$content .= '<div class="box-header with-border">';
						$content .= '<h3 class="box-title">Edit GK</h3>';
						$content .= '<div class="box-tools pull-right">';
						$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
						$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="box-body">';
						$content .= '<div class="row">';
						/** field gk_id:id **/
						/** field gk_title:varchar **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>GK Title</label>';
						$content .= '<input maxlength="128" name="postdata[gk-title]" id="postdata-gk-title" type="text" class="form-control" placeholder="GK Title" value="'.htmlentities(stripslashes($postdata['gk-title'])).'" />';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field gk_image:thumbnail **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>GK Image</label>';
						$content .= '<div class="input-group">';
						$content .= '<input name="postdata[gk-image]" id="postdata-gk-image" type="text" class="form-control" placeholder="image.jpg" value="'.htmlentities(stripslashes($postdata['gk-image'])).'" />';
						$content .= '<span class="input-group-btn">';
						$content .= '<button type="button" data-type="file-picker" class="btn btn-default btn-flat" data-target="#postdata-gk-image">';
						$content .= '<i class="fa fa-folder-open"></i>';
						$content .= '</button>';
						$content .= '<a class="btn btn-default btn-flat" target="_blank" href="'.htmlentities(stripslashes($postdata['gk-image'])).'" ><i class="fa fa-eye"></i></a>';
						$content .= '</span>';
						$content .= '</div>';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field gk_content:longtext **/
						$content .= '<div class="col-md-12">';
						$content .= '<div class="form-group">';
						$content .= '<label>GK Content</label>';
						$content .= '<textarea name="postdata[gk-content]" id="postdata-gk-content" class="form-control" data-type="html5" >'.htmlentities(stripslashes($postdata['gk-content'])).'</textarea>';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="box-footer">';
						$content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit"><i class="fa fa-floppy-o"></i> Update</button>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</form>';
						$content .= '</section>';
					}else{
						header("Location: ?page=gk&notice=wrong-id");
					}
				}else{
					header("Location: ?page=gk&notice=wrong-id");
				}
				break;
			case "add":
				// TODO: PAGE - GK - ADD
				/** default value **/
				$postdata["gk-title"] = "" ;
				$postdata["gk-image"] = "" ;
				$postdata["gk-content"] = "" ;
				/** response postdata **/
				if(isset($_POST["submit"])){
					if(isset($_POST["postdata"]["gk-title"])){
						$postdata["gk-title"] = addslashes($_POST["postdata"]["gk-title"]);
					}
					if(isset($_POST["postdata"]["gk-image"])){
						$postdata["gk-image"] = addslashes($_POST["postdata"]["gk-image"]);
					}
					if(isset($_POST["postdata"]["gk-content"])){
						$postdata["gk-content"] = addslashes($_POST["postdata"]["gk-content"]);
					}
					$sql_query = "INSERT INTO `gk` (`gk_title`,`gk_image`,`gk_content`) VALUES ('{$postdata['gk-title']}','{$postdata['gk-image']}','{$postdata['gk-content']}')" ;
					$mysql->query($sql_query);
					$last_id = $mysql->insert_id;
					header("Location: ?page=gk&notice=success-add&action=edit&id=".$last_id);
				}
				/** breadcrumb **/
				$content .= '<section class="content-header">';
				$content .= '<h1>GK <small></small></h1>';
				$content .= '<ol class="breadcrumb">';
				$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
				$content .= '<li><a href="?">GK</a></li>';
				$content .= '<li class="active">Add</li>';
				$content .= '</ol>';
				$content .= '</section>';
				/** content **/
				$content .= '<section class="content">';
				$content .= $notification;
				$content .= '<form action="" method="post">';
				$content .= '<div class="box box-success">';
				$content .= '<div class="box-header with-border">';
				$content .= '<h3 class="box-title">Add new GK</h3>';
				$content .= '<div class="box-tools pull-right">';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-body">';
				$content .= '<div class="row">';
				/** field gk_id:id **/
				/** field gk_title:varchar **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>GK Title</label>';
				$content .= '<input maxlength="128" name="postdata[gk-title]" id="postdata-gk-title" type="text" class="form-control" placeholder="GK Title" value="'.htmlentities(stripslashes($postdata['gk-title'])).'" />';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field gk_image:thumbnail **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>GK Image</label>';
				$content .= '<div class="input-group">';
				$content .= '<input name="postdata[gk-image]" id="postdata-gk-image" type="text" class="form-control" placeholder="image.jpg" value="'.htmlentities(stripslashes($postdata['gk-image'])).'" />';
				$content .= '<span class="input-group-btn">';
				$content .= '<button type="button" data-type="file-picker" class="btn btn-primary btn-flat" data-target="#postdata-gk-image">';
				$content .= '<i class="fa fa-folder-open"></i>';
				$content .= '</button>';
				$content .= '</span>';
				$content .= '</div>';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field gk_content:longtext **/
				$content .= '<div class="col-md-12">';
				$content .= '<div class="form-group">';
				$content .= '<label>GK Content</label>';
				$content .= '<textarea name="postdata[gk-content]" id="postdata-gk-content" class="form-control" data-type="html5" >'.htmlentities(stripslashes($postdata['gk-content'])).'</textarea>';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-footer">';
				$content .= '<button type="submit" class="btn btn-flat btn-success" name="submit"><i class="fa fa-plus"></i> Add new GK</button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</form>';
				$content .= '</section>';
				break;
			case "delete":
				// TODO: PAGE - GK - DELETE
				if(isset($_GET["id"])){
					$entry_id= (int)$_GET["id"];
					/** fetch current data **/
					$sql_query = "SELECT * FROM `gk` WHERE `gk_id`=$entry_id LIMIT 0,1" ;
					$result = $mysql->query($sql_query);
					$rowdata = $result->fetch_array();
					if(isset($rowdata["gk_id"])){
						$sql_query = "DELETE FROM `gk` WHERE `gk_id`=$entry_id";
						$stmt = $mysql->prepare($sql_query);
						$stmt->execute();
						$stmt->close();
						header("Location: ?page=gk&notice=success-delete");
					}else{
						header("Location: ?page=gk&notice=wrong-id");
					}
				}
				break;
			}
			$content .= '</div>';
			$content .= '<footer class="main-footer">';
			$content .= '<div class="pull-right hidden-xs">';
			$content .= '<b>Version</b> 01.01.01';
			$content .= '</div>';
			$content .= '<strong>Copyright &copy; '.date("Y").' <a href="http://godigitally.co.in">Go Digitally</a>.</strong> All rights reserved.';
			$content .= '</footer>';
			$content .= '</div>';
			break;
	// TODO: PAGE - JOBS
	case "jobs":
		$notification = null;
		if(isset($_GET["notice"])){
			switch($_GET["notice"]){
				case "success-delete":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully deleted the item of the <strong>Jobs data</strong>';
					$notification .= '</div>';
					break;
				case "success-edit":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully update the item of the <strong>Jobs data</strong>';
					$notification .= '</div>';
					break;
				case "success-add":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully add new item to the <strong>Jobs data</strong>';
					$notification .= '</div>';
					break;
				case "wrong-id":
					$notification .= '<div id="notification" class="alert alert-danger">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You did not find ID of this item in <strong>Jobs</strong>';
					$notification .= '</div>';
					break;
			}
		}
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		$page_title = "Jobs";
		$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";
		$current_user = $_SESSION["CURRENT_USER"];
		$content = null;
		$content .= '<div class="wrapper">';
		$content .= '<header class="main-header">';
		$content .= '<a href="?" class="logo">';
		$content .= '<span class="logo-mini"><b>PN</b>L</span>';
		$content .= '<span class="logo-lg"><b>'.$app_name.'</b> Panel</span>';
		$content .= '</a>';
		$content .= '<nav class="navbar navbar-static-top">';
		$content .= '<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">';
		$content .= '<span class="sr-only">Toggle navigation</span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '</a>';
		$content .= '<div class="navbar-custom-menu">';
		$content .= '<ul class="nav navbar-nav">';
		$content .= '<li class="dropdown user user-menu">';
		$content .= '<a href="?" class="dropdown-toggle" data-toggle="dropdown">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="user-image" alt="User Image">';
		$content .= '<span class="hidden-xs">' . htmlentities(stripslashes($current_user['user_name'])).'</span>';
		$content .= '</a>';
		$content .= '<ul class="dropdown-menu">';
		$content .= '<li class="user-header">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="User Image">';
		$content .= '<p>';
		$content .= '' . htmlentities(stripslashes($current_user['user_name'])).'';
		$content .= '<small>' . htmlentities(stripslashes($current_user['user_level'])).'</small>';
		$content .= '</p>';
		$content .= '</li>';
		$content .= '<li class="user-footer">';
		$content .= '<div class="pull-left">';
		$content .= '<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>';
		$content .= '</div>';
		$content .= '<div class="pull-right">';
		$content .= '<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>';
		$content .= '</div>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '<li>';
		$content .= '</ul>';
		$content .= '</div>';
		$content .= '</nav>';
		$content .= '</header>';
		$content .= '<aside class="main-sidebar">';
		$content .= '<section class="sidebar">';
		$content .= '<div class="user-panel">';
		$content .= '<div class="pull-left image">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="'.htmlentities(stripslashes($current_user['user_name'])).'">';
		$content .= '</div>';
		$content .= '<div class="pull-left info">';
		$content .= '<p>'.htmlentities(stripslashes($current_user['user_name'])).'</p>';
		$content .= '<a href="?"><i class="fa fa-circle text-success"></i> '.htmlentities(stripslashes($current_user['user_level'])).'</a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<ul class="sidebar-menu" data-widget="tree">';
		$content .= '<li class="header">DATA MANAGER</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-sitemap"></i> <span>Categories</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=categories&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=categories&amp;action=list"><i class="fa fa-list-ul"></i> All Categories</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-book"></i> <span>Chapters</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=chapters&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=chapters&amp;action=list"><i class="fa fa-list-ul"></i> All Chapters</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-newspaper-o"></i> <span>Daily Current Affairs</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=daily&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=daily&amp;action=list"><i class="fa fa-list-ul"></i> All Daily Current Affairs</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview ">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-lightbulb-o"></i> <span>GK</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=gk&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=gk&amp;action=list"><i class="fa fa-list-ul"></i> All GK</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview active">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-briefcase"></i> <span>Jobs</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=jobs&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=jobs&amp;action=list"><i class="fa fa-list-ul"></i> All Jobs</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="header">TOOLS</li>';
		$content .= '<li><a href="?page=onesignal-sender"><i class="fa fa-send"></i> <span>OneSignal Sender</span></a></li>';
		$content .= '<li class="header">USERS</li>';
		$content .= '<li><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>';
		$content .= '</ul>';
		$content .= '</section>';
		$content .= '</aside>';
		$content .= '<div class="content-wrapper">';
		switch($_GET["action"]){
			case "list":
				// TODO: PAGE - JOBS - LIST
				/** breadcrumb **/
				$content .= '<section class="content-header">';
				$content .= '<h1>Jobs<small></small></h1>';
				$content .= '<ol class="breadcrumb">';
				$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
				$content .= '<li><a href="?page=jobs&amp;action=list">Jobs</a></li>';
				$content .= '<li class="active">List</li>';
				$content .= '</ol>';
				$content .= '</section>';
				/** content **/
				$content .= '<section class="content">';
				$content .= $notification;
				$content .= '<div class="box box-danger">';
				$content .= '<div class="box-header with-border">';
				$content .= '<h3 class="box-title">All Jobs</h3>';
				$content .= '<div class="box-tools pull-right">';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-body">';
				$content .= '<div class="table-responsive">';
				$content .= '<table class="datatable table table-striped table-hover">';
				$content .= '<thead>';
				$content .= '<tr>';
				$content .= '<th>Job Title</th>';
				$content .= '<th>Company Name</th>';
				$content .= '<th>Company Logo</th>';
				$content .= '<th>Last Date</th>';
				$content .= '<th style="width:100px;">#</th>';
				$content .= '</tr>';
				$content .= '</thead>';
				$content .= '<tbody>';
				/** fetch data from mysql **/
				$sql_query = "SELECT * FROM `jobs` ORDER BY `job_id` DESC" ;
				if($result = $mysql->query($sql_query)){
					while ($data = $result->fetch_array()){
						$content .= '<tr>';
						
						/** job_id **/
						
						/** job_title **/
						$content .= '<td>' . htmlentities(stripslashes(substr(strip_tags($data["job_title"]),0,64))) . '</td>';
						
						/** company_name **/
						$content .= '<td>' . htmlentities(stripslashes(substr(strip_tags($data["company_name"]),0,64))) . '</td>';
						
						/** company_logo **/
						if($data["company_logo"] ==""){
							$data["company_logo"] ="https://placehold.it/80x80";
						}
						$content .= '<td><img class="img-thumbnail" width="80" height="80" src="' . htmlentities(stripslashes(strip_tags($data["company_logo"]))) . '" class="img-thumbnail" alt="..."/></td>';
						
						/** last_date **/
						$content .= '<td>' . htmlentities(stripslashes($data["last_date"])) . '</td>';
						
						/** job_details **/
						
						/** job_notification **/
						
						/** notification_file **/
						$content .= '<td>';
						$content .= '<a href="?page=jobs&amp;action=edit&amp;id='.$data["job_id"].'" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i></a>';
						$content .= '<a class="btn btn-danger btn-flat btn-sm" href="#" onClick="doModal(\'Delete Job\',\'<div class=\\\'row\\\'><div class=\\\'col-md-3 text-center text-primary\\\'><i class=\\\'fa fa-5x fa-briefcase\\\'></i></div><div class=\\\'col-md-9\\\'>You are about to permanently delete these items from your site. <br/>This action cannot be undo, `Cancel` to stop, `OK` to delete.</div></div>\',\'Ok\',\'danger\',\'window.location=\\\'?page=jobs&amp;action=delete&amp;id='.$data["job_id"].'\\\'\');"><i class="fa fa-trash"></i></a>';
						$content .= '</td>';
						$content .= '</tr>';
					}
				}
				$content .= '</tbody>';
				$content .= '</table>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</section>';
				break;
			case "edit":
				// TODO: PAGE - JOBS - EDIT
				if(isset($_GET["id"])){
					$entry_id= (int)$_GET["id"];
					/** fetch current data **/
					$sql_query = "SELECT * FROM `jobs` WHERE `job_id`=$entry_id LIMIT 0,1" ;
					$result = $mysql->query($sql_query);
					$rowdata = $result->fetch_array();
					if(isset($rowdata["job_id"])){
						/** default value **/
						$postdata["job-title"] = "" ;
						$postdata["company-name"] = "" ;
						$postdata["company-logo"] = "" ;
						$postdata["last-date"] = "" ;
						$postdata["job-details"] = "" ;
						$postdata["job-notification"] = "" ;
						$postdata["notification-file"] = "" ;
						/** response postdata **/
						if(isset($_POST["submit"])){
							if(isset($_POST["postdata"]["job-title"])){
								$postdata["job-title"] = addslashes($_POST["postdata"]["job-title"]);
							}
							if(isset($_POST["postdata"]["company-name"])){
								$postdata["company-name"] = addslashes($_POST["postdata"]["company-name"]);
							}
							if(isset($_POST["postdata"]["company-logo"])){
								$postdata["company-logo"] = addslashes($_POST["postdata"]["company-logo"]);
							}
							if(isset($_POST["postdata"]["last-date"])){
								$postdata["last-date"] = addslashes($_POST["postdata"]["last-date"]);
							}
							if(isset($_POST["postdata"]["job-details"])){
								$postdata["job-details"] = addslashes($_POST["postdata"]["job-details"]);
							}
							if(isset($_POST["postdata"]["job-notification"])){
								$postdata["job-notification"] = addslashes($_POST["postdata"]["job-notification"]);
							}
							if(isset($_POST["postdata"]["notification-file"])){
								$postdata["notification-file"] = addslashes($_POST["postdata"]["notification-file"]);
							}
							$sql_query = "UPDATE `jobs` SET `job_title` = '{$postdata["job-title"]}' ,`company_name` = '{$postdata["company-name"]}' ,`company_logo` = '{$postdata["company-logo"]}' ,`last_date` = '{$postdata["last-date"]}' ,`job_details` = '{$postdata["job-details"]}' ,`job_notification` = '{$postdata["job-notification"]}' ,`notification_file` = '{$postdata["notification-file"]}'  WHERE `job_id`=$entry_id" ;
							$stmt = $mysql->prepare($sql_query);
							$stmt->execute();
							$stmt->close();
							header("Location: ?page=jobs&action=edit&id=".$entry_id."&notice=success-edit");
						}
						/** init variable field **/
						$postdata["job-title"] = '';
						if(isset($rowdata["job_title"])){
							$postdata["job-title"] = stripslashes($rowdata["job_title"]);
						}
						$postdata["company-name"] = '';
						if(isset($rowdata["company_name"])){
							$postdata["company-name"] = stripslashes($rowdata["company_name"]);
						}
						$postdata["company-logo"] = '';
						if(isset($rowdata["company_logo"])){
							$postdata["company-logo"] = stripslashes($rowdata["company_logo"]);
						}
						$postdata["last-date"] = '';
						if(isset($rowdata["last_date"])){
							$postdata["last-date"] = stripslashes($rowdata["last_date"]);
						}
						$postdata["job-details"] = '';
						if(isset($rowdata["job_details"])){
							$postdata["job-details"] = stripslashes($rowdata["job_details"]);
						}
						$postdata["job-notification"] = '';
						if(isset($rowdata["job_notification"])){
							$postdata["job-notification"] = stripslashes($rowdata["job_notification"]);
						}
						$postdata["notification-file"] = '';
						if(isset($rowdata["notification_file"])){
							$postdata["notification-file"] = stripslashes($rowdata["notification_file"]);
						}
						/** breadcrumb **/
						$content .= '<section class="content-header">';
						$content .= '<h1>Jobs <small></small></h1>';
						$content .= '<ol class="breadcrumb">';
						$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
						$content .= '<li><a href="?">Jobs</a></li>';
						$content .= '<li class="active">Edit</li>';
						$content .= '</ol>';
						$content .= '</section>';
						/** content **/
						$content .= '<section class="content">';
						$content .= $notification;
						$content .= '<form action="" method="post">';
						$content .= '<div class="box box-primary">';
						$content .= '<div class="box-header with-border">';
						$content .= '<h3 class="box-title">Edit Job</h3>';
						$content .= '<div class="box-tools pull-right">';
						$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
						$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="box-body">';
						$content .= '<div class="row">';
						/** field job_id:id **/
						/** field job_title:varchar **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Job Title</label>';
						$content .= '<input maxlength="128" name="postdata[job-title]" id="postdata-job-title" type="text" class="form-control" placeholder="Job Title" value="'.htmlentities(stripslashes($postdata['job-title'])).'" />';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field company_name:varchar **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Company Name</label>';
						$content .= '<input maxlength="128" name="postdata[company-name]" id="postdata-company-name" type="text" class="form-control" placeholder="Microsoft" value="'.htmlentities(stripslashes($postdata['company-name'])).'" />';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field company_logo:thumbnail **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Company Logo</label>';
						$content .= '<div class="input-group">';
						$content .= '<input name="postdata[company-logo]" id="postdata-company-logo" type="text" class="form-control" placeholder="image.jpg" value="'.htmlentities(stripslashes($postdata['company-logo'])).'" />';
						$content .= '<span class="input-group-btn">';
						$content .= '<button type="button" data-type="file-picker" class="btn btn-default btn-flat" data-target="#postdata-company-logo">';
						$content .= '<i class="fa fa-folder-open"></i>';
						$content .= '</button>';
						$content .= '<a class="btn btn-default btn-flat" target="_blank" href="'.htmlentities(stripslashes($postdata['company-logo'])).'" ><i class="fa fa-eye"></i></a>';
						$content .= '</span>';
						$content .= '</div>';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field last_date:date **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Last Date</label>';
						$content .= '<div class="input-group date">';
						$content .= '<div class="input-group-addon"><i class="fa fa-calendar"></i></div>';
						$content .= '<input name="postdata[last-date]" id="postdata-last-date" type="text" class="form-control" placeholder="'.date("Y-m-d").'" value="'.htmlentities(stripslashes($postdata['last-date'])).'" data-type="date" />';
						$content .= '</div>';
						$content .= '<p class="help-block">Filled with date</p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field job_details:longtext **/
						$content .= '<div class="col-md-12">';
						$content .= '<div class="form-group">';
						$content .= '<label>Job Details</label>';
						$content .= '<textarea name="postdata[job-details]" id="postdata-job-details" class="form-control" data-type="html5" >'.htmlentities(stripslashes($postdata['job-details'])).'</textarea>';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field job_notification:varchar **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Notification</label>';
						$content .= '<input maxlength="128" name="postdata[job-notification]" id="postdata-job-notification" type="text" class="form-control" placeholder="" value="'.htmlentities(stripslashes($postdata['job-notification'])).'" />';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						/** field notification_file:varchar **/
						$content .= '<div class="col-md-6">';
						$content .= '<div class="form-group">';
						$content .= '<label>Notification File</label>';
						$content .= '<input maxlength="128" name="postdata[notification-file]" id="postdata-notification-file" type="text" class="form-control" placeholder="Notification File" value="'.htmlentities(stripslashes($postdata['notification-file'])).'" />';
						$content .= '<p class="help-block"></p>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '<div class="box-footer">';
						$content .= '<button type="submit" class="btn btn-flat btn-primary" name="submit"><i class="fa fa-floppy-o"></i> Update</button>';
						$content .= '</div>';
						$content .= '</div>';
						$content .= '</form>';
						$content .= '</section>';
					}else{
						header("Location: ?page=jobs&notice=wrong-id");
					}
				}else{
					header("Location: ?page=jobs&notice=wrong-id");
				}
				break;
			case "add":
				// TODO: PAGE - JOBS - ADD
				/** default value **/
				$postdata["job-title"] = "" ;
				$postdata["company-name"] = "" ;
				$postdata["company-logo"] = "" ;
				$postdata["last-date"] = "" ;
				$postdata["job-details"] = "" ;
				$postdata["job-notification"] = "" ;
				$postdata["notification-file"] = "" ;
				/** response postdata **/
				if(isset($_POST["submit"])){
					if(isset($_POST["postdata"]["job-title"])){
						$postdata["job-title"] = addslashes($_POST["postdata"]["job-title"]);
					}
					if(isset($_POST["postdata"]["company-name"])){
						$postdata["company-name"] = addslashes($_POST["postdata"]["company-name"]);
					}
					if(isset($_POST["postdata"]["company-logo"])){
						$postdata["company-logo"] = addslashes($_POST["postdata"]["company-logo"]);
					}
					if(isset($_POST["postdata"]["last-date"])){
						$postdata["last-date"] = addslashes($_POST["postdata"]["last-date"]);
					}
					if(isset($_POST["postdata"]["job-details"])){
						$postdata["job-details"] = addslashes($_POST["postdata"]["job-details"]);
					}
					if(isset($_POST["postdata"]["job-notification"])){
						$postdata["job-notification"] = addslashes($_POST["postdata"]["job-notification"]);
					}
					if(isset($_POST["postdata"]["notification-file"])){
						$postdata["notification-file"] = addslashes($_POST["postdata"]["notification-file"]);
					}
					$sql_query = "INSERT INTO `jobs` (`job_title`,`company_name`,`company_logo`,`last_date`,`job_details`,`job_notification`,`notification_file`) VALUES ('{$postdata['job-title']}','{$postdata['company-name']}','{$postdata['company-logo']}','{$postdata['last-date']}','{$postdata['job-details']}','{$postdata['job-notification']}','{$postdata['notification-file']}')" ;
					$mysql->query($sql_query);
					$last_id = $mysql->insert_id;
					header("Location: ?page=jobs&notice=success-add&action=edit&id=".$last_id);
				}
				/** breadcrumb **/
				$content .= '<section class="content-header">';
				$content .= '<h1>Jobs <small></small></h1>';
				$content .= '<ol class="breadcrumb">';
				$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
				$content .= '<li><a href="?">Jobs</a></li>';
				$content .= '<li class="active">Add</li>';
				$content .= '</ol>';
				$content .= '</section>';
				/** content **/
				$content .= '<section class="content">';
				$content .= $notification;
				$content .= '<form action="" method="post">';
				$content .= '<div class="box box-success">';
				$content .= '<div class="box-header with-border">';
				$content .= '<h3 class="box-title">Add new Job</h3>';
				$content .= '<div class="box-tools pull-right">';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
				$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-body">';
				$content .= '<div class="row">';
				/** field job_id:id **/
				/** field job_title:varchar **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Job Title</label>';
				$content .= '<input maxlength="128" name="postdata[job-title]" id="postdata-job-title" type="text" class="form-control" placeholder="Job Title" value="'.htmlentities(stripslashes($postdata['job-title'])).'" />';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field company_name:varchar **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Company Name</label>';
				$content .= '<input maxlength="128" name="postdata[company-name]" id="postdata-company-name" type="text" class="form-control" placeholder="Microsoft" value="'.htmlentities(stripslashes($postdata['company-name'])).'" />';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field company_logo:thumbnail **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Company Logo</label>';
				$content .= '<div class="input-group">';
				$content .= '<input name="postdata[company-logo]" id="postdata-company-logo" type="text" class="form-control" placeholder="image.jpg" value="'.htmlentities(stripslashes($postdata['company-logo'])).'" />';
				$content .= '<span class="input-group-btn">';
				$content .= '<button type="button" data-type="file-picker" class="btn btn-primary btn-flat" data-target="#postdata-company-logo">';
				$content .= '<i class="fa fa-folder-open"></i>';
				$content .= '</button>';
				$content .= '</span>';
				$content .= '</div>';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field last_date:date **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Last Date</label>';
				$content .= '<div class="input-group date">';
				$content .= '<div class="input-group-addon"><i class="fa fa-calendar"></i></div>';
				$content .= '<input name="postdata[last-date]" id="postdata-last-date" type="text" class="form-control" placeholder="'.date("Y-m-d").'" value="'.htmlentities(stripslashes($postdata['last-date'])).'" data-type="date" />';
				$content .= '</div>';
				$content .= '<p class="help-block">Filled with date</p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field job_details:longtext **/
				$content .= '<div class="col-md-12">';
				$content .= '<div class="form-group">';
				$content .= '<label>Job Details</label>';
				$content .= '<textarea name="postdata[job-details]" id="postdata-job-details" class="form-control" data-type="html5" >'.htmlentities(stripslashes($postdata['job-details'])).'</textarea>';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field job_notification:varchar **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Notification</label>';
				$content .= '<input maxlength="128" name="postdata[job-notification]" id="postdata-job-notification" type="text" class="form-control" placeholder="" value="'.htmlentities(stripslashes($postdata['job-notification'])).'" />';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				/** field notification_file:varchar **/
				$content .= '<div class="col-md-6">';
				$content .= '<div class="form-group">';
				$content .= '<label>Notification File</label>';
				$content .= '<input maxlength="128" name="postdata[notification-file]" id="postdata-notification-file" type="text" class="form-control" placeholder="Notification File" value="'.htmlentities(stripslashes($postdata['notification-file'])).'" />';
				$content .= '<p class="help-block"></p>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '<div class="box-footer">';
				$content .= '<button type="submit" class="btn btn-flat btn-success" name="submit"><i class="fa fa-plus"></i> Add new Job</button>';
				$content .= '</div>';
				$content .= '</div>';
				$content .= '</form>';
				$content .= '</section>';
				break;
			case "delete":
				// TODO: PAGE - JOBS - DELETE
				if(isset($_GET["id"])){
					$entry_id= (int)$_GET["id"];
					/** fetch current data **/
					$sql_query = "SELECT * FROM `jobs` WHERE `job_id`=$entry_id LIMIT 0,1" ;
					$result = $mysql->query($sql_query);
					$rowdata = $result->fetch_array();
					if(isset($rowdata["job_id"])){
						$sql_query = "DELETE FROM `jobs` WHERE `job_id`=$entry_id";
						$stmt = $mysql->prepare($sql_query);
						$stmt->execute();
						$stmt->close();
						header("Location: ?page=jobs&notice=success-delete");
					}else{
						header("Location: ?page=jobs&notice=wrong-id");
					}
				}
				break;
			}
			$content .= '</div>';
			$content .= '<footer class="main-footer">';
			$content .= '<div class="pull-right hidden-xs">';
			$content .= '<b>Version</b> 01.01.01';
			$content .= '</div>';
			$content .= '<strong>Copyright &copy; '.date("Y").' <a href="http://godigitally.co.in">Go Digitally</a>.</strong> All rights reserved.';
			$content .= '</footer>';
			$content .= '</div>';
			break;
	// TODO: PAGE - PROFILE
	case "profile":
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		$page_title = "Profile";
		$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";
		$notification = null;
		if(isset($_GET["notice"])){
			switch($_GET["notice"]){
				case "success-profile-update":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'You have successfully update your profile.';
					$notification .= '</div>';
					break;
				case "error-password-too-short":
					$notification .= '<div id="notification" class="alert alert-danger">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'The new password you wrote is too short, at least 6 characters or more';
					$notification .= '</div>';
					break;
				case "error-password-not-same":
					$notification .= '<div id="notification" class="alert alert-danger">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'The new password and new password again are not the same, please try again!';
					$notification .= '</div>';
					break;
				case "error-old-password":
					$notification .= '<div id="notification" class="alert alert-danger">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'Your old password is wrong, please try again!';
					$notification .= '</div>';
					break;
				case "success-password-update":
					$notification .= '<div id="notification" class="alert alert-success">';
					$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
					$notification .= 'Your password has been changed, please logout!';
					$notification .= '</div>';
					break;
			}
		}
		$sql_query = "SELECT * FROM `users` WHERE `user_id` = '{$_SESSION["CURRENT_USER"]["user_id"]}' AND `user_email` = '{$_SESSION["CURRENT_USER"]["user_email"]}'" ;
		$result = $mysql->query($sql_query);
		$current_user = $result->fetch_array();
		if(!isset($current_user["user_email"])){
			header("Location: ?page=login");
		}
		
		/** resp update profile **/
		if(isset($_POST["user-data"])){
			$user_first_name = addslashes($_POST["postdata"]["user-first-name"]) ;
			$user_last_name = addslashes($_POST["postdata"]["user-last-name"]) ;
			$user_website = addslashes($_POST["postdata"]["user-website"]) ;
			$sql_query = "UPDATE `users` SET `user_first_name` = '{$user_first_name}', `user_last_name` = '{$user_last_name}',`user_website` = '{$user_website}' WHERE `user_id` ={$current_user["user_id"]};";
			$stmt = $mysql->prepare($sql_query);
			$stmt->execute();
			$stmt->close();
			$_SESSION["CURRENT_USER"]["user_first_name"] = $user_first_name;
			header("Location: ?page=profile&notice=success-profile-update");
		}
		
		/** resp update password **/
		if(isset($_POST["user-password"])){
			if(strlen($_POST["postdata"]["user-new-password"]) >= 6){
				if($_POST["postdata"]["user-new-password"] == $_POST["postdata"]["user-new-password-again"]){
					$old_password_hash = sha1("imabuilder".$_POST["postdata"]["user-old-password"]);
					if($old_password_hash == $current_user["user_password"]){
						$user_password = sha1("imabuilder".$_POST["postdata"]["user-new-password"]);
						$sql_query = "UPDATE `users` SET `user_password` = '{$user_password}' WHERE `user_id` ={$current_user["user_id"]};";
						$stmt = $mysql->prepare($sql_query);
						$stmt->execute();
						$stmt->close();
						header("Location: ?page=profile&notice=success-password-update");
					}else{
						header("Location: ?page=profile&notice=error-old-password");
					}
				}else{
					header("Location: ?page=profile&notice=error-password-not-same");
				}
			}else{
				header("Location: ?page=profile&notice=error-password-too-short");
			}
		}
		
		$content = null;
		$content .= '<div class="wrapper">';
		$content .= '<header class="main-header">';
		$content .= '<a href="?" class="logo">';
		$content .= '<span class="logo-mini"><b>PN</b>L</span>';
		$content .= '<span class="logo-lg"><b>'.$app_name.'</b> Panel</span>';
		$content .= '</a>';
		$content .= '<nav class="navbar navbar-static-top">';
		$content .= '<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">';
		$content .= '<span class="sr-only">Toggle navigation</span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '</a>';
		$content .= '<div class="navbar-custom-menu">';
		$content .= '<ul class="nav navbar-nav">';
		$content .= '<li class="dropdown user user-menu">';
		$content .= '<a href="?" class="dropdown-toggle" data-toggle="dropdown">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="user-image" alt="User Image">';
		$content .= '<span class="hidden-xs">' . htmlentities(stripslashes($current_user['user_name'])).'</span>';
		$content .= '</a>';
		$content .= '<ul class="dropdown-menu">';
		$content .= '<li class="user-header">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="User Image">';
		$content .= '<p>';
		$content .= '' . htmlentities(stripslashes($current_user['user_name'])).'';
		$content .= '<small>' . htmlentities(stripslashes($current_user['user_level'])).'</small>';
		$content .= '</p>';
		$content .= '</li>';
		$content .= '<li class="user-footer">';
		$content .= '<div class="pull-left">';
		$content .= '<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>';
		$content .= '</div>';
		$content .= '<div class="pull-right">';
		$content .= '<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>';
		$content .= '</div>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '</div>';
		$content .= '</nav>';
		$content .= '</header>';
		$content .= '<aside class="main-sidebar">';
		$content .= '<section class="sidebar">';
		$content .= '<div class="user-panel">';
		$content .= '<div class="pull-left image">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="'.htmlentities(stripslashes($current_user['user_name'])).'">';
		$content .= '</div>';
		$content .= '<div class="pull-left info">';
		$content .= '<p>'.htmlentities(stripslashes($current_user['user_name'])).'</p>';
		$content .= '<a href="?"><i class="fa fa-circle text-success"></i> '.htmlentities(stripslashes($current_user['user_level'])).'</a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<ul class="sidebar-menu" data-widget="tree">';
		$content .= '<li class="header">DATA MANAGER</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-sitemap"></i> <span>Categories</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=categories&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=categories&amp;action=list"><i class="fa fa-list-ul"></i> All Categories</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-book"></i> <span>Chapters</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=chapters&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=chapters&amp;action=list"><i class="fa fa-list-ul"></i> All Chapters</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-newspaper-o"></i> <span>Daily Current Affairs</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=daily&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=daily&amp;action=list"><i class="fa fa-list-ul"></i> All Daily Current Affairs</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-lightbulb-o"></i> <span>GK</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=gk&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=gk&amp;action=list"><i class="fa fa-list-ul"></i> All GK</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-briefcase"></i> <span>Jobs</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=jobs&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=jobs&amp;action=list"><i class="fa fa-list-ul"></i> All Jobs</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="header">TOOLS</li>';
		$content .= '<li><a href="?page=onesignal-sender"><i class="fa fa-send"></i> <span>OneSignal Sender</span></a></li>';
		$content .= '<li class="header">USERS</li>';
		$content .= '<li class="active"><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>';
		$content .= '</ul>';
		$content .= '</section>';
		$content .= '</aside>';
		$content .= '<div class="content-wrapper">';
		/** breadcrumb **/
		$content .= '<section class="content-header">';
		$content .= '<h1>Profile <small>Your personal data</small></h1>';
		$content .= '<ol class="breadcrumb">';
		$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
		$content .= '<li class="active">Profile</li>';
		$content .= '</ol>';
		$content .= '</section>';
		/** content **/
		$content .= '<section class="content">';
		$content .= $notification;
		$content .= '<div class="row">';
		$content .= '<div class="col-md-3">';
		$content .= '<div class="box box-primary">';
		$content .= '<div class="box-body box-profile">';
		$content .= '<img class="profile-user-img img-responsive img-circle" src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'?s=128" alt="User profile picture">';
		$content .= '<h3 class="profile-username text-center">' . htmlentities(stripslashes($current_user['user_name'])).'</h3>';
		$content .= '<p class="text-muted text-center">' . htmlentities(stripslashes($current_user['user_level'])).'</p>';
		$content .= '<ul class="list-group list-group-unbordered">';
		
		/** count categories data **/
		$sql_query = "SELECT COUNT(*) AS `total` FROM `categories` LIMIT 0,1" ;
		$result = $mysql->query($sql_query);
		$count = $result->fetch_array();
		$content .= '<li class="list-group-item">';
		$content .= '<b>Categories</b> <a class="pull-right">'.$count["total"].'</a>';
		$content .= '</li>';
		
		/** count chapters data **/
		$sql_query = "SELECT COUNT(*) AS `total` FROM `chapters` LIMIT 0,1" ;
		$result = $mysql->query($sql_query);
		$count = $result->fetch_array();
		$content .= '<li class="list-group-item">';
		$content .= '<b>Chapters</b> <a class="pull-right">'.$count["total"].'</a>';
		$content .= '</li>';
		
		/** count daily data **/
		$sql_query = "SELECT COUNT(*) AS `total` FROM `daily` LIMIT 0,1" ;
		$result = $mysql->query($sql_query);
		$count = $result->fetch_array();
		$content .= '<li class="list-group-item">';
		$content .= '<b>Daily Current Affairs</b> <a class="pull-right">'.$count["total"].'</a>';
		$content .= '</li>';
		
		/** count gk data **/
		$sql_query = "SELECT COUNT(*) AS `total` FROM `gk` LIMIT 0,1" ;
		$result = $mysql->query($sql_query);
		$count = $result->fetch_array();
		$content .= '<li class="list-group-item">';
		$content .= '<b>GK</b> <a class="pull-right">'.$count["total"].'</a>';
		$content .= '</li>';
		
		/** count jobs data **/
		$sql_query = "SELECT COUNT(*) AS `total` FROM `jobs` LIMIT 0,1" ;
		$result = $mysql->query($sql_query);
		$count = $result->fetch_array();
		$content .= '<li class="list-group-item">';
		$content .= '<b>Jobs</b> <a class="pull-right">'.$count["total"].'</a>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '<a href="https://en.gravatar.com/" target="_blank" class="btn btn-flat btn-primary btn-block"><b>Change Gravatar</b></a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="col-md-5">';
		$content .= '<form action="" method="post">';
		$content .= '<div class="box box-success">';
		$content .= '<div class="box-header with-border">';
		$content .= '<h3 class="box-title">About Yourself</h3>';
		$content .= '<div class="box-tools pull-right">';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="box-body">';
		$content .= '<div class="form-group">';
		$content .= '<label>First Name</label>';
		$content .= '<input name="postdata[user-first-name]" id="postdata-user-first-name" type="text" class="form-control" placeholder="Regel" value="'.htmlentities(stripslashes($current_user['user_first_name'])).'" />';
		$content .= '<p class="help-block">What is your first name?</p>';
		$content .= '</div>';
		$content .= '<div class="form-group">';
		$content .= '<label>Last Name</label>';
		$content .= '<input name="postdata[user-last-name]" id="postdata-user-last-name" type="text" class="form-control" placeholder="Jambak" value="'.htmlentities(stripslashes($current_user['user_last_name'])).'" />';
		$content .= '<p class="help-block">What is your last name?</p>';
		$content .= '</div>';
		$content .= '<div class="form-group">';
		$content .= '<label>Email Address</label>';
		$content .= '<input name="postdata[user-email]" id="postdata-user-email" type="text" class="form-control" placeholder="regel@ihsana.com" value="'.htmlentities(stripslashes($current_user['user_email'])).'" readonly/>';
		$content .= '<p class="help-block">What is the email address used to log in?</p>';
		$content .= '</div>';
		$content .= '<div class="form-group">';
		$content .= '<label>Website</label>';
		$content .= '<input name="postdata[user-website]" id="postdata-user-website" type="text" class="form-control" placeholder="http://ihsana.com" value="'.htmlentities(stripslashes($current_user['user_website'])).'" />';
		$content .= '<p class="help-block">What is the your website?</p>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="box-footer">';
		$content .= '<button type="submit" class="btn btn-flat btn-success" name="user-data"><i class="fa fa-floppy-o"></i> Update Profile</button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</form>';
		$content .= '</div>';
		$content .= '<div class="col-md-4">';
		$content .= '<form action="" method="post">';
		$content .= '<div class="box box-danger">';
		$content .= '<div class="box-header with-border">';
		$content .= '<h3 class="box-title">Account Management</h3>';
		$content .= '<div class="box-tools pull-right">';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="box-body">';
		$content .= '<div class="form-group">';
		$content .= '<label>Old Password</label>';
		$content .= '<input name="postdata[user-old-password]" id="postdata-user-old-password" type="password" class="form-control" autocomplete="off"/>';
		$content .= '<p class="help-block">What is old password have you used?</p>';
		$content .= '</div>';
		$content .= '<div class="form-group">';
		$content .= '<label>New Password</label>';
		$content .= '<input name="postdata[user-new-password]" id="postdata-user-new-password" type="password" class="form-control" autocomplete="off"/>';
		$content .= '<p class="help-block">What is your new password?</p>';
		$content .= '</div>';
		$content .= '<div class="form-group">';
		$content .= '<label>New Password Again</label>';
		$content .= '<input name="postdata[user-new-password-again]" id="postdata-user-new-password-again" type="password" class="form-control" autocomplete="off"/>';
		$content .= '<p class="help-block">Type again new password</p>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="box-footer">';
		$content .= '<button type="submit" class="btn btn-flat btn-danger" name="user-password"><i class="fa fa-floppy-o"></i> Update</button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</form>';
		$content .= '</div>';
		$content .= '</section>';
		$content .= '</div>';
		$content .= '<footer class="main-footer">';
		$content .= '<div class="pull-right hidden-xs">';
		$content .= '<b>Version</b> 01.01.01';
		$content .= '</div>';
		$content .= '<strong>Copyright &copy; '.date("Y").' <a href="http://godigitally.co.in">Go Digitally</a>.</strong> All rights reserved.';
		$content .= '</footer>';
		$content .= '</div>';
		break;
	// TODO: PAGE - FILE-BROWSER
	case "file-browser":
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		if(!file_exists("./filebrowser/php/autoload.php")){
			die("elfinder not installed, please download <a target=\"blank\" href=\"https://studio-42.github.io/elFinder/\">elfinder</a> and extracted into `filebrowser` directory");
		}
		$site_url="";
		if(isset($_SERVER["HTTP_REFERER"])){
			$parse_url = parse_url($_SERVER["HTTP_REFERER"]);
			$site_url = $parse_url["scheme"] . "://" . $parse_url["host"] . "/" . dirname($parse_url["path"]) . "/";
		}
		$content .= '<!DOCTYPE HTML>';
		$content .= '<html>';
		$content .= '<head>';
		$content .= '<meta charset="utf-8" />';
		$content .= '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />';
		$content .= '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2" />';
		$content .= '<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css" />';
		$content .= '<link rel="stylesheet" href="./filebrowser/css/elfinder.min.css"/>';
		$content .= '<link rel="stylesheet" href="./filebrowser/css/theme.css"/>';
		$content .= '<title>elFinder</title>';
		$content .= '<style type="text/css">';
		$content .= 'body {padding: 0 !important;margin: 0 !important;}';
		$content .= '#elfinder{z-index:999999999;height: 100%; width: 100%;}';
		$content .= 'div{border-radius: 0 !important;}';
		$content .= '</style>';
		$content .= '</head>';
		$content .= '<body>';
		$content .= '<div id="elfinder"></div>';
		$content .= '<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>';
		$content .= '<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>';
		$content .= '<script src="./filebrowser/js/elfinder.min.js"></script>';
		$content .= '<script type="text/javascript">';
		if(isset($_GET["CKEditor"])){
			$content .= 'function getUrlParam(n){var a=new RegExp("(?:[?&]|&)"+n+"=([^&]+)","i"),e=window.location.search.match(a);return e&&1<e.length?e[1]:null}';
			$content .= 'var userfiles="";$(document).ready(function(){$("#elfinder").elfinder({cssAutoLoad:!1,baseUrl:"./",url:"?page=file-connector",width:"100%",height:"100%",resizable:!1,getFileCallback:function(n,e){var i=n.path;i=i.replace(/\\\\/gi,"/");var t="'.$site_url.'"+i.replace(/src\//gi,"");window.opener.CKEDITOR.tools.callFunction(getUrlParam("CKEditorFuncNum"),t),window.close()}},function(i,n){i.bind("init",function(){"ja"===i.lang&&i.loadScript(["//cdn.rawgit.com/polygonplanet/encoding.js/1.0.26/encoding.min.js"],function(){window.Encoding&&Encoding.convert&&i.registRawStringDecoder(function(n){return Encoding.convert(n,{to:"UNICODE",type:"string"})})},{loadType:"tag"})});var t=document.title;i.bind("open",function(){var n="",e=i.cwd();e&&(n=i.path(e.hash)||null),document.title=n?n+":"+t:t}).bind("destroy",function(){document.title=t})})});';
		}else{
			$content .= 'var userfiles="";$(document).ready(function(){$("#elfinder").elfinder({cssAutoLoad:!1,baseUrl:"./",url:"?page=file-connector",width:"100%",height:"100%",resizable:!1,getFileCallback:function(n,e){var i=n.path;i=i.replace(/\\\\/gi,"/");var t="'.$site_url.'"+i.replace(/src\//gi,"");window.opener.fileBrowser.callBack(t),window.close()}},function(i,n){i.bind("init",function(){"ja"===i.lang&&i.loadScript(["//cdn.rawgit.com/polygonplanet/encoding.js/1.0.26/encoding.min.js"],function(){window.Encoding&&Encoding.convert&&i.registRawStringDecoder(function(n){return Encoding.convert(n,{to:"UNICODE",type:"string"})})},{loadType:"tag"})});var t=document.title;i.bind("open",function(){var n="",e=i.cwd();e&&(n=i.path(e.hash)||null),document.title=n?n+":"+t:t}).bind("destroy",function(){document.title=t})})});';
		}
		$content .= '</script>';
		$content .= '</body>';
		$content .= '</html>';
		die($content);
		break;
	// TODO: PAGE - FILE-CONNECTOR
	case "file-connector":
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		if(file_exists("./filebrowser/php/autoload.php")){
			require "./filebrowser/php/autoload.php";
			elFinder::$netDrivers["ftp"] = "FTP";
			function access($attr, $path, $data, $volume, $isDir, $relpath){
				$basename = basename($path);
				return $basename[0] === "."
				&& strlen($relpath) !== 1
					? !($attr == "read" || $attr == "write")
					: null;
			}
			$opts = array( // "debug" => true,
				"roots" => array( // Items volume
					array(
					"driver" => "LocalFileSystem", // driver for accessing file system (REQUIRED)
					"path" => "./userfiles/", // path to files (REQUIRED)
					"URL" => dirname($_SERVER["PHP_SELF"]) . "/userfiles/", // URL to files (REQUIRED)
					"trashHash" => "t1_Lw", // elFinder"s hash of trash folder
					"winHashFix" => DIRECTORY_SEPARATOR !== "/", // to make hash same to Linux one on windows too
					"uploadDeny" => array("all"), // All Mimetypes not allowed to upload
					"uploadAllow" => array(
						"image/x-ms-bmp",
						"image/gif",
						"image/jpeg",
						"image/png",
						"image/x-icon",
						"text/plain"), // Mimetype `image` and `text/plain` allowed to upload
					"uploadOrder" => array("deny", "allow"), // allowed Mimetype `image` and `text/plain` only
					"accessControl" => "access" // disable and hide dot starting files (OPTIONAL)
				), // Trash volume
				array(
					"id" => "1",
					"driver" => "Trash",
					"path" => "./userfiles/.trash/",
					"tmbURL" => dirname($_SERVER["PHP_SELF"]) . "/userfiles/.trash/.tmb/",
					"winHashFix" => DIRECTORY_SEPARATOR !== "/", // to make hash same to Linux one on windows too
					"uploadDeny" => array("all"), // Recomend the same settings as the original volume that uses the trash
					"uploadAllow" => array(
						"image/x-ms-bmp",
						"image/gif",
						"image/jpeg",
						"image/png",
						"image/x-icon",
						"text/plain"), // Same as above
					"uploadOrder" => array("deny", "allow"), // Same as above
					"accessControl" => "access", // Same as above
				)));
			$connector = new elFinderConnector(new elFinder($opts));
			$connector->run();
		}else{
			die("elfinder not installed");
		}
		die($content);
		break;
	// TODO: PAGE - ONESIGNAL-SENDER
	case "onesignal-sender":
		if($_SESSION["IS_LOGIN"]==false){
			header("Location: ?page=login");
		}
		$page_title = "Profile";
		$body_class = "hold-transition skin-".$config["color"]." sidebar-mini";
		$current_user = $_SESSION["CURRENT_USER"];
		$notification = null;
		if(isset($_POST["send-push"])){
			$push_content = array("en" => $_POST["push-message"]);
		
			$fields = array(
				"app_id" => $config["onesignal_app_id"],
				"included_segments" => array("All"),
				"data" => array("page" => ""),
				"contents" => $push_content
			);
		
			$fields = json_encode($fields);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=utf-8", "Authorization: Basic " . $config["onesignal_api_key"]));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$response = json_decode(curl_exec($ch), true);
			curl_close($ch);
		
			if (isset($response["errors"][0])){
				$notification .= '<div id="notification" class="alert alert-danger">';
				$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
				$notification .=  $response["errors"][0];
				$notification .= '</div>';
			} else{
				$notification .= '<div id="notification" class="alert alert-success">';
				$notification .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
				$notification .= 'ID #' . $response["id"] . ' with ' . $response["recipients"] . ' recipients';
				$notification .= '</div>';
			}
		
		}
		$content = null;
		$content .= '<div class="wrapper">';
		$content .= '<header class="main-header">';
		$content .= '<a href="?" class="logo">';
		$content .= '<span class="logo-mini"><b>PN</b>L</span>';
		$content .= '<span class="logo-lg"><b>'.$app_name.'</b> Panel</span>';
		$content .= '</a>';
		$content .= '<nav class="navbar navbar-static-top">';
		$content .= '<a href="?" class="sidebar-toggle" data-toggle="push-menu" role="button">';
		$content .= '<span class="sr-only">Toggle navigation</span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '<span class="icon-bar"></span>';
		$content .= '</a>';
		$content .= '<div class="navbar-custom-menu">';
		$content .= '<ul class="nav navbar-nav">';
		$content .= '<li class="dropdown user user-menu">';
		$content .= '<a href="?" class="dropdown-toggle" data-toggle="dropdown">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="user-image" alt="User Image">';
		$content .= '<span class="hidden-xs">' . htmlentities(stripslashes($current_user['user_name'])).'</span>';
		$content .= '</a>';
		$content .= '<ul class="dropdown-menu">';
		$content .= '<li class="user-header">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="User Image">';
		$content .= '<p>';
		$content .= '' . htmlentities(stripslashes($current_user['user_name'])).'';
		$content .= '<small>' . htmlentities(stripslashes($current_user['user_level'])).'</small>';
		$content .= '</p>';
		$content .= '</li>';
		$content .= '<li class="user-footer">';
		$content .= '<div class="pull-left">';
		$content .= '<a href="?page=profile" class="btn btn-default btn-flat">Profile</a>';
		$content .= '</div>';
		$content .= '<div class="pull-right">';
		$content .= '<a href="?page=logout" class="btn btn-default btn-flat">Sign out</a>';
		$content .= '</div>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '</ul>';
		$content .= '</div>';
		$content .= '</nav>';
		$content .= '</header>';
		$content .= '<aside class="main-sidebar">';
		$content .= '<section class="sidebar">';
		$content .= '<div class="user-panel">';
		$content .= '<div class="pull-left image">';
		$content .= '<img src="https://www.gravatar.com/avatar/' . md5(strtolower(trim($current_user['user_email']))).'" class="img-circle" alt="'.htmlentities(stripslashes($current_user['user_name'])).'">';
		$content .= '</div>';
		$content .= '<div class="pull-left info">';
		$content .= '<p>'.htmlentities(stripslashes($current_user['user_name'])).'</p>';
		$content .= '<a href="?"><i class="fa fa-circle text-success"></i> '.htmlentities(stripslashes($current_user['user_level'])).'</a>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<ul class="sidebar-menu" data-widget="tree">';
		$content .= '<li class="header">DATA MANAGER</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-sitemap"></i> <span>Categories</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=categories&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=categories&amp;action=list"><i class="fa fa-list-ul"></i> All Categories</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-book"></i> <span>Chapters</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=chapters&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=chapters&amp;action=list"><i class="fa fa-list-ul"></i> All Chapters</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-newspaper-o"></i> <span>Daily Current Affairs</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=daily&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=daily&amp;action=list"><i class="fa fa-list-ul"></i> All Daily Current Affairs</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-lightbulb-o"></i> <span>GK</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=gk&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=gk&amp;action=list"><i class="fa fa-list-ul"></i> All GK</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="treeview">';
		$content .= '<a href="?">';
		$content .= '<i class="fa fa-briefcase"></i> <span>Jobs</span>';
		$content .= '<span class="pull-right-container">';
		$content .= '<i class="fa fa-angle-left pull-right"></i>';
		$content .= '</span>';
		$content .= '</a>';
		$content .= '<ul class="treeview-menu">';
		$content .= '<li><a href="?page=jobs&amp;action=add"><i class="fa fa-plus"></i> Add New</a></li>';
		$content .= '<li><a href="?page=jobs&amp;action=list"><i class="fa fa-list-ul"></i> All Jobs</a></li>';
		$content .= '</ul>';
		$content .= '</li>';
		$content .= '<li class="header">TOOLS</li>';
		$content .= '<li class="active"><a href="?page=onesignal-sender"><i class="fa fa-send"></i> <span>OneSignal Sender</span></a></li>';
		$content .= '<li class="header">USERS</li>';
		$content .= '<li><a href="?page=profile"><i class="fa fa-user"></i> <span>Your Profile</span></a></li>';
		$content .= '</ul>';
		$content .= '</section>';
		$content .= '</aside>';
		$content .= '<div class="content-wrapper">';
		/** breadcrumb **/
		$content .= '<section class="content-header">';
		$content .= '<h1>OneSignal Sender <small>Send push notifications for your app</small></h1>';
		$content .= '<ol class="breadcrumb">';
		$content .= '<li><a href="?"><i class="fa fa-dashboard"></i> Home</a></li>';
		$content .= '<li class="active">OneSignal Sender</li>';
		$content .= '</ol>';
		$content .= '</section>';
		/** content **/
		$content .= '<section class="content">';
		$content .= $notification;
		$content .= '<form action="" method="post">';
		$content .= '<div class="box box-danger">';
		$content .= '<div class="box-header with-border">';
		$content .= '<h3 class="box-title">Push Notification</h3>';
		$content .= '<div class="box-tools pull-right">';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>';
		$content .= '<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="box-body">';
		$content .= '<div class="form-group">';
		$content .= '<label class="">Message</label>';
		$content .= '<textarea class="form-control" name="push-message"></textarea>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div class="box-footer">';
		$content .= '<button type="submit" class="btn btn-flat btn-danger" name="send-push"><i class="fa fa-plane"></i> Send notification!</button>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</form>';
		$content .= '</section>';
		$content .= '</div><!-- ./content-wrapper -->';
		$content .= '<footer class="main-footer">';
		$content .= '<div class="pull-right hidden-xs">';
		$content .= '<b>Version</b> 01.01.01';
		$content .= '</div>';
		$content .= '<strong>Copyright &copy; '.date("Y").' <a href="http://godigitally.co.in">Go Digitally</a>.</strong> All rights reserved.';
		$content .= '</footer>';
		$content .= '</div><!-- ./wrapper -->';
		break;
}

$mysql->close();
$html_tags = null;
$html_tags .= '<!DOCTYPE html>';
$html_tags .= '<html>';
$html_tags .= '<head>';
$html_tags .= '<meta charset="utf-8">';
$html_tags .= '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
$html_tags .= '<meta name="generator" content="IMA-BuildeRz vrev20.10.18" />';
$html_tags .= '<title>'. htmlentities($app_name .' | '. $page_title) .'</title>';
$html_tags .= '<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">';
$html_tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3/dist/css/bootstrap.min.css">';
$html_tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4/css/font-awesome.min.css">';
$html_tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@2/dist/css/AdminLTE.min.css">';
$html_tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@2/dist/css/skins/_all-skins.min.css">';
$html_tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-tagsinput@0.7.1/dist/bootstrap-tagsinput.min.css">';
$html_tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables.net-bs@1/css/dataTables.bootstrap.min.css">';
$html_tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/eonasdan-bootstrap-datetimepicker@4/build/css/bootstrap-datetimepicker.min.css">';
$html_tags .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icheck@1/skins/all.css">';
$html_tags .= '<!--[if lt IE 9]>';
$html_tags .= '<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>';
$html_tags .= '<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>';
$html_tags .= '<![endif]-->';
$html_tags .= '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Anton|Staatliches|Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">';
$html_tags .= '<style type="text/css">';
$html_tags .= 'body{background: url(\''.$config["background"].'\') no-repeat center center fixed !important; -webkit-background-size: cover !important;-moz-background-size: cover !important;-o-background-size: cover !important; background-size: cover !important; }';
$html_tags .= '.well h1 {font-weight:600;font-family:Anton;font-size:48px;}';
$html_tags .= '.content-header h1 {font-size:32px;font-family:Anton;}';
$html_tags .= '.login-logo img {width: 100px;height: 100px;}';
$html_tags .= '.login-logo a, .register-logo a {color: #fff;text-shadow: 1px 1px 1px #333;-webkit-text-shadow: 1px 1px 1px #333;-moz-text-shadow: 1px 1px 1px #333;-o-text-shadow: 1px 1px 1px #333;}';
$html_tags .= 'hr {border-top: 1px solid #ddd;}';
$html_tags .= '.bootstrap-tagsinput{display: block !important;border-radius: 0 !important;}';
$html_tags .= '</style>';
$html_tags .= '</head>';
$html_tags .= '<body class="'.$body_class.'">';
$html_tags .= $content ;
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/jquery@3/dist/jquery.min.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/bootstrap@3/dist/js/bootstrap.min.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/bootstrap-tagsinput@0.7.1/dist/bootstrap-tagsinput.min.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/datatables.net@1/js/jquery.dataTables.min.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/datatables.net-bs@1/js/dataTables.bootstrap.min.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/ckeditor@4/ckeditor.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/ckeditor@4/adapters/jquery.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/moment@2/moment.min.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/eonasdan-bootstrap-datetimepicker@4/build/js/bootstrap-datetimepicker.min.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/icheck@1/icheck.min.js"></script>';
$html_tags .= '<script src="https://cdn.jsdelivr.net/npm/admin-lte@2/dist/js/adminlte.min.js"></script>';
$html_tags .= '<script>';
$html_tags .= '$(document).ready(function(){';
$html_tags .= '$(".delete").on("click",function(){ var target = $(this).attr("data-target") ;$(target).replaceWith(""); });';
$html_tags .= '$(".sidebar-menu").tree();';
$html_tags .= '$(".datatable").length && $(".datatable").dataTable({"order":[[0,"desc"]]});';
$html_tags .= '$("textarea[data-type=\'html5\']").length && $("textarea[data-type=\'html5\']").ckeditor({filebrowserBrowseUrl:"?page=file-browser"});';
$html_tags .= '$("input[data-type=\'tags\']").length && $("input[data-type=\'tags\']").tagsinput();';
$html_tags .= '$("input[data-type=\'date\']").length && $("input[data-type=\'date\']").datetimepicker({format:\'YYYY-MM-DD\'});';
$html_tags .= '$("input[data-type=\'datetime\']").length && $("input[data-type=\'datetime\']").datetimepicker({format:"YYYY-MM-DD HH:mm:ss"});';
$html_tags .= '$("input[data-type=\'time\']").length && $("input[data-type=\'time\']").datetimepicker({format:"HH:mm:ss"});';
$html_tags .= '$("input[type=\'radio\'].flat-red").length && $("input[type=\'radio\'].flat-red").iCheck({checkboxClass:"icheckbox_flat-red",radioClass:"iradio_flat-red"});';
$html_tags .= 'var fileBrowserTarget="undefined";window.fileBrowser={callBack:function(a){$(fileBrowserTarget).val(a)},open:function(a){var b=window.open("?page=file-browser","File Browser","scrollbars=no, width=1028, height=480, top="+((window.innerHeight?window.innerHeight:document.documentElement.clientHeight?document.documentElement.clientHeight:screen.height)/2-240+(void 0!=window.screenTop?window.screenTop:window.screenY))+", left="+((window.innerWidth?window.innerWidth:document.documentElement.clientWidth?document.documentElement.clientWidth:screen.width)/2-514+(void 0!=window.screenLeft?window.screenLeft:window.screenX)));fileBrowserTarget=a;window.focus&&b.focus()}};if($(\'*[data-type="file-picker"]\').length)$(\'*[data-type="file-picker"]\').on("click",function(){var a=$(this).attr("data-target");fileBrowser.open(a);return!1});';
$html_tags .= '});';
$html_tags .= 'function doModal(a,l,d,m,t){html=\'<div id="dynamicModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirm-modal" aria-hidden="true">\',html+=\'<div class="modal-dialog">\',html+=\'<div class="modal-content">\',html+=\'<div class="modal-header">\',html+=\'<a class="close" data-dismiss="modal">&times;</a>\',html+="<h4 class=\"modal-title\">"+a+"</h4>",html+="</div>",html+=\'<div class="modal-body">\',html+=l,html+="</div>",html+=\'<div class="modal-footer">\',""!=d&&(html+=\'<span class="btn btn-flat btn-\'+m+\'" onClick="\'+t+\'">\'+d+"</span>"),html+=\'<span class="btn btn-default btn-flat pull-left" data-dismiss="modal">Cancel</span>\',html+="</div>",html+="</div>",html+="</div>",html+="</div>",$("body").append(html),$("#dynamicModal").modal(),$("#dynamicModal").modal("show"),$("#dynamicModal").on("hidden.bs.modal",function(a){$(this).remove()})}';
$html_tags .= 'setTimeout(function(){$("#notification").fadeOut()},5e3);';
$html_tags .= '</script>';
$html_tags .= '</body>';
$html_tags .= '</html>';
echo $html_tags;
