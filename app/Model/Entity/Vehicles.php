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


    public function atualizar(){

        $this->veiculo_id = (new Database('veiculo'))->update('veiculo_id = '.$this->veiculo_id, [
            'modelo' => $this->modelo,
            'ano' => $this->ano,
            'autonomia' => $this->autonomia,
        ]);

        return true;
    }

    public function deletar(){

        $this->veiculo_id = (new Database('veiculo'))->delete('veiculo_id = '.$this->veiculo_id);

        return true;
    }

  public static function getVehicle($where = null, $order = null, $limit = null, $fields = '*'){
      return (new Database('veiculo')) -> select($where, $order, $limit, $fields);
  }

}
