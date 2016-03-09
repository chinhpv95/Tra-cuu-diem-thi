<?php

namespace App\Http\Controllers;
use Auth;
use App\Classes;
use App\User;
use Illuminate\Http\Request;
use Input;
use Excel;


class AdminController extends Controller
{
    public function index() {
    	if (Auth::check()){
    		return view('admin');
    	}
    }

    public function addUser(Request $request){
    	$data = $request->all();
    	$user = new User;
            $user['name'] = $data['username'];
            $user['email'] = $data['email'];
            $user['password'] = bcrypt($data['password']);
            $user['isAdmin'] = $data['role'];
           
         	$user->save();
        return redirect()->route('admin');

    }

    public function addExcel($classes){
    		$class = new Classes();
       		$class['class_code']=$classes['class_code'];
       		$class['class_name']=$classes['class_name'];
       		$class['year_id']='1';
       		$class['semester_id']='1';
       		$user = User::where('name', '=', $classes['teacher'])->get()->first();     
       		$class['user_id'] = $user->id;  
       		$class->save();
}

	public function getExcel(Request $request){	
    $file = $request['xls'];
    Excel::load($file, function($reader) {
    	$results = $reader->get();
    	
        $total_sheets=$reader->getSheetCount();
        $allSheetName=$reader->getSheetNames();
        $objWorksheet  = $reader->setActiveSheetIndex(0);
        $highestRow    = $objWorksheet->getHighestRow();
        $highestColumn = $objWorksheet->getHighestColumn();
        $arraydata = array();
        for ($row = 2; $row <= $highestRow;++$row){
        	$classes = array();
            $classes['class_code']=$objWorksheet->getCellByColumnAndRow(0, $row)->getValue();
            $classes['class_name']=$objWorksheet->getCellByColumnAndRow(1, $row)->getValue();
            $classes['teacher']=$objWorksheet->getCellByColumnAndRow(2, $row)->getValue();
            $this->addExcel($classes);
         }


    });	    
    }
}
