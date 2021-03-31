<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\OfferOrderTask;
use Illuminate\Support\Facades\Storage;

class order extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_name',
        'expert_id',
        'status',
        'title',
        'description',
        'filename',
        'budget',
        'currency',
        'to',
        'finish',
    ];
    public function sendOffer($request,$order){
        $validated = $request->validated();
        $order->project_name = $validated['project_name'];
        $order->expert_id = $validated['expert_id'];
        $order->status = "offer";
        $order->title = $validated['title'];
        $order->description = $validated['description'];

        if ($validated['filename']) {
            $file = $validated['filename'];
            $order_photo_url = Storage::disk('local')->putFile("/public/order/$order->expert_id/$order->project_name", $file);
        } else {
            $order_photo_url = 'https://cdn1.iconfinder.com/data/icons/website-internet/48/website_-_male_user-512.png';
        }
        $order->filename = $order_photo_url;
        $order->budget = $validated['budget'];
        $order->currency = $validated['currency'];
        $order->to = $validated['to'];
        $order->finish = $validated['finish'];
        $order->save();
        $expert_email = User::select('email')->where('id',$validated['expert_id'])->pluck('email');
        //Send email in expert
        $details = [
            'body' => 'Do you have an order, please enter your karkatan profile and give your answer',
        ];
        Mail::to($expert_email[0])->send(new OfferOrderTask($details));
    }
    public function acceptOffer($expert_id){
        $order = order::findorfail($expert_id);
        $order->status = "ongoing";
        $order->update();
    }
}
