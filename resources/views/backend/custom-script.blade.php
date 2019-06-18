$( document ).ready(function() {

});


$(document).on("click", ".save-company", function () {

var test = {{$blade["ll"]}};
alert(test);

data = {};
obj = {
"company" : $("#company").val(),
"address" : $("#address").val(),
"country" : $("#country").val(),
"city" : $("#city").val(),
}

data["company"] = JSON.stringify(obj);
save("save-company", data);

});


function action_json(url, data) {

if (window.XMLHttpRequest) {
xmlhttp = new XMLHttpRequest();
} else {
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange = function () {

if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
action('description', xmlhttp.responseText);
}
}

urlAddress = "{{env("MYHTTP")}}/{{$blade["ll"]}}/backend/programs/basedata/" + url;

if(data != null && Object.keys(data).length > 0) {
urlAddress += "?";

for (var k in data) {
urlAddress += k + "=" + data[k] + "&";
}

urlAddress = urlAddress.slice(0, -1);
}

xmlhttp.open("GET", urlAddress, true);;
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send();

}

function save(url, data) {

urlAddress = "{{env('MYHTTP')}}/{{$blade["ll"]}}/freelancer/setup/save/" + url;


if(data != null && Object.keys(data).length > 0) {



urlAddress += "?";
for (var k in data) {
urlAddress += k + "=" + data[k] + "&";
}
urlAddress = urlAddress.slice(0, -1);
}

$.ajax({

type: 'GET',
url: ' + urlAddress,
data: { variable: 'value' },
dataType: 'json',
success: function(data) {
alert("test");
var items = data["project"];

}
});

}