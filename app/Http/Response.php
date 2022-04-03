<?php

namespace App\Http;

class Response {

 /*
  * Código do status HTTP
  * @var integer
  */
  private $httpCode = 200;

 /*
  * Cabeçalho do response
  * @var array
  */
  private $headers = [];

 /*
  * Tipo de conteúdo que esta sendo retornado
  * @var string
  */
  private $contentType = 'text/html';

 /*
  * Conteúdo do response
  * @var mixed
  */
  private $content;


  /**
  * Método responsável por retornar o método HTTP da requisição
  * @params integer $httpCode
  * @params mixed $content
  * @params string $contentType
  */
  public function __construct($httpCode, $content, $contentType = 'text/html'){
    $this->httpCode = $httpCode;
    $this->content = $content;
    $this->contentType = $contentType;
    $this->setContentType($contentType);
  }

  /**
  * Método responsável por alterar o content type do response
  * @params string $contentType
  */
  public function setContentType($contentType){
    $this->contentType = $contentType;
    $this->addHeader('Content-Type', $contentType);
    }

  /**
  * Método responsável por adicionar um registro no cabeçalho do response
  * @params string $key
  * @params string $value
  */
  public function sendHeaders(){
    http_response_code($this->httpCode);

    foreach($this->headers as $key=>$value){
      header($key.': '.$value);
    }
  }

  /**
  * Método responsável por adicionar um registro no cabeçalho do response
  * @params string $key
  * @params string $value
  */
  public function addHeader($key, $value){
    $this->headers[$key] = $value;
  }

  /**
  * Método responsável por enviar a resposta para o usuário
  */
  public function sendResponse(){
    $this->sendHeaders();
    switch($this->contentType){
      case 'text/html':
        echo $this->content;
        exit;
    }
  }

}
