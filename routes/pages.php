<?php

use App\Controller\Pages\Page;
use \App\Http\Response;
use \App\Controller\Pages;
use App\Utils\View;
use App\Model\Entity;

$obRouter->get('/',[
    'middlewares' => [
        'require-admin-login',
        'user-blocked'
    ],
  function(){
    return new Response(200, Pages\Home::getHome());
  }
]);

$obRouter->get('/list/collaborators/form',[
    'middlewares' => [
        'require-admin-login',
        'required-role-admin'
    ],
  function(){
    return new Response(200, Pages\Collaborators::getCollaborators());
  }
]);

$obRouter->post('/list/collaborators/form',[
    'middlewares' => [
        'require-admin-login',
        'required-role-admin'
    ],
  function($request){
    return new Response(200, Pages\Collaborators::insertCollaborators($request));
  }
]);

$obRouter->get('/list/collaborators',[
    'middlewares' => [
        'require-admin-login',
        'required-role-admin'
    ],
    function($request){
        return new Response(200, Pages\CollaboratorsList::getCollaboratorsList($request));
    }
]);

$obRouter->get('/list/collaborators/form/{id}',[
    'middlewares' => [
        'require-admin-login',
        'required-role-admin'
    ],
    function($request, $id){
        return new Response(200, Pages\Collaborators::getEditCollaborators($request, $id));
    }
]);

$obRouter->post('/list/collaborators/form/{id}',[
    'middlewares' => [
        'require-admin-login',
        'required-role-admin'
    ],
    function($request, $id){
        return new Response(200, Pages\Collaborators::editCollaborators($request, $id));
    }
]);

$obRouter->post('/list/collaborators/delete/{id}',[
    'middlewares' => [
        'require-admin-login',
        'required-role-admin'
    ],
    function($request, $id){
        return new Response(200, Pages\Collaborators::deleteCollaborators($request, $id));
    }
]);

$obRouter->get('/list/collaborators/delete/{id}',[
    'middlewares' => [
        'require-admin-login',
        'required-role-admin'
    ],
    function($request, $id){
        return new Response(200, Pages\Collaborators::getDeleteCollaborators($request, $id));
    }
]);

$obRouter->get('/reports',[
    'middlewares' => [
        'require-admin-login',
        'required-role-admin'
    ],
    function(){
        return new Response(200, Pages\Report::getReport());
    }
]);

$obRouter->post('/reports',[
    'middlewares' => [
        'require-admin-login',
        'required-role-admin'
    ],
    function($request){
        return new Response(200, Pages\Report::processReport($request));
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
        'require-admin-login',
        'required-role-admin'
    ],
    function(){
        return new Response(200, Pages\Vehicles::getVehicles());
    }
]);

$obRouter->post('/list/vehicles/form',[
    'middlewares' => [
        'require-admin-login',
        'required-role-admin'
    ],
    function($request){
        return new Response(200, Pages\Vehicles::insertVehicle($request));
    }
]);

$obRouter->get('/list/vehicles/form/{id}',[
    'middlewares' => [
        'require-admin-login',
        'required-role-admin'
    ],
    function($request, $id){
        return new Response(200, Pages\Vehicles::getEditVehicle($request, $id));
    }
]);

$obRouter->post('/list/vehicles/form/{id}',[
    'middlewares' => [
        'require-admin-login',
        'required-role-admin'
    ],
    function($request, $id){
        return new Response(200, Pages\Vehicles::editVehicle($request, $id));
    }
]);

$obRouter->post('/list/vehicles/delete/{id}',[
    'middlewares' => [
        'require-admin-login',
        'required-role-admin'
    ],
    function($request, $id){
        return new Response(200, Pages\Vehicles::deleteVehicle($request, $id));
    }
]);

$obRouter->get('/list/vehicles/delete/{id}',[
    'middlewares' => [
        'require-admin-login',
        'required-role-admin'
    ],
    function($request, $id){
        return new Response(200, Pages\Vehicles::getDeleteVehicle($request, $id));
    }
]);


$obRouter->get('/list/vehicles',[
    'middlewares' => [
        'require-admin-login',
        'required-role-admin'
    ],
    function($request){
        return new Response(200, Pages\VehiclesList::getVehiclesList($request));
    }
]);

$obRouter->get('/list/calleds',[
    'middlewares' => [
        'require-admin-login',
        'required-role-operator-driver',
    ],
    function($request){
        return new Response(200, Pages\CalledList::getCalledList($request));
    }
]);


$obRouter->get('/list/calleds/form',[
    'middlewares' => [
        'require-admin-login',
        'required-role-operator'
    ],
    function(){
        return new Response(200, Pages\Called::getCalled());
    }
]);

$obRouter->post('/list/calleds/form',[
    'middlewares' => [
        'require-admin-login',
        'required-role-operator'
    ],
    function($request){
        return new Response(200, Pages\Called::insertCalled($request));
    }
]);

$obRouter->post('/list/calleds/form/{id}',[
    'middlewares' => [
        'require-admin-login',
        'required-role-operator'
    ],
    function($request, $id){
        return new Response(200, Pages\Called::editCalled($request, $id));
    }
]);

$obRouter->get('/list/calleds/form/{id}',[
    'middlewares' => [
        'require-admin-login',
        'required-role-operator'
    ],
    function($request, $id){
        return new Response(200, Pages\Called::getEditCalled($request, $id));
    }
]);

$obRouter->post('/list/calleds/delete/{id}',[
    'middlewares' => [
        'require-admin-login',
        'required-role-operator'
    ],
    function($request, $id){
        return new Response(200, Pages\Called::deleteCalled($request, $id));
    }
]);

$obRouter->get('/list/calleds/delete/{id}',[
    'middlewares' => [
        'require-admin-login',
        'required-role-operator'
    ],
    function($request, $id){
        return new Response(200, Pages\Called::getDeleteCalled($request, $id));
    }
]);

$obRouter->post('/list/calleds/finish/{id}',[
    'middlewares' => [
        'require-admin-login',
        'required-role-driver'
    ],
    function($request, $id){
        return new Response(200, Pages\Called::finishCalled($request, $id));
    }
]);

$obRouter->get('/list/calleds/finish/{id}',[
    'middlewares' => [
        'require-admin-login',
        'required-role-driver'
    ],
    function($request, $id){
        return new Response(200, Pages\Called::getFinishCalled($request, $id));
    }
]);





$obRouter->get('/list/users/form',[
    'middlewares' => [
        'require-admin-login',
        'required-role-admin'
    ],
    function(){
        return new Response(200, Pages\User::getUser());
    }
]);

$obRouter->post('/list/users/form',[
    'middlewares' => [
        'require-admin-login',
        'required-role-admin'
    ],
    function($request){
        return new Response(200, Pages\User::insertUser($request));
    }
]);

$obRouter->get('/list/users',[
    'middlewares' => [
        'require-admin-login',
        'required-role-admin'
    ],
    function($request){
        return new Response(200, Pages\UsersList::getUsersList($request));
    }
]);

//$obRouter->get('/list/users/form/{id}',[
//    'middlewares' => [
//        'require-admin-login',
//        'required-role-admin'
//    ],
//    function($request, $id){
//        return new Response(200, Pages\User::getEditUser($request, $id));
//    }
//]);
//
//$obRouter->post('/list/users/form/{id}',[
//    'middlewares' => [
//        'require-admin-login',
//        'required-role-admin'
//    ],
//    function($request, $id){
//        return new Response(200, Pages\User::editUser($request, $id));
//    }
//]);

$obRouter->get('/list/users/blocked/{id}',[
    'middlewares' => [
        'require-admin-login',
        'required-role-admin'
    ],
    function($request, $id){
        return new Response(200, Pages\User::getBlockedUser($request, $id));
    }
]);

$obRouter->post('/list/users/blocked/{id}',[
    'middlewares' => [
        'require-admin-login',
        'required-role-admin'
    ],
    function($request, $id){
        return new Response(200, Pages\User::blockedUser($request, $id));
    }
]);

$obRouter->get('/list/users/unblocked/{id}',[
    'middlewares' => [
        'require-admin-login',
        'required-role-admin'
    ],
    function($request, $id){
        return new Response(200, Pages\User::getUnBlockedUser($request, $id));
    }
]);

$obRouter->post('/list/users/unblocked/{id}',[
    'middlewares' => [
        'require-admin-login',
        'required-role-admin'
    ],
    function($request, $id){
        return new Response(200, Pages\User::unBlockedUser($request, $id));
    }
]);


$obRouter->get('/list/calleds/cancel/{id}',[
    'middlewares' => [
        'require-admin-login',
        'required-role-operator'
    ],
    function($request, $id){
        return new Response(200, Pages\Called::getCancelledCalled($request, $id));
    }
]);

$obRouter->post('/list/calleds/cancel/{id}',[
    'middlewares' => [
        'require-admin-login',
        'required-role-operator'
    ],
    function($request, $id){
        return new Response(200, Pages\Called::cancelCalled($request, $id));
    }
]);



