<?php

namespace App\Http\Controllers;

use App\Models\Beverage;
use App\Models\BeverageType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeverageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beverages = Beverage::all();

        return view('home', ['beverages' => $beverages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = BeverageType::all();
        return view('manages/create', ['types' => $types]);
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
            'name' => 'required|string|min:5|max:20',
            'price' => 'required|numeric|min:5000',
            'stock' => 'required|numeric|min:1',
            'type' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $topping = ($request->has('topping')?  "true":"false");
        $ice = ($request->has('ice')?  "true":"false");
        $sugar = ($request->has('sugar')?  "true":"false");

        $path = "";
        if($request->hasFile('image')){
            $file = $request->file('image');
            $path = time().$file->getClientOriginalName();
            Storage::putFileAs('public/beverage', $file, $path);

        }

        $beverage = Beverage::create([
            'id' => Str::uuid(),
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'beverage_type_id' => $request->type,
            'image' => $path,
            'custom_topping' => $topping,
            'custom_ice' => $ice,
            'custom_sugar' => $sugar,
        ]);

       return redirect()->back()->with('success', 'Successfully uploaded');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Beverage  $beverage
     * @return \Illuminate\Http\Response
     */
    public function show(Beverage $beverage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Beverage  $beverage
     * @return \Illuminate\Http\Response
     */
    public function edit(Beverage $beverage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Beverage  $beverage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Beverage $beverage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Beverage  $beverage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Beverage $beverage)
    {
        //
    }
}
