function OnSubmitForm()
{
  if(document.pressed == 'Download')
  {
    document.signgenform.action ="signaDownloader.php";
  }
  if(document.pressed == 'Preview')
  {
    document.signgenform.action ="";
  }
}
