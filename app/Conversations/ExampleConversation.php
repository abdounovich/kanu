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
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
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
    {   $this->somme=0;
        $this->total=0;
        $this->debut=0;
        $this->temps=0;
        $this->date=date("l");
        if ($this->date=='Friday') {
            $this->debut="09:00";
            $this->mx="15:00";
            $this->mi="12:00";
           
            $this->total="600";
        }elseif($this->date=='Saturday'){
             $this->total="720";
             $this->debut="09:00";
             $this->mx="13:00";
             $this->mi="12:00";   
        }else{
            $this->total="360";
            $this->debut="16:00";
            $this->mx="13:00";
            $this->mi="12:00";
        }
        $this->config=Config::get('app.url');
        $this->max=date("Y-m-d ").$this->mx.":00";
        $this->max=date("Y-m-d H:i:s",strtotime(date($this->max)));
        $this->min=date("Y-m-d ").$this->mi.":00";
        $this->min=date("Y-m-d H:i:s",strtotime(date($this->min)));
$Tos=Appointment::where('ActiveType','1')->latest('created_at')->first();
date_default_timezone_set("Africa/Algiers");

    $this->now=date("Y-m-d H:i:s");
if($Tos){

    if ($now>$Tos->temps) {
        $this->temps= $this->now;
        $this->mgg=date("H:i:",strtotime(date($this->temps)));

    } 
               
      }
            else {

               

                if ($this->now>$this->debut) {
                    
                    $this->temps=$this->now;
                    $seconds = 15*60;
                    $this->temps=date("Y-m-d H:i:s", (strtotime(date($this->temps)) + $seconds));
                    $this->mgg=date("H:i",strtotime(date($this->temps)));

                } 
                             else {
                $start_time=date("Y-m-d ").$this->debut.":00";

                $this->temps=date("Y-m-d H:i:s",strtotime(date($start_time)));
                $this->mgg=date("H:i",strtotime(date($this->temps)));

            }}


            if ($this->min < $this->temps &&  $this->temps < $this->max) {
                $this->temps=$this->max;
                $this->mgg=date("H:i",strtotime(date($this->temps)));

                
              }
    $this->say(' ⏰ موعد حلاقتك في حوالي : '.  $this->mgg);
    $question = Question::create("تأكيد الموعد ")
    ->addButtons([
                Button::create(' ✅ تأكيد')->value('yes'),
                Button::create(' ❎ إلغاء')->value('no')]);
                return $this->ask($question, function (Answer $answer) {
                    $this->reponse=$answer->getValue();
                    if ($answer->isInteractiveMessageReply()) {
                    if ($this->reponse==="yes") {
                       $this->stepTwo();}
                    else{ $this->say('لقد تم إلغاء موعدك بنجاح  ');
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
                $app->temps=$this->temps;
                $app->fb_id=$this->fb_id;
                $app->save(); 
                $this->say('شكرا لك  '.$this->facebook);
                $this->say('لقد تم حجز موعدك بنجاح ');
                $this->say(ButtonTemplate::create('  الرجاء إختيار زر من القائمة 👇👇 ')
                ->addButton(ElementButton::create(' 📅 مواعيدي')
                ->url($this->config.'/client/'.$client->slug)
            
                )
                ->addButton(ElementButton::create(' 🎁 نقاطي')
                ->url($this->config.'/client/'.$client->slug)
                )
            );
                $this->say(' ⏰ موعد حلاقتك : '.$this->mgg);
               
               
            
    
    }
    /**
     * Start the conversation
     */
    public function run()
    
    {


       

        $this->askType();
    }
}
