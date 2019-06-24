<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Twilio extends CI_Controller {

	public function __construct()
        {
                parent::__construct();
                $this->load->library('twilio');
        }

	public function index()
	{

        $recipient_number = "+XXXXXXXXXXXXX";
        $sender_number = "+XXXXXXXXXXXXX";
        $message = "Your appointment is coming up on 30/06/2014 at 4:15 PM";
        $send = $this->twilio->sendmessage($recipient_number, $sender_number, $message);
        return true;
	}
}
