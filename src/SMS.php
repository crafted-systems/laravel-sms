<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 12/14/17
 * Time: 4:54 PM
 */

namespace CraftedSystems\LaravelSMS;


use Illuminate\Http\Request;

class SMS
{
    /**
     * SMS Configuration.
     *
     * @var null|object
     */
    protected $config = null;

    /**
     * Sms Gateway Settings.
     *
     * @var null|object
     */
    protected $settings = null;

    /**
     * Sms Gateway Name.
     *
     * @var null|string
     */
    protected $gateway = null;

    /**
     *
     * @var object
     */
    protected $object = null;


    /**
     * SMS constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->config = config('sms');
        $this->gateway = $this->config['default'];
        $this->mapGateway();
    }

    /**
     * Change the gateway on the fly.
     *
     * @param $gateway
     * @return $this
     */
    public function gateway($gateway)
    {
        $this->gateway = $gateway;
        $this->mapGateway();
        return $this;
    }

    private function mapGateway()
    {
        $this->settings = $this->config['gateways'][$this->gateway];
        $class = $this->config['map'][$this->gateway];
        $this->object = new $class($this->settings);
    }


    /**
     * @param $recipient
     * @param $message
     * @param null $params
     * @return mixed
     */
    public function send($recipient, $message, $params = null)
    {
        return $this->object->send($recipient, $message, $params);
    }

    /**
     * @return mixed
     */
    public function getBalance()
    {
        return $this->object->getBalance();
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function getDeliveryReports(Request $request)
    {
        return $this->object->getDeliveryReports($request);
    }

}