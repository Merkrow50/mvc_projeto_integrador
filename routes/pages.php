<?php

use App\Controller\Pages\Page;
use \App\Http\Response;
use \App\Controller\Pages;
use App\Utils\View;
use App\Model\Entity;

$obRouter->get('/',[
    'middlewares' => [
        'require-admin-login'
    ],
  function(){
    return new Response(200, Pages\Home::getHome());
  }
]);

$obRouter->get('/list/collaborators/form',[
  function(){
    return new Response(200, Pages\Collaborators::getCollaborators());
  }
]);

$obRouter->post('/list/collaborators/form',[
  function($request){
    return new Response(200, Pages\Collaborators::insertCollaborators($request));
  }
]);

$obRouter->get('/list/collaborators',[
    function($request){
        return new Response(200, Pages\CollaboratorsList::getCollaboratorsList($request));
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


$obRouter->get('/list/vehicles/form',[
    function(){
        return new Response(200, Pages\Vehicles::getVehicles());
    }
]);

$obRouter->post('/list/vehicles/form',[
    function($request){
        return new Response(200, Pages\Vehicles::insertVehicle($request));
    }
]);

$obRouter->get('/list/vehicles',[
    function($request){
        return new Response(200, Pages\VehiclesList::getVehiclesList($request));
    }
]);

$obRouter->delete('/list/vehicles',[
    function($request){
        return new Response(200, Pages\VehiclesList::deleteVehicle($request));
    }
]);

$obRouter->get('/list/calleds',[
    function($request){
        return new Response(200, Pages\CalledList::getCalledList($request));
    }
]);


$obRouter->get('/list/calleds/form',[
    function(){
        return new Response(200, Pages\Called::getCalled());
    }
]);

$obRouter->post('/list/calleds/form',[
    function($request){
        return new Response(200, Pages\Called::insertCalled($request));
    }
]);