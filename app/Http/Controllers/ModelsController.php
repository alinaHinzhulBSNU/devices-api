<?php

namespace App\Http\Controllers;

use App\Models\Model;
use Illuminate\Http\Request;

class ModelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Model::all();
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
        return Model::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Model::find($id);
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
        return Model::find($id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Model::destroy($id);
    }

    /**
     * Search for a model
     *
     * @param  int  $model_name
     * @return \Illuminate\Http\Response
     */
    public function search($model_name)
    {
        return Model::where('model_name', 'like', '%'.$model_name.'%')->get();
    }

    /**
     * Validate new data
     * 
     * @param  mixed  $data
     * @return mixed
     */
    private function validateNewData($data){ 
        return $this->validate($data, [
            'model_name' => ['required', 'unique:models'],
            'brand_id' => ['required', 'exists:brands,id'],
            'description' => ['required'],
            'diagonal' => ['required', 'numeric']
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
            'model_name' => ['required'],
            'brand_id' => ['required', 'exists:brands,id'],
            'description' => ['required'],
            'diagonal' => ['required', 'numeric']
        ]);
    }
}
