<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Diagnostic;

class ExcelController extends Controller
{
    
    public function index(){
     Excel::create('ReportDiagnosticos', function($excel) {
           $excel->setTitle('Reporte Excel OmarMV');
           $excel->setCreator('Omar')->setCompany('Omar');
           $excel->setDescription('Software Clinico');
           $diagnosticos=Diagnostic::where('estado',1)->get();
           $data=[];
           $i=0;
           foreach($diagnosticos as $diagnostico){ 
            $row=[];
            $row[0]=$diagnostico->descripcion;
            $row[1]=$diagnostico->cie10;
            $row[2]=$diagnostico->recomendaciones;
            $data[]=$row;
            $i++;
           }
            //$sheet->freezeFirstRow();
                //$sheet->setFreeze('A1');
                  //$sheet->setWidth(array('B'=>'17'));
                // $sheet->setHeight(array('4'=>'20'));
            $excel->sheet('Hoja 1', function ($sheet)  use($data,$i){
                $sheet->setOrientation('landscape');
                $sheet->mergeCells('A1:C1');
                $sheet->row(1,['Relacion']); 
                $sheet->row(2,['Descripcion','CIE 10','Recomendaciones']); 
                $sheet->setBorder('A1:C'.($i+2),'thin');
                $sheet->cells('A1:C2',function($cells){
                    $cells->setFont(array('bold'=> true));
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFontSize(13);
                    $cells->setBackground('#33AD25');
                    $cells->setFontColor('#FFFFFF'); 
                });
                $sheet->fromArray($data,NULL, 'A3',false,false);
                //$sheet->setAutoFilter('A2:C2');
            });

         })->export('xlsx');
    }

}



