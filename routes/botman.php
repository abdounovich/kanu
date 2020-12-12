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
    $bot->reply('مرحبا بك  🙋‍♂️ '.$full_name."\n".' 🖤💚 IK9 تشرفنا زيارتك لصفحة   ');
    $bot->typesAndWaits(2);
    $bot->reply(ButtonTemplate::create('   أنا روربوت المحادثة التلقائية  🤖  كيف يمكنني خدمتك ؟  ')
	->addButton(ElementButton::create(' 📆 احجز موعدك الآن')
	    ->type('postback')
	    ->payload('GotoDis')
	)
	->addButton(ElementButton::create(' 👨‍🏫  كيف أحجز موعد    ')
    ->type('postback')
    ->payload('steps')	)
);
});
  



$botman->hears('OhYes([0-9]+)', function ( $bot,$number) {

$user = $bot->getUser();
$facebook_id = $user->getId();
// Access last name
$firstname = $user->getFirstname();
// Access last name
$lastname = $user->getLastname();
$full_name=$firstname.'-'.$lastname;
// Access Username

$DbUsername=Client::whereFacebook($full_name)->first();


$types2=Type::where('point','<','30')->get();

$array2=array();




 foreach ($types2 as $type2 ) {
    $array2[]= Element::create($type2->type)
    ->subtitle("السعر : ".$type2->prix.' دج ')
    ->image($type2->photo)
    ->addButton(ElementButton::create(' 📆 احجز موعدك الآن')
    ->url($this->config.'/test/'.$type2->id.'/D'.$number."/".$full_name."/".$DbUsername->id)
    ->heightRatio('tall')
    ->disableShare()
    ->enableExtensions());}



$bot->typesAndWaits(2);

$bot->reply(GenericTemplate::create()
->addImageAspectRatio(GenericTemplate::RATIO_SQUARE)
->addElements($array2)
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
// Access Username
  
$DbUsername=Client::whereFacebook($full_name)->first();


 $types1=Type::where('point','>=','30')->get();

 $array1=array();


 foreach ($types1 as $type ) {
     $array1[]= Element::create($type->type)
     ->subtitle("السعر : ".$type->prix.' دج ')
     ->image($type->photo)
     ->addButton(ElementButton::create(' 📆 احجز موعدك الآن')
     ->url($this->config.'/test/'.$type->id.'/D'.$number."/".$full_name."/".$DbUsername->id)
     ->heightRatio('tall')
     ->disableShare()
     ->enableExtensions());}

  


     $bot->typesAndWaits(1);

        
   


 $bot->reply(GenericTemplate::create()
 ->addImageAspectRatio(GenericTemplate::RATIO_SQUARE)
 ->addElements($array1)
); 


 

$bot->reply(Question::create(' إظهار المزيد ➕ ؟   ')->addButtons([
    Button::create(' ✅ نعم ')->value('OhYes'.$number),]));
});






$botman->hears('GoToDis', function ( $bot) {

    $user = $bot->getUser();
    $facebook_id = $user->getId();
    // Access last name
    $firstname = $user->getFirstname();
// Access last name
$lastname = $user->getLastname();
$full_name=$firstname.'-'.$lastname;
// Access Username

    $DbUsername=Client::whereFacebook($full_name)->first();
    $OneApp=Appointment::where('facebook',$full_name)
    ->where('ActiveType','1')->count();
    
    if ($OneApp>0) {
        $bot->typesAndWaits(2);
    
        $bot->reply(ButtonTemplate::create(' عذرا صديقي 😕 '.$full_name ."\n"." لقد حجزت موعد من قبل لا يمكنك حجز أكثر من موعد في نفس اليوم ")
        ->addButton(ElementButton::create('🗒 تصفح مواعيدي  ')
        ->url($this->config.'/client/'.$DbUsername->slug)
        ->enableExtensions()
        ->heightRatio('tall')
        ->disableShare()
    
        )
        
        );}



        else{


$arr=array();
date_default_timezone_set("Africa/Algiers");
    $today=date("l");
    $tomorrow=date("l", strtotime($today. ' + 1 day'));
    $aftertomorrow=date("l", strtotime($today. ' + 2 day'));
   

    if ($today=='Tuesday') {
   
        $arr[]=  ElementButton::create(' بعد غد  🕐')
        ->type('postback')
        ->payload('rdv3');
      
        $arr[]=  ElementButton::create('يوم الغد  🕐')
        ->type('postback')
        ->payload('rdv2');
        
    }
    elseif ($tomorrow=='Tuesday') {
       

        $arr[]=  ElementButton::create(' بعد غد  🕐')
        ->type('postback')
        ->payload('rdv3');
      
        $arr[]=  ElementButton::create(' اليوم  🕐')
        ->type('postback')
        ->payload('rdv1');
    }
    elseif ($aftertomorrow=='Tuesday') {
     
        $arr[]=  ElementButton::create(' اليوم 🕐')
        ->type('postback')
        ->payload('rdv1');
      
        $arr[]=  ElementButton::create(' يوم الغد  🕐')
        ->type('postback')
        ->payload('rdv2');


    }
    else{  
        $arr[]=  ElementButton::create('     اليوم 🕐')
        ->type('postback')
        ->payload('rdv1');
        $arr[]=  ElementButton::create(' يوم الغد  🕐')
        ->type('postback')
        ->payload('rdv2');
          $arr[]=  ElementButton::create(' بعد غد  🕐')
        ->type('postback')
        ->payload('rdv3');
      
    }
    $bot->typesAndWaits(2);
 /* 

    $bot->reply(" عفوا لا يمكنك استعمال هاته الخدمة بسبب خلل تقني سنقوم بإصلاحه قريبا ");
    $bot->reply(" يمكنك حجز موعد عبر الهاتف مؤقتا على الرقم  0555727410 "); */


     $bot->reply(ButtonTemplate::create('  من فضلك إختر يوم موعدك  👇👇')->addButtons($arr)); 
    }
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
    // Access last name
    $firstname = $user->getFirstname();
// Access last name
$lastname = $user->getLastname();
$full_name=$firstname.'-'.$lastname;
// Access Username

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
    ->enableExtensions()



	)
);

  });





  $botman->hears('steps', function($bot) {
    $user = $bot->getUser();
    $facebook_id = $user->getId();
    // Access last name
    $firstname = $user->getFirstname();
// Access last name
$lastname = $user->getLastname();
$full_name=$firstname.'-'.$lastname;
// Access Username


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
// Access Username

      
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