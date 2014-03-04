<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>My Signature Generator</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <script src="js/jquery-1.4.2.min.js"></script>
  <script src="js/jquery-ui-1.8.1.custom.min.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/inputValidator.js"></script>
  <script src="js/dynamicdropdown.js"></script>
  <script src="js/submitActionEvaluator.js"></script>
  <script src="js/jquery.form.js"></script>
  <script src="js/clearForm.js"></script>
  <link rel="stylesheet" type="text/css" href="css/mystyle.css" />
  <link type="text/css" href="css/start/jquery-ui-1.8.1.custom.css" rel="stylesheet" />
  <script>

  </script>
</head>
<body>
  <div class="ui-widget">
    <div class="ui-widget-header ui-corner-top">
      <h1 align="center">My Signature Generator</h1>
      <p align="right">
      <a href="guide/siggy_update_guide.pdf" target="blank">Printed User Guide(PDF)</a><br>
      <a href="guide/siggy_update_video.htm" target="blank">Video User Guide (WMV)</a><br>
      <br>
      The form fields labeled Title, Extension, Promo Banner and the dropdown with 'No Additional Phone', 'Mobile Number', 'Timesheet' and 'Timesheet Fax' are optional to be filled in
      <br>
      version 2.11 (July 2010)
      </p>
    </div>
    <div class="ui-widget-content ui-corner-bottom">
      <div class="form-div">
        <form name="signgenform" id="signgenform" method="post" onSubmit="return OnSubmitForm();">
          <table border="0">
            <tr>
              <td>Full Name *</td>
              <td colspan="2">
                <input type="text" name="name" id="name" value="<?php echo $_POST['name'];?>" class="required"/>
              </td>
            </tr>
            <tr>
              <td>Title</td>
              <td colspan="2">
                <input type="text" name="title" id="title" value="<?php echo $_POST['title'];?>"/>
              </td>
            </tr>
            <tr>
              <td>Office *</td>
              <td colspan="2">
                <select name="office" id="office" class="required">
                  <option value='' default>Select One</option>
        <?php
                  include("getOfcList.php");
                  $ofcList = getCompanyOfficeList();
                  foreach($ofcList as $key => $value)
                  {
                    $_POST['office']== $value[0]? $selected="selected='selected'": $selected='';
                    echo "<option value='$value[0]' $selected/>$value[1]";
                  }
        ?>
                </select>
              </td>
            </tr>
            <tr>
              <td>E-mail *</td>
              <td>
                <input name="email" id="email" type="text" value="<?php echo $_POST['email'];?>" class="required">@
              </td>
              <td id="domain">
                <?php
                  if(isset($_POST['domain']))
                  {
                    $_REQUEST['ofc_id'] = $_POST['office'];
                    include("dynamicDomainListmaker.php");
                  }
                  else
                  {
                    echo "please choose an office first";
                  }
                ?>
              </td>
            </tr>
            <tr>
              <td>Extension:</td>
              <td colspan="2"><input type="text" name="ext" value="<?php echo $_POST['ext'];?>" class="input"/></td>     
            </tr>
            <tr>
              <td>
                <select name="optlabel" id="optlabel">
                  <?php
                    $config = parse_ini_file("config/application.ini", true);
                    $dropDownArray = $config['dropdown_selection'];
                    foreach($dropDownArray as $key => $value)
                    {
                      $numElements = sizeof($value);
                      for($a=0; $a < $numElements; $a++)
                      {
                        if($_POST['optlabel'] == $value[$a])
                        {
                          if($a == 0)
                          {
                            echo "<option value='' selected='selected'>$value[$a]</option>";
                          }
                          else
                          {
                            echo "<option value='".$value[$a]."' selected='selected'>$value[$a]</option>";
                          }
                        }
                        else
                        {
                          if($a == 0)
                          {
                            echo "<option value=''>$value[$a]</option>";
                          }
                          else
                          {
                            echo "<option value='".$value[$a]."'>$value[$a]</option>";
                          }
                        }
                      }
                    }
                  ?>
                </select>
              </td>
              <td colspan="2"><input type="text" name="optcontact" value="<?php echo $_POST['optcontact'];?>" maxlength="32" class="input"/></td>     
            </tr>
            <tr>
              <td>With Promo Banner?</td>
              <td><input type="radio" name="haveBanner" value="Yes" <?php if($_POST['haveBanner'] == "Yes") echo "checked='yes'"; ; if(!isset($_POST['haveBanner'])) echo "checked='yes'";?>>Yes<br/><input type="radio" name="haveBanner" value="No" <?php if($_POST['haveBanner'] == "No") echo "checked='yes'"?>>No</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2">
                <input type="submit" name="preview" id="preview" onClick="document.pressed=this.value" value="Preview">
                <input type="submit" name="download" id="download" onClick="document.pressed=this.value" value="Download">
                <input type="button" name="clearform" id="clearform" onClick="clearForm();" value="Clear Form">
              </td>
            </tr>
          </table>
        </form>
      </div>
    </div>
    <br/>
    <br/>
    <?php
    if(isset($_POST['preview']))
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

      $haveBanner = $_POST['haveBanner'];

      require_once("coreFunction.php");

      if(isset($_POST['preview']))
      {
        echo $signature;
      }
    }
    ?>
  </div>
</body>
</html>
