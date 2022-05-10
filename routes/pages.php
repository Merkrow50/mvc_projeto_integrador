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
    'middlewares' => [
        'require-admin-login'
    ],
  function(){
    return new Response(200, Pages\Collaborators::getCollaborators());
  }
]);

$obRouter->post('/list/collaborators/form',[
    'middlewares' => [
        'require-admin-login'
    ],
  function($request){
    return new Response(200, Pages\Collaborators::insertCollaborators($request));
  }
]);

$obRouter->get('/list/collaborators',[
    'middlewares' => [
        'require-admin-login'
    ],
    function($request){
        return new Response(200, Pages\CollaboratorsList::getCollaboratorsList($request));
    }
]);

$obRouter->get('/contato',[
    'middlewares' => [
        'require-admin-login'
    ],
    function(){
        return new Response(200, Pages\Contact::getContact());
    }
]);

$obRouter->get('/pegada',[
    'middlewares' => [
        'require-admin-login'
    ],
    function(){
        return new Response(200, Pages\CarbonFootprint::getCarbonFootprint());
    }
]);


$obRouter->get('/list/vehicles/form',[
    'middlewares' => [
        'require-admin-login'
    ],
    function(){
        return new Response(200, Pages\Vehicles::getVehicles());
    }
]);

$obRouter->post('/list/vehicles/form',[
    'middlewares' => [
        'require-admin-login'
    ],
    function($request){
        return new Response(200, Pages\Vehicles::insertVehicle($request));
    }
]);

$obRouter->get('/list/vehicles/form/{id}',[
    'middlewares' => [
        'require-admin-login'
    ],
    function($request, $id){
        return new Response(200, Pages\Vehicles::getEditVehicle($request, $id));
    }
]);

$obRouter->post('/list/vehicles/form/{id}',[
    'middlewares' => [
        'require-admin-login'
    ],
    function($request, $id){
        return new Response(200, Pages\Vehicles::editVehicle($request, $id));
    }
]);

$obRouter->post('/list/vehicles/delete/{id}',[
    'middlewares' => [
        'require-admin-login'
    ],
    function($request, $id){
        return new Response(200, Pages\Vehicles::deleteVehicle($request, $id));
    }
]);

$obRouter->get('/list/vehicles',[
    'middlewares' => [
        'require-admin-login'
    ],
    function($request){
        return new Response(200, Pages\VehiclesList::getVehiclesList($request));
    }
]);

$obRouter->delete('/list/vehicles',[
    'middlewares' => [
        'require-admin-login'
    ],
    function($request){
        return new Response(200, Pages\VehiclesList::deleteVehicle($request));
    }
]);

$obRouter->get('/list/calleds',[
    'middlewares' => [
        'require-admin-login'
    ],
    function($request){
        return new Response(200, Pages\CalledList::getCalledList($request));
    }
]);


$obRouter->get('/list/calleds/form',[
    'middlewares' => [
        'require-admin-login'
    ],
    function(){
        return new Response(200, Pages\Called::getCalled());
    }
]);

$obRouter->post('/list/calleds/form',[
    'middlewares' => [
        'require-admin-login'
    ],
    function($request){
        return new Response(200, Pages\Called::insertCalled($request));
    }
]);