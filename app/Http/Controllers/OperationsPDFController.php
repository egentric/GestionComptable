<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

class OperationsPDFController extends Controller
{
//  /**
//      * Display a listing of the resource.
//      *
//      * @return \Illuminate\Http\Response
//     */
//     public function generatePDF()
//     {
//         $users = User::get();
  
//         $data = [
//             'title' => 'Welcome to Nicesnippets.com',
//             'date' => date('m/d/Y'),
//             'users' => $users
//         ]; 
            
//         $pdf = PDF::loadView('myPDF', $data);
     
//         return $pdf->download('nicesnippets.pdf');
//     }












    
    function index()
    {
        $operations_data = $this->get_operations_data();
        return view('liste-operations_pdf')
            ->with('operations_data', $operations_data);
}
    
    function get_operations_data()
    {
        $operations_data = DB::table('operations')
        ->get();
        return $operations_data;
    }

    function pdf()
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_operations_data_to_html());
        $pdf->getDomPDF()->sec_option('enable_php', true);
        $pdf->setPapaer('a4', 'landscape');
        return $pdf->stream();
    }

    function convert_operations_data_to_html()
    {

        
        $operations_data = $this->get_operations_data();
        $output = '
        <h4 align="center">Opérations</h4>
        <table with="100%" style="border-colapse: 0px;">
        <thead>
        <tr>
            <th style="border: 1px solid; padding:6px;" width="10%">Date</th>
            <th style="border: 1px solid; padding:6px;" width="40%">Nature de l\'opération</th>
            <th style="border: 1px solid; padding:6px;" width="30%">Catégorie de l\'opération</th>
            <th style="border: 1px solid; padding:6px;" width="10%">Débit</th>
            <th style="border: 1px solid; padding:6px;" width="10%">Crédit</th>
        </tr>
        </thead>
        <tbody>
        ';
            foreach($operations as $operation)
            {
                $output .= '
            <tr>
                <td style="border: 1px solid; padding:6px;">'.$operation->operationDate.'</td>
                <td style="border: 1px solid; padding:6px;">'.$operation->operationDescription.'</td>
                <td style="border: 1px solid; padding:6px;">'.$operation->category->categoryName.'</td>
                <td style="border: 1px solid; padding:6px;">
                if ('.$operation->operationSomme.'<0){
                    $operation->operationSomme €
                }else{
                    - 
                }   
                </td>
                <td style="border: 1px solid; padding:6px;">
                    if ($operation->operationSomme>=0){
                    $operation->operationSomme €
                    }else{
                    -
                    }
                </td>
            </tr>
            ';
            }
            $output .= '
            </tbody>
        <tfoot>
            <tr>
                <td colspan="2" style="border: 1px solid; padding:6px;"></td>
                <th style="border: 1px solid; padding:6px;">Total :</th>
                <td colspan="2" style="border: 1px solid; padding:6px;">
                    '.$total.' €
                 <td>
             </tr>
        </tfoot>
        </table>'
        ;
        $output .='<script type="text/php">
        if (isset(pdf)) {
            $text = "Page :{PAGE_NUM}/{PAGE_COUNT}";
            $size = 10;
            $font = $fontMetrics->getFont("verdana");
            $width = $fontMetrics->get_text_width($text, $font, $size / 2;
            $x = ($pdf->get_width() - $width / 2;
            $y = ($pdf->get_height() - 35;
            $pdf->page_text($x, $y, $text, $font, $size);
        }
        </script>';
        return $output;
    }

}
