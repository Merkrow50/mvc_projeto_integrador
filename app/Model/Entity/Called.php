<?php

namespace App\Model\Entity;
use App\DatabaseManager\Database;


class Called {

  public $colaborador_id;

  public $data;

  public $veiculo_id;

  public $distancia_percorrida;

  public $chamado_id;


  public function cadastrar(){

      $this->chamado_id = (new Database('chamado'))->insert([
          'veiculo_id' => $this->veiculo_id,
          'distancia_percorrida' => $this->distancia_percorrida,
          'data' => $this->data
      ]);

      $this->chamado_id = (new Database('chamado_colaborador'))->insert([
          'chamado_id' => $this->chamado_id,
          'colaborador_id' => $this->colaborador_id
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
