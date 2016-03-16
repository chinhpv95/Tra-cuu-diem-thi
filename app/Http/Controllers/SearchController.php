<?php

namespace App\Http\Controllers;

use View;
use App\Classes;
use App\Year;
use App\Semester;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SearchController extends Controller
{
    public function index()
    {
        return view('search');
    }

    public function autoComplete(Request $request)
    {
        $term = $request->input('term');
        $results = array();
        $queries = Classes::distinct()->select('class_name')->where([['class_name', 'LIKE', '%' . $term . '%']])
            ->orWhere([['class_code', 'LIKE', '%' . $term . '%']])
            ->take(10)->get();
        $index = 0;
        foreach ($queries as $query) {
            $results[] = ['id' => $index, 'value' => $query->class_name];
            $index++;
        }
        return response()->json($results);
    }

    public function result(Request $request)
    {
        $input = $request->all();
        $class = $input['auto'];
        if ('0' == $input['select-year'] && '0' == $input['select-semester']) {
            $year_id = Year::where('active', 1)->get()->first();
            $semester_id = Semester::where('active', 1)->get()->first();
            $result = Classes::where([['class_name', 'LIKE', '%' . $class . '%'], ['semester_id', '=', $semester_id->semester_id], ['year_id', '=', $year_id->year_id]])
                ->orWhere([['class_code', 'LIKE', '%' . $class . '%'], ['semester_id', '=', $semester_id->semester_id], ['year_id', '=', $year_id->year_id]])
                ->orderBy('class_name', 'asc')->get();
        } else {
            $year_id = $input['select-year'];
            $semester_id = $input['select-semester'];
            if( $year_id == '0' ) {
                $result = Classes::where([['class_name', 'LIKE', '%' . $class . '%'], ['semester_id', '=', $semester_id]])
                    ->orWhere([['class_code', 'LIKE', '%' . $class . '%'], ['semester_id', '=', $semester_id]])
                    ->orderBy('class_name', 'asc')->get();
            } elseif($semester_id == '0' ) {
                $result = Classes::where([['class_name', 'LIKE', '%' . $class . '%'], ['year_id', '=', $year_id]])
                    ->orWhere([['class_code', 'LIKE', '%' . $class . '%'], ['year_id', '=', $year_id]])
                    ->orderBy('class_name', 'asc')->get();
            } else {
                $result = Classes::where([['class_name', 'LIKE', '%' . $class . '%'], ['semester_id', '=', $semester_id], ['year_id', '=', $year_id]])
                    ->orWhere([['class_code', 'LIKE', '%' . $class . '%'], ['semester_id', '=', $semester_id], ['year_id', '=', $year_id]])
                    ->orderBy('class_name', 'asc')->get();
            }
        }
        return View::make('search')->with('result', $result);
    }
}
