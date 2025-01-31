<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    //

    public function sendMessage(Request $req){
        $text = $req->get('text');
        $answer = $req->get('answer');
        $user = $req->get('userData');
        $company = $req->get('companyData');
        $sender = '';

        if($user != null)
        {
            $sender = 'user';
        }else if($company != null){
            $sender = 'company';
        }
//        dd($answer,Answer::all(),Answer::where('id',strval($answer))->first());

        $answer = Answer::where('id',$answer)->first();
    try{
        $mes = Message::create([
            'user_id'=>$answer->user_id,
            'company_id'=>$answer->company_id,
            'message'=>$text,
            'token' => $answer->id,
            'status' =>'not read',
            'advert_id'=>$answer->advert_id,
            'sender'=>$sender
        ]);

        $view = view('.include.message-item',['v'=>$mes])->render();
        return response()->json([
            'send'=>true,
            'view'=>$view
        ]);

    }catch (\Exception $e){
        dd($e);
        return response()->json([
            'send'=>false
        ]);
    }


    }
}
