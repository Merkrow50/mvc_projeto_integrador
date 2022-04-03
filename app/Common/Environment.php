<?php

namespace App\Common;

class Environment {


  /*
  * Metodo responsavel por carregar as variaveis de ambiente
  *@param string $dir
  */
  public static function load($dir){
    //VERIFICA SE O ARQUIVO .ENV EXISTE
    if(!file_exists($dir.'/.env')){
      return false;
    }

    $lines = file($dir.'/.env');

    foreach($lines as $line){
      putenv(trim($line));
    }

  }

}
