<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\professors;
use \App\University;
use \App\Course;

class ProfessorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function search(Request $request){

        $searchTerm = $request->input('query');

        $professors = professors::query()
        ->where('f_name', 'LIKE', "%{$searchTerm}%")
        ->orwhere('l_name','LIKE', "%{$searchTerm}%")->get();
          $data = [
            'professors' => $professors,
            'searchTerm' => $searchTerm,
        ]; 
        return view('professors.list')->with($data);

    }


    public function list(){

    }
    public function index()
    {
        //
       $professors = professors::all();
       return view('professors.list')->with('professors', $professors);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       $professors = professors::all();
       $universities = University::all();
       $courses = Course::all();
      $data = [
            'professors' => $professors,
            'universities' => $universities,
            'courses' => $courses,
        ]; 
       return view('professors.add')->with($data);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'f_name' => 'required',
            'l_name' => 'required',
            'titles' => 'required',
            'university' => 'required',
             'g-recaptcha-response' => 'required|recaptcha',
        ]);
        // Create Professor
        $professor = new professors;
        $professor->titles = $request->input('titles');
        $professor->f_name = $request->input('f_name');
        $professor->l_name = $request->input('l_name');
        $professor->university_id = $request->input('university');
        $professor->save();
        return redirect('/professors')->with('success', 'Professor added');
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
        $professor = professors::where('id', $id)->get();
        $data = [
            'professor' => $professor,
        ];
        return view(professors.show)-with($data);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
