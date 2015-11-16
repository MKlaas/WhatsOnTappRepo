<!DOCTYPE html>
<html>
<body>

<p id="demo"></p>

<script>
var xhttp;
xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
        myFunction(xhttp);
    }
}
xhttp.open("GET", "bars.xml", true);
xhttp.send();

function myFunction(xml) {
    var x, i, txt, xmlDoc; 
    xmlDoc = xml.responseXML;
    txt = "";
    x = xmlDoc.getElementsByTagName("title");
    for (i = 0; i < x.length; i++) { 
        txt += x[i].childNodes[0].nodeValue + "<br>";
    }
    document.getElementById("demo").innerHTML = txt;
}
</script>
</body>
</html>
