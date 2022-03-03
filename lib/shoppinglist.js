function productinfo(pid) {
  var xhttp;
  var rtn = "";
  xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    if (this.readyState == 4 && this.status == 200) {parseJSON(xhttp);}
  }
  xhttp.open("GET", "../lib/cartinfo.php?pid="+pid, false);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send();
}

var total = 0;

function parseJSON(xhttp) {
	var txt = xhttp.responseText;
  var info = JSON.parse(txt.slice(1,txt.length - 1));
	var tablehtml = document.getElementById('shoppingcarttable').innerHTML;
  total += +info.PRICE * localStorage.getItem(info.PID);
  tablehtml += '<tr><td>' + info.NAME + '</td><td><input class="form-control" type="number" onchange="localStorage.setItem(' + info.PID + ',this.value); refreshcart();" value="' + localStorage.getItem(info.PID) +'" min="0" max="99"></td><td>$' + info.PRICE * localStorage.getItem(info.PID) + '</td></tr>';
  document.getElementById('shoppingcarttable').innerHTML = tablehtml;
}


function refreshcart() {
  document.getElementById('shoppingcarttable').innerHTML = "";
  var key = "";
  var i = 0;
  total = 0;
  for (i = 0; i <= localStorage.length - 1; i++) {
    key = localStorage.key(i);
    if (localStorage.getItem(key) > 0) productinfo(key);
  }
  console.log("refresh");
  document.getElementById('shoppingcartfoot').innerHTML = '<tr><td><button type="button" onclick="refreshcart()" class="btn btn-success btn-sm">Refresh</button></td><td><button type="button" class="btn btn-success btn-sm">Checkout</button></td><td>$' + total + '</td></tr>';
}

async function addtocart(pid) {
  if (localStorage.getItem(pid) == null) {localStorage.setItem(pid, 1);} else {localStorage.setItem(pid, +localStorage.getItem(pid) + 1);};
  await refreshcart();
}


var key = "";
  var i = 0;
  total = 0;
  for (i = 0; i <= localStorage.length - 1; i++) {
    key = localStorage.key(i);
    if (localStorage.getItem(key) > 0) productinfo(key);
  }
  document.getElementById('shoppingcartfoot').innerHTML = '<tr><td><button type="button" onclick="refreshcart()" class="btn btn-success btn-sm">Refresh</button></td><td><button type="button" class="btn btn-success btn-sm">Checkout</button></td><td>$' + total + '</td></tr>';
