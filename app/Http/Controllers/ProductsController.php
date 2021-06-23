<?php

namespace App\Http\Controllers;

use App\Products;
use App\sections;

use Illuminate\Http\Request;

class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:المنتجات', ['only'=>['index']]);
        $this->middleware('permission:اضافة منتج', ['only'=>['create','store']]);
        $this->middleware('permission:تعديل منتج' , ['only'=>['edit','update']]);
        $this->middleware('premission:حذف منتج' , ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = sections::all();
        $products = Products::all();



        return view('products.products',compact('sections','products'));
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
        $this->validate($request,[
            'product_name'=>'required',

            'section_id'=>'required'
        ],[
            'product_name.required'=>'يرجى ادخال اسم المنتج',

            'section_id.required'=>'يرجى ادخال اسم القسم'
        ]);
         Products::create([
            'product_name'=>$request->product_name,
            'description'=>$request->description,
            'section_id'=>$request->section_id
        ]);
        session()->flash('Add','تم اضافه منتج بنجاح');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $products)
    {
        $id = $request->id;

        $Products = Products::find($id);
        $sections =sections::all();
        $sections->id;

        $Products->update([
        'Product_name' => $request->Product_name,
        'description' => $request->description,
        'section_id' => $request->section_id,
        ]);
        session()->flash('edit','تم تعديل  المنتج بنجاح');
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $products = Products::find($id);
        $products->delete();
        session()->flash('delete','تم حذف المنتج بنجاح');
        return redirect()->back();
    }
}
