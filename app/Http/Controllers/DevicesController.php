<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DevicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Device::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validateData($request);
        return Device::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Device::find($id);
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
        $data = $this->validateData($request);
        return Device::find($id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Device::destroy($id);
    }

    /**
     * Search for a device (by max price)
     *
     * @param  int  $max_price
     * @return \Illuminate\Http\Response
     */
    public function search($max_price)
    {
        return Device::where('price', '<=', $max_price)->get();
    }

    /**
     * Validate data
     * 
     * @param  mixed  $data
     * @return mixed
     */
    private function validateData($data){ 
        return $this->validate($data, [
            'model_id' => ['required', 'exists:models,id'],
            'total_quantity' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'discount' => ['required', 'numeric'],
            'ram' => ['required', 'numeric'],
            'rom' => ['required', 'numeric'],
            'color' => ['required'],
            'image' => ['required'],
        ]);
    }
}
