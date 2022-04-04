<?php

use \App\Http\Response;
use \App\Controller\Pages;


$obRouter->get('/',[
  function(){
    return new Response(200, Pages\Home::getHome());
  }
]);

$obRouter->get('/collaborators',[
  function(){
    return new Response(200, Pages\Collaborators::getCollaborators());
  }
]);

$obRouter->post('/collaborators',[
  function($request){
    return new Response(200, Pages\Collaborators::insertCollaborators());
  }
]);
