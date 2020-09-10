<?php

namespace App\Conversations;

use App\Type;
use DateTime;
use App\Client;
use DateTimeZone;
use Carbon\Carbon;
use App\Appointment;
use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\Drivers\Facebook\Extensions\Element;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\Drivers\Facebook\Extensions\GenericTemplate;

class ExampleConversation extends Conversation
{
    protected $facebook;
    protected $number;


    public function __construct(string $facebook ,string $number,string $fb_id) {

        $this->facebook = $facebook;
        $this->type = $number;
        $this->fb_id = $fb_id;

    }
    public function askType()
    {


        $this->total=0;
        $this->debut=0;
 
        $this->date=date("l");
        if ($this->date=='Friday') {
            $this->debut="09:00";
            $this->total="600";
        }elseif($this->date=='Saturday'){
            $this->debut="09:00";
            $this->total="720"; 
        }else{
            $this->total="360";
            $this->debut="15:00";
        }

        
$Tos=Appointment::all();
$this->app_tot=Appointment::all()->count();
$this->somme=0;
foreach ($Tos as $To) {
$this->somme=$this->somme+$To->type->temps;
}

$this->diff=$this->total-$this->somme;

       $rest= new Carbon($this->debut);
                $rest->addMinutes($this->somme-10);
                $Lerestant=date_format($rest,"H").'h'.date_format($rest,"i");

                
                    $this->say(' ⏰ موعد حلاقتك في حوالي : '.$Lerestant);

                    $question = Question::create("تأكيد الموعد ")
                    ->addButtons([
                        Button::create(' ✅ تأكيد')->value('yes'),
                        Button::create(' ❎ إلغاء')->value('no')]);
                    
                        return $this->ask($question, function (Answer $answer) {
                            $this->reponse=$answer->getValue();

                            if ($answer->isInteractiveMessageReply()) {
                            if ($this->reponse==="yes") {

                               $this->stepTwo();
                            }
                            else{ $this->say('حسنا ');
                                        }
                               
                               
                            }
                        });
      
       
    }


    public function stepTwo()
    {


 
       


        
      $client=Client::whereFacebook($this->facebook)->first();
          
                $app=new Appointment();
                $app->facebook=$this->facebook;
                $app->type_id=intval($this->type);
                $app->ActiveType="1";
                $app->client_id=$client->id;
                $rest= new Carbon($this->debut);
                $rest->addMinutes($this->somme);
                $app->temps=$rest;
                $app->fb_id=$this->fb_id;
                $app->save(); 
                $rest->subMinutes(10);
                $Lerestant=date_format($rest,"H").'h'.date_format($rest,"i");
                $this->say('شكرا لك  '.$this->facebook);
                $this->say('لقد تم حجز موعدك بنجاح ');
                $this->say(' ⏰ موعد حلاقتك : '.$Lerestant);
               
               
            
    
    }
    /**
     * Start the conversation
     */
    public function run()
    
    {


       

        $this->askType();
    }
}
