<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return City::all();
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
        return City::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return City::find($id);
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
        return City::find($id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return City::destroy($id);
    }

    /**
     * Search for a city
     *
     * @param  int  $city_name
     * @return \Illuminate\Http\Response
     */
    public function search($city_name)
    {
        return City::where('city_name', 'like', '%'.$city_name.'%')->get();
    }

    /**
     * Validate new data
     * 
     * @param  mixed  $data
     * @return mixed
     */
    private function validateNewData($data){ 
        return $this->validate($data, [
            'city_name' => ['required', 'unique:cities'],
            'country_id' => ['required', 'exists:countries,id']
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
            'city_name' => ['required'],
            'country_id' => ['required', 'exists:countries,id']
        ]);
    }
}
