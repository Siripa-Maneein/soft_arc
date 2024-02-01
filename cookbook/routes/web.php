<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get("userform", function()
{
    return View::make('userform');
});

Route::post('userform', function (Request $request) {
    return redirect('userresults')
        ->withInput($request->only('username', 'color'))
        ->withErrors(['errors' => 'Validation errors here']);
});

Route::post('userform', function(Request $request)
{
    $rules = array(
        'email' => 'required|email|different:username',
        'username' => 'required|min:6',
        'password' => 'required|same:password_confirm'
    );
    $validation = Validator::make($request->all(), $rules);
    if ($validation->fails())
    {
        return Redirect::to('userform')->withErrors($validation)->withInput();
    }
    return Redirect::to('userresults')->withInput();
});

Route::get('userresults', function()
{
    return dd(old());
});

Route::get('fileform', function()
{
    return View::make('fileform');
});


Route::post('fileform', function(Request $request)
   {
       $rules = array(
           'myfile' => 'mimes:doc,docx,pdf,txt|max:1000'
    );
    $validation = Validator::make($request->all(), $rules);
           if ($validation->fails())
           {
       return Redirect::to('fileform')->withErrors($validation)
           ->withInput();
           }
           else
           {
               $file = $request->file('myfile');
               if ($file->move('files', $file
                   ->getClientOriginalName()))
               {
                   return "Success";
               }
else {
                   return "Error";
               }
} });

Route::get('myform', function()
{
    return View::make('myform');
});

Route::post('myform', array('before' => 'csrf', function(Request $request)
    {
    $rules = array(
        'email'    => 'required|email',
        'password' => 'required',
        'no_email' => 'honey_pot'
    );
    $messages = array(
        'honey_pot' => 'Nothing should be in this field.'
    );
    $validation = Validator::make($request->all(), $rules,
        $messages);
    if ($validation->fails())
    {
        return Redirect::to('myform')->withErrors
            ($validation)->withInput();
    }
    return Redirect::to('myresults')->withInput();
}));



Validator::extend('honey_pot', function($attribute, $value,
          $parameters)
      {
          return $value == '';
});

Route::get('myresults', function()
{
    return dd(old());
});

// Route::get('redactor', function()
//        {
//            return View::make('redactor');
//        });

// Route::post('redactorupload', function()
// {
//     $rules = array(
//         'file' => 'image|max:10000'

//     );
//        $validation = Validator::make(Input::all(), $rules);
//        $file = Input::file('file');
//        if ($validation->fails())
//        {
//            return FALSE;
//        }
//        else {
//            if ($file->move('files', $file->
//                getClientOriginalName()))
//            {
//                return Response::json(array('filelink' =>
//                   'files/' . $file->getClientOriginalName()));
//        } else {
//                    return FALSE;
//                }
//        } });

// Route::post('redactor', function()
// {
//     return dd(Input::all());
// });

Route::get('autocomplete', function () {
    return view('autocomplete');
});

Route::get('getdata', function (Request $request) {
    $term = \Illuminate\Support\Str::lower($request->get('term'));
    $data = [
        'R' => 'Red',
        'O' => 'Orange',
        'Y' => 'Yellow',
        'G' => 'Green',
        'B' => 'Blue',
        'I' => 'Indigo',
        'V' => 'Violet',
    ];

    $return_array = [];
    foreach ($data as $k => $v) {
        if (strpos(\Illuminate\Support\Str::lower($v), $term) !== false) {
            $return_array[] = ['value' => $v, 'id' => $k];
        }
    }
    return response()->json($return_array);
});