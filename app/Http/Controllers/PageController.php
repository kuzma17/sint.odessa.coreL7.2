<?php

namespace App\Http\Controllers;

use App\News;
use App\Page;
use App\Slider;
use App\Stock;
use Illuminate\Http\Request;
use Mail;

class PageController extends Controller
{
    public function home(){
        $slider = Slider::where('active', 1)->orderBy('weight', 'asc')->get();
        $page = Page::where('url', '/')->first();
        $news = News::where('published', 1)->limit(3)->orderBy('published_at', 'desc')->get();
        return view('home', ['slider' => $slider, 'page' => $page, 'news' => $news]);
    }

    public function contacts(){
       $page = Page::where('url', 'contacts')->first();
        return view('contacts', ['page' => $page]);
    }

    public function mail(){
         return view('mail');
    }

	public function send_mail(Request $request){
        Mail::send('mails.mail', array('key' => $request), function($message) {
            $message->from('us@example.com', 'sint.odessa.ua');
            $message->to('sysadmin@sint.odessa.ua', 'Info')->subject('Письмо с сайта');
        });
            return view('mail', ['status'=>1]);
    
    }

    public function stock(){
        $stocks = Stock::where('active', 1)
            ->where('from','<=', date("Y-m-d",time()))
            ->orwherenull('from')
            ->where('to','>=', date("Y-m-d",time()))
            ->orwherenull('to')
            ->get();
        return view('stock', ['stocks' => $stocks]);
    }

    public function page($url){
        $page = Page::where('url', $url)->first();
        return view('page', ['page' => $page]);
    }
}
