<?php

  namespace App\Controller\Pages;

  use \App\Utils\View;

  class Page {


    private static function getHeader(){
      return View::render('pages/header',[
          'usuario' => $_SESSION['admin']['usuario']['nome']
      ]);
    }

    private static function getFooter(){
      return View::render('pages/footer');
    }



    /*
    * Método responsável por retornar o conteudo (view) da nossa pagina genérica
    * @return string
    */

    public static function getPage($title,$content){

        return View::render('pages/page', [
        'title' => $title,
        'header' => self::getHeader(),
        'footer' => self::getFooter(),
        'role' => $_SESSION['admin']['usuario']['role'],
        'content' => $content,
      ]);
    }

    public static function getPagination($request, $obPagination){

        //PAGINAS
        $pages = $obPagination->getPages();
        // VERIFICA QUANTIDADE DE PAGINAS
        if(count($pages) <= 1 ) return '';

        // LINKS
        $links = '';

        // URL ATUAL (SEM GETS)
        $url = $request->getRouter()->getCurrentUrl();

        //GET
        $queryParams = $request->getQueryParams();

        foreach($pages as $page){
            $queryParams['page'] = $page['page'];

            $link = $url.'?'.http_build_query($queryParams);

            $links .= View::render('pages/pagination/link', [
                'page' => $page['page'],
                'link' => $link,
                'active' => $page['current'] ? 'active' : '',
            ]);
        }
        return View::render('pages/pagination/box', [
            'links' => $links
        ]);
    }
  }
