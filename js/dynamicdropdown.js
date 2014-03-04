function setup_office_change()
{
  $('#office').change(update_domain);
}

function update_domain()
{
  var ofc_id=$('#office').attr('value');
  $.get('dynamicDomainListmaker.php?ofc_id='+ofc_id, show_domain);
}

function show_domain(res)
{
  $('#domain').html(res);
}

$(document).ready(setup_office_change);
