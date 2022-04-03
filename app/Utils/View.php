<?php

namespace App\Utils;

class View {

  // Variaveis padrões da View
  // @var array
  private static $vars = [];

  /**
  *Metodo responsável por definir os dados iniciais da classe
  *@param array $vars
  */
  public static function init($vars = []){
    self::$vars = $vars;
  }

  /**
  *Método responsável por retornar o conteúdo de uma view
  *@param string $view
  *@param array $vars (string, numeric)
  *@return string
  */
  public static function getContentView($view){
    $file = __DIR__.'/../../resources/view/'.$view.'.html';
    return file_exists($file) ? file_get_contents($file) : '';
  }

  /**
  *Método responsável por retornar o conteúdo renderizado de uma view
  *@param string $view
  *@return string
  */
  public static function render($view, $vars = []){
    //Conteudo da view
    $contentView = self::getContentView($view);

    // MERGE DE Variaveis DDA View
    $vars = array_merge(self::$vars, $vars);

    $keys = array_keys($vars);
    $keys = array_map(function($item){
      return '{{'.$item.'}}';
    },$keys);

    //Retorna o conteúdo renderizado
    return str_replace($keys, array_values($vars), $contentView);
  }

}
