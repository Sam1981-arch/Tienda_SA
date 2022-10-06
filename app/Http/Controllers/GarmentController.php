<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Garment;

class GarmentController extends Controller
{

	public function index()
    {
        $garments = Garment::orderby('id', 'desc')->get();

        return response()->json($garments);
    }

    public function store(Request $request)
    {

        $garment = Garment::create($request->all());

        return response()->json([
            'status' => 'success',
            'garment'   => $garment
        ]);
    }

    public function show($id)
    {
        $garment = Garment::find($id);

        return response()->json($garment);
    }

    public function update(Request $request, $id)
    {
        $garment = Garment::find($id);
        $garment->update($request->all());

        return response()->json([
            'status' => 'success',
            'post'   => $garment
        ]);
    }

    public function destroy($id)
     {
         $garment = Garment::find($id);
         $garment->delete();

         return response()->json('La prenda a sido eliminado con exito!');
     }
	
}
