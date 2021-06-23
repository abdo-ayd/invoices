<?php

namespace App\Http\Controllers;

use App\sections;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class SectionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:الاقسام',['only'=>['index']]);
        $this->middleware('permission:اضافة قسم',['only'=>['create','store']]);
        $this->middleware('permission:تعديل قسم',['only'=>['edit','update']]);
        $this->middleware('permission:حذف قسم',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = sections::all();
        return view('sections.sections',compact('sections'));
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
        $validate = $request->validate([

            'section_name'=>'required|unique:sections',
            'description'=>'required'


        ],[
            'section_name.required'=>'يرجى ادخال اسم القسم',
            'section_name.unique'=>'اسم القسم مسجل مسبقا',
            'description.required'=>'يرجى ادخال البيان'

        ]);


            sections::create([
                'section_name'=>$request->section_name,
                'description'=>$request->description,
                'created_by'=> (Auth::user()->name)

            ]);
            session()->flash('Add','تم اضافة القسم بنجاح');
            return redirect('/sections');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,sections $sections)
    {
        $id = $request->id;
        $sections = sections::find($id);


        $validate = $request->validate([

            'section_name'=>'required|unique:sections,section_name,'.$id,
            'description'=>'required'


        ],[
            'section_name.required'=>'يرجى ادخال اسم القسم',
            'section_name.unique'=>'اسم القسم مسجل مسبقا',
            'description.required'=>'يرجى ادخال البيان'

        ]);


        $sections->update([
            'section_name'=>$request->section_name,
            'description'=>$request->description,


        ]);
            session()->flash('edit','تم تعديل القسم بنجاح');
            return redirect('/sections');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $sections = sections::find($id)->delete();

        session()->flash('delete','تم حذف القسم بنجاح');
            return redirect('/sections');
    }
}
