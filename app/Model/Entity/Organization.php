<?php

namespace App\Model\Entity;

class Organization {

  /*
  * id da organização
  * @var integer
  */

  public $id = 1;

  /*
  * nome da organização
  * @var string
  */
  public $name = 'Carbon Footprint';

  /*
  * site da organização
  * @var string
  */
  public $site = 'https://carbonfootprint.com.br';


  /*
  * descriçãso sobre a organização
  * @var string
  */
  public $description = 'Carbon Footprint é um projeto desenvolvido pelos alunos Marcelo Klosouski Junior, Alexandre Ramos Barbosa e Alan Campos Silva na instituição SENAI, curso de graduação de análise e desenvolvimento de sistemas, no terceiro período, com o objetivo de construir um sistema capaz de gerenciar e relatar dados sobre a pegada de carbono gerada pela frota de carros das empresas, para um controle maior sobre a emissão de CO2 na atmosfera, e um amadurecimento da empresa assim caminhando para uma concientização sobre a natureza e o futuro.';


}
