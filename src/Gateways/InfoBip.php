<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 12/14/17
 * Time: 6:04 PM
 */

namespace CraftedSystems\LaravelSMS\Gateways;

use CraftedSystems\LaravelSMS\Contracts\SMSContract;
use Illuminate\Http\Request;
use infobip\api\client\SendMultipleTextualSmsAdvanced;
use infobip\api\configuration\BasicAuthConfiguration;
use infobip\api\model\Destination;
use infobip\api\model\sms\mt\send\Message;
use infobip\api\model\sms\mt\send\textual\SMSAdvancedTextualRequest;

use infobip\api\model\sms\mt\reports\SMSReportResponse;
use JsonMapper;

use infobip\api\client\GetAccountBalance;


class InfoBip implements SMSContract
{
    /**
     * @var SendMultipleTextualSmsAdvanced
     */
    protected $class;


    /**
     * @var object
     */
    protected $settings;

    /**
     * InfoBip constructor.
     * @param $settings
     * @throws \Exception
     */
    public function __construct($settings)
    {
        if (!class_exists('infobip\api\client\SendMultipleTextualSmsAdvanced')) {

            throw new \Exception("Class 'infobip\api\client\SendMultipleTextualSmsAdvanced' does not exist");
        }

        $this->settings = (object)$settings;

        $this->class = new SendMultipleTextualSmsAdvanced(new BasicAuthConfiguration($this->settings->username, $this->settings->password));
    }


    /**
     * @param $recipient
     * @param $message
     * @param null $params
     * @return mixed|object
     */
    public function send($recipient, $message, $params = null)
    {
        $destination = new Destination();
        $destination->setTo($recipient);

        $mess = new Message();
        $mess->setFrom($this->settings->from);
        $mess->setDestinations([$destination]);
        $mess->setText($message);
        $mess->setNotifyUrl($this->settings->call_back_url);
        $requestBody = new SMSAdvancedTextualRequest();
        $requestBody->setMessages([$mess]);

        $response = $this->class->execute($requestBody);
        $sentMessageInfo = $response->getMessages()[0];

        $data = [
            'is_success' => $sentMessageInfo->getStatus()->getName() === 'PENDING_ENROUTE',
            'receiver' => $sentMessageInfo->getTo(),
            'message_id' => $sentMessageInfo->getMessageId()
        ];

        return (object)$data;
    }


    /**
     * @return mixed
     */
    public function getBalance()
    {
        $client = new GetAccountBalance(new BasicAuthConfiguration($this->settings->username, $this->settings->password));
        $response = $client->execute();

        return $response->getBalance();
    }


    /**
     * @param Request $request
     * @return mixed|object
     * @throws \JsonMapper_Exception
     */
    public function getDeliveryReports(Request $request)
    {
        $mapper = new JsonMapper();
        $responseObject = $mapper->map(json_decode($request->getContent()), new SMSReportResponse());

        $result = $responseObject->getResults()[0];

        $data = [
            'status' => $result->getStatus()->getName(),
            'message_id' => $result->getMessageId(),
            'price' => $result->getPrice()->getPricePerMessage()
        ];

        return (object)$data;
    }
}