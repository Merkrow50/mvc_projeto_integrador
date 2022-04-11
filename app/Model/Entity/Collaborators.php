<?php

namespace App\Model\Entity;
use App\DatabaseManager\Database;


class Collaborators {

  public $id;

  public $nome;

  public $cnh;

  public $matricula;

  public $data_nascimento;

  public $atribuicao;


  public function cadastrar(){

      $this->id = (new Database('colaborador'))->insert([
          'nome' => $this->nome,
          'cnh' => $this->cnh,
          'matricula' => $this->matricula,
          'data_nascimento' => $this->data_nascimento,
          'atribuicao' => $this->atribuicao
      ]);

      return true;
  }

  public static function getCollaborators($where = null, $order = null, $limit = null, $fields = '*'){
      return (new Database('colaborador')) -> select($where, $order, $limit, $fields);
  }

}
