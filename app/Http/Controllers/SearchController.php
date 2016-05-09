<?php

namespace App\Http\Controllers;

use View;
use App\Classes;
use App\Year;
use App\Semester;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Storage;
use Carbon\Carbon;
use Auth;

class SearchController extends Controller {
	public function index() {
		$years     = Year::select( 'year_id', 'year_name' )->get();
		$semesters = Semester::select( 'semester_id', 'semester_name' )->get();
		
		return view( 'search', compact( 'years', 'semesters' ) );
	}

	public function autoComplete( Request $request ) {
		$term     = $request->input( 'term' );
		$results  = array();
		$parts    = explode( ' ', $term );
		$p        = count( $parts );
		$sql_name = 'class_name LIKE "%' . $parts[0] . '%"';
		$sql_code = 'class_code LIKE "%' . $parts[0] . '%"';
		for ( $i = 1; $i < $p; $i ++ ) {
			$sql_name .= ' and class_name LIKE "%' . $parts[ $i ] . '%"';
			$sql_code .= ' and class_code LIKE "%' . $parts[ $i ] . '%"';
		}
		$queries = Classes::distinct()->select( 'class_name' )->whereRaw( $sql_name )
		                  ->orWhereRaw( $sql_code )
		                  ->take( 10 )->get();
		$index   = 0;
		foreach ( $queries as $query ) {
			$results[] = [ 'id' => $index, 'value' => $query->class_name ];
			$index ++;
		}

		return response()->json( $results );
	}

	public function result( Request $request ) {
		$input    = $request->all();
		$class    = $input['auto'];
		$parts    = explode( ' ', $class );
		$p        = count( $parts );
		$sql_name = 'class_name LIKE "%' . $parts[0] . '%"';
		$sql_code = 'class_code LIKE "%' . $parts[0] . '%"';
		for ( $i = 1; $i < $p; $i ++ ) {
			$sql_name .= ' and class_name LIKE "%' . $parts[ $i ] . '%"';
			$sql_code .= ' and class_code LIKE "%' . $parts[ $i ] . '%"';
		}
		$years     = Year::select( 'year_id', 'year_name' )->get();
		$semesters = Semester::select( 'semester_id', 'semester_name' )->get();
		if ( '0' == $input['select-year'] && '0' == $input['select-semester'] ) {
			$year_id     = Year::where( 'active', 1 )->get()->first();
			$semester_id = Semester::where( 'active', 1 )->get()->first();
			$sql_name .= ' and semester_id = ' . $semester_id['semester_id'] . ' and year_id = ' . $year_id['year_id'];
			$sql_code .= ' and semester_id = ' . $semester_id['semester_id'] . ' and year_id = ' . $year_id['year_id'];
			$result = Classes::whereRaw( $sql_name )
			                 ->orWhereRaw( $sql_code )
			                 ->orderBy( 'class_name', 'asc' )->paginate( 15 );
		} else {
			$year_id     = $input['select-year'];
			$semester_id = $input['select-semester'];
			if ( $year_id == '0' ) {
				$sql_name .= ' and semester_id = ' . $semester_id;
				$sql_code .= ' and semester_id = ' . $semester_id;
				$result = Classes::whereRaw( $sql_name )
				                 ->orWhereRaw( $sql_code )
				                 ->orderBy( 'class_name', 'asc' )->paginate( 15 );
			} elseif ( $semester_id == '0' ) {
				$sql_name .= ' and year_id = ' . $year_id;
				$sql_code .= ' and year_id = ' . $year_id;
				$result = Classes::whereRaw( $sql_name )
				                 ->orWhereRaw( $sql_code )
				                 ->orderBy( 'class_name', 'asc' )->paginate( 15 );
			} else {
				$sql_name .= ' and semester_id = ' . $semester_id . ' and year_id = ' . $year_id;
				$sql_code .= ' and semester_id = ' . $semester_id . ' and year_id = ' . $year_id;
				$result = Classes::whereRaw( $sql_name )
				                 ->orWhereRaw( $sql_code )
				                 ->orderBy( 'class_name', 'asc' )->paginate( 15 );
			}
		}

		return view( 'search', compact( 'result', 'input', 'years', 'semesters' ) );
	}
}
