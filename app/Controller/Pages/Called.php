<?php

namespace App\Controller\Pages;

use App\Model\Entity\Vehicles as EntityVehicles;
use App\Model\Entity\Collaborators as EntityCollaborators;
use \App\Utils\View;
use \App\Model\Entity\Called as EntityCalled;
use DateTime;

class Called extends Page
{

    public static function getCalled()
    {

        $content = View::render('pages/called', [
            'options-collaborators' => self::getOptionsCollaborators(0),
            'options-vehicles' => self::getOptionsVehicles(0)
        ]);

        return parent::getPage('Novo colaborador', $content);
    }

    public static function getOptionsCollaborators($selected){

        $options = '';

        $results = EntityCollaborators::getCollaborators(null, 'colaborador_id DESC');

        while ($obCollaborators = $results->fetchObject(Collaborators::class)){

            $options .= View::render('pages/options-selector',[
                'option' => $obCollaborators->nome,
                'value' => $obCollaborators->colaborador_id,
                'selected' => $selected == $obCollaborators->colaborador_id ? 'selected' : ''
            ]);

        }

        return $options;

    }

    public static function getOptionsVehicles($selected){

        $options = '';

        $results = EntityVehicles::getVehicle(null, 'veiculo_id DESC');

        while ($obVehicles = $results->fetchObject(\App\Model\Entity\Vehicles::class)){

            $options .= View::render('pages/options-selector',[
                'option' => $obVehicles->modelo,
                'value' => $obVehicles->veiculo_id,
                'selected' => $selected == $obVehicles->veiculo_id ? 'selected' : ''
            ]);

        }

        return $options;

    }


    public static function insertCalled($request)
    {
        $postVars = $request->getPostVars();

        $obCalled = new EntityCalled;

        $obCalled->veiculo_id = $postVars['veiculo_id'];
        $obCalled->data = $postVars['data'];
        $obCalled->colaborador_id = $postVars['colaborador_id'];
        $obCalled->hodometro_start = $postVars['hodometro_start'];
        $obCalled->cadastrar();

        $request->getRouter()->redirect('/list/calleds');
    }

    public static function getFinishCalled($request, $id){
        $obCalled = EntityCalled::getCalleds('chamado_id = '."'$id'")->fetchObject(EntityCalled::class);

        $content = View::render('pages/called-finish',[]);

        return parent::getPage('Finalizar chamado', $content);
    }

    public static function finishCalled($request, $id){
        $postVars = $request->getPostVars();

        $obCalled = EntityCalled::getCalleds('chamado_id = '."'$id'")->fetchObject(EntityCalled::class);

        $obCalled->hodometro_finish = $postVars['hodometro_finish'] ?? $obCalled->hodometro_finish;
        $obCalled->finalizar();

        $request->getRouter()->redirect('/list/calleds');
    }

    public static function getEditCalled($request, $id){
        $obCalled = EntityCalled::getCalleds('chamado_id = '."'$id'")->fetchObject(EntityCalled::class);
        $obCalledCollaborators = EntityCalled::getCalledsCollaborators('chamado_id = '."'$id'")->fetchObject(EntityCalled::class);

        $content = View::render('pages/called',[
            'options-collaborators' => self::getOptionsCollaborators($obCalledCollaborators->colaborador_id),
            'options-vehicles' => self::getOptionsVehicles($obCalled->veiculo_id),
            'data' => (new DateTime($obCalled->data))->format('Y-m-d\TH:i:s'),
            'hodometro_start' => $obCalled->hodometro_start
        ]);

        return parent::getPage('Editar chamado', $content);
    }

    public static function editCalled($request, $id){
        $postVars = $request->getPostVars();

        $obCalled = EntityCalled::getCalleds('chamado_id = '."'$id'")->fetchObject(EntityCalled::class);
        $obCalledCollaborators = EntityCalled::getCalledsCollaborators('chamado_id = '."'$id'")->fetchObject(EntityCalled::class);

        $obCalled->veiculo_id = $postVars['veiculo_id'] ?? $obCalled->veiculo_id;
        $obCalled->data = $postVars['data'] ?? $obCalled->data;
        $obCalled->hodometro_start = $postVars['hodometro_start'] ?? $obCalled->hodometro_start;
        $obCalled->atualizar();


        $obCalledCollaborators->colaborador_id = $postVars['colaborador_id'] ?? $obCalledCollaborators->colaborador_id;
        $obCalledCollaborators->atualizar_chamado_colaborador();

        $request->getRouter()->redirect('/list/calleds');
    }

    public static function deleteCalled($request, $id){
        $obCalledCollaborators = EntityCalled::getCalledsCollaborators('chamado_id = '."'$id'")->fetchObject(EntityCalled::class);

        $obCalledCollaborators->deletar_chamado_colaborador();

        $obCalled = EntityCalled::getCalleds('chamado_id = '."'$id'")->fetchObject(EntityCalled::class);

        $obCalled->deletar();

        $request->getRouter()->redirect('/list/calleds');
    }

    public static function getDeleteCalled($request, $id){

        $content = View::render('pages/delete',[]);

        return parent::getPage('Deletar chamado', $content);
    }


}
