<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

class Twilio {
    private $twilio;

    public function __construct()
    {
        $CI =& get_instance();
        $sid = $CI->config->item('twilio_sid');
        $token = $CI->config->item('twilio_token');
        $this->twilio = new Client($sid, $token);
    }


    public function sendmessage($recipient_number, $sender_number, $message)
    {
        $result = $this->twilio->messages
                  ->create("whatsapp:".$recipient_number, // to
                           array(
                               "from" => "whatsapp:".$sender_number,
                               "body" =>  $message
                           )
                  );
        $return = $this->preparereturndata($result);
        return $return;
    }

    public function preparereturndata($result){
        $data = array(
            'account_sid'           => $result->accountSid,
            'api_version'           => $result->apiVersion,
            'body'                  => $result->body,
            'date_created'          => $result->dateCreated,
            'date_sent'             => $result->dateSent,
            'date_updated'          => $result->dateUpdated,
            'direction'             => $result->direction,
            'error_code'            => $result->errorCode,
            'error_message'         => $result->errorMessage,
            'from'                  => $result->from,
            'messaging_service_sid' => $result->messagingServiceSid,
            'num_media'             => $result->numMedia,
            'num_segments'          => $result->numSegments,
            'price'                 => $result->price,
            'price_unit'            => $result->priceUnit,
            'sid'                   => $result->sid,
            'status'                => $result->status,
            'subresource_uris'      => $result->subresourceUris,
            'to'                    => $result->to,
            'uri'                   => $result->uri

        );
        return  $data;
    }
}