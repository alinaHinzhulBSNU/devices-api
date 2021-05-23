<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Country::with('cities')->get();
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
        return Country::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Country::with('cities')->where('id', $id)->get();
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
        return Country::find($id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Country::destroy($id);
    }

    /**
     * Search for a country
     *
     * @param  int  $country_name
     * @return \Illuminate\Http\Response
     */
    public function search($country_name)
    {
        return Country::with('cities')->where('country_name', 'like', '%'.$country_name.'%')->get();
    }

    /**
     * Validate new data
     * 
     * @param  mixed  $data
     * @return mixed
     */
    private function validateNewData($data){ 
        return $this->validate($data, [
            'country_name' => ['required', 'unique:countries'],
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
            'country_name' => ['required'],
        ]);
    }
}
