<?php

namespace App\Http\Controllers;

use Auth;
use App\Classes;
use App\Year;
use App\Semester;
use App\User;
use App\UserRole;
use Illuminate\Http\Request;
use Excel;
use View;
use Illuminate\Support\Facades\Input;
use Response;
use Session;
use File;
use Validator;
use Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Mail;


class AdminController extends Controller {
	public function index() {
		if ( Auth::check() ) {
			$years           = Year::select( 'year_id', 'year_name' )->get();
			$semesters       = Semester::select( 'semester_id', 'semester_name' )->get();
			$users           = User::get();
			$user_role       = User::find(Auth::user()->id)->roles()->get()->toArray();
			$latest_year     = Year::select( 'year_id' )->where( 'active', 1 )->get();
			$latest_semester = Semester::select( 'semester_id' )->where( 'active', 1 )->get();
			$latest_class    = Classes::where( [
				[ 'semester_id', $latest_semester[0]['semester_id'] ],
				[ 'year_id', $latest_year[0]['year_id'] ]
			] )->get();

			return view( 'admin', compact( 'years', 'semesters', 'users', 'user_role', 'latest_class' ) );
		}
	}

	//Them user moi
	public function addUser( Request $request ) {
		$this->validate( $request, [
			'email' => 'required|unique:users',
		] );
		$data             = $request->all();
		$user             = new User;
		$user['name']     = $data['username'];
		$user['email']    = $data['email'];
		$user['password'] = bcrypt( $data['password'] );
		if( isset($data['isAdmin']) ) {
			$user['is_admin'] = $data['isAdmin'];
		}
		$user->save();
		$user_id = $user['id'];
		foreach( $data['role'] as $item ) {
			UserRole::insert(['user_id' => $user_id, 'role_id' => $item]);
		}
		Session::flash( 'flash_message', 'Tạo thành công tài khoản ' . $user['name'] . ' !' );

		return Redirect::to( URL::previous() . "#manager" );
	}

	//Tao class moi
	public function addClass( $classes ) {
		$class               = new Classes();
		$class['class_code'] = $classes['class_code'];
		$class['class_name'] = $classes['class_name'];
		$class['teacher']    = $classes['teacher'];
		$class['email']    = $classes['email'];
		$class['year_id']     = $classes['year_id'];
		$class['semester_id'] = $classes['semester_id'];

		$class->save();
		Session::flash( 'flash_message', 'Lớp môn học đã được thêm thành công!' );

		return Redirect::to( URL::previous() . "#home" );
	}

	//Doc du lieu tu excel
	public function getExcel( Request $request ) {
		$data = $request->all();
		$file = Input::file( 'xls' );
		if ( $file == null ) {
			Session::flash( 'flash_message', 'File invalid!' );

			return redirect()->route( 'admin' );
		} else {
			$extension = $file->getClientOriginalExtension();
			if ( $extension != 'xls' and $extension != 'xlsx' ) {
				Session::flash( 'flash_message', 'File invalid!' );

				return redirect()->route( 'admin' );
			}
			Excel::load( $file, function ( $reader ) use ( $data ) {
				$results = $reader->get();

				$total_sheets           = $reader->getSheetCount();
				$allSheetName           = $reader->getSheetNames();
				$objWorksheet           = $reader->setActiveSheetIndex( 0 );
				$highestRow             = $objWorksheet->getHighestRow();
				$highestColumn          = $objWorksheet->getHighestColumn();
				$classes                = array();
				$classes['year_id']     = $data['select-year-excel'];
				$classes['semester_id'] = $data['select-semester-excel'];
				for ( $row = 2; $row <= $highestRow; ++ $row ) {
					$classes['class_code'] = $objWorksheet->getCellByColumnAndRow( 0, $row )->getValue();
					$classes['class_name'] = $objWorksheet->getCellByColumnAndRow( 1, $row )->getValue();
					$classes['teacher']    = $objWorksheet->getCellByColumnAndRow( 2, $row )->getValue();
					$classes['email']    = $objWorksheet->getCellByColumnAndRow( 3, $row )->getValue();
					$this->addClass( $classes );
				}
			}


			);
		}
		Session::flash( 'flash_message', 'File uploaded!' );

		return redirect()->route( 'admin' );
	}

	//Lay du lieu 1 class tu form
	public function getClass( Request $request ) {
		$messages = [
			'class-code-input.required'       => 'Bắt buộc nhập mã môn học!',
			'class-name-input.required'       => 'Bắt buộc nhập tên môn học!',
			'teacher-input.required'          => 'Bắt buộc nhập tên giáo viên!',
			'class-code-input.unique:classes' => 'Bắt buộc nhập mã môn học!',

		];

		$data                   = $request->all();
		$classes                = array();
		$classes['year_id']     = $data['select-year'];
		$classes['semester_id'] = $data['select-semester'];
		$classes['class_code']  = $data['class-code-input'];
		$classes['class_name']  = $data['class-name-input'];
		$classes['teacher']     = $data['teacher-input'];

		$this->validate( $request, [
			'class-code-input' => 'required',
			'class-name-input' => 'required',
			'teacher-input'    => 'required',

		], $messages );

		$this->addClass( $classes );

		return redirect()->route( 'admin' );
	}

	public function upLoad( $class_id ) {
		$file = Input::file( 'link' );

		$filename        = $file->getClientOriginalName();
		$destinationPath = base_path() . "\public\storage\\";
		$file->move( $destinationPath, $filename );

		$class = Classes::find( $class_id );
		if ( $class->link != null ) {
			Storage::delete( $class->link );
		}
		$class->link = $filename;
		$class->save();


		Session::flash( 'flash_message', 'File uploaded!' );

		return Redirect::to( URL::previous() . "#class" );
	}

	public function deleteFile( Request $request ) {
		$fileName = $request->get( 'fileName' );

		$destinationPath = base_path() . "\\public\\storage\\";

		unlink( $destinationPath . $fileName );
	}

	public function download( $class_id ) {
		$class           = Classes::find( $class_id );
		$destinationPath = base_path() . "\public\storage\\";

		return Response::download( $destinationPath . $class->link );
	}

	public function delete( Request $request ) {
		$user_id = Input::get( 'id' );
		User::where( 'id', $user_id )->delete();
	}

	public function delete_year( Request $request ) {
		$year_id = Input::get( 'id' );
		Year::where( 'year_id', $year_id )->delete();
	}

	public function updateYear( Request $request, $year_id ) {
		$data = $request->all();
		Year::where( 'year_id', $year_id )->update( [ 'year_name' => $data['year_name'] ] );

		return redirect()->back();
	}

	public function profile( $user_id ) {
		$data = Auth::user()->where( 'id', '=', $user_id )->get()->first();

		return View::make( 'profile' )->with( 'data', $data );
	}

	public function updateName( Request $request, $user_id ) {
		$data = $request->all();
		Auth::user()->where( 'id', '=', $user_id )->update( [ 'name' => $data['username'] ] );
		Session::flash( 'update_message', 'Update successfully!' );

		return redirect()->back();
	}

	public function updateEmail( Request $request, $user_id ) {
		$data = $request->all();
		Auth::user()->where( 'id', '=', $user_id )->update( [ 'email' => $data['email'] ] );
		Session::flash( 'update_message', 'Update successfully!' );

		return redirect()->back();
	}

	public function updatePassword( Request $request, $user_id ) {
		$data     = $request->all();
		$password = bcrypt( $data['password'] );
		Auth::user()->where( 'id', '=', $user_id )->update( [ 'password' => $password ] );
		Session::flash( 'update_message', 'Update successfully!' );

		return redirect()->back();
	}

	public function search_class() {
		$search = $_POST['keysearch'];
		$parts  = explode( ' ', $search );
		$p      = count( $parts );
		$sql    = 'class_name LIKE "%' . $parts[0] . '%"';
		for ( $i = 1; $i < $p; $i ++ ) {
			$sql .= ' and class_name LIKE "%' . $parts[ $i ] . '%"';
		}
		$latest_class = Classes::whereRAw( $sql )
		                       ->orWhereRaw( $sql )
		                       ->get();
		$html         = view( 'partials._filter', compact( 'latest_class' ) )->render();

		return response()->json( $html );
	}

	public function addYear() {
		$year        = Input::get( 'new_year' );
		$year_active = Input::get( 'year_active' );
		if ( $year_active ) {
			Year::where( 'active', '1' )->update( [ 'active' => '0' ] );
			Year::insert( [ 'year_name' => $year, 'active' => '1' ] );
		} else {
			Year::insert( [ 'year_name' => $year ] );
		}
		Session::flash( 'add_message', 'Add year successfully!' );

		return redirect()->back();
	}

	public function filter_class() {
		$latest_year     = Input::get( 'filter_year' );
		$latest_semester = Input::get( 'filter_semester' );
		if ( $latest_year != '0' && $latest_year != '0' ) {
			$latest_class = Classes::where( [
				[ 'semester_id', $latest_semester ],
				[ 'year_id', $latest_year ]
			] )->get();
		}
		if ( $latest_year == '0' && $latest_semester == '0' ) {
			$latest_class = '';
		}
		if ( $latest_year != '0' && $latest_semester == '0' ) {
			$latest_class = Classes::where( 'year_id', $latest_year )->get();
		}
		if ( $latest_year == '0' && $latest_semester != '0' ) {
			$latest_class = Classes::where( 'semester_id', $latest_semester )->get();
		}

		$html = view( 'partials._filter', compact( 'latest_class' ) )->render();

		return response()->json( $html );
	}

	public function multi_delete() {
		$get_data = Input::all();
		$id_array = $get_data['id_array'];
		Year::destroy( $id_array );

		Session::flash('multi_delete', 'Delete Successfully');

		return redirect()->back();
	}

	public function sendEmail() {
		$class_id = Input::get( 'id' );
		$classes  = Classes::select( 'email', 'class_code' )->where( 'class_id', $class_id )->get();
		foreach ( $classes as $class ) {
			$data = array( 'email' => $class['email'], 'class_code' => $class['class_code'] );
			Mail::raw( 'Phòng Đào Tạo xin thông báo: Giảng Viên nhanh chóng nộp điểm tổng kết lớp môn học ' . $data['class_code'] . ' về PĐT', function ( $arg ) use ( $data ) {
				$arg->from( 'daitd58@gmail.com', 'Quan Ly' );
				$arg->to( $data['email'], 'Nguyen Manh Hung2' )->subject( '[Thông báo]Về việc nộp bảng điểm tổng kết' );

			} );
		}
	}

	public function updateAvatar( $user_id ) {
		$file            = Input::file( 'image_name' );
		$file_name       = $file->getClientOriginalName();
		$destinationPath = base_path() . "\public\storage\\images";
		$file->move( $destinationPath, $file_name );

		User::where( 'id', $user_id )->update( [ 'image' => $file_name ] );

		return redirect()->back();
	}

	public function manytomany() {
		$data = User::find( 2 )->roles()->get()->toArray();
		echo '<pre>';
		print_r( $data );
		echo '</pre>';
	}
}
