<?php

namespace App\Http\Controllers;
use Auth;
use App\Classes;
use App\Year;
use App\Semester;
use App\User;
use Illuminate\Http\Request;
use Excel;
use Illuminate\Support\Facades\Input;
use Response;
use Session;


class AdminController extends Controller
{
    public function index() {
    	if (Auth::check()){
    		return view('admin');
    	}
    }

    //Them user moi
    public function addUser(Request $request){
    	$data = $request->all();
    	$user = new User;
            $user['name'] = $data['username'];
            $user['email'] = $data['email'];
            $user['password'] = bcrypt($data['password']);
            $user['role'] = $data['role'];
           
         	$user->save();
        return redirect()->route('admin');

    }

    //Tao class moi
    public function addClass($classes){
    		$class = new Classes();
       		$class['class_code']=$classes['class_code'];
       		$class['class_name']=$classes['class_name'];

       		//Tim id cua nam	
       		$year = Year::where('year_name', '=', $classes['year_name'])->get()->first();
       		$class['year_id'] = $year->year_id;
       		
       		//Tim Id cua hoc ky
       		$semester = Semester::where('semester_name', '=', $classes['semester_name'])->get()->first();
       		$class['semester_id']= $semester->semester_id;

       		//Tim Id cua user
       		$user = User::where('name', '=', $classes['teacher'])->get()->first();     
       		$class['user_id'] = $user->id;

       		$class->save();
}

	//Doc du lieu tu excel
	public function getExcel(Request $request){	
    $data = $request->all();
    $file = $request['xls'];
    Excel::load($file, function($reader) use ($data) {
    	$results = $reader->get();
    	
        $total_sheets=$reader->getSheetCount();
        $allSheetName=$reader->getSheetNames();
        $objWorksheet  = $reader->setActiveSheetIndex(0);
        $highestRow    = $objWorksheet->getHighestRow();
        $highestColumn = $objWorksheet->getHighestColumn();
        $classes = array();
        $classes['year_name'] = $data['year-input-excel'];
    	$classes['semester_name'] = $data['semester-input-excel'];
        for ($row = 2; $row <= $highestRow;++$row){
            $classes['class_code']=$objWorksheet->getCellByColumnAndRow(0, $row)->getValue();
            $classes['class_name']=$objWorksheet->getCellByColumnAndRow(1, $row)->getValue();
            $classes['teacher']=$objWorksheet->getCellByColumnAndRow(2, $row)->getValue();
            $this->addClass($classes);
         }


    });	 

       return redirect()->route('admin');
    }

    //Lay du lieu 1 class tu form
    public function getClass(Request $request){
    	$data = $request->all();
    	$classes = array();
    		$classes['year_name'] = $data['year-input'];
    		$classes['semester_name'] = $data['semester-input'];
            $classes['class_code']= $data['class-code-input'];
            $classes['class_name']= $data['class-name-input'];
            $classes['teacher']= $data['teacher-input'];
            $this->addClass($classes);
    }

    public function upLoad($class_id){
      $file = Input::file('link');
      //var_dump($file);

      $filename = $file->getClientOriginalName();
      $destinationPath = base_path()."\public\\";
      $file->move($destinationPath, $filename);


      //$class = Classes::where('class_id', '=', $class_id)->get()->first();
      $class = Classes::find($class_id);
      $class->link = $destinationPath . $filename;
      $class->save();



      Session::flash('flash_message', 'File uploaded!');

        return  redirect()->back();
    }

    public function download($class_id){
      $class = Classes::find($class_id);
      return Response::download($class->link);
    }

    public function delete($user_id) {
        User::where('id', $user_id)->delete();
        Session::flash('delete_message', 'Delete successfully!');

        return  redirect()->back();
    }
}
