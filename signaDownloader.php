<?php
if(isset($_POST['name']) || isset($_POST['title']) || isset($_POST['office']) || isset($_POST['ext']) || isset($_POST['optlabel']) || isset($_POST['optcontact']) || isset($_POST['email']) || isset($_POST['domain']) || isset($_POST['preview']) || isset($_POST['download']))
{
  $name = $_POST['name'];
  $title = $_POST['title'];
  $office = $_POST['office'];
  $my_ext = $_POST['ext'];
  $my_ext == ""? $ext = "": $ext = "ext: $my_ext";
  $my_label = $_POST['optlabel'];
  $my_label == ""? $optlabel = "": $optlabel = $my_label;
  if($my_label != "")
  {
    $my_optcontact = $_POST['optcontact'];
    $my_optcontact == ""? $optcontact = "": $optcontact = "$optlabel: $my_optcontact";
  }
  else
  {
    $optcontact = "";
  }

  $domain = "";
  if($_POST['domain'] != "")
  {
    $domain = $_POST['domain'];
    $email_element[0] = $_POST['email'];
    $email_element[1] = $domain;
    $email_address = implode("@", $email_element);
  }
  else
  {
    $email_address = "";
  }

  require_once("coreFunction.php");

  header("Content-type: application/octet-stream");
  header("Content-Disposition: attachment; filename=\"my".$companyLocationArray[0]."signature.htm\"");
  echo $signature;
}
?>
