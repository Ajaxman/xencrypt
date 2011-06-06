<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        // Report all PHP errors
ini_set('error_reporting', E_ALL);
 
// Set the display_errors directive to On
ini_set('display_errors', 1);
                  include 'encrypt.php';
         
                  $Encrypt = Encrypt::instance();
                  //echo "_?";
                  //$Encrypt = new Xencrypt('KSALanding');
                  
                  $post = array(
                                'name' => 'javier',
                                'email' => 'javier@pce.com.mx',
                                'landing' => 5,
                                );
                  $post = json_encode($post);
                  $post = $Encrypt->encode($post);
                  
                  //var_dump($post);
                  
                  
                  $redirectLink = "Location: ".$url."recibe.php?landing_id=".$landing_id;
                  echo ($redirectLink.'&u_key='.urlencode($post));
                  
                  //$data = $Encrypt->decrypt($post);
                  //echo "<hr><hr>";
                  //echo $data;
        ?>
        <h1>Passed</h1>
    </body>
</html>
