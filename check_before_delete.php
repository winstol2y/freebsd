<html>
<head>
<title>Config DNS and DHCP</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<meta content="list/html; charset=utf-8" http-equiv="Content-Type" />
</head>
<body>

<script>
function myFunction() {
    var ok = confirm("Are you sure!");
        if(ok && chk_data() == 0){
                document.getElementByld("form_new_qus").submit();
        };
}
</script>

<?php
$ip = $_GET["ip"];
$mac = $_GET["mac"];


?>
</body>
</html>
