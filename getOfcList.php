<?php
function getCompanyOfficeList()
{
  $config = parse_ini_file("config/application.ini", true);
  $scopeLimit = $config["default"]["limit"];
  $limitSize = sizeof($scopeLimit);

  foreach($config as $key => $value)
  {
    $company_location_array = explode("_", $key);

    $compLocArray[0] = $company_location_array[0];
    $compLocArray[1] = $company_location_array[1];
    $companyLocation = implode("_", $compLocArray);

    $dispCompLocArray[0] = $company_location_array[0];

    $tempCompLocArray[0] = $company_location_array[1];
    $tempCompLocArray[1] = $company_location_array[2];

    if($company_location_array[2] != "")
    {
      $dispCompLocArray[1] = implode(" - ", $tempCompLocArray);
    }
    else
    {
      $dispCompLocArray[1] = $company_location_array[1];
    }

    $displayedCompLoc = implode(" ", $dispCompLocArray);

    $compLocArraySize = sizeof($company_location_array);
    if($limitSize > 0)
    {
      for($a = 0; $a < $limitSize; $a++)
      {
        if($companyLocation == $scopeLimit[$a])
        {
          $companyOfcLoc[0] = $key;
          $companyOfcLoc[1] = $displayedCompLoc;
          $data[]= $companyOfcLoc;
          
        }
      }
    }
  }
  return $data;
}
?>
