<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TiendaChein;
use Carbon\Carbon;

class MostrarPrenda extends Controller
{
    public function index()
    {
        $datosTiendaChein = TiendaChein::all();
        return response()->json($datosTiendaChein);
    }
    
    public function guardarTiendaChein(Request $request)
    {

        $datosTiendaChein = new TiendaChein();
        if ($request->hasFile('imagen')) {
            $nombreArchivoOriginal = $request->file('imagen')->getClientOriginalName();
            $nuevoNombre = Carbon::now()->timestamp . "_" . $nombreArchivoOriginal;

            $carpetaDestino = './upload/';
            $request->file('imagen')->move($carpetaDestino, $nuevoNombre);

            $datosTiendaChein->nombre = $request->nombre;
            $datosTiendaChein->genero = $request->genero;
            $datosTiendaChein->tipo = $request->tipo;
            $datosTiendaChein->color = $request->color;
            $datosTiendaChein->tallas = $request->tallas;
            $datosTiendaChein->precio = $request->precio;
            $datosTiendaChein->imagen = ltrim($carpetaDestino,'.').$nuevoNombre;

            $datosTiendaChein->save();
        }
        return response()->json($nuevoNombre);
    }

    public function verTiendaChein($id){
        $datosTiendaChein= new TiendaChein();
        $datosEncontrados=$datosTiendaChein->find($id);
        return response()->json($datosEncontrados);

    }

    public function eliminarTiendaChein($id){
        $datosTiendaChein= TiendaChein::find($id);
        if ($datosTiendaChein) {
            $rutaArchivo= base_path('public').$datosTiendaChein->imagen;
            if (file_exists($rutaArchivo)) {
                unlink($rutaArchivo);
            }
            $datosTiendaChein->delete();
        }

        return response()->json("Registro Borrado");
    }

    public function actualizarTiendaChein(Request $request,$id){
        $datosTiendaChein= TiendaChein::find($id);

        if ($request->hasFile('imagen')) {
            if ($datosTiendaChein) {
                $rutaArchivo= base_path('public').$datosTiendaChein->imagen;
                if (file_exists($rutaArchivo)) {
                    unlink($rutaArchivo);
                }
                $datosTiendaChein->delete();
            }

            $nombreArchivoOriginal = $request->file('imagen')->getClientOriginalName();
            $nuevoNombre = Carbon::now()->timestamp . "_" . $nombreArchivoOriginal;

            $carpetaDestino = './upload/';
            $request->file('imagen')->move($carpetaDestino, $nuevoNombre);

            $datosTiendaChein->imagen = ltrim($carpetaDestino,'.').$nuevoNombre;
            $datosTiendaChein->save();
        }

        if ($request->input('nombre')) {
            $datosTiendaChein->nombre=$request->input('nombre');
        }
        if ($request->input('genero')) {
            $datosTiendaChein->genero=$request->input('genero');
        }
        if ($request->input('tipo')) {
            $datosTiendaChein->tipo=$request->input('tipo');
        }
        if ($request->input('color')) {
            $datosTiendaChein->color=$request->input('color');
        }
        if ($request->input('tallas')) {
            $datosTiendaChein->tallas=$request->input('tallas');
        }
        if ($request->input('precio')) {
            $datosTiendaChein->precio=$request->input('precio');
        }

        $datosTiendaChein->save();
        return response()->json("Datos Actualizados");
    }
    
}