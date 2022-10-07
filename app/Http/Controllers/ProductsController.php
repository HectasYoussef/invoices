<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections=sections::all();
        $products=products::all();
        return view("products.products",compact('sections','products'));
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

        $validated = $request->validate([
            'Product_name' => 'required|unique:products|max:255',
            'description' => 'required',
        ],[
            'Product_name.required'=>'entrer le nom de section ',
            'Product_name.unique'=>'le nom de section et deja utuliser',
            'description'=>'entrer le description'
         ]);




            products::create(
                [

                    'Product_name'=>$request->Product_name,
                    'section_id'=>$request->section_id,
                    'description'=>$request->description,
                ]
                );
                session()->flash('Add',"ajout avec succes");
                return redirect("/products");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, products $products)
    {

        $validated = $request->validate([
            'Product_name' => 'required|max:255',
            'description' => 'required',
        ],[
            'Product_name.required'=>'entrer le nom de section ',
            'description'=>'entrer le description'
         ]);


    $id = sections::where('section_name',$request->section_name)->first()->id;
    $product = products::findorFail($request->pro_id);

            $product->update(
                [

                    'Product_name'=>$request->Product_name,
                    'description'=>$request->description,
                    'section_id'=>$id,

                ]
                );
                session()->flash('Edit',"ajout avec succes");
                return redirect("/products");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $Products = Products::findOrFail($request->pro_id);
        $Products->delete();
        session()->flash('delete', 'تم حذف المنتج بنجاح');
        return back();
    }

   




}
