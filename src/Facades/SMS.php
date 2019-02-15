<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 12/13/17
 * Time: 6:39 AM
 */

namespace CraftedSystems\LaravelSMS\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static gateway(string $gateway)
 * @method static send(string $recipient, string $message, $params = null)
 * @method static bool is_successful()
 * @method static getMessageID()
 * @method static getBalance()
 * @method static object getDeliveryReports(\Illuminate\Http\Request $request)
 *
 * @see \CraftedSystems\LaravelSMS\SMS
 */
class SMS extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'sms';
    }
}