<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Students;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return Students::where('status',1)->latest()->paginate(5);
        //return Students::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'classRoom' => 'required|string|max:2',
            'teachersName' => 'required|string|max:50',
            'studentFirstName' => 'required|string|max:255',
            'studentLastName' => 'required|string|max:255',
            'gender' => 'required|string|max:2',
            'joinedYear' => 'required|numeric'
        ]);
         return Students::create([
             'class_room' => $request->classRoom,
             'teachers_name' => $request->teachersName,
             'student_firstname' => $request->studentFirstName,
             'student_lastname' => $request->studentLastName,
             'gender' => $request->gender,
             'status' => 1,
             'joined_year' => $request->joinedYear

         ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'classRoom' => 'required|string|max:2',
            'teachersName' => 'required|string|max:50',
            'studentFirstName' => 'required|string|max:255',
            'studentLastName' => 'required|string|max:255',
            'gender' => 'required|string|max:2',
            'joinedYear' => 'required|numeric'
        ]);

        $student = Students::find($id);
        $student->class_room = $request->classRoom;
        $student->teachers_name = $request->teachersName;
        $student->student_firstname = $request->studentFirstName;
        $student->student_lastname = $request->studentLastName;
        $student->gender = $request->gender;
        $student->status = 1;
        $student->joined_year = $request->joinedYear;
        $student->save();

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Students::find($id);

        $student->status = 0;

        $student->save();
    }
}
