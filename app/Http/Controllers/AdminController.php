<?php

namespace App\Http\Controllers;

use Auth;
use App\Classes;
use App\Year;
use App\Semester;
use App\User;
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


class AdminController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('admin');
        }
    }

    //Them user moi
    public function addUser(Request $request)
    {
        $this->validate($request, [
        'email' => 'required|unique:users',
    ]);
        $data = $request->all();
        $user = new User;
        $user['name'] = $data['username'];
        $user['email'] = $data['email'];
        $user['password'] = bcrypt($data['password']);
        $user['role'] = $data['role'];
        $user->save();
        return Redirect::to(URL::previous() . "#manager");
    }

    //Tao class moi
    public function addClass($classes)
    {
        $class = new Classes();
        $class['class_code'] = $classes['class_code'];
        $class['class_name'] = $classes['class_name'];
        $class['teacher'] = $classes['teacher'];

        $class['year_id'] = $classes['year_id'];
        $class['semester_id'] = $classes['semester_id'];

        $class->save();
        return Redirect::to(URL::previous() . "#home");
    }

    //Doc du lieu tu excel
    public function getExcel(Request $request)
    {
        $data = $request->all();
        $file = Input::file('xls');
        $extension = $file->getClientOriginalExtension();
        if($extension != 'xls' and $extension != 'xlsx') {
            Session::flash('flash_message', 'File invalid!');
            return redirect()->route('admin');
        }
        Excel::load($file, function ($reader) use ($data) {
            $results = $reader->get();

            $total_sheets = $reader->getSheetCount();
            $allSheetName = $reader->getSheetNames();
            $objWorksheet = $reader->setActiveSheetIndex(0);
            $highestRow = $objWorksheet->getHighestRow();
            $highestColumn = $objWorksheet->getHighestColumn();
            $classes = array();
            $classes['year_id'] = $data['select-year-excel'];
            $classes['semester_id'] = $data['select-semester-excel'];
            for ($row = 2; $row <= $highestRow; ++$row) {
                $classes['class_code'] = $objWorksheet->getCellByColumnAndRow(0, $row)->getValue();
                $classes['class_name'] = $objWorksheet->getCellByColumnAndRow(1, $row)->getValue();
                $classes['teacher'] = $objWorksheet->getCellByColumnAndRow(2, $row)->getValue();
                $this->addClass($classes);
            }

            
        });
        Session::flash('flash_message', 'File uploaded!');
        return redirect()->route('admin');
    }

    //Lay du lieu 1 class tu form
    public function getClass(Request $request)
    {
        $messages = [
        'class-code-input.required' => 'Bắt buộc nhập Mã môn học!', 
        'class-name-input.required' => 'Bắt buộc nhập Tên môn học!', 
        'teacher-input.required' => 'Bắt buộc nhập tên Giáo viên!',
        'class-code-input.unique:classes' => 'Bắt buộc nhập Mã môn học!', 

    ];
        
        $data = $request->all();
        $classes = array();
        $classes['year_id'] = $data['select-year'];
        $classes['semester_id'] = $data['select-semester'];
        $classes['class_code'] = $data['class-code-input'];
        $classes['class_name'] = $data['class-name-input'];
        $classes['teacher'] = $data['teacher-input'];

        $this->validate($request, [
        'class-code-input' => 'required',
        'class-name-input' => 'required',
        'teacher-input' => 'required',

        ], $messages);

        $this->addClass($classes);
        return redirect()->route('admin');
    }

    public function upLoad($class_id)
    {
        $file = Input::file('link');
        //var_dump($file);

        $filename = $file->getClientOriginalName();
        $destinationPath = base_path() . "\public\storage\\";
        $file->move($destinationPath, $filename);


        $class = Classes::find($class_id);
        if($class->link != NUll){
            Storage::delete($class->link);
        }
        $class->link = $filename;
        $class->save();


        Session::flash('flash_message', 'File uploaded!');

        return Redirect::to(URL::previous() . "#class");
    }

    public function download($class_id)
    {
        $class = Classes::find($class_id);
        $destinationPath = base_path() . "\public\storage\\";
        return Response::download($destinationPath . $class->link);
    }

    public function delete( Request $request )
    {
        $user_id = Input::get('id');
        User::where('id', $user_id)->delete();
    }

    public function profile($user_id)
    {
        $data = Auth::user()->where('id', '=', $user_id)->get()->first();
        return View::make('profile')->with('data', $data);
    }

    public function updateName(Request $request, $user_id)
    {
        $data = $request->all();
        Auth::user()->where('id', '=', $user_id)->update(['name' => $data['username']]);
        Session::flash('update_message', 'Update successfully!');
        return redirect()->back();
    }
    public function updateEmail(Request $request, $user_id)
    {
        $data = $request->all();
        Auth::user()->where('id', '=', $user_id)->update(['email' => $data['email']]);
        Session::flash('update_message', 'Update successfully!');
        return redirect()->back();
    }
    public function updatePassword(Request $request, $user_id)
    {
        $data = $request->all();
        $password = bcrypt($data['password']);
        Auth::user()->where('id', '=', $user_id)->update(['password' => $password]);
        Session::flash('update_message', 'Update successfully!');
        return redirect()->back();
    }
}
