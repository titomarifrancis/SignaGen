<?php
$ofc_id=$_REQUEST['ofc_id'];
$config = parse_ini_file("config/application.ini", true);

$ofcIdArray = explode("_", $ofc_id);
foreach($config as $key => $value)
{
  if($ofcIdArray[1] != "default")
  {
    if($key == $ofc_id)
    {
      $domainList = $value["mail_domain"];
    }
  }

}
if(!$domainList)echo 'please choose an office first';
else
{
 echo '<select name="domain">';
 foreach($domainList as $dlist)
 {
    if($dlist == $_REQUEST['domain'])
      echo '<option selected="selected">'.$dlist.'</option>';
    else
      echo '<option>'.$dlist.'</option>';
 }
 echo "</select>";
}
?>
