<?php

namespace App\Http\Controllers;
use Khill\Lavacharts\Lavacharts;
use App\Factores;
use DB;
use App\Convenios;
use App\Dimension;
use Request;
use Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Instituciones;
use App\Encuesta;
use App\Regiones;

class ReporteController extends Controller
{
  
// Menu 1: IMDIS por Municipios  
public function municipiosPorcentaje(Request $request){

    $id_combo             =  Request::get('convenio_id');
    $id_combo_regiones    =  Request::get('regiones');
    
    if ($id_combo == "0")
    {
        $message = "Seleccione un Período";
        return redirect()->back()->withInput()->withErrors($message);
               
    }

   $convenios = Convenios::getIdAttributeConvenios(); 
   $regiones = Regiones::all();
    return view('reportes/porcentajeMunicipios',compact('convenios','id_combo', 'id_combo_regiones', 'regiones'));
 }

 
 //Menu 1 Ajax
 public function porcentajeMunicipioAjax()
  {

    $data = Input::all();

    // Calcula el promedio
        $suma = 0; 
        $cont_promedio = 0; 
        $promedio = 0;
       
    $rs_encuestas = Instituciones::getMunicipiosPorcentajePost($data['convenio_id'], $data['regiones']);
    
     foreach($rs_encuestas as $row){    
            $suma = $suma +$row->porcentaje;
            $cont_promedio += 1;
        }

        if (($suma != 0) && ($cont_promedio != 0))
        {
            $promedio = $suma/$cont_promedio;
        
          //return $promedio;
        }
     
    $modulo = "porcentajeMunicipio";
    return json_encode(array($rs_encuestas,$promedio,$modulo));

  }


// Menu 2: Cumplimiento por Dimensión
 public function PorcentajeDimension (){

    $id_combo = Request::get('convenio_id');
    $id_combo_regiones = Request::get('regiones');
     
    if ($id_combo == " ")
    {
        $message = "Seleccione un Período";
        return redirect()->back()->withInput()->withErrors($message);
    }

    $regiones = Regiones::all();
    $convenios = Convenios::getIdAttributeConvenios();
    return view('reportes/porcentajeDimension',compact('convenios','id_combo',                                                'regiones',
                                                    'id_combo_regiones'
                                                        ));
 }

//Menu 2 Ajax
 public function porcentajeDimensionAjax(){
  
  $data = Input::all();
  
  $rs_encuestas = Dimension::getPorcentajeDimension($data['convenio_id'], $data['regiones']);
  $promedio = 0;

  $modulo = "porcentajeDimension";
  return json_encode(array($rs_encuestas,$promedio,$modulo));
 }



 // Menu 3: Dimensión por Municipalidad
 public function dimensionMunicipalidad()
 {
    
    $id_periodo   = Request::get('periodo_id');
    $id_combo     = Request::get('dimension_id');
    $id_combo_regiones = Request::get('regiones');

     $convenios   = Convenios::getIdAttributeConvenios();
     $dimensiones = Dimension::getIdAttributeDimensiones($id_periodo);

     if (($id_periodo == "0") && ($id_combo == "0")) {
            $message = "Seleccione un Período y Dimensión";
            return redirect()->back()->withInput()->withErrors($message)
             ->with("id_combo",$id_combo)
             ->with("id_periodo",$id_periodo)
             ->with("convenios",$convenios)
             ->with("dimensiones",$dimensiones);
     } else {

          if (($id_periodo == "0"))
          {
            $message = "Seleccione un Periodo";
             return redirect()->back()->withInput()->withErrors($message)
             ->with('id_periodo', $id_periodo)
             ->with("id_combo",$id_combo);
                   
          } else {
            // Si no selecciona ninguna dimensión
            if (($id_combo == "0")){    
               $message = "Seleccione una Dimensión";
               return redirect()->back()->withInput()->withErrors($message)
               ->with('id_periodo', $id_periodo)
               ->with("id_combo",$id_combo);
            } else { 

                // Calcula el promedio
            
              $regiones = Regiones::all();
              return view('reportes/porcentajeDimensionMunicipalidad', compact('dimensiones','id_combo','convenios','id_periodo', 'regiones','id_combo_regiones'));
     }
   }
 }
}

//Menu 3

public function porcentajeDimensionmunicipalidadAjax(){
 
 $data = Input::all();

 $rs_encuestas = Instituciones::getDimensionMunicipalidad($data['dimension_id'], $data['periodo_id'],$data['regiones']);

// Calcula el promedio
                $suma = 0; 
                $cont_promedio = 0; 
                $promedio = 0;
                foreach($rs_encuestas as $row){    
                    $suma = $suma +$row->porcentaje;
                    $cont_promedio += 1;
                }
        
                if (($suma != 0) && ($cont_promedio != 0))
                {
                    $promedio = $suma/$cont_promedio;
                }

$modulo = "dimensionMunicipalidad";
return json_encode(array($rs_encuestas,$promedio,$modulo));

}


// Menu 4: Cumplimiento por Factor
public function cumplimientoFactor()
{
    
    $id_combo = Request::get('convenio_id');
    $id_combo_regiones = Request::get('regiones');

    if ($id_combo == "0")
    {
        $message = "Seleccione un Período";
        return redirect()->back()->withInput()->withErrors($message);
               
    }
    
    // Retorna los factores del perido seleccionado.
    // Un convenio tiene 1 encuesta. Una encuesta puede pertenecer a muchos convenios.
    $convenios = Convenios::getIdAttributeConvenios();
    $regiones = Regiones::all();
   
    return view('reportes/porcentajeCumplimientoFactor',compact('convenios','id_combo', 'regiones', 'id_combo_regiones'));

}

//Menu 4 AJax.
public function porcentajeFactorAjax(){
  $data = Input::all();
  
  $rs_encuestas = Factores::getCumplimientoFactor($data['convenio_id'], $data['regiones']);
  $promedio = 0;

  $modulo = "porcentajeFactor";
  return json_encode(array($rs_encuestas,$promedio,$modulo));

}



 // Menu 5: Factor por Municipalidad
public function factorMunicipalidad()
{

    $id_combo   = Request::get('periodo_id');
    $id_factor  = Request::get('factor_id');
    $id_combo_regiones = Request::get('regiones');

    if (($id_combo == "0") && ($id_factor == "0"))
    {
      $message = "Seleccione un Período y un Factor";
      return redirect()->back()->withInput()->withErrors($message)
          ->with("id_combo",$id_combo)
          ->with("id_factor",$id_factor);
    } else {
        if ($id_combo == "0")
        {
            $message = "Seleccione un Período";
            return redirect()->back()->withInput()->withErrors($message)
                  ->with("id_factor",$id_factor)
                  ->with("id_combo", $id_combo);
        } else {

           $convenios   = Convenios::getIdAttributeConvenios();
           $factores    = Factores::getIdAttributeFactores($id_combo); // Envia id del factor.

           $regiones = Regiones::all();

          return view('reportes/porcentajeFactorMunicipalidad',compact('factores','id_factor','convenios','id_combo', 'regiones', 'id_combo_regiones'));

      }

    }
  }


// Menu 5 Ajax
public function porcentajefactormunicipalidadAjax(){

    $data = Input::all();


    $rs_encuestas = Instituciones::getFactorMunicipalidad($data['factor_id'],$data['periodo_id'], $data['regiones']);
 
   // Calcula el promedio
    $suma = 0;
    $cont_promedio = 0;
    $promedio = 0;
    foreach($rs_encuestas as $row){  
      $suma = $suma + $row->porcentaje;
      $cont_promedio += 1;
    }

   // Para que no de error de división por cero la primera vez.
    if (($suma != 0) && ($cont_promedio != 0))
    {
        $promedio = $suma/$cont_promedio;
    }

    $modulo = "porcentajeFactoresmunicipalidad";
    return json_encode(array($rs_encuestas,$promedio,$modulo));

}


 //ajax combo reporte 3
 public function dimensionMunicipalidadAjax($id_periodo)
 {
   $dimensiones = Dimension::getIdAttributeDimensiones($id_periodo); // Envia id del factor.
   return $dimensiones;


 }

//ajax combo reporte 5
  public function factorMunicipalidadAjax($id){
      $factores    = Factores::getIdAttributeFactores($id); // Envia id del factor.
      return $factores;
  }

}//fin class

