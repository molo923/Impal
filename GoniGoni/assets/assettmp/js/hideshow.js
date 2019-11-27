$("#selector").change(function() {
  if ($(this).val() == "unit") {
    $('#otherDiv').show();
  } else {
    $('#otherDiv').hide();
  }
});
$("#selector").trigger("change");

$("#pick").change(function() {
  if ($(this).val() == "hibah") {
    $('#otherpick').hide();
    $('#otherpicks').show();
  } 

  else if ($(this).val() == "lainnya") {
    $('#otherpick').hide();
    $('#otherpicks').show();
  } 

  else {
    $('#otherpick').show();
    $('#otherpicks').hide();
  }
});
$("#pick").trigger("change");


$("#picked").change(function() {
  if ($(this).val() == "nonjual") {
    $('#otherpicked').hide();
    $('#otherpickeds').show();
  } 

  else {
    $('#otherpicked').show();
    $('#otherpickeds').hide();
  }
});
$("#picked").trigger("change");


