<?php

use Illuminate\Support\Facades\Mail;
use App\Mail\MyMail;

use LINE\LINEBot as LineBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient as LineClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder as LineMessageBuilder;
use LINE\LINEBot\Response as LineResponse;

use Twilio\Rest\Client as TwilioClient;
use Twilio\Rest\Api\V2010\Account\MessageInstance as TwillioResponse;

if (!function_exists('sendMail')) {
    function sendMail(string $viewName, array $data, string $to): bool
    {
        if (empty(config("mail.from.address")) || empty(config("mail.from.name"))) {
            dividerLog();
            infoLog("MAIL CANNOT SEND");
            infoLog("PLEASE CHECK .env AND SET ABOUT MAIL IF YOU WANT TO SEND MAIL");
            dividerLog();

            return false;
        }

        emphasisLog('MAIL SEND TO ' . $to);

        $result = Mail::to($to)->send(new MyMail($viewName, $data));

        return !is_null($result);
    }
}

if (!function_exists('sendLine')) {
    function sendLine(string $to, string $message, ?string $accessToken = null, ?string $channelSecret = null): bool
    {
        /* 
            $response: LineResponse
        */

        if (is_null($accessToken)) $accessToken = config("line.access_token");
        if (is_null($channelSecret)) $channelSecret = config("line.channel_secret");

        if (is_null($accessToken) || is_null($channelSecret)) return false;

        emphasisLog('LINE SEND TO ' . $to . ' MESSAGE ' . $message);

        $client   = new LineClient($accessToken);
        $bot      = new LineBot($client, ['channelSecret' => $channelSecret]);
        $response = $bot->pushMessage($to, new LineMessageBuilder($message));

        if (!$response instanceof LineResponse) return false;

        emphasisLogStart("LINE");
        infoLog("header: " . json_encode($response->getHeaders(), JSON_UNESCAPED_UNICODE));
        infoLog("body: " . json_encode($response->getJSONDecodedBody(), JSON_UNESCAPED_UNICODE));
        infoLog("status: " . json_encode($response->getHTTPStatus(), JSON_UNESCAPED_UNICODE));
        emphasisLogEnd("LINE");

        return $response->isSucceeded();
    }
}


if (!function_exists('sendSMS')) {
    function sendSMS(string $to, string $message, ?string $from = null, ?string $accountSid = null, ?string $authToken = null, ?string $statusCallback = null): bool
    {
        /* 
            $response: TwillioResponse
        */

        if (is_null($from)) $from = config("twilio.from");
        if (is_null($accountSid)) $accountSid = config("twilio.account_sid");
        if (is_null($authToken)) $authToken = config("twilio.auth_token");
        if (is_null($statusCallback)) $statusCallback = config("twilio.status_callback");

        if (is_null($from) || is_null($accountSid) || is_null($authToken) || is_null($statusCallback)) return false;

        emphasisLog('SMS SEND TO ' . $to . ' MESSAGE ' . $message);

        $client = new TwilioClient($accountSid, $authToken);
        $response = $client->messages->create($to, ['from' => $from, 'body' => $message, "statusCallback" => $statusCallback]);

        if (!$response instanceof TwillioResponse) return false;

        $responseArray = $response->toArray();

        if (!is_null($responseArray["errorCode"]) || !is_null($responseArray["errorMessage"])) return false;

        emphasisLogStart("SMS");
        infoLog("to: " . json_encode($responseArray["to"], JSON_UNESCAPED_UNICODE));
        infoLog("from: " . json_encode($responseArray["from"], JSON_UNESCAPED_UNICODE));
        infoLog("body: " . json_encode($responseArray["body"], JSON_UNESCAPED_UNICODE));
        infoLog("status: " . json_encode($responseArray["status"], JSON_UNESCAPED_UNICODE));
        infoLog("errorCode: " . json_encode($responseArray["errorCode"], JSON_UNESCAPED_UNICODE));
        infoLog("errorMessage: " . json_encode($responseArray["errorMessage"], JSON_UNESCAPED_UNICODE));
        emphasisLogEnd("SMS");

        return true;
    }
}
