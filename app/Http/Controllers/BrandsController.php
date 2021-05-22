<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Brand::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validateNewData($request);
        return Brand::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Brand::find($id);
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
        $data = $this->validateEditedData($request);
        return Brand::find($id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Brand::destroy($id);
    }

    /**
     * Search for a brand
     *
     * @param  int  $brand_name
     * @return \Illuminate\Http\Response
     */
    public function search($brand_name)
    {
        return Brand::where('brand_name', 'like', '%'.$brand_name.'%')->get();
    }

    /**
     * Validate new data
     * 
     * @param  mixed  $data
     * @return mixed
     */
    private function validateNewData($data){ 
        return $this->validate($data, [
            'brand_name' => ['required', 'unique:brands'],
        ]);
    }

    /**
     * Validate edited data
     * 
     * @param  mixed  $data
     * @return mixed
     */
    private function validateEditedData($data){ 
        return $this->validate($data, [
            'brand_name' => ['required'],
        ]);
    }
}
