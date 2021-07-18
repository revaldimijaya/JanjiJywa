<?php

namespace App\Http\Controllers;

use App\Models\Beverage;
use App\Models\Cart;
use App\Models\Ice;
use App\Models\Sugar;
use App\Models\Topping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpseclib3\Crypt\Hash;
use Symfony\Component\Console\Input\Input;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = DB::table('carts')
            ->select('carts.id', 'user_id', 'beverage_id', 'topping_id', 'ice_id', 'sugar_id', 'quantity', 'beverage_type_id', 'name', 'price', 'stock', 'image', 'description', 'custom_topping', 'custom_sugar')
            ->leftJoin('beverages', 'carts.beverage_id', '=','beverages.id')
            ->get();

        $grand_total = 0;
        foreach ($carts as $cart){

            if($cart->sugar_id != ""){
                $sugar = Sugar::where('id','=',$cart->sugar_id)->first();
                $cart->sugar_name = $sugar->name;
            }

            if($cart->ice_id != ""){
                $ice = Ice::where('id','=',$cart->ice_id)->first();
                $cart->ice_name = $ice->name;
            }
            $sub_total = $cart->price * $cart->quantity;
            if($cart->topping_id != ""){
                $split = explode("#", $cart->topping_id);
                $toppings = array();
                foreach($split as $s){
                    $t = new Topping();
                    $top = Topping::where('id','=',$s)->first();
                    $t->id = $top->id;
                    $t->name = $top->name;
                    $t->price = $top->price;
                    $sub_total += $t->price;
                    array_push($toppings, $t);
                }
                $cart->toppings = $toppings;
            }
            $cart->sub_total = $sub_total;

            $grand_total += $cart->sub_total;
        }
        $carts->grand_total = $grand_total;

        return view('carts.index', ['carts' => $carts]);
    }

    public function changeQuantity(Request $request, $id,$qty){
        DB::table('carts')
            ->where([['user_id', '=', Auth::id()], ['id', '=', $id]])
            ->update(['quantity' => $qty]);

        $carts = DB::table('carts')
            ->select('carts.id', 'user_id', 'beverage_id', 'topping_id', 'ice_id', 'sugar_id', 'quantity', 'beverage_type_id', 'name', 'price', 'stock', 'image', 'description', 'custom_topping', 'custom_sugar')
            ->leftJoin('beverages', 'carts.beverage_id', '=','beverages.id')
            ->get();
        $grand_total = 0;
        foreach ($carts as $cart){

            if($cart->sugar_id != ""){
                $sugar = Sugar::where('id','=',$cart->sugar_id)->first();
                $cart->sugar_name = $sugar->name;
            }

            if($cart->ice_id != ""){
                $ice = Ice::where('id','=',$cart->ice_id)->first();
                $cart->ice_name = $ice->name;
            }
            $sub_total = $cart->price * $cart->quantity;
            if($cart->topping_id != ""){
                $split = explode("#", $cart->topping_id);
                $toppings = array();
                foreach($split as $s){
                    $t = new Topping();
                    $top = Topping::where('id','=',$s)->first();
                    $t->id = $top->id;
                    $t->name = $top->name;
                    $t->price = $top->price;
                    $sub_total += $t->price;
                    array_push($toppings, $t);
                }
                $cart->toppings = $toppings;
            }
            $cart->sub_total = $sub_total;

            $grand_total += $cart->sub_total;
        }
        $carts->grand_total = $grand_total;


        return view('carts.index', ['carts' => $carts]);
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
//        dd($request->all());
        $beverage = Beverage::where('id', $request->beverage)->first();
        if($beverage->custom_ice == "true"){
            $request->validate([
                'ice' => 'required'
            ]);
        }
        if($beverage->custom_sugar == "true"){
            $request->validate([
                'sugar' => 'required'
            ]);
        }
        if($beverage->custom_topping == "true"){
            $request->validate([
                'topping' => 'max:2'
            ]);
        }

        $request->validate([
            'quantity' => 'required|numeric|min:1|max:'.$beverage->stock,
        ]);
        $ice_id = "";
        if($request->has("ice")){
            $ice_id = $request->ice;
        }
        $sugar_id = "";
        if($request->has("sugar")){
            $sugar_id = $request->sugar;
        }

        $topping_id = "";
        if($request->has("topping")){
            foreach($request->topping as $key => $val){

                $split = explode("#", $val);
                $topping_id .= $split[1];
                if(count($request->topping)-1 != $key){
                    $topping_id .= "#";
                }
            }
        }

        $cart = new Cart();
        $cart->user_id = Auth::id();
        $cart->beverage_id = $request->beverage;
        $cart->topping_id = $topping_id;
        $cart->ice_id = $ice_id;
        $cart->sugar_id = $sugar_id;
        $cart->quantity = $request->quantity;

        $get_cart = Cart::where([
                ['user_id', '=', Auth::id()],
                ['beverage_id', '=', $request->beverage],
                ['topping_id', '=', $topping_id],
                ['ice_id', '=', $ice_id],
                ['sugar_id', '=', $sugar_id]
            ])->first();

        if(!empty($get_cart)){
            $get_cart->update([
                "quantity" => $request->quantity + $get_cart->quantity
            ]);
        } else {
            $cart->save();
        }
        return redirect()->back()->with('success', 'Successfully add to cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        $data = Input::all();
        dd($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $cart = Cart::where([['id', '=', $id], ['user_id', '=' , Auth::id()]])->first();
        if(!empty($cart)){
            Cart::where('id', '=', $id)->delete();
        } else {
            return back()->withErrors("Cart not found");
        }

        $carts = DB::table('carts')
            ->select('carts.id', 'user_id', 'beverage_id', 'topping_id', 'ice_id', 'sugar_id', 'quantity', 'beverage_type_id', 'name', 'price', 'stock', 'image', 'description', 'custom_topping', 'custom_sugar')
            ->leftJoin('beverages', 'carts.beverage_id', '=','beverages.id')
            ->get();
        $grand_total = 0;
        foreach ($carts as $cart){

            if($cart->sugar_id != ""){
                $sugar = Sugar::where('id','=',$cart->sugar_id)->first();
                $cart->sugar_name = $sugar->name;
            }

            if($cart->ice_id != ""){
                $ice = Ice::where('id','=',$cart->ice_id)->first();
                $cart->ice_name = $ice->name;
            }
            $sub_total = $cart->price * $cart->quantity;
            if($cart->topping_id != ""){
                $split = explode("#", $cart->topping_id);
                $toppings = array();
                foreach($split as $s){
                    $t = new Topping();
                    $top = Topping::where('id','=',$s)->first();
                    $t->id = $top->id;
                    $t->name = $top->name;
                    $t->price = $top->price;
                    $sub_total += $t->price;
                    array_push($toppings, $t);
                }
                $cart->toppings = $toppings;
            }
            $cart->sub_total = $sub_total;

            $grand_total += $cart->sub_total;
        }
        $carts->grand_total = $grand_total;


        return view('carts.index', ['carts' => $carts]);

    }
}
