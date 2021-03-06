<?php

namespace App\Model\Entity;
use App\DatabaseManager\Database;


class Collaborators {

  public $colaborador_id;

  public $nome;

  public $matricula;

  public $habilitado;

  public $deleted;



    public function cadastrar(){

      $this->colaborador_id = (new Database('colaborador'))->insert([
          'nome' => $this->nome,
          'matricula' => $this->matricula,
          'habilitado' => $this->habilitado
      ]);

      return true;
  }


    public function atualizar(){

        $this->colaborador_id = (new Database('colaborador'))->update('colaborador_id = '.$this->colaborador_id, [
            'nome' => $this->nome,
            'matricula' => $this->matricula,
            'habilitado' => $this->habilitado,
        ]);

        return true;
    }

    public function deleted(){

        $this->colaborador_id = (new Database('colaborador'))->delete('colaborador_id = ' . $this->colaborador_id);

        return true;
    }

    public function deletar(){

        $this->colaborador_id = (new Database('colaborador'))->update('colaborador_id = '.$this->colaborador_id, [
            'deleted' => $this->deleted
        ]);

        return true;
    }


    public static function getCollaborators($where = null, $order = null, $limit = null, $fields = '*'){
      return (new Database('colaborador')) -> select($where, $order, $limit, $fields);
  }

}
