<?php

namespace App\Http\Controllers;

use App\Helpers\CarbonHelper;
use App\Models\Cart;
use App\Models\DetailTransaction;
use App\Models\HeaderTransaction;
use App\Models\Ice;
use App\Models\Sugar;
use App\Models\Topping;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headers = DB::table('header_transactions')
            ->select(DB::raw('date, detail_transactions.transaction_id, SUM(quantity) AS total_beverages, SUM(price * quantity) AS total_price'))
            ->join('detail_transactions', 'detail_transactions.transaction_id', '=', 'header_transactions.id')
            ->join('beverages', 'beverages.id', '=', 'detail_transactions.beverage_id')
            ->groupBy('detail_transactions.transaction_id', 'date')
            ->where('user_id', '=', Auth::id())->get();
        foreach ($headers as $header){
            $header->date = Carbon::parse($header->date)->toDayDateTimeString();
        }
        return view('histories.index', ['headers' => $headers]);
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
        $data = $request->all();
        $carts = DB::table('carts')
            ->join('beverages', 'carts.beverage_id', '=', 'beverages.id')
            ->select(DB::raw('SUM(carts.quantity) AS sum_quantity, beverage_id, stock, name'))
            ->where('user_id', '=', Auth::id())
            ->groupBy( 'carts.beverage_id', 'stock', 'name')
            ->get();

        foreach ($carts as $cart){
            if($cart->sum_quantity > $cart->stock){
                return back()->withErrors($cart->name." quantity must be less than equals ".$cart->stock);
            }

            DB::table('beverages')
                ->where('id', '=', $cart->beverage_id)
                ->update(['stock' => $cart->stock - $cart->sum_quantity]);
        }



        $header = new HeaderTransaction();
        $header->id = Str::uuid();
        $header->user_id = Auth::id();
        $header->date = Carbon::parse($request['created_at']);
        $header->save();

        $carts = DB::table('carts')
            ->join('beverages', 'carts.beverage_id', '=', 'beverages.id')
            ->where('user_id', '=', Auth::id())
            ->get();

        foreach($carts as $cart){
            $detail = new DetailTransaction();
            $detail->transaction_id = $header->id;
            $detail->beverage_id = $cart->beverage_id;
            $detail->topping_id = $cart->topping_id;
            $detail->ice_id = $cart->ice_id;
            $detail->sugar_id = $cart->sugar_id;
            $detail->quantity = $cart->quantity;
            $detail->save();
        }

        Cart::where('user_id', '=', Auth::id())->delete();

        return redirect()->back()->with('success', 'Successfully bought beverage');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HeaderTransaction  $headerTransaction
     * @return \Illuminate\Http\Response
     */
    public function show($headerTransaction)
    {

        $details = DB::table('detail_transactions')
            ->join('header_transactions', 'header_transactions.id', '=', 'detail_transactions.transaction_id')
            ->join('beverages', 'beverages.id', '=', 'detail_transactions.beverage_id')
            ->where([['transaction_id', '=', $headerTransaction], ['user_id', '=', Auth::id()]])
            ->get();


        foreach ($details as $detail){

            if($detail->sugar_id != ""){
                $sugar = Sugar::where('id','=',$detail->sugar_id)->first();
                $detail->sugar_name = $sugar->name;
            }

            if($detail->ice_id != ""){
                $ice = Ice::where('id','=',$detail->ice_id)->first();
                $detail->ice_name = $ice->name;
            }
            $sub_total = $detail->price * $detail->quantity;
            if($detail->topping_id != ""){
                $split = explode("#", $detail->topping_id);
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
                $detail->toppings = $toppings;
            }
            $detail->sub_total = $sub_total;

        }
        return view('histories.detail', ['details' => $details]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HeaderTransaction  $headerTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(HeaderTransaction $headerTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HeaderTransaction  $headerTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HeaderTransaction $headerTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HeaderTransaction  $headerTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(HeaderTransaction $headerTransaction)
    {
        //
    }
}
