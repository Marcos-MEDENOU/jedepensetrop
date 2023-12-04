<?php

namespace App\Http\Controllers;

use App\Mail\NewsletterMailNotify;
use Illuminate\Support\Facades\Mail;
// use Mail;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
class NewsletterMailNotifyController extends Controller
{

    public function index()
    {
        $data = [
            'subject' => 'Jedepensetrop.fr mail delivery',
            'name' =>"tot" ,
        ];

        try {

            Mail::to('marcosmedenou@gmail.com')->send(new NewsletterMailNotify($data));

            // dd("Email sending ...");
            return response()->json(['Great check your mail box']);
        } catch (Exception $th) {
            return response()->json(['Soory something went wrong']);
        }
    }
}
