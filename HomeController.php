<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Config;

use App\Type;
use App\Client;
use Setting;
use App\Appointment;
use Illuminate\Http\Request;
use BotMan\Drivers\Facebook\FacebookDriver;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */



    public function index()
    {
        $clients=Client::all();
        $appointments=Appointment::all();
        $types=Type::all();
        return view('home')->with('clients',$clients)->with('appointments',$appointments)->with('types',$types);
    }


    public function test()
    {

        Setting::set('Theme', [
            'primary-color'=> '#24801c',
            'secondary-color'=> '#000000',
            'bg-image' => 'https://res.cloudinary.com/ds9qfm1ok/image/upload/v1599670310/1_zvsdhh.jpg',
            'text-color' => '#ffffff',

            ]);

           

            return;
        Setting::set('Saturday', [
            'debut'=> '08:00',
            'fin'=> '21:00',
            'active' => '1',
            'debut-repos' => '12:00',
            'fin-repos' => '13:00',
            ]);
        Setting::set('Sunday', [
            'debut'=> '08:00',
            'fin'=> '21:00',
            'active' => '1',
            'debut-repos' => '12:00',
            'fin-repos' => '13:00',
             ]);
    
        Setting::set('Monday', [
            'debut'=> '08:00',
            'fin'=> '21:00',
            'active' => '1',
            'debut-repos' => '12:00',
            'fin-repos' => '13:00',
             ]);
        Setting::set('Tuesday', [
            'debut'=> '08:00',
            'fin'=> '21:00',
            'active' => '0',
            'debut-repos' => '12:00',
            'fin-repos' => '13:00',
            ]);
        Setting::set('Wednesday', [
                'debut'=> '08:00',
                'fin'=> '21:00',
                'active' => '1',
                'debut-repos' => '12:00',
                'fin-repos' => '13:00',
                ]);
         Setting::set('Thursday', [
                'debut'=> '08:00',
                'fin'=> '21:00',
                'active' => '1',
                'debut-repos' => '12:00',
                'fin-repos' => '13:00',
                ]);
        Setting::set('Friday', [
                'debut'=> '08:00',
                'fin'=> '21:00',
                'active' => '1',
                'debut-repos' => '12:00',
                'fin-repos' => '13:00',
                    ]);
        
    
    
            
    echo "ok";
    return;
    
}
}
