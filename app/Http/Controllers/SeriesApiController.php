<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesApiController extends Controller
{
    function index(Request $request)
    {
        $series = Serie::query()->orderBy('nome')->get();

        return response()->json($series);
    }

    function store(Request $request)
    {
        $serie = Serie::create($request->all());

        return response()->json($serie, 201);
    }

    function update($id, Request $request)
    {
        $serie = Serie::find($id);

        if ($serie) {
            $serie->fill($request->all());
            $serie->save();

            return response()->json($serie);
        }

        return response()->json(null, 400);
    }

    function destroy($id)
    {
        $serie = Serie::find($id);
        if ($serie) {
            $serie->delete();
            return response()->json($serie);
        }

        return response()->json(null, 400);
    }
}
