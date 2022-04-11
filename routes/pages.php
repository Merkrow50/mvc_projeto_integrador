<?php

use App\Controller\Pages\Page;
use \App\Http\Response;
use \App\Controller\Pages;
use App\Utils\View;

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
    return new Response(200, Pages\Collaborators::insertCollaborators($request));
  }
]);

$obRouter->get('/list/collaborators',[
    function(){
        return new Response(200, Pages\CollaboratorsList::getCollaboratorsList());
    }
]);

$obRouter->get('/contato',[
    function(){
        return new Response(200, Pages\Contact::getContact());
    }
]);

$obRouter->get('/pegada',[
    function(){
        return new Response(200, Pages\CarbonFootprint::getCarbonFootprint());
    }
]);