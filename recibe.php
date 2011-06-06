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
        
                  include 'encrypt.php';
         
                  $Encrypt = Encrypt::instance();
                  $datalanding = $_GET['u_key'];
                  $data = $Encrypt->decode($datalanding);
                  
                var_dump($data);
        ?>
    </body>
</html>
