<?php
    //finaliza cookies
	echo '<script>document.cookie = "cookieappid=; expires=closed; path=/";</script>';

    echo '<script>document.cookie = "cookiesessionid=; expires=closed; path=/";</script>';
    
    //finaliza session
	session_destroy();
	echo "<script> window.location.href='https://".$host."/user';</script>";
	
	
?>