<?php

namespace App\Http\Controllers;

use App\Http\Requests\StripeDeptCartRequest;
use App\Models\order;
use Session;
use Stripe;

class StripeController extends Controller
{
    public function stripe($order_id)
    {
        $order = order::findOrFail($order_id);
        return view('stripe',compact('order'));
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(StripeDeptCartRequest $request,$order_id)
    {
        $order = order::findOrFail($order_id);

        if ($order->budget == $request->ammount){

            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            Stripe\Charge::create ([
                "amount" => $order->budget*100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "This payment is tested purpose ".$order->title
            ]);
        }
        else{
            echo "please don't try to cheat our system :)";
        }


        Session::flash('success', 'Payment successful!');

        return back();
    }
}
