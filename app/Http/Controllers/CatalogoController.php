<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB; //agregada
use Illuminate\Http\Request; //agregado
use DataTables;

class CatalogoController extends Controller{
    public function index(Request $request){

        if($request->ajax()){
            $herramientas = DB::select('SELECT * FROM catalogo');
            
            return DataTables::of($herramientas)
                ->addColumn('action', function($herramientas){
                    $acciones = '<a href="javascript:void(0)" onclick="editarHerramienta('. $herramientas->id .')" class="btn btn-info btn-sm">Editar</a>';
                    $acciones .= '&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="'. $herramientas->id .'" class="delete btn btn-danger btn-sm">Eliminar</button>';
                    return $acciones; 
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('catalogo.index');
    }
    
    public function registrar(Request $request){

        $descripcion = $request->descripcion;
        $codigo = $request->codigo;
        $numserie = $request->numserie;
        $tipo = $request->tipo;

        //codigo o serie estara vacio, por eso cambia el query
        if(empty($numserie)){
            $query= 'INSERT INTO catalogo(descripcion, codigo, tipo)'
                    .'VALUES("'.$descripcion.'","'.$codigo.'","'.$tipo.'")';
                
        }

        if(empty($codigo)){
            $query= 'INSERT INTO catalogo(descripcion, numserie, tipo)'
                    .'VALUES("'.$descripcion.'","'.$numserie.'","'.$tipo.'")';
                
        }
     
        $herramienta = DB::select($query);
        return back();

    }

    public function eliminar($id){
        $herramienta = DB::select('DELETE FROM catalogo WHERE id = '. $id);
        return back();

    }

    public function editar($id){
        //solo seleccionar la herramienta para despues actualizarla
        $herramienta = DB::select('SELECT * FROM catalogo WHERE id = '. $id);
        return response()->json($herramienta);
    }

    public function actualizar(Request $request){
        
        $id = $request->id;
        $descripcion = $request->descripcion;
        $codigo = $request->codigo;
        $serie = $request->numserie;
        $tipo = $request->tipo;

         //ASI NO FUNCIONA -> $serie = !empty($request->numserie) ? $request->numserie : NULL; 

        if(empty($codigo)){
            $query = 'UPDATE catalogo SET '
            .'descripcion="'.$descripcion.'",'
            .'numserie="'. $serie .'",'
            .'tipo="'. $tipo . '"'
            .' WHERE id='.$id;  
        }

        if(empty($serie)){
            $query = 'UPDATE catalogo SET '
            .'descripcion="'.$descripcion.'",'
            .'codigo="'. $codigo .'",'
            .'tipo="'. $tipo . '"'
            .' WHERE id='.$id;
        }

        $herramienta = DB::select($query);
        return back();
    }

}