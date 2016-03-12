<?php

namespace App\Http\Controllers;
use View;
use App\Classes;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SearchController extends Controller
{
    public function index()
    {
        return view('search');
    }

    public function autoComplete( Request $request)
    {
        $term = $request->input('term');

        $results = array();

        $queries = Classes::where('class_name', 'LIKE', '%' . $term . '%')->orWhere('class_code', 'LIKE', '%' . $term . '%')->take(10)->get();

        foreach( $queries as $query ) {
            $results[] = [ 'id' => $query->class_id, 'value' => $query->class_name ];
        }
        return response()->json($results);
    }

    public function result( Request $request ) {
        $input = $request->all();
        $class = $input['auto'];
        $year = $input['select-year'];
        $semester = $input['select-semester'];
        $result = Classes::where('class_name', 'LIKE', '%' . $class . '%')
            ->orWhere('class_code', 'LIKE', '%' . $class . '%')
            ->where('semester_id', 'LIKE', '%' . $semester . '%')
            ->where('year_id', 'LIKE', '%' . $year . '%')->get();
        return View::make('search')->with('result', $result);
    }
}
