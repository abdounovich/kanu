<?php
use App\Type;
use App\Client;
use Carbon\Carbon;
use App\Appointment;
use Illuminate\Support\Str;
use App\Conversations\ExampleConversation;
use App\Http\Controllers\BotManController;
use BotMan\Drivers\Facebook\Extensions\Element;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\Drivers\Facebook\Extensions\MediaTemplate;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
use BotMan\Drivers\Facebook\Extensions\GenericTemplate;
use BotMan\Drivers\Facebook\Extensions\MediaAttachmentElement;

$botman = resolve('botman');


$botman->hears('p', function ( $bot) {
    $user = $bot->getUser();
    // Access last name
// Access last name
$picture=$user->getId();
$bot->reply('id '.$picture);
});

$botman->hears('GET_STARTED', function ( $bot) {
    $user = $bot->getUser();

    $facebook_id = $user->getId();

    // Access last name
    $firstname = $user->getFirstname();
// Access last name
$lastname = $user->getLastname();
$full_name=$firstname.'-'.$lastname;
// Access Username



$DbUsername=Client::whereFacebook($full_name)->count();
if ($DbUsername=="0") {
    $client=new Client();
    $client->facebook=$full_name;
    $client->slug=Str::random(10) ;

    $client->points='5';
    $client->fb_id=$facebook_id;

    $client->save();



}
else
{

}
$DbUsername=Client::whereFacebook($full_name)->first();

$bot->typesAndWaits(2);

$config=Config::get('app.url');

    $bot->reply('مرحبا بك  🙋‍♂️ '.$full_name."\n".'تشرفنا زيارتك لصفحتنا ');
    $bot->typesAndWaits(2);

    $bot->reply(ButtonTemplate::create(' كيف يمكننا خدمتك ؟ ')
	->addButton(ElementButton::create(' 📆 احجز موعدك الآن')
	    ->type('postback')
	    ->payload('rdv')
	)
	->addButton(ElementButton::create('تصفح مواعيدي ')
	    ->url($config.'/client/'.$DbUsername->slug)
	)
);
});
  

$botman->hears('rdv', function($bot) {

    $user = $bot->getUser();
    // Access last name
    $firstname = $user->getFirstname();
// Access last name
$lastname = $user->getLastname();
$full_name=$firstname.'-'.$lastname;
$OneApp=Appointment::where('facebook',$full_name)
->where('ActiveType','1')->count();
if ($OneApp>0) {
$bot->reply('عذرا , لقد حجزت موعد من قبل لا يمكنك حجز أكثر من موعد في نفس اليوم');}
else{
$app_tot=Appointment::all()->count();

$date=date("l");
$debut=0;
if ($date=='Friday') {
    $total="600";
    $debut="09:00";

    $fin="22:00";
 }elseif($date=='Saturday'){
     $total="720";
     $debut="09:00";

 }else{
     $total="360";
     $debut="01:00";

 }

 $Tos=Appointment::all();
$somme=0;
foreach ($Tos as $To) {
$somme=$somme+$To->type->temps;
}

 if ($somme<$total) {    
    date_default_timezone_set("Africa/Algiers");
    $date = new Carbon($debut);
    $date->subMinute(120);
    $date=$date->format('H:i:s');
    $heure_actuel=$dt=date("H:i:s");
if ($heure_actuel>=$date){
    $Tos=Appointment::all();
    $app_tot=Appointment::all()->count();
    $somme=0;
    foreach ($Tos as $To) {
        $somme=$somme+$To->type->temps;
    }
$diff=$total-$somme;
    $types=Type::where('temps','<=',$diff)->get();
    $array=array();
    foreach ($types as $type ) {
        $array[]= Element::create($type->type)
        ->subtitle("السعر : ".$type->prix.' دج ')
        ->image($type->photo)
        ->addButton(ElementButton::create(' 📆 احجز موعدك الآن')
            ->payload('C'.$type->id)
            ->type('postback'));}
    $bot->reply(GenericTemplate::create()
    ->addImageAspectRatio(GenericTemplate::RATIO_SQUARE)
    ->addElements($array)
); 
 }else{    
    $bot->reply(' عذرا صديقي يتم أخذ موعد إبتداءا  من '.$date);
}}
else{
$complet_message="  أنا آسف صديقي 😕  ".$full_name."\n"." كل الأماكن محجوزة لنهار اليوم ";
    $bot->reply($complet_message);

}
}
});





$botman->hears('menu)', function ($bot) {
    $bot->reply("lll");
  
});
$botman->hears('C([0-9]+)', function ($bot, $number) {
    $user = $bot->getUser();
    // Access last name
    $facebook_id=$user->getId();
    $firstname = $user->getFirstname();
// Access last name
$lastname = $user->getLastname();
$full_name=$firstname.'-'.$lastname;
    $bot->startConversation(new ExampleConversation($full_name,$number,$facebook_id));
});

$botman->hears('hi', function ($bot) {


   
});


$botman->fallback(function ($bot) {
    $bot->reply('sorry');
});