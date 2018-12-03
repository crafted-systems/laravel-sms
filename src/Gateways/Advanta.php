<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 12/14/17
 * Time: 6:04 PM
 */

namespace CraftedSystems\LaravelSMS\Gateways;


use CraftedSystems\Advanta\AdvantaSMS;
use CraftedSystems\LaravelSMS\Contracts\SMSContract;
use Illuminate\Http\Request;

class Advanta implements SMSContract
{
    /**
     * @var AdvantaSMS
     */
    protected $class;


    /**
     * Advanta constructor.
     * @param $settings
     * @throws \Exception
     */
    public function __construct($settings)
    {
        if (!class_exists('CraftedSystems\Advanta\AdvantaSMS')) {

            throw new \Exception("Class 'CraftedSystems\Advanta\AdvantaSMS' does not exist");
        }

        $this->class = new AdvantaSMS($settings);
    }

    /**
     * @param $recipient
     * @param $message
     * @param null $params
     * @return mixed
     * @throws \Exception
     */
    public function send($recipient, $message, $params = null)
    {
        $response = $this->class->send($recipient, $message);

        $data = [
            'is_success' => !empty($response),
            'message_id' => rand(10000,9999999)
        ];

        return (object)$data;
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
     * @return mixed|object
     */
    public function getDeliveryReports(Request $request)
    {
        $response = $this->class->getDeliveryReports($request);

        $data = [
            'status' => '',
            'message_id' => ''
        ];

        return (object)$data;
    }
}