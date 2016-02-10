<?php namespace Vultuk\HlrLookup\Parsers;

class SingleNumberParse
{

    /**
     * @var boolean
     */
    public $verified;

    /**
     * @var string
     */
    public $timezone;

    /**
     * @var string
     */
    public $location;

    /**
     * @var string
     */
    public $networkName;

    /**
     * @var integer
     */
    public $countryCode;

    /**
     * @var string
     */
    public $area;

    public $type;

    public $errorCode;

    public $errorText;

    public $status;

    public $isPorted;

    public $isRoaming;

    public function isActive()
    {
        if ($this->errorCode !== 0) {
            return false;
        }

        return true;
    }


    public static function parse($response)
    {
        $parse = new self;

        // Check responses for errors

        // Parse All the Things
        $parse->verified = $response['issueing_info']['verified'];
        $parse->timezone = $response['issueing_info']['timezone'];
        $parse->location = $response['issueing_info']['location'];
        $parse->networkName = $response['issueing_info']['network_name'];
        $parse->countryCode = $response['issueing_info']['country_code'];
        $parse->area = $response['issueing_info']['area'];

        $parse->errorCode = $response['error_code'];
        $parse->errorText = $response['error_text'];
        $parse->type = $response['type'];
        $parse->status = $response['status'];
        $parse->isPorted = $response['is_ported'];
        $parse->isRoaming = $response['is_roaming'];

        return $parse;
    }

}