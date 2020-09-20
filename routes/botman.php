<?php
use App\Type;
use App\Client;
use Carbon\Carbon;
use App\Appointment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use App\Conversations\ExampleConversation;
use App\Http\Controllers\BotManController;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\Drivers\Facebook\Extensions\Element;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\Drivers\Facebook\Extensions\MediaTemplate;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
use BotMan\Drivers\Facebook\Extensions\GenericTemplate;
use BotMan\Drivers\Facebook\Extensions\MediaAttachmentElement;

$this->config=Config::get('app.url');
$botman = resolve('botman');




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

$DbUsername=Client::whereFacebook($full_name)->first();
$bot->typesAndWaits(2);
    $bot->reply('مرحبا بك  🙋‍♂️ '.$full_name."\n".'تشرفنا زيارتك لصفحتنا ');
    $bot->typesAndWaits(2);
    $bot->reply(ButtonTemplate::create(' كيف يمكننا خدمتك ؟ ')
	->addButton(ElementButton::create(' 📆 احجز موعدك الآن')
	    ->type('postback')
	    ->payload('GotoDis')
	)
	->addButton(ElementButton::create(' 👨‍🏫  كيف أحجز موعد    ')
    ->type('postback')
    ->payload('steps')	)
);
});
  

$botman->hears('rdv([0-9]+)', function($bot,$number) {
 

    $user = $bot->getUser();
    $facebook_id = $user->getId();
    // Access last name
    $firstname = $user->getFirstname();
// Access last name
$lastname = $user->getLastname();
$full_name=$firstname.'-'.$lastname;
$DbUsername=Client::whereFacebook($full_name)->first();


 $types=Type::all();
 $array=array();
 $bot->typesAndWaits(2);

 foreach ($types as $type ) {
     $array[]= Element::create($type->type)
     ->subtitle("السعر : ".$type->prix.' دج ')
     ->image($type->photo)
     ->addButton(ElementButton::create(' 📆 احجز موعدك الآن')
     ->url($this->config.'/test/'.$type->id.'/D'.$number."/".$full_name."/".$DbUsername->id)
     ->heightRatio('tall')
     ->disableShare()
     ->enableExtensions());}
 $bot->reply(GenericTemplate::create()
 ->addImageAspectRatio(GenericTemplate::RATIO_SQUARE)
 ->addElements($array)
); 

 /* $Tos=Appointment::where('ActiveType','1')->get();
$somme=0;
foreach ($Tos as $To) {
$somme=$somme+$To->type->temps;
}

 if ($somme<=$total) {    
    date_default_timezone_set("Africa/Algiers");
    $date = new Carbon($debut);
    $date->subMinute(120);
    $date=$date->format('H:i:s');
    $heure_actuel=$dt=date("H:i:s");
if ($heure_actuel>=$date){
    $Tos=Appointment::where('ActiveType','1')->get();
    $app_tot=Appointment::where('ActiveType','1')->count();
    $somme=0;
    foreach ($Tos as $To) {
        $somme=$somme+$To->type->temps;
    }
$diff=$total-$somme;
    $types=Type::all();
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
    $bot->reply(' عذرا صديقي يتم أخذ موعد إبتداءا  من 🧏‍♂️ '.$date);
}}
else{
$complet_message="  أنا آسف صديقي 😕  ".$full_name."\n"." كل الأماكن محجوزة لنهار اليوم ";
    $bot->reply($complet_message);
}*/
 
});






$botman->hears('GoToDis', function ( $bot) {

    $user = $bot->getUser();
    $facebook_id = $user->getId();
    // Access last name
    $firstname = $user->getFirstname();
// Access last name
$lastname = $user->getLastname();
$full_name=$firstname.'-'.$lastname;
    $DbUsername=Client::whereFacebook($full_name)->first();
    $OneApp=Appointment::where('facebook',$full_name)
    ->where('ActiveType','1')->count();
    
    if ($OneApp>0) {
        $bot->typesAndWaits(2);
    
        $bot->reply(ButtonTemplate::create(' عذرا صديقي 😕 '.$full_name ."\n"." لقد حجزت موعد من قبل لا يمكنك حجز أكثر من موعد في نفس اليوم ")
        ->addButton(ElementButton::create('🗒 تصفح مواعيدي  ')
        ->url($this->config.'/client/'.$DbUsername->slug)
    
        )
        
        );}



        else{



    $bot->typesAndWaits(2);

    $bot->reply(Question::create('  من فضلك إختر يوم موعدك  👇👇')->addButtons([
    Button::create(' 🕐 بعد غد')->value('rdv3'),
    Button::create(' 🕐 يوم الغد ')->value('rdv2'),        
    Button::create('🕐 اليوم')->value('rdv1'),



    

    ]));}
});

/* $botman->hears('C([0-9]+)', function ($bot, $number) {
    $user = $bot->getUser();
    // Access last name
    $facebook_id=$user->getId();
    $firstname = $user->getFirstname();
// Access last name
$lastname = $user->getLastname();
$full_name=$firstname.'-'.$lastname;
$bot->startConversation(new ExampleConversation($full_name,$number,$facebook_id));

}); */





$botman->hears('menu', function ($bot) {

    $user = $bot->getUser();
    $facebook_id = $user->getId();
    $firstname = $user->getFirstname();
    $lastname = $user->getLastname();
    $full_name=$firstname.'-'.$lastname;
    $DbUsername=Client::whereFacebook($full_name)->first();
    $bot->typesAndWaits(2);

    $bot->reply(ButtonTemplate::create('  الرجاء إختيار زر من القائمة 👇👇 ')
	->addButton(ElementButton::create(' 📅 مواعيدي')
    ->url($this->config.'/client/'.$DbUsername->slug)
    ->heightRatio('tall')
    ->disableShare()
    ->enableExtensions()

	)
	->addButton(ElementButton::create(' 🎁 رصيدي')
    ->url($this->config.'/client/'.$DbUsername->slug)
    ->heightRatio('tall')
    ->disableShare()


	)
);

  });





  $botman->hears('steps', function($bot) {

    $bot->reply(' 🤭  لتسهيل عملية حجز موعد إختصرتها لك في  ثلاث  مراحل بسيطة  للغاية  😁 : ');
    $bot->typesAndWaits(1);
    $bot->reply('1⃣ :  إضغط على زر إحجز موعد ثم إختر اليوم الذي تريد حجز موعد فيه  ');

    $bot->reply('2⃣ :  اختر نوع الحلاقة واضغط على زر احجز الموجود أسفل كل صورة ');
    $bot->typesAndWaits(1);
    $bot->reply('3⃣ :   إختر الساعة قم إضغط تأكيد الموعد    ');
    $bot->typesAndWaits(1);

    $bot->reply('بعد قيامك بهاته المراحل  تكون قد أتممت عملية الحجز  ');
    $bot->reply(' يمكنك كذلك معرفة الزمن المتبقي لموعدك بالضغط على زر  📆 رصيدي 🎁  |  مواعيدي من القائمة  ');
    $bot->typesAndWaits(1);
    
    $bot->reply(ButtonTemplate::create('يمكنك الآن حجز موعدك  بكل سهولة  😍 ')
    ->addButton(ElementButton::create('🛍 إحجز موعدك الأن ')
        ->type('postback')
        ->payload('GotoDis')
    )
    
    );
    
    
    
    
    
    });

  $botman->fallback(function($bot) {
    $bot->reply(ButtonTemplate::create('عذرًا ، لم أستطع فهمك 😕 '."\n". 'هذه قائمة بالأوامر التي أفهمها:')
	->addButton(ElementButton::create('🛍 احجز موعد ')
	    ->type('postback')
	    ->payload('GotoDis')
    )
    ->addButton(ElementButton::create('💬 استفسار ')
    ->url('https://www.messenger.com/t/merahi.adjalile')

    )
    ->addButton(ElementButton::create('🤔 طريقة حجز موعد ')
	    ->type('postback')
	    ->payload('steps')
	)
);
});