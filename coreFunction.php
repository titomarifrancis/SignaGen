<?php
$companyLocationArray = explode("_", $office);
$companyDefaultArray[0] = $companyLocationArray[0];
$companyDefaultArray[1] = "default";
$companyDefault = implode("_", $companyDefaultArray);

$config = parse_ini_file("config/application.ini", true);
$myCompanyDefault = $config["$companyDefault"];
$myCompanyCurrent = $config["$office"];


$myCompanyCurrent["legal_notice"] != "" ? $disclaimer = $myCompanyCurrent["legal_notice"]: $disclaimer = $myCompanyDefault["legal_notice"];

$myCompanyCurrent["slogan"] != "" ? $slogan = $myCompanyCurrent["slogan"]: $slogan = $myCompanyDefault["slogan"];

$myCompanyCurrent["logo_url"] != "" ? $logo_url = $myCompanyCurrent["logo_url"]: $logo_url = $myCompanyDefault["logo_url"];

$myCompanyCurrent["logo_image_w"] != "" ? $logo_w = $myCompanyCurrent["logo_image_w"]: $logo_w = $myCompanyDefault["logo_image_w"];

$myCompanyCurrent["logo_image_h"] != "" ? $logo_h = $myCompanyCurrent["logo_image_h"]: $logo_h = $myCompanyDefault["logo_image_h"];

$myCompanyCurrent["logo_alt"] != "" ? $logo_alt = $myCompanyCurrent["logo_alt"]: $logo_alt = $myCompanyDefault["logo_alt"];

$addressArraySize = sizeof($myCompanyCurrent["address"]);
if($addressArraySize > 1)
{
  $address = "";
  for($g=0; $g < $addressArraySize; $g++)
  {
    $address = $address."".$myCompanyCurrent["address"][$g]."<br/>";
  }
}
else
{
  $myCompanyCurrent["address"][0] != "" ? $address = $myCompanyCurrent["address"][0]: $address = $myCompanyDefault["address"][0];
}

$myCompanyCurrent["phone"] != "" ? $phone = 'Phone: '.$myCompanyCurrent["phone"].'': $phone = 'Phone: '.$myCompanyDefault["phone"].'';

$fax = "";
if($myCompanyCurrent["fax"] != "")
{
  $fax = 'Fax: '.$myCompanyCurrent["fax"].'';
}
elseif($myCompanyDefault["fax"] != "")
{
  $fax = 'Fax: '.$myCompanyDefault["fax"].'';
}

$myCompanyCurrent["website"] != "" ? $website = $myCompanyCurrent["website"]: $website = $myCompanyDefault["website"];

$ad_img = $myCompanyCurrent["promo_ad_img"];
$ad_url = $myCompanyCurrent["promo_ad_url"];
$ad_alt = $myCompanyCurrent["promo_ad_alt"];


$natl_sales="";
if(isset($myCompanyCurrent["natl_sales"]))
{
  $myCompanyCurrent["natl_sales"] == "" ? $natl_sales = "" : $natl_sales = "<br/>National Sales: ".$myCompanyCurrent["natl_sales"]."";
}

include("templates/".$companyLocationArray[0].".php");

$signature = str_replace(array("  ", "\n", "\r", "\t"), array("", "", "", ""), $signature);
$signature = trim($signature);
?>
