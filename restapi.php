<?php
/**
 * @author Mahesh Babu <info@godigitally.co.in>
 * @copyright Go Digitally 2020
 * @package current-affairs-quiz
 * 
 * 
 * Created using IMABuildeRz v3 (rev20.10.18)
 */


/** site **/
$config["app-name"]			= "Current Affairs Quiz" ; //Write the name of your website
$config["app-desc"]			= "Current Affairs GK Quiz App" ; //Write a brief description of your website
$config["utf8"]				= true; 
$config["debug"]			= false; 
$config["protect"]			= false; 
$config["url"]			= "https://cagkquiz.herokuapp.com/restapi.php"; 
$config["userfile_url"]			= ""; // leave blank for absolute urls
$config["timezone"]			= "Asia/Kolkata" ; // check this site: http://php.net/manual/en/timezones.php
$config["gzip"]			= false; //compressed page 

/** mysql **/
$config["db_host"]				= "us-cdbr-east-02.cleardb.com" ; //host
$config["db_user"]				= "b56cb747d9962d" ; //Username SQL
$config["db_pwd"]				= "fa7a108a" ; //Password SQL
$config["db_name"]			= "heroku_978ed889cbdaeea" ; //Database


/** DON'T EDIT THE CODE BELLOW **/
session_start();
if($config["gzip"]==true){
	ob_start("ob_gzhandler");
}
ini_set("internal_encoding", "utf-8");
date_default_timezone_set($config["timezone"]);
if($config["debug"]==true){
	error_reporting(E_ALL);
}else{
	error_reporting(0);
}

if($config["protect"]==true){
	if(isset($_SERVER["HTTP_USER_AGENT"])){
		if(!preg_match("/current\-affairs\-quiz/i",$_SERVER["HTTP_USER_AGENT"])){
			die("Not allowed");
		}
	}else{
		die("Not allowed");
	}
}

if(isset($_SERVER["HTTP_X_AUTHORIZATION"])){
	$_SERVER["HTTP_AUTHORIZATION"] = $_SERVER["HTTP_X_AUTHORIZATION"];
}
/** CONNECT TO MYSQL **/
$mysql = new mysqli($config["db_host"], $config["db_user"], $config["db_pwd"], $config["db_name"]);
if (mysqli_connect_errno()){
	die(mysqli_connect_error());
}

if($config["utf8"]==true){
	$mysql->set_charset("utf8");
}
if(!isset($_GET["api"])){
	$_GET["api"]= "route";
}
$root_url = $config["url"];
$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Routes not found");
switch($_GET["api"]){
	case "route":
		// TODO: JSON --+-- ROUTES
		$rest_api=array();
		$rest_api["name"] = "Current Affairs Quiz" ;
		$rest_api["description"] = "Current Affairs GK Quiz App" ;
		$rest_api["generator"] = "IMA-BuildeRz vrev20.10.18" ;

		$rest_api["namespaces"][1] = "categories/";
		$rest_api["namespaces"][2] = "chapters/";
		$rest_api["namespaces"][3] = "daily/";
		$rest_api["namespaces"][4] = "gk/";
		$rest_api["namespaces"][5] = "jobs/";

		$rest_api["routes"]["/categories/"]["namespace"] = "categories/";
		$rest_api["routes"]["/categories/"]["methods"][0] = "GET";
		$rest_api["routes"]["/categories/"]["endpoints"][0]["methods"][0] = "GET";
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["category-name"]["required"] = false;
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["category-name"]["default"] = "";
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["category-name"]["type"] = "string";
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["category-name"]["description"] = "Limit result set to items with more specific by `category_name`.";

		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["orderby"]["required"] = false;
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["orderby"]["default"] = "cat_id";
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["orderby"]["type"] = "string";
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["orderby"]["enum"][0] = "cat-id";
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["orderby"]["enum"][1] = "category-name";
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["orderby"]["enum"][2] = "category-image";
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["orderby"]["description"] = "Sort collection by object attribute";
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["sort"]["required"] = false;
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["sort"]["default"] = "asc";
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["sort"]["type"] = "string";
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["sort"]["enum"][0] = "asc";
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["sort"]["enum"][1] = "desc";
		$rest_api["routes"]["/categories/"]["endpoints"][0]["args"]["sort"]["description"] = "Order sort attribute ascending or descending";
		$rest_api["routes"]["/categories/"]["endpoints"][0]["_links"][0] = $root_url . "?api=categories";

		$rest_api["routes"]["/categories/(?P<cat-id>[\d]+)"]["namespace"] = "categories/";
		$rest_api["routes"]["/categories/(?P<cat-id>[\d]+)"]["method"][0] = "GET";
		$rest_api["routes"]["/categories/(?P<cat-id>[\d]+)"]["endpoints"]["args"]["cat-id"]["required"] = "true";
		$rest_api["routes"]["/categories/(?P<cat-id>[\d]+)"]["endpoints"]["args"]["cat-id"]["type"] = "integer";
		$rest_api["routes"]["/categories/(?P<cat-id>[\d]+)"]["endpoints"]["args"]["cat-id"]["description"] = "Unique identifier for the object";
		$rest_api["routes"]["/categories/(?P<cat-id>[\d]+)"]["endpoints"]["_links"][0] = $root_url . "?api=categories&cat-id=<cat-id>";

		$rest_api["routes"]["/chapters/"]["namespace"] = "chapters/";
		$rest_api["routes"]["/chapters/"]["methods"][0] = "GET";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["methods"][0] = "GET";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["chapter-name"]["required"] = false;
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["chapter-name"]["default"] = "";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["chapter-name"]["type"] = "string";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["chapter-name"]["description"] = "Limit result set to items with more specific by `chapter_name`.";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["chapter-category"]["required"] = false;
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["chapter-category"]["default"] = "";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["chapter-category"]["type"] = "string";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["chapter-category"]["description"] = "Limit result set to items with more specific by `chapter_category`.";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["chapter-content"]["required"] = false;
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["chapter-content"]["default"] = "";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["chapter-content"]["type"] = "string";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["chapter-content"]["description"] = "Limit result set to items with more specific by `chapter_content`.";

		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["orderby"]["required"] = false;
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["orderby"]["default"] = "chapter_id";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["orderby"]["type"] = "string";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["orderby"]["enum"][0] = "chapter-id";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["orderby"]["enum"][1] = "chapter-name";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["orderby"]["enum"][2] = "chapter-category";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["orderby"]["enum"][3] = "chapter-image";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["orderby"]["enum"][4] = "chapter-content";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["orderby"]["description"] = "Sort collection by object attribute";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["sort"]["required"] = false;
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["sort"]["default"] = "asc";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["sort"]["type"] = "string";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["sort"]["enum"][0] = "asc";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["sort"]["enum"][1] = "desc";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["args"]["sort"]["description"] = "Order sort attribute ascending or descending";
		$rest_api["routes"]["/chapters/"]["endpoints"][0]["_links"][0] = $root_url . "?api=chapters";

		$rest_api["routes"]["/chapters/(?P<chapter-id>[\d]+)"]["namespace"] = "chapters/";
		$rest_api["routes"]["/chapters/(?P<chapter-id>[\d]+)"]["method"][0] = "GET";
		$rest_api["routes"]["/chapters/(?P<chapter-id>[\d]+)"]["endpoints"]["args"]["chapter-id"]["required"] = "true";
		$rest_api["routes"]["/chapters/(?P<chapter-id>[\d]+)"]["endpoints"]["args"]["chapter-id"]["type"] = "integer";
		$rest_api["routes"]["/chapters/(?P<chapter-id>[\d]+)"]["endpoints"]["args"]["chapter-id"]["description"] = "Unique identifier for the object";
		$rest_api["routes"]["/chapters/(?P<chapter-id>[\d]+)"]["endpoints"]["_links"][0] = $root_url . "?api=chapters&chapter-id=<chapter-id>";

		$rest_api["routes"]["/daily/"]["namespace"] = "daily/";
		$rest_api["routes"]["/daily/"]["methods"][0] = "GET";
		$rest_api["routes"]["/daily/"]["endpoints"][0]["methods"][0] = "GET";
		$rest_api["routes"]["/daily/"]["endpoints"][0]["args"]["chapter-name"]["required"] = false;
		$rest_api["routes"]["/daily/"]["endpoints"][0]["args"]["chapter-name"]["default"] = "";
		$rest_api["routes"]["/daily/"]["endpoints"][0]["args"]["chapter-name"]["type"] = "string";
		$rest_api["routes"]["/daily/"]["endpoints"][0]["args"]["chapter-name"]["description"] = "Limit result set to items with more specific by `chapter_name`.";
		$rest_api["routes"]["/daily/"]["endpoints"][0]["args"]["published-date"]["required"] = false;
		$rest_api["routes"]["/daily/"]["endpoints"][0]["args"]["published-date"]["default"] = "";
		$rest_api["routes"]["/daily/"]["endpoints"][0]["args"]["published-date"]["type"] = "string";
		$rest_api["routes"]["/daily/"]["endpoints"][0]["args"]["published-date"]["description"] = "Limit result set to items with more specific by `published_date`.";
		$rest_api["routes"]["/daily/"]["endpoints"][0]["args"]["chapter-content"]["required"] = false;
		$rest_api["routes"]["/daily/"]["endpoints"][0]["args"]["chapter-content"]["default"] = "";
		$rest_api["routes"]["/daily/"]["endpoints"][0]["args"]["chapter-content"]["type"] = "string";
		$rest_api["routes"]["/daily/"]["endpoints"][0]["args"]["chapter-content"]["description"] = "Limit result set to items with more specific by `chapter_content`.";

		$rest_api["routes"]["/daily/"]["endpoints"][0]["args"]["orderby"]["required"] = false;
		$rest_api["routes"]["/daily/"]["endpoints"][0]["args"]["orderby"]["default"] = "chaper_id";
		$rest_api["routes"]["/daily/"]["endpoints"][0]["args"]["orderby"]["type"] = "string";
		$rest_api["routes"]["/daily/"]["endpoints"][0]["args"]["orderby"]["enum"][0] = "chaper-id";
		$rest_api["routes"]["/daily/"]["endpoints"][0]["args"]["orderby"]["enum"][1] = "chapter-name";
		$rest_api["routes"]["/daily/"]["endpoints"][0]["args"]["orderby"]["enum"][2] = "published-date";
		$rest_api["routes"]["/daily/"]["endpoints"][0]["args"]["orderby"]["enum"][3] = "chapter-image";
		$rest_api["routes"]["/daily/"]["endpoints"][0]["args"]["orderby"]["enum"][4] = "chapter-content";
		$rest_api["routes"]["/daily/"]["endpoints"][0]["args"]["orderby"]["description"] = "Sort collection by object attribute";
		$rest_api["routes"]["/daily/"]["endpoints"][0]["args"]["sort"]["required"] = false;
		$rest_api["routes"]["/daily/"]["endpoints"][0]["args"]["sort"]["default"] = "asc";
		$rest_api["routes"]["/daily/"]["endpoints"][0]["args"]["sort"]["type"] = "string";
		$rest_api["routes"]["/daily/"]["endpoints"][0]["args"]["sort"]["enum"][0] = "asc";
		$rest_api["routes"]["/daily/"]["endpoints"][0]["args"]["sort"]["enum"][1] = "desc";
		$rest_api["routes"]["/daily/"]["endpoints"][0]["args"]["sort"]["description"] = "Order sort attribute ascending or descending";
		$rest_api["routes"]["/daily/"]["endpoints"][0]["_links"][0] = $root_url . "?api=daily";

		$rest_api["routes"]["/daily/(?P<chaper-id>[\d]+)"]["namespace"] = "daily/";
		$rest_api["routes"]["/daily/(?P<chaper-id>[\d]+)"]["method"][0] = "GET";
		$rest_api["routes"]["/daily/(?P<chaper-id>[\d]+)"]["endpoints"]["args"]["chaper-id"]["required"] = "true";
		$rest_api["routes"]["/daily/(?P<chaper-id>[\d]+)"]["endpoints"]["args"]["chaper-id"]["type"] = "integer";
		$rest_api["routes"]["/daily/(?P<chaper-id>[\d]+)"]["endpoints"]["args"]["chaper-id"]["description"] = "Unique identifier for the object";
		$rest_api["routes"]["/daily/(?P<chaper-id>[\d]+)"]["endpoints"]["_links"][0] = $root_url . "?api=daily&chaper-id=<chaper-id>";

		$rest_api["routes"]["/gk/"]["namespace"] = "gk/";
		$rest_api["routes"]["/gk/"]["methods"][0] = "GET";
		$rest_api["routes"]["/gk/"]["endpoints"][0]["methods"][0] = "GET";
		$rest_api["routes"]["/gk/"]["endpoints"][0]["args"]["gk-title"]["required"] = false;
		$rest_api["routes"]["/gk/"]["endpoints"][0]["args"]["gk-title"]["default"] = "";
		$rest_api["routes"]["/gk/"]["endpoints"][0]["args"]["gk-title"]["type"] = "string";
		$rest_api["routes"]["/gk/"]["endpoints"][0]["args"]["gk-title"]["description"] = "Limit result set to items with more specific by `gk_title`.";
		$rest_api["routes"]["/gk/"]["endpoints"][0]["args"]["gk-content"]["required"] = false;
		$rest_api["routes"]["/gk/"]["endpoints"][0]["args"]["gk-content"]["default"] = "";
		$rest_api["routes"]["/gk/"]["endpoints"][0]["args"]["gk-content"]["type"] = "string";
		$rest_api["routes"]["/gk/"]["endpoints"][0]["args"]["gk-content"]["description"] = "Limit result set to items with more specific by `gk_content`.";

		$rest_api["routes"]["/gk/"]["endpoints"][0]["args"]["orderby"]["required"] = false;
		$rest_api["routes"]["/gk/"]["endpoints"][0]["args"]["orderby"]["default"] = "gk_id";
		$rest_api["routes"]["/gk/"]["endpoints"][0]["args"]["orderby"]["type"] = "string";
		$rest_api["routes"]["/gk/"]["endpoints"][0]["args"]["orderby"]["enum"][0] = "gk-id";
		$rest_api["routes"]["/gk/"]["endpoints"][0]["args"]["orderby"]["enum"][1] = "gk-title";
		$rest_api["routes"]["/gk/"]["endpoints"][0]["args"]["orderby"]["enum"][2] = "gk-image";
		$rest_api["routes"]["/gk/"]["endpoints"][0]["args"]["orderby"]["enum"][3] = "gk-content";
		$rest_api["routes"]["/gk/"]["endpoints"][0]["args"]["orderby"]["description"] = "Sort collection by object attribute";
		$rest_api["routes"]["/gk/"]["endpoints"][0]["args"]["sort"]["required"] = false;
		$rest_api["routes"]["/gk/"]["endpoints"][0]["args"]["sort"]["default"] = "asc";
		$rest_api["routes"]["/gk/"]["endpoints"][0]["args"]["sort"]["type"] = "string";
		$rest_api["routes"]["/gk/"]["endpoints"][0]["args"]["sort"]["enum"][0] = "asc";
		$rest_api["routes"]["/gk/"]["endpoints"][0]["args"]["sort"]["enum"][1] = "desc";
		$rest_api["routes"]["/gk/"]["endpoints"][0]["args"]["sort"]["description"] = "Order sort attribute ascending or descending";
		$rest_api["routes"]["/gk/"]["endpoints"][0]["_links"][0] = $root_url . "?api=gk";

		$rest_api["routes"]["/gk/(?P<gk-id>[\d]+)"]["namespace"] = "gk/";
		$rest_api["routes"]["/gk/(?P<gk-id>[\d]+)"]["method"][0] = "GET";
		$rest_api["routes"]["/gk/(?P<gk-id>[\d]+)"]["endpoints"]["args"]["gk-id"]["required"] = "true";
		$rest_api["routes"]["/gk/(?P<gk-id>[\d]+)"]["endpoints"]["args"]["gk-id"]["type"] = "integer";
		$rest_api["routes"]["/gk/(?P<gk-id>[\d]+)"]["endpoints"]["args"]["gk-id"]["description"] = "Unique identifier for the object";
		$rest_api["routes"]["/gk/(?P<gk-id>[\d]+)"]["endpoints"]["_links"][0] = $root_url . "?api=gk&gk-id=<gk-id>";

		$rest_api["routes"]["/jobs/"]["namespace"] = "jobs/";
		$rest_api["routes"]["/jobs/"]["methods"][0] = "GET";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["methods"][0] = "GET";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["job-title"]["required"] = false;
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["job-title"]["default"] = "";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["job-title"]["type"] = "string";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["job-title"]["description"] = "Limit result set to items with more specific by `job_title`.";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["company-name"]["required"] = false;
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["company-name"]["default"] = "";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["company-name"]["type"] = "string";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["company-name"]["description"] = "Limit result set to items with more specific by `company_name`.";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["last-date"]["required"] = false;
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["last-date"]["default"] = "";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["last-date"]["type"] = "string";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["last-date"]["description"] = "Limit result set to items with more specific by `last_date`.";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["job-details"]["required"] = false;
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["job-details"]["default"] = "";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["job-details"]["type"] = "string";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["job-details"]["description"] = "Limit result set to items with more specific by `job_details`.";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["job-notification"]["required"] = false;
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["job-notification"]["default"] = "";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["job-notification"]["type"] = "string";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["job-notification"]["description"] = "Limit result set to items with more specific by `job_notification`.";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["notification-file"]["required"] = false;
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["notification-file"]["default"] = "";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["notification-file"]["type"] = "string";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["notification-file"]["description"] = "Limit result set to items with more specific by `notification_file`.";

		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["orderby"]["required"] = false;
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["orderby"]["default"] = "job_id";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["orderby"]["type"] = "string";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["orderby"]["enum"][0] = "job-id";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["orderby"]["enum"][1] = "job-title";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["orderby"]["enum"][2] = "company-name";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["orderby"]["enum"][3] = "company-logo";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["orderby"]["enum"][4] = "last-date";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["orderby"]["enum"][5] = "job-details";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["orderby"]["enum"][6] = "job-notification";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["orderby"]["enum"][7] = "notification-file";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["orderby"]["description"] = "Sort collection by object attribute";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["sort"]["required"] = false;
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["sort"]["default"] = "asc";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["sort"]["type"] = "string";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["sort"]["enum"][0] = "asc";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["sort"]["enum"][1] = "desc";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["args"]["sort"]["description"] = "Order sort attribute ascending or descending";
		$rest_api["routes"]["/jobs/"]["endpoints"][0]["_links"][0] = $root_url . "?api=jobs";

		$rest_api["routes"]["/jobs/(?P<job-id>[\d]+)"]["namespace"] = "jobs/";
		$rest_api["routes"]["/jobs/(?P<job-id>[\d]+)"]["method"][0] = "GET";
		$rest_api["routes"]["/jobs/(?P<job-id>[\d]+)"]["endpoints"]["args"]["job-id"]["required"] = "true";
		$rest_api["routes"]["/jobs/(?P<job-id>[\d]+)"]["endpoints"]["args"]["job-id"]["type"] = "integer";
		$rest_api["routes"]["/jobs/(?P<job-id>[\d]+)"]["endpoints"]["args"]["job-id"]["description"] = "Unique identifier for the object";
		$rest_api["routes"]["/jobs/(?P<job-id>[\d]+)"]["endpoints"]["_links"][0] = $root_url . "?api=jobs&job-id=<job-id>";		break;
	case "categories":
		$rest_api = array();
		// TODO: JSON --+-- CATEGORIES
		/** statement `where` **/

		if(isset($_GET["cat-id"])){
			if($_GET["cat-id"] != "-1"){
				if($_GET["cat-id"]=="random"){
					$_GET["orderby"] = "random";
				}else{
					$id = (int)$_GET["cat-id"] ; 
					$statement[] = "`cat_id` =$id"; 
				}
			}
		}

		if(isset($_GET["category-name"])){
			if($_GET["category-name"] != "-1"){
				$value = $mysql->escape_string($_GET["category-name"]); 
				$statement[] = "`category_name` LIKE '%$value%'"; 
			}
		}

		if(isset($_GET["category-image"])){
			if($_GET["category-image"] != "-1"){
				$value = $mysql->escape_string($_GET["category-image"]); 
				$statement[] = "`category_image` LIKE '%$value%'"; 
			}
		}

		$where ="" ;
		if(isset($statement)){
			$where ="WHERE " . implode(" AND ",$statement);
		}
		/** order by **/
		$order_by = "`cat_id`";
		if(isset($_GET["orderby"])){
			switch($_GET["orderby"]){
			case "cat-id":
				$order_by = "`cat_id`";
				break;
			case "category-name":
				$order_by = "`category_name`";
				break;
			case "category-image":
				$order_by = "`category_image`";
				break;
			case "random":
				$order_by = "RAND()";
				break;
			}
		}

		/** sort **/
		$sort = "ASC";
		if(isset($_GET["sort"])){
			if($_GET["sort"]=="asc"){
				$sort = "ASC";
			}else{
				$sort = "DESC";
			}
		}

		$sql_query = "SELECT * FROM `categories` ".$where." ORDER BY ".$order_by." ".$sort.";"; 
		$z=0;
		if($result = $mysql->query($sql_query)){
			while ($data = $result->fetch_array()){
				if(isset($data["cat_id"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["cat_id"] = (int) $data["cat_id"];
				}
				if(isset($data["category_name"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["category_name"] = $data["category_name"];
				}
				if(isset($data["category_image"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["category_image"] = $config["userfile_url"] . $data["category_image"];
				}
				$rest_api[$z]["_links"]["self"][0] = $root_url . "?api=categories&cat-id=". $data["cat_id"];
				$z++;
			}
			$result->close();
		}
		if(isset($_GET["cat-id"])){
			if(isset($data_rest_api[0])){
				$rest_api = array();
				$rest_api["cat_id"] = $data_rest_api[0]["cat_id"];
				$rest_api["category_name"] = $data_rest_api[0]["category_name"];
				$rest_api["category_image"] = $config["userfile_url"] . $data_rest_api[0]["category_image"];
			}else{
				$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Invalid ID");
			}
		}
		break;
	case "chapters":
		$rest_api = array();
		// TODO: JSON --+-- CHAPTERS
		/** statement `where` **/

		if(isset($_GET["chapter-id"])){
			if($_GET["chapter-id"] != "-1"){
				if($_GET["chapter-id"]=="random"){
					$_GET["orderby"] = "random";
				}else{
					$id = (int)$_GET["chapter-id"] ; 
					$statement[] = "`chapter_id` =$id"; 
				}
			}
		}

		if(isset($_GET["chapter-name"])){
			if($_GET["chapter-name"] != "-1"){
				$value = $mysql->escape_string($_GET["chapter-name"]); 
				$statement[] = "`chapter_name` LIKE '%$value%'"; 
			}
		}

		if(isset($_GET["chapter-category"])){
			if($_GET["chapter-category"] != "-1"){
				$value = $mysql->escape_string($_GET["chapter-category"]); 
				$statement[] = "`chapter_category` LIKE '$value'"; 
			}
		}

		if(isset($_GET["chapter-image"])){
			if($_GET["chapter-image"] != "-1"){
				$value = $mysql->escape_string($_GET["chapter-image"]); 
				$statement[] = "`chapter_image` LIKE '%$value%'"; 
			}
		}

		if(isset($_GET["chapter-content"])){
			if($_GET["chapter-content"] != "-1"){
				$value = $mysql->escape_string($_GET["chapter-content"]); 
				$statement[] = "`chapter_content` LIKE '%$value%'"; 
			}
		}

		$where ="" ;
		if(isset($statement)){
			$where ="WHERE " . implode(" AND ",$statement);
		}
		/** order by **/
		$order_by = "`chapter_id`";
		if(isset($_GET["orderby"])){
			switch($_GET["orderby"]){
			case "chapter-id":
				$order_by = "`chapter_id`";
				break;
			case "chapter-name":
				$order_by = "`chapter_name`";
				break;
			case "chapter-category":
				$order_by = "`chapter_category`";
				break;
			case "chapter-image":
				$order_by = "`chapter_image`";
				break;
			case "chapter-content":
				$order_by = "`chapter_content`";
				break;
			case "random":
				$order_by = "RAND()";
				break;
			}
		}

		/** sort **/
		$sort = "ASC";
		if(isset($_GET["sort"])){
			if($_GET["sort"]=="asc"){
				$sort = "ASC";
			}else{
				$sort = "DESC";
			}
		}

		$sql_query = "SELECT * FROM `chapters` ".$where." ORDER BY ".$order_by." ".$sort.";"; 
		$z=0;
		if($result = $mysql->query($sql_query)){
			while ($data = $result->fetch_array()){
				if(isset($data["chapter_id"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["chapter_id"] = (int) $data["chapter_id"];
				}
				if(isset($data["chapter_name"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["chapter_name"] = $data["chapter_name"];
				}
				if(isset($data["chapter_category"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["chapter_category"]["id"] = $data["chapter_category"];
					$categories_id = htmlentities(stripslashes($data["chapter_category"]));
					$sql_categories_query = "SELECT * FROM `categories` WHERE `cat_id`='{$categories_id}'" ;
					$categories_result = $mysql->query($sql_categories_query);
					if($categories_result){
						$categories_result_data = $categories_result->fetch_array();
						if(isset($categories_result_data["category_name"])){
							$rest_api[$z]["chapter_category"]["rendered"] = stripslashes($categories_result_data["category_name"]);
						}else{
							$rest_api[$z]["chapter_category"]["rendered"] = "";
						}
					}else{
						$rest_api[$z]["chapter_category"]["rendered"] = "";
					}
				}
				if(isset($data["chapter_image"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["chapter_image"] = $config["userfile_url"] . $data["chapter_image"];
				}
				if(isset($data["chapter_content"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["chapter_content"] = $data["chapter_content"];
				}
				$rest_api[$z]["_links"]["self"][0] = $root_url . "?api=chapters&chapter-id=". $data["chapter_id"];
				$z++;
			}
			$result->close();
		}
		if(isset($_GET["chapter-id"])){
			if(isset($data_rest_api[0])){
				$rest_api = array();
				$rest_api["chapter_id"] = $data_rest_api[0]["chapter_id"];
				$rest_api["chapter_name"] = $data_rest_api[0]["chapter_name"];
				$rest_api["chapter_category"]["rendered"] = "Invalid ID";
				$rest_api["chapter_category"]["id"] = $data_rest_api[0]["chapter_category"];
				$categories_id = htmlentities(stripslashes($data_rest_api[0]["chapter_category"]));
				$sql_categories_query = "SELECT * FROM `categories` WHERE `cat_id`='{$categories_id}'" ;
				$categories_result = $mysql->query($sql_categories_query);
				if($categories_result){
					$categories_result_data = $categories_result->fetch_array();
					if(isset($categories_result_data["category_name"])){
						$rest_api["chapter_category"]["rendered"] = stripslashes($categories_result_data["category_name"]);
					}else{
						$rest_api["chapter_category"]["rendered"] = "Invalid ID";
					}
				}else{
					$rest_api["chapter_category"]["rendered"] = "Invalid ID";
				}
				$rest_api["chapter_image"] = $config["userfile_url"] . $data_rest_api[0]["chapter_image"];
				$rest_api["chapter_content"] = $data_rest_api[0]["chapter_content"];
			}else{
				$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Invalid ID");
			}
		}
		break;
	case "daily":
		$rest_api = array();
		// TODO: JSON --+-- DAILY
		/** statement `where` **/

		if(isset($_GET["chaper-id"])){
			if($_GET["chaper-id"] != "-1"){
				if($_GET["chaper-id"]=="random"){
					$_GET["orderby"] = "random";
				}else{
					$id = (int)$_GET["chaper-id"] ; 
					$statement[] = "`chaper_id` =$id"; 
				}
			}
		}

		if(isset($_GET["chapter-name"])){
			if($_GET["chapter-name"] != "-1"){
				$value = $mysql->escape_string($_GET["chapter-name"]); 
				$statement[] = "`chapter_name` LIKE '%$value%'"; 
			}
		}

		if(isset($_GET["published-date"])){
			if($_GET["published-date"] != "-1"){
				$value = $mysql->escape_string($_GET["published-date"]); 
				$statement[] = "`published_date` LIKE '%$value%'"; 
			}
		}

		if(isset($_GET["chapter-image"])){
			if($_GET["chapter-image"] != "-1"){
				$value = $mysql->escape_string($_GET["chapter-image"]); 
				$statement[] = "`chapter_image` LIKE '%$value%'"; 
			}
		}

		if(isset($_GET["chapter-content"])){
			if($_GET["chapter-content"] != "-1"){
				$value = $mysql->escape_string($_GET["chapter-content"]); 
				$statement[] = "`chapter_content` LIKE '%$value%'"; 
			}
		}

		$where ="" ;
		if(isset($statement)){
			$where ="WHERE " . implode(" AND ",$statement);
		}
		/** order by **/
		$order_by = "`chaper_id`";
		if(isset($_GET["orderby"])){
			switch($_GET["orderby"]){
			case "chaper-id":
				$order_by = "`chaper_id`";
				break;
			case "chapter-name":
				$order_by = "`chapter_name`";
				break;
			case "published-date":
				$order_by = "`published_date`";
				break;
			case "chapter-image":
				$order_by = "`chapter_image`";
				break;
			case "chapter-content":
				$order_by = "`chapter_content`";
				break;
			case "random":
				$order_by = "RAND()";
				break;
			}
		}

		/** sort **/
		$sort = "ASC";
		if(isset($_GET["sort"])){
			if($_GET["sort"]=="asc"){
				$sort = "ASC";
			}else{
				$sort = "DESC";
			}
		}

		$sql_query = "SELECT * FROM `daily` ".$where." ORDER BY ".$order_by." ".$sort.";"; 
		$z=0;
		if($result = $mysql->query($sql_query)){
			while ($data = $result->fetch_array()){
				if(isset($data["chaper_id"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["chaper_id"] = (int) $data["chaper_id"];
				}
				if(isset($data["chapter_name"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["chapter_name"] = $data["chapter_name"];
				}
				if(isset($data["published_date"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["published_date"] = $data["published_date"];
				}
				if(isset($data["chapter_image"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["chapter_image"] = $config["userfile_url"] . $data["chapter_image"];
				}
				if(isset($data["chapter_content"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["chapter_content"] = $data["chapter_content"];
				}
				$rest_api[$z]["_links"]["self"][0] = $root_url . "?api=daily&chaper-id=". $data["chaper_id"];
				$z++;
			}
			$result->close();
		}
		if(isset($_GET["chaper-id"])){
			if(isset($data_rest_api[0])){
				$rest_api = array();
				$rest_api["chaper_id"] = $data_rest_api[0]["chaper_id"];
				$rest_api["chapter_name"] = $data_rest_api[0]["chapter_name"];
				$rest_api["published_date"] = $data_rest_api[0]["published_date"];
				$rest_api["chapter_image"] = $config["userfile_url"] . $data_rest_api[0]["chapter_image"];
				$rest_api["chapter_content"] = $data_rest_api[0]["chapter_content"];
			}else{
				$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Invalid ID");
			}
		}
		break;
	case "gk":
		$rest_api = array();
		// TODO: JSON --+-- GK
		/** statement `where` **/

		if(isset($_GET["gk-id"])){
			if($_GET["gk-id"] != "-1"){
				if($_GET["gk-id"]=="random"){
					$_GET["orderby"] = "random";
				}else{
					$id = (int)$_GET["gk-id"] ; 
					$statement[] = "`gk_id` =$id"; 
				}
			}
		}

		if(isset($_GET["gk-title"])){
			if($_GET["gk-title"] != "-1"){
				$value = $mysql->escape_string($_GET["gk-title"]); 
				$statement[] = "`gk_title` LIKE '%$value%'"; 
			}
		}

		if(isset($_GET["gk-image"])){
			if($_GET["gk-image"] != "-1"){
				$value = $mysql->escape_string($_GET["gk-image"]); 
				$statement[] = "`gk_image` LIKE '%$value%'"; 
			}
		}

		if(isset($_GET["gk-content"])){
			if($_GET["gk-content"] != "-1"){
				$value = $mysql->escape_string($_GET["gk-content"]); 
				$statement[] = "`gk_content` LIKE '%$value%'"; 
			}
		}

		$where ="" ;
		if(isset($statement)){
			$where ="WHERE " . implode(" AND ",$statement);
		}
		/** order by **/
		$order_by = "`gk_id`";
		if(isset($_GET["orderby"])){
			switch($_GET["orderby"]){
			case "gk-id":
				$order_by = "`gk_id`";
				break;
			case "gk-title":
				$order_by = "`gk_title`";
				break;
			case "gk-image":
				$order_by = "`gk_image`";
				break;
			case "gk-content":
				$order_by = "`gk_content`";
				break;
			case "random":
				$order_by = "RAND()";
				break;
			}
		}

		/** sort **/
		$sort = "ASC";
		if(isset($_GET["sort"])){
			if($_GET["sort"]=="asc"){
				$sort = "ASC";
			}else{
				$sort = "DESC";
			}
		}

		$sql_query = "SELECT * FROM `gk` ".$where." ORDER BY ".$order_by." ".$sort.";"; 
		$z=0;
		if($result = $mysql->query($sql_query)){
			while ($data = $result->fetch_array()){
				if(isset($data["gk_id"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["gk_id"] = (int) $data["gk_id"];
				}
				if(isset($data["gk_title"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["gk_title"] = $data["gk_title"];
				}
				if(isset($data["gk_image"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["gk_image"] = $config["userfile_url"] . $data["gk_image"];
				}
				if(isset($data["gk_content"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["gk_content"] = $data["gk_content"];
				}
				$rest_api[$z]["_links"]["self"][0] = $root_url . "?api=gk&gk-id=". $data["gk_id"];
				$z++;
			}
			$result->close();
		}
		if(isset($_GET["gk-id"])){
			if(isset($data_rest_api[0])){
				$rest_api = array();
				$rest_api["gk_id"] = $data_rest_api[0]["gk_id"];
				$rest_api["gk_title"] = $data_rest_api[0]["gk_title"];
				$rest_api["gk_image"] = $config["userfile_url"] . $data_rest_api[0]["gk_image"];
				$rest_api["gk_content"] = $data_rest_api[0]["gk_content"];
			}else{
				$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Invalid ID");
			}
		}
		break;
	case "jobs":
		$rest_api = array();
		// TODO: JSON --+-- JOBS
		/** statement `where` **/

		if(isset($_GET["job-id"])){
			if($_GET["job-id"] != "-1"){
				if($_GET["job-id"]=="random"){
					$_GET["orderby"] = "random";
				}else{
					$id = (int)$_GET["job-id"] ; 
					$statement[] = "`job_id` =$id"; 
				}
			}
		}

		if(isset($_GET["job-title"])){
			if($_GET["job-title"] != "-1"){
				$value = $mysql->escape_string($_GET["job-title"]); 
				$statement[] = "`job_title` LIKE '%$value%'"; 
			}
		}

		if(isset($_GET["company-name"])){
			if($_GET["company-name"] != "-1"){
				$value = $mysql->escape_string($_GET["company-name"]); 
				$statement[] = "`company_name` LIKE '%$value%'"; 
			}
		}

		if(isset($_GET["company-logo"])){
			if($_GET["company-logo"] != "-1"){
				$value = $mysql->escape_string($_GET["company-logo"]); 
				$statement[] = "`company_logo` LIKE '%$value%'"; 
			}
		}

		if(isset($_GET["last-date"])){
			if($_GET["last-date"] != "-1"){
				$value = $mysql->escape_string($_GET["last-date"]); 
				$statement[] = "`last_date` LIKE '%$value%'"; 
			}
		}

		if(isset($_GET["job-details"])){
			if($_GET["job-details"] != "-1"){
				$value = $mysql->escape_string($_GET["job-details"]); 
				$statement[] = "`job_details` LIKE '%$value%'"; 
			}
		}

		if(isset($_GET["job-notification"])){
			if($_GET["job-notification"] != "-1"){
				$value = $mysql->escape_string($_GET["job-notification"]); 
				$statement[] = "`job_notification` LIKE '%$value%'"; 
			}
		}

		if(isset($_GET["notification-file"])){
			if($_GET["notification-file"] != "-1"){
				$value = $mysql->escape_string($_GET["notification-file"]); 
				$statement[] = "`notification_file` LIKE '%$value%'"; 
			}
		}

		$where ="" ;
		if(isset($statement)){
			$where ="WHERE " . implode(" AND ",$statement);
		}
		/** order by **/
		$order_by = "`job_id`";
		if(isset($_GET["orderby"])){
			switch($_GET["orderby"]){
			case "job-id":
				$order_by = "`job_id`";
				break;
			case "job-title":
				$order_by = "`job_title`";
				break;
			case "company-name":
				$order_by = "`company_name`";
				break;
			case "company-logo":
				$order_by = "`company_logo`";
				break;
			case "last-date":
				$order_by = "`last_date`";
				break;
			case "job-details":
				$order_by = "`job_details`";
				break;
			case "job-notification":
				$order_by = "`job_notification`";
				break;
			case "notification-file":
				$order_by = "`notification_file`";
				break;
			case "random":
				$order_by = "RAND()";
				break;
			}
		}

		/** sort **/
		$sort = "ASC";
		if(isset($_GET["sort"])){
			if($_GET["sort"]=="asc"){
				$sort = "ASC";
			}else{
				$sort = "DESC";
			}
		}

		$sql_query = "SELECT * FROM `jobs` ".$where." ORDER BY ".$order_by." ".$sort.";"; 
		$z=0;
		if($result = $mysql->query($sql_query)){
			while ($data = $result->fetch_array()){
				if(isset($data["job_id"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["job_id"] = (int) $data["job_id"];
				}
				if(isset($data["job_title"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["job_title"] = $data["job_title"];
				}
				if(isset($data["company_name"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["company_name"] = $data["company_name"];
				}
				if(isset($data["company_logo"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["company_logo"] = $config["userfile_url"] . $data["company_logo"];
				}
				if(isset($data["last_date"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["last_date"] = $data["last_date"];
				}
				if(isset($data["job_details"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["job_details"] = $data["job_details"];
				}
				if(isset($data["job_notification"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["job_notification"] = $data["job_notification"];
				}
				if(isset($data["notification_file"])){
					$data_rest_api[$z] = $data;
					$rest_api[$z]["notification_file"] = $data["notification_file"];
				}
				$rest_api[$z]["_links"]["self"][0] = $root_url . "?api=jobs&job-id=". $data["job_id"];
				$z++;
			}
			$result->close();
		}
		if(isset($_GET["job-id"])){
			if(isset($data_rest_api[0])){
				$rest_api = array();
				$rest_api["job_id"] = $data_rest_api[0]["job_id"];
				$rest_api["job_title"] = $data_rest_api[0]["job_title"];
				$rest_api["company_name"] = $data_rest_api[0]["company_name"];
				$rest_api["company_logo"] = $config["userfile_url"] . $data_rest_api[0]["company_logo"];
				$rest_api["last_date"] = $data_rest_api[0]["last_date"];
				$rest_api["job_details"] = $data_rest_api[0]["job_details"];
				$rest_api["job_notification"] = $data_rest_api[0]["job_notification"];
				$rest_api["notification_file"] = $data_rest_api[0]["notification_file"];
			}else{
				$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Invalid ID");
			}
		}
		break;
}

$mysql->close();

// TODO: JSON --+-- CROSSDOMAIN
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization, X-Authorization');
header('Access-Control-Max-Age: 86400');
header('Connection: close');

if (!isset($_GET["callback"])){
	// TODO: OUTPUT --+-- JSON
	if(defined("JSON_UNESCAPED_UNICODE")){
		echo json_encode($rest_api,JSON_UNESCAPED_UNICODE);
	}else{
		echo json_encode($rest_api);
	}
}else{
	// TODO: OUTPUT --+-- JSONP
	if(defined("JSON_UNESCAPED_UNICODE")){
		echo strip_tags($_GET["callback"]) ."(". json_encode($rest_api,JSON_UNESCAPED_UNICODE). ");" ;
	}else{
		echo strip_tags($_GET["callback"]) ."(". json_encode($rest_api) . ");" ;
	}
}

