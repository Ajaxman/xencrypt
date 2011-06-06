<?php
/**
 * Description of xencrypt
 *
 * Xencrypt: Es una clase que permite encriptar y desencriptar una cadena
 *           usando mcrypt de php
 * 
 * @author Javier López López(Ajaxman)
 * 
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * 
 * @version 1.0 alpha
 * 
 * @see http://php.net/manual/es/function.mcrypt-generic.php
 * 
 * @todo muchas cosas como varios tipos de encriptacion, interface y/o namespaces 
 *       y hacerle TDD(sorry aun estoy aprendiendo TDD),y /0 DI(Dependency Injection) }
 * 
 *       Nota: hace falta tambien documentar los metodos, pero porm falata de tiempo 
 *            Se queda asi, sorry, pronto le pogo + phpdoc ok?
 * 
 */

class Xencrypt {
    
    private $_key,            
            $_algorithm = 'rijndael-256',            
            $_algorithm_directory= '',            
            $_mode = 'ofb',            
            $_mode_directory = '',
            
            $handler = null,
            $iv = null,
            $keysize = null,
            $encrypted = '',
            $decrypted = '';
    
    
    public function __construct($key = '')    
    {
        $this->setHandler();
        $this->setIv();
        $this->setKeysize();
        
        $key = (!empty($key))?$key:'Xencrypt';
        $this->setKey($key); 
        $this->initEncrypt(); 
        
    }

    
    public function encrypt($string = '')
    {
        if(!empty ($string)){
            $this->encrypted = mcrypt_generic($this->handler, $string);
            $this->endEncrypt();
            return $this->encrypted  = base64_encode($this->encrypted);
                            
        }else{
            throw new Exception("Error: para encriptar un texto debe de 
                                ingresar al menos un caracter");
        }
    }
    
    public function decrypt($string = '')
    {
        if(!empty ($string)){
            $string = base64_decode($string);
            $this->initEncrypt();
            //Note the string returned by mdecrypt_generic() 
            //will be 16 characters as well...use rtrim($str, "\0") to remove the padding. 
            $this->decrypted = rtrim(mdecrypt_generic($this->handler, $string),"\0");
            $this->endEncrypt();
            return $this->decrypted;
                            
        }else{
            throw new Exception("Error: para desencriptar ingrese una cadena encriptada");
        }
    }    
    
    
    private function setHandler()
    {
        try{
            $this->handler = mcrypt_module_open( $this->_algorithm,
                                $this->_algorithm_directory, 
                                $this->_mode, 
                                $this->_mode_directory
                                );
            
        } catch (Exception $e){
            throw new Exception(    'Se genero un error al crear el hanlder Error:'.
                                    $e->getMessage()
                                );
        }
        
    }
    
    private function setKey($key = '')
    {
        $this->_key = substr(md5($key), 0, $this->keysize);
    }
    
    private function setIv()
    {
        $this->iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($this->handler), MCRYPT_DEV_RANDOM);
    }
    
    private function setKeysize()
    {
        $this->keysize = mcrypt_enc_get_key_size($this->handler);
    }
    
    private function initEncrypt()
    {
        mcrypt_generic_init($this->handler, $this->_key, $this->iv);
    }
    
    private function endEncrypt()
    {
         //mcrypt_generic_deinit($this->handler);
    }
       
    /*public function __destruct()
    {
        mcrypt_module_close($this->handler);
    }*/
    
}//End of xencrypt


?>
