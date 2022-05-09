<?php

namespace App\Model\Entity;
use App\DatabaseManager\Database;


class Vehicles {

  public $veiculo_id;

  public $modelo;

  public $ano;

  public $autonomia;

  public $quantidade;

  public function cadastrar(){

      $this->veiculo_id = (new Database('veiculo'))->insert([
          'modelo' => $this->modelo,
          'ano' => $this->ano,
          'autonomia' => $this->autonomia,
          'quantidade' => $this->quantidade
      ]);

      return true;
  }

  public static function getVehicle($where = null, $order = null, $limit = null, $fields = '*'){
      return (new Database('veiculo')) -> select($where, $order, $limit, $fields);
  }

    public static function deleteVehicle($where = null, $order = null, $limit = null, $fields = '*'){
        return (new Database('veiculo')) -> delete($where, $order, $limit, $fields);
    }

}
