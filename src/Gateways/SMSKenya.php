<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 12/14/17
 * Time: 6:04 PM.
 */

namespace CraftedSystems\LaravelSMS\Gateways;

use CraftedSystems\LaravelSMS\Contracts\SMSContract;
use CraftedSystems\SMSKenya\SMSKenya as SMS_Kenya;
use Illuminate\Http\Request;

class SMSKenya implements SMSContract
{
    /**
     * @var SMS_Kenya
     */
    protected $class;

    /**
     * @param $settings
     *
     * @throws \Exception
     */
    public function __construct($settings)
    {
        if (!class_exists('CraftedSystems\SMSKenya\SMSKenya')) {
            throw new \Exception("Class 'CraftedSystems\SMSKenya\SMSKenya' does not exist");
        }

        $this->class = new SMS_Kenya($settings);
    }

    /**
     * @param $recipient
     * @param $message
     * @param null $params
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function send($recipient, $message, $params = null)
    {
        $response = $this->class->send($recipient, $message);

        $data = [
            'is_success' => $response->code === '200:OK',
            'message_id' => '',
        ];

        return (object) $data;
    }

    /**
     * @return mixed
     */
    public function getBalance()
    {
        return $this->class->getBalance();
    }

    /**
     * @param Request $request
     *
     * @return mixed|object
     */
    public function getDeliveryReports(Request $request)
    {
        $response = $this->class->getDeliveryReports($request);

        $data = [
            'status'     => '',
            'message_id' => '',
        ];

        return (object) $data;
    }
}
