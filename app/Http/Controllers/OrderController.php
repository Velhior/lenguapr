<?php

namespace App\Http\Controllers;
use App\Settings;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Setting as Setting;
use App\Order;
use Mail;
use Session;
use App\User;
use  App\Tariff;
class OrderController extends Controller
{
    public function postOrder(Request $request){    
      $setting = Setting::where ('key', '=', 'site.admin_email')->first();
        $this->validate($request,['tariff_id'=>'required','user_id'=>'required']);

        $tariff = Tariff::where('id', '=', $request->tariff_id)->first();
        $user = User::where('id', '=', $request->user_id)->first();
        //$pam=var_dump($tariff);
        $data = array(
          'tariff_id' => $request->tariff_id,
          'tariff_name' => $tariff['name'],
          'user_name' => $user['name'],
          //'some' => $pam,
          'user_id' => $request->user_id,
          'start_date' => $request->start_date,
                    
        );
        Mail::send('emails.order', $data, function ($message) use ($data){
            //$settings = Setting::where('id','=','1')->first();
            $message->from('phlegmatic.dev@gmail.com', 'John Dosherak');
            //$message->sender('john@johndoe.com', 'John Doe');
            $message->to('phlegmatic.dev@gmail.com', 'John Doe');
            //$message->cc('john@johndoe.com', 'John Doe');
            //$message->bcc('john@johndoe.com', 'John Doe');
            //$message->replyTo('john@johndoe.com', 'John Doe');
            $message->subject('Новый заказ');
            //$message->priority(3);
            //$message->attach('pathToFile');
        });


        $order = new Order;
        $order->tariff_id = $request->tariff_id;
        //$order->last_name = $request->last_name;
        $order->user_id = $request->user_id;
        //$order->start_date = $request->start_date;
        $order->save();
        Session::flash('success', 'Заявка успешно отправлена');
        return redirect()->route('page.main');
      }
}
