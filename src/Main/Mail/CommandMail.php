<?php
namespace Module\Main\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Module\Main\Http\Repository\CrudRepository;

class CommandMail extends Mailable
{
    use Queueable, SerializesModels;

    public $param;

    public function __construct($param){
    	$this->param = $param;
    }

    public function build(){
        $output = $this
            ->subject($this->param->subject)
            ->view('main::blank')
            ->with([
            	'data' => $this->param->mail_content
            ]);

        if(!empty($this->param->reply_to)){
            $output = $output->replyTo($this->param->reply_to);
        }

        return $output;
    }


}