
<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 26/03/2019
 * Time: 15:08
 */
    spl_autoload_register(function($classname){
        //echo __DIR__.'\\'.$classname.".php<br>";
        //require_once __DIR__.'\\'.$classname.".php";
        require_once __DIR__.DIRECTORY_SEPARATOR.str_replace('\\',DIRECTORY_SEPARATOR,$classname).".php";
    });
?>
