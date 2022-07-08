<?php

namespace App\Models;

use App\Mail\AcceptOffer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OfferOrderTask;
use Illuminate\Support\Facades\Storage;


class order extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_name',
        'expert_id',
        'client_id',
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
        $order->client_id = Auth::user()->id;
        if ($validated['filename']) {
            $file = $validated['filename'];
            Storage::disk('local')->putFile("/public/order/$order->expert_id/$order->project_name", $file);
            $order_photo_url = '/storage/order/'.$order->expert_id.'/'.$order->project_name.'/'.$file->hashname();
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
    public function acceptOffer($order){
        $order->status = "ongoing";
        $order->update();
        $expert_email = User::select('email')->where('id',$order->id)->pluck('email')->first();
        //Send email in expert
//        $details = [
//            'body' => 'Ձեր պատվերը հաստատվել է,խնդրում ենք այն կատարել  Նշված ժամանակահատվածում',
//            'to'=>$order->to,
//            'finish'=>$order->finish
//        ];
//        Mail::to($expert_email)->send(new OfferOrderTask($details));
//        //Send email in client
//        $client_email = User::select('email')->where('id',$order->client_id)->pluck('email')->first();
//        $details2 = [
//            'body' => 'Ձեր պատվերը հաստատվել է,խնդրում ենք այն կատարել  Նշված ժամանակահատվածում',
//            'to'=>$order->to,
//            'finish'=>$order->finish
//        ];
//        Mail::to($client_email)->send(new AcceptOffer($details2));
    }
    public function  rejectOffer($request,$order){
        $validated = $request->validated();
        if ($validated['filename']) {
            $folder_path = 'storage/order/' . $order->expert_id . '/' . $order->project_name;

            $files = glob($folder_path . '/*');

            // Deleting all the files in the list
            foreach ($files as $file) {

                if (is_file($file))

                    // Delete the given file
                    unlink($file);
            }
            rmdir('storage/order/' . $order->expert_id . '/' . $order->project_name . '/');
        }

        $order->delete();
    }
    public function finishTask($order){
        $order->status = "finish";
        $order->update();
    }
    public function delivery($order){
        $order->status = "delivery";
        $order->update();
    }
    public function completed($order){
        $order->status = "completed";
        $order->update();
    }
    public function canceled($expert_id){
        $order = order::findorfail($expert_id);
        $order->status = "canceled";
        $order->update();
    }
    public function  User(){
        return $this->belongsTo('app\models\User','client_id','id');
    }
}
