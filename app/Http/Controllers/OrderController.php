<?php

namespace App\Http\Controllers;

use App\Http\Requests\orderOfferRequest;
use App\Models\order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($profile_id)
    {

        $expert = User::select('id')->where('id',$profile_id)->pluck('id');
        return view('website.order.create_order',['expert'=>$expert[0]]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function sendOffer(orderOfferRequest $request){
        $order = new order();
        $order->sendOffer($request,$order);
        return redirect('/dashboard');
    }
    public function acceptOffer($id){
        $order = order::findOrFail($id);
        if(Auth::user()->id == $order->expert_id){
            $order->acceptOffer($order);
        }
        return redirect()->back();
    }
    public function finishTask($id){
        $order = order::findOrFail($id);
        if(Auth::user()->id == $order->expert_id) {
            $order->finishTask($order);
        }
        return redirect()->back();
    }
    public function delivery($id){
        $order = order::findOrFail($id);
        if(Auth::user()->id == $order->expert_id) {
            $order->delivery($order);
        }
        return redirect()->back();
    }
    public function completed($id){
        $order = order::findOrFail($id);
        if(Auth::user()->id == $order->client_id) {
            $order->completed($order);
        }
        return redirect()->back();
    }
    public function canceled(){
        $expert_id = Auth::user()->id;
        $order = order::findOrFail($expert_id);
        $order->canceled($order);
        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(order $order)
    {
        //
    }
}
