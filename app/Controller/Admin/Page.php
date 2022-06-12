<?php

namespace App\Controller\Admin;

use App\Utils\View;

class Page
{

    /**
     * Método responsavel por retornar o conteudo da view da estrutura generica de pagina do painel
     * @param string $title
     * @param string $content
     * @return string
     */
    public static function getPage($title, $content){
        return View::render('admin/page',[
            'title' => $title,
            'content' => $content,
            'header' => self::getHeader(),
        ]);
    }


    private static function getHeader(){
        return View::render('admin/header',[]);
    }


}