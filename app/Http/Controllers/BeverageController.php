<?php

namespace App\Http\Controllers;

use App\Models\Beverage;
use App\Models\BeverageType;
use App\Models\Ice;
use App\Models\Sugar;
use App\Models\Topping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $beverages = DB::table('beverages');
        if(\request()->has('search') && \request()->get('search') != ''){
            $beverages = $beverages->where('name', '=', \request()->get('search'));
        }
        $beverages = $beverages->paginate(15);
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
        return view('beverages/create', ['types' => $types]);
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
            'description' => 'required|string|min:10|max:255',
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
            'description' => $request->description,
            'image' => $path,
            'custom_topping' => $topping,
            'custom_ice' => $ice,
            'custom_sugar' => $sugar,
        ]);

       return redirect()->back()->with('success', 'Successfully create beverage');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Beverage  $beverage
     * @return \Illuminate\Http\Response
     */
    public function show(Beverage $beverage)
    {
        $ices = Ice::all();
        $sugars = Sugar::all();
        $toppings = Topping::all();
        return view('beverages/detail', ['beverage' => $beverage, 'ices' => $ices, 'sugars' =>$sugars, 'toppings'=> $toppings]);
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
