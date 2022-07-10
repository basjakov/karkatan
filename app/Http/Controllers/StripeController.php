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
    public function stripePost(StripeDeptCartRequest $request)
    {
       dd($request);die;
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
            "amount" => 100 * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "This payment is tested purpose Karkatan.com"
        ]);

        Session::flash('success', 'Payment successful!');

        return back();
    }
}
