<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 12/14/17
 * Time: 6:04 PM
 */

namespace CraftedSystems\LaravelSMS\Gateways;

use CraftedSystems\InfoSky\InfoSkySMS;
use CraftedSystems\LaravelSMS\Contracts\SMSContract;
use Illuminate\Http\Request;

class InfoSky implements SMSContract
{
    /**
     * @var InfoSkySMS
     */
    protected $class;


    /**
     * MicroMobile constructor.
     * @param $settings
     * @throws \Exception
     */
    public function __construct($settings)
    {
        if (!class_exists('CraftedSystems\InfoSky\InfoSkySMS')) {

            throw new \Exception("Class 'CraftedSystems\InfoSky\InfoSkySMS' does not exist");
        }

        $this->class = new InfoSkySMS($settings);
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
            'is_success' => $response->status === 1,
            'description' => $response->description,
            'message_id' => $response->sms_id,
            'msisdn' => $response->msisdn
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
            'status' => $this->deliveryReports()->where('code', $response->status)->first()['name'],
            'message_id' => $response->sms_id,
            'phone_number' => $response->msisdn
        ];

        return (object)$data;
    }

    private function deliveryReports()
    {
        return collect(
            [
                [
                    'code' => 0,
                    'name' => 'Sent',
                    'description' => 'Awaiting Delivery Report'
                ],
                [
                    'code' => 1,
                    'name' => 'MessageWaiting',
                    'description' => 'MessageWaiting'
                ],
                [
                    'code' => 2,
                    'name' => 'DeliveredToNetwork',
                    'description' => 'DeliveredToNetwork'
                ],
                [
                    'code' => 3,
                    'name' => 'DeliveredToTerminal',
                    'description' => 'DeliveredToTerminal'
                ],
                [
                    'code' => 4,
                    'name' => 'DeliveryNotificationNotSupported',
                    'description' => 'DeliveryNotificationNotSupported'
                ],
                [
                    'code' => 5,
                    'name' => 'DeliveryUncertain',
                    'description' => 'DeliveryUncertain'
                ],
                [
                    'code' => 6,
                    'name' => 'Insufficient_Balance',
                    'description' => 'Insufficient_Balance'
                ],
                [
                    'code' => 7,
                    'name' => 'Invalid_Linkid',
                    'description' => 'Invalid_Linkid'
                ],
                [
                    'code' => 8,
                    'name' => 'DeliveryImpossible',
                    'description' => 'DeliveryImpossible'
                ],
                [
                    'code' => 9,
                    'name' => 'Unknown',
                    'description' => 'Unknown'
                ],
                [
                    'code' => 10,
                    'name' => 'Insufficient_BulkSMS_Credit',
                    'description' => 'Insufficient_BulkSMS_Credit'
                ],
                [
                    'code' => 11,
                    'name' => 'UnknownSubscriber',
                    'description' => 'UnknownSubscriber'
                ],
                [
                    'code' => 12,
                    'name' => 'UnknownBaseStation',
                    'description' => 'UnknownBaseStation'
                ],
                [
                    'code' => 13,
                    'name' => 'UnknownMSC',
                    'description' => 'UnknownMSC'
                ],
                [
                    'code' => 14,
                    'name' => 'UnidentifiedSubscriber',
                    'description' => 'UnidentifiedSubscriber'
                ],
                [
                    'code' => 15,
                    'name' => 'AbsentSubscriberSM',
                    'description' => 'AbsentSubscriberSM'
                ],
                [
                    'code' => 16,
                    'name' => 'UnknownEquipment',
                    'description' => 'UnknownEquipment'
                ],
                [
                    'code' => 17,
                    'name' => 'RoamingNotAllowed',
                    'description' => 'RoamingNotAllowed'
                ],
                [
                    'code' => 18,
                    'name' => 'IllegalSubscriber',
                    'description' => 'IllegalSubscriber'
                ],
                [
                    'code' => 19,
                    'name' => 'BearerServiceNotProvisioned',
                    'description' => 'BearerServiceNotProvisioned'
                ],
                [
                    'code' => 20,
                    'name' => 'TeleserviceNotProvisioned',
                    'description' => 'TeleserviceNotProvisioned'
                ],
                [
                    'code' => 21,
                    'name' => 'IllegalEquipment',
                    'description' => 'IllegalEquipment'
                ],
                [
                    'code' => 22,
                    'name' => 'CallBarred',
                    'description' => 'CallBarred'
                ],
                [
                    'code' => 23,
                    'name' => 'ForwardingViolation',
                    'description' => 'ForwardingViolation'
                ],
                [
                    'code' => 24,
                    'name' => 'CUG-Reject',
                    'description' => 'CUG-Reject'
                ],
                [
                    'code' => 25,
                    'name' => 'IllegalSS-Operation',
                    'description' => 'IllegalSS-Operation'
                ],
                [
                    'code' => 26,
                    'name' => 'SS-ErrorStatus',
                    'description' => 'SS-ErrorStatus'
                ],
                [
                    'code' => 27,
                    'name' => 'SS-NotAvailable',
                    'description' => 'SS-NotAvailable'
                ],
                [
                    'code' => 28,
                    'name' => 'SS-SubscriptionViolation',
                    'description' => 'SS-SubscriptionViolation'
                ],
                [
                    'code' => 29,
                    'name' => 'SS-Incompatibility',
                    'description' => 'SS-Incompatibility'
                ],
                [
                    'code' => 30,
                    'name' => 'FacilityNotSupported',
                    'description' => 'FacilityNotSupported'
                ],
                [
                    'code' => 31,
                    'name' => 'InvalidTargetBaseStation',
                    'description' => 'InvalidTargetBaseStation'
                ],
                [
                    'code' => 32,
                    'name' => 'NoRadioResourceAvailable',
                    'description' => 'NoRadioResourceAvailable'
                ],
                [
                    'code' => 33,
                    'name' => 'NoHandoverNumberAvailable',
                    'description' => 'NoHandoverNumberAvailable'
                ],
                [
                    'code' => 34,
                    'name' => 'SubsequentHandoverFailure',
                    'description' => 'SubsequentHandoverFailure'
                ],
                [
                    'code' => 35,
                    'name' => 'AbsentSubscriber',
                    'description' => 'AbsentSubscriber'
                ],
                [
                    'code' => 36,
                    'name' => 'SubscriberBusyForMT-SMS',
                    'description' => 'SubscriberBusyForMT-SMS'
                ],
                [
                    'code' => 37,
                    'name' => 'SM-DeliveryFailure',
                    'description' => 'SM-DeliveryFailure'
                ],
                [
                    'code' => 38,
                    'name' => 'MessageWaitingListFull',
                    'description' => 'MessageWaitingListFull'
                ],
                [
                    'code' => 39,
                    'name' => 'SystemFailure',
                    'description' => 'SystemFailure'
                ],
                [
                    'code' => 40,
                    'name' => 'DataMissing',
                    'description' => 'DataMissing'
                ],
                [
                    'code' => 41,
                    'name' => 'UnexpectedDataValue',
                    'description' => 'UnexpectedDataValue'
                ],
                [
                    'code' => 42,
                    'name' => 'PW-RegistrationFailure',
                    'description' => 'PW-RegistrationFailure'
                ],
                [
                    'code' => 43,
                    'name' => 'NegativePW-Check',
                    'description' => 'NegativePW-Check'
                ],
                [
                    'code' => 44,
                    'name' => 'NoRoamingNumberAvailable',
                    'description' => 'NoRoamingNumberAvailable'
                ],
                [
                    'code' => 45,
                    'name' => 'TracingBufferFull',
                    'description' => 'TracingBufferFull'
                ],
                [
                    'code' => 46,
                    'name' => 'NumberOfPW-AttemptsViolation',
                    'description' => 'NumberOfPW-AttemptsViolation'
                ],
                [
                    'code' => 47,
                    'name' => 'NumberChanged',
                    'description' => 'NumberChanged'
                ],
                [
                    'code' => 48,
                    'name' => 'UnknownAlphabet',
                    'description' => 'UnknownAlphabet'
                ],
                [
                    'code' => 49,
                    'name' => 'USSD-Busy',
                    'description' => 'USSD-Busy'
                ],
                [
                    'code' => 50,
                    'name' => 'OK',
                    'description' => 'OK'
                ],
                [
                    'code' => 51,
                    'name' => 'UserInBlacklist',
                    'description' => 'UserInBlacklist'
                ],
                [
                    'code' => 52,
                    'name' => 'UserAbnormalState',
                    'description' => 'UserAbnormalState'
                ],
                [
                    'code' => 53,
                    'name' => 'UserIsSuspended',
                    'description' => 'UserIsSuspended'
                ],
                [
                    'code' => 54,
                    'name' => 'NotSFCUser',
                    'description' => 'NotSFCUser'
                ],
                [
                    'code' => 55,
                    'name' => 'UserNotSubscribed',
                    'description' => 'UserNotSubscribed'
                ],
                [
                    'code' => 56,
                    'name' => 'UserNotExist',
                    'description' => 'UserNotExist'
                ]
            ]
        );
    }
}