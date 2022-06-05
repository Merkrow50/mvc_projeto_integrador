<?php

namespace App\Model\Entity;
use App\DatabaseManager\Database;


class Called {

  public $colaborador_id;

  public $data;

  public $veiculo_id;

  public $hodometro_start;

  public $hodometro_finish;

  // EM_ANDAMENTO OU FINALIZADO
  public $status;

  public $chamado_id;

  public $deleted;


    public function cadastrar(){

      $this->chamado_id = (new Database('chamado'))->insert([
          'veiculo_id' => $this->veiculo_id,
          'hodometro_start' => $this->hodometro_start,
          'status' => 'EM_ANDAMENTO',
          'data' => $this->data
      ]);

      $this->chamado_id = (new Database('chamado_colaborador'))->insert([
          'chamado_id' => $this->chamado_id,
          'colaborador_id' => $this->colaborador_id
      ]);

      $this->veiculo_id = (new Database('veiculo'))->update('veiculo_id = '.$this->veiculo_id ,[
          'isEnable' => false
      ]);

      return true;
  }

    public function atualizar(){

        $this->chamado_id = (new Database('chamado'))->update('chamado_id = '.$this->chamado_id, [
            'veiculo_id' => $this->veiculo_id,
            'hodometro_start' => $this->hodometro_start,
            'data' => $this->data
        ]);

        return true;
    }

    public function finalizar(){

        $this->chamado_id = (new Database('chamado'))->update('chamado_id = '.$this->chamado_id, [
            'hodometro_finish' => $this->hodometro_finish,
            'status' => 'FINALIZADO'
        ]);

        $this->veiculo_id = (new Database('veiculo'))->update('veiculo_id = '.$this->veiculo_id ,[
            'isEnable' => true
        ]);

        return true;
    }


    public function atualizar_chamado_colaborador(){

        $this->chamado_id = (new Database('chamado_colaborador'))->update('chamado_id = '.$this->chamado_id, [
            'colaborador_id' => $this->colaborador_id
        ]);

        return true;
    }

    public function deletar(){

        $this->chamado_id = (new Database('chamado'))->update('chamado_id = '.$this->chamado_id, [
            'deleted' => $this->deleted
        ]);

        $this->veiculo_id = (new Database('veiculo'))->update('veiculo_id = '.$this->veiculo_id ,[
            'isEnable' => true
        ]);

        return true;
    }

    public function cancelar(){

        $this->chamado_id = (new Database('chamado'))->update('chamado_id = '.$this->chamado_id, [
            'status' => $this->status
        ]);

        return true;
    }

    public function deletar_chamado_colaborador(){

        $this->chamado_id = (new Database('chamado_colaborador'))->update('chamado_id = '.$this->chamado_id, [
            'deleted' => $this->deleted
        ]);

        return true;
    }


    public static function getCalleds($where = null, $order = null, $limit = null, $fields = '*'){
      return (new Database('chamado')) -> select($where, $order, $limit, $fields);
  }

  public static function getCalledsCollaborators($where = null, $order = null, $limit = null, $fields = '*'){
      return (new Database('chamado_colaborador')) -> select($where, $order, $limit, $fields);
  }

}
