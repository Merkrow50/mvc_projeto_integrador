<?php

namespace App\Controller\Pages;

use App\Utils\View;
use Mpdf\Mpdf;

class Report extends Page
{


    /*
    *@return string
    */
    public static function getReport(){

        // View da home
        $content =  View::render('pages/report', [
        ]);

        // View da pagina
        return parent::getPage('Contato', $content);
    }

    public static function generateReport(){
        $mpdf = new mPDF();

// Write some HTML code:

        $mpdf->WriteHTML('<style>

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th {
      background: #333;
      color: white;
      font-weight: bold;
      cursor: cell;
    }
    td, th {
      padding: 6px;
      border: 1px solid #ccc;
      text-align: left;
      box-sizing: border-box;
    }

    tr:nth-child(even) {background-color: #f2f2f2;}



</style>');

        $mpdf->WriteHTML('
<div style="text-align: center;">
<h1 style="padding: 15px;">Relatório</h1>
<div style="overflow-x:auto;">
    <table width="100%">
        <tr>
            <th>Número total de chamados</th>
            <th>Distância total percorrida</th>
            <th>Média da distância por chamado</th>
            <th>Total de CO2 emitido</th>
            <th>Média de CO2 emitido por chamado</th>
        </tr>
        {{itens}}
    </table>
</div>
</div>

');

// Output a PDF file directly to the browser
        $mpdf->Output();
    }

}