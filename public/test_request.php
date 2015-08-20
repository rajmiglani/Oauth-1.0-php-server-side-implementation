<!--API Resource to be accessed by the Client-->


<?php
require_once '../include/common.php';

if (OAuthRequestVerifier::requestIsSigned()) {
    try {
        $req = new OAuthRequestVerifier();
        $id = $req->verify();

//	echo "hey";
        if ($id) {
            echo 'Hello ' . $id;
        }
    }
    catch (OAuthException $e) {
        
        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: OAuth realm=""');
        header('Content-Type: text/plain; charset=utf8');

        echo $e->getMessage();
        exit();
    }
}
