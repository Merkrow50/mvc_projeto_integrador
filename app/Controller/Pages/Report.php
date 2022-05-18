<?php

namespace App\Controller\Pages;

use App\Model\Entity\Called as EntityCalled;
use App\Model\Entity\Vehicles as EntityVehicles;
use App\Utils\View;
use Mpdf\Mpdf;

class Report extends Page
{


    /*
    *@return string
    */
    public static function getReport()
    {

        // View da home
        $content = View::render('pages/report', [
        ]);

        // View da pagina
        return parent::getPage('Contato', $content);
    }

    public static function processReport($request)
    {

        $postVars = $request->getPostVars();
        $distancia_total = null;
        $pegada_total = null;

        $start_date = $postVars["start_date"];
        $finish_date = $postVars["finish_date"];


//        QUANTIDADE TOTAL DE REGISTROS
        $quantidadeTotal = EntityCalled::getCalleds("data >= " . "'$start_date'" . " AND " . "data <= '$finish_date'", null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;

        $results = EntityCalled::getCalleds("data >= " . "'$start_date'" . " AND " . "data <= '$finish_date'", 'chamado_id DESC');

        while ($obCalleds = $results->fetchObject(EntityCalled::class)) {
            $distancia_total += $obCalleds->hodometro_finish - $obCalleds->hodometro_start;
            $autonomia = EntityVehicles::getVehicle("veiculo_id = $obCalleds->veiculo_id", 'veiculo_id DESC')->fetchObject()->autonomia;
            $CG = ($obCalleds->hodometro_finish - $obCalleds->hodometro_start) / $autonomia;
            $pegada_total += ($CG * 0.73 * 0.75 * 3.7);
        }

        $media_distancia = $distancia_total / $quantidadeTotal;
        $mediaCo2 = $pegada_total / $quantidadeTotal;

        self::generateReport($quantidadeTotal, $distancia_total, $media_distancia, $pegada_total, $mediaCo2);
    }

    public static function generateReport($quantidadeTotal, $distancia_total, $media_distancia, $pegada_total, $mediaCo2)
    {
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
        <tr>         
            <td>' . $quantidadeTotal . '</td>        
            <td>' . $distancia_total . ' KM</td>
            <td>' . $media_distancia . ' KM</td>
            <td>' . $pegada_total . ' Kg/L</td>
            <td>' . $mediaCo2 . ' Kg/L</td>
        </tr>
    </table>
</div>
</div>

');

// Output a PDF file directly to the browser
        $mpdf->Output();
    }

}