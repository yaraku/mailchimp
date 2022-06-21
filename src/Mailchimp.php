<?php

namespace Mailchimp;

use Mailchimp\Exceptions;

class Mailchimp
{
    public $apikey;
    public $ch;
    public $root  = 'https://api.mailchimp.com/2.0';
    public $debug = false;

    public static $error_map = array(
        "ValidationError" => Exceptions\ValidationError::class,
        "ServerError_MethodUnknown" => Exceptions\ServerError\MethodUnknown::class,
        "ServerError_InvalidParameters" => Exceptions\ServerError\InvalidParameters::class,
        "Unknown_Exception" => Exceptions\Unknown\Exception::class,
        "Request_TimedOut" => Exceptions\Request\TimedOut::class,
        "Zend_Uri_Exception" => Exceptions\Zend\Uri\Exception::class,
        "PDOException" => Exceptions\PDOException::class,
        "Avesta_Db_Exception" => Exceptions\Avesta\Db\Exception::class,
        "XML_RPC2_Exception" => Exceptions\XML\RPC2\Exception::class,
        "XML_RPC2_FaultException" => Exceptions\XML\RPC2\FaultException::class,
        "Too_Many_Connections" => Exceptions\Too\Many\Connections::class,
        "Parse_Exception" => Exceptions\Parse\Exception::class,
        "User_Unknown" => Exceptions\User\Unknown::class,
        "User_Disabled" => Exceptions\User\Disabled::class,
        "User_DoesNotExist" => Exceptions\User\DoesNotExist::class,
        "User_NotApproved" => Exceptions\User\NotApproved::class,
        "Invalid_ApiKey" => Exceptions\Invalid\ApiKey::class,
        "User_UnderMaintenance" => Exceptions\User\UnderMaintenance::class,
        "Invalid_AppKey" => Exceptions\Invalid\AppKey::class,
        "Invalid_IP" => Exceptions\Invalid\IP::class,
        "User_DoesExist" => Exceptions\User\DoesExist::class,
        "User_InvalidRole" => Exceptions\User\InvalidRole::class,
        "User_InvalidAction" => Exceptions\User\InvalidAction::class,
        "User_MissingEmail" => Exceptions\User\MissingEmail::class,
        "User_CannotSendCampaign" => Exceptions\User\CannotSendCampaign::class,
        "User_MissingModuleOutbox" => Exceptions\User\MissingModuleOutbox::class,
        "User_ModuleAlreadyPurchased" => Exceptions\User\ModuleAlreadyPurchased::class,
        "User_ModuleNotPurchased" => Exceptions\User\ModuleNotPurchased::class,
        "User_NotEnoughCredit" => Exceptions\User\NotEnoughCredit::class,
        "MC_InvalidPayment" => Exceptions\MC\InvalidPayment::class,
        "List_DoesNotExist" => Exceptions\List\DoesNotExist::class,
        "List_InvalidInterestFieldType" => Exceptions\List\InvalidInterestFieldType::class,
        "List_InvalidOption" => Exceptions\List\InvalidOption::class,
        "List_InvalidUnsubMember" => Exceptions\List\InvalidUnsubMember::class,
        "List_InvalidBounceMember" => Exceptions\List\InvalidBounceMember::class,
        "List_AlreadySubscribed" => Exceptions\List\AlreadySubscribed::class,
        "List_NotSubscribed" => Exceptions\List\NotSubscribed::class,
        "List_InvalidImport" => Exceptions\List\InvalidImport::class,
        "MC_PastedList_Duplicate" => Exceptions\MC\PastedList\Duplicate::class,
        "MC_PastedList_InvalidImport" => Exceptions\MC\PastedList\InvalidImport::class,
        "Email_AlreadySubscribed" => Exceptions\Email\AlreadySubscribed::class,
        "Email_AlreadyUnsubscribed" => Exceptions\Email\AlreadyUnsubscribed::class,
        "Email_NotExists" => Exceptions\Email\NotExists::class,
        "Email_NotSubscribed" => Exceptions\Email\NotSubscribed::class,
        "List_MergeFieldRequired" => Exceptions\List\MergeFieldRequired::class,
        "List_CannotRemoveEmailMerge" => Exceptions\List\CannotRemoveEmailMerge::class,
        "List_Merge_InvalidMergeID" => Exceptions\List\Merge\InvalidMergeID::class,
        "List_TooManyMergeFields" => Exceptions\List\TooManyMergeFields::class,
        "List_InvalidMergeField" => Exceptions\List\InvalidMergeField::class,
        "List_InvalidInterestGroup" => Exceptions\List\InvalidInterestGroup::class,
        "List_TooManyInterestGroups" => Exceptions\List\TooManyInterestGroups::class,
        "Campaign_DoesNotExist" => Exceptions\Campaign\DoesNotExist::class,
        "Campaign_StatsNotAvailable" => Exceptions\Campaign\StatsNotAvailable::class,
        "Campaign_InvalidAbsplit" => Exceptions\Campaign\InvalidAbsplit::class,
        "Campaign_InvalidContent" => Exceptions\Campaign\InvalidContent::class,
        "Campaign_InvalidOption" => Exceptions\Campaign\InvalidOption::class,
        "Campaign_InvalidStatus" => Exceptions\Campaign\InvalidStatus::class,
        "Campaign_NotSaved" => Exceptions\Campaign\NotSaved::class,
        "Campaign_InvalidSegment" => Exceptions\Campaign\InvalidSegment::class,
        "Campaign_InvalidRss" => Exceptions\Campaign\InvalidRss::class,
        "Campaign_InvalidAuto" => Exceptions\Campaign\InvalidAuto::class,
        "MC_ContentImport_InvalidArchive" => Exceptions\MC\ContentImport\InvalidArchive::class,
        "Campaign_BounceMissing" => Exceptions\Campaign\BounceMissing::class,
        "Campaign_InvalidTemplate" => Exceptions\Campaign\InvalidTemplate::class,
        "Invalid_EcommOrder" => Exceptions\Invalid\EcommOrder::class,
        "Absplit_UnknownError" => Exceptions\Absplit\UnknownError::class,
        "Absplit_UnknownSplitTest" => Exceptions\Absplit\UnknownSplitTest::class,
        "Absplit_UnknownTestType" => Exceptions\Absplit\UnknownTestType::class,
        "Absplit_UnknownWaitUnit" => Exceptions\Absplit\UnknownWaitUnit::class,
        "Absplit_UnknownWinnerType" => Exceptions\Absplit\UnknownWinnerType::class,
        "Absplit_WinnerNotSelected" => Exceptions\Absplit\WinnerNotSelected::class,
        "Invalid_Analytics" => Exceptions\Invalid\Analytics::class,
        "Invalid_DateTime" => Exceptions\Invalid\DateTime::class,
        "Invalid_Email" => Exceptions\Invalid\Email::class,
        "Invalid_SendType" => Exceptions\Invalid\SendType::class,
        "Invalid_Template" => Exceptions\Invalid\Template::class,
        "Invalid_TrackingOptions" => Exceptions\Invalid\TrackingOptions::class,
        "Invalid_Options" => Exceptions\Invalid\Options::class,
        "Invalid_Folder" => Exceptions\Invalid\Folder::class,
        "Invalid_URL" => Exceptions\Invalid\URL::class,
        "Module_Unknown" => Exceptions\Module\Unknown::class,
        "MonthlyPlan_Unknown" => Exceptions\MonthlyPlan\Unknown::class,
        "Order_TypeUnknown" => Exceptions\Order\TypeUnknown::class,
        "Invalid_PagingLimit" => Exceptions\Invalid\PagingLimit::class,
        "Invalid_PagingStart" => Exceptions\Invalid\PagingStart::class,
        "Max_Size_Reached" => Exceptions\Max\Size\Reached::class,
        "MC_SearchException" => Exceptions\MC\SearchException::class,
        "Goal_SaveFailed" => Exceptions\Goal\SaveFailed::class,
        "Conversation_DoesNotExist" => Exceptions\Conversation\DoesNotExist::class,
        "Conversation_ReplySaveFailed" => Exceptions\Conversation\ReplySaveFailed::class,
        "File_Not_Found_Exception" => Exceptions\File\Not\Found\Exception::class,
        "Folder_Not_Found_Exception" => Exceptions\Folder\Not\Found\Exception::class,
        "Folder_Exists_Exception" => Exceptions\Folder\Exists\Exception::class,
    );

    public function __construct($apikey = null, $opts = array())
    {
        if (!$apikey) {
            $apikey = getenv('MAILCHIMP_APIKEY');
        }

        if (!$apikey) {
            $apikey = $this->readConfigs();
        }

        if (!$apikey) {
            throw new Exceptions\Error('You must provide a MailChimp API key');
        }

        $this->apikey = $apikey;
        $dc           = "us1";

        if (strstr($this->apikey, "-")) {
            list($key, $dc) = explode("-", $this->apikey, 2);
            if (!$dc) {
                $dc = "us1";
            }
        }

        $this->root = str_replace('https://api', 'https://' . $dc . '.api', $this->root);
        $this->root = rtrim($this->root, '/') . '/';

        if (!isset($opts['timeout']) || !is_int($opts['timeout'])) {
            $opts['timeout'] = 600;
        }
        if (isset($opts['debug'])) {
            $this->debug = true;
        }


        $this->ch = curl_init();

        if (isset($opts['CURLOPT_FOLLOWLOCATION']) && $opts['CURLOPT_FOLLOWLOCATION'] === true) {
            curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
        }

        curl_setopt($this->ch, CURLOPT_USERAGENT, 'MailChimp-PHP/2.0.6');
        curl_setopt($this->ch, CURLOPT_POST, true);
        curl_setopt($this->ch, CURLOPT_HEADER, false);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, $opts['timeout']);


        $this->folders = new Folders($this);
        $this->templates = new Templates($this);
        $this->users = new Users($this);
        $this->helper = new Helper($this);
        $this->mobile = new Mobile($this);
        $this->conversations = new Conversations($this);
        $this->ecomm = new Ecomm($this);
        $this->neapolitan = new Neapolitan($this);
        $this->lists = new Lists($this);
        $this->campaigns = new Campaigns($this);
        $this->vip = new Vip($this);
        $this->reports = new Reports($this);
        $this->gallery = new Gallery($this);
        $this->goal = new Goal($this);
    }

    public function __destruct()
    {
        if (is_resource($this->ch)) {
            curl_close($this->ch);
        }
    }

    public function call($url, $params)
    {
        $params['apikey'] = $this->apikey;

        $params = json_encode($params);
        $ch     = $this->ch;

        curl_setopt($ch, CURLOPT_URL, $this->root . $url . '.json');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_VERBOSE, $this->debug);

        $start = microtime(true);
        $this->log('Call to ' . $this->root . $url . '.json: ' . $params);
        if ($this->debug) {
            $curl_buffer = fopen('php://memory', 'w+');
            curl_setopt($ch, CURLOPT_STDERR, $curl_buffer);
        }

        $response_body = curl_exec($ch);

        $info = curl_getinfo($ch);
        $time = microtime(true) - $start;
        if ($this->debug) {
            rewind($curl_buffer);
            $this->log(stream_get_contents($curl_buffer));
            fclose($curl_buffer);
        }
        $this->log('Completed in ' . number_format($time * 1000, 2) . 'ms');
        $this->log('Got response: ' . $response_body);

        if (curl_error($ch)) {
            throw new Exceptions\HttpError("API call to $url failed: " . curl_error($ch));
        }
        $result = json_decode($response_body, true);

        if (floor($info['http_code'] / 100) >= 4) {
            throw $this->castError($result);
        }

        return $result;
    }

    public function readConfigs()
    {
        $paths = array('~/.mailchimp.key', '/etc/mailchimp.key');
        foreach ($paths as $path) {
            if (file_exists($path)) {
                $apikey = trim(file_get_contents($path));
                if ($apikey) {
                    return $apikey;
                }
            }
        }
        return false;
    }

    public function castError($result)
    {
        if ($result['status'] !== 'error' || !$result['name']) {
            throw new Exceptions\Error('We received an unexpected error: ' . json_encode($result));
        }

        $class = (isset(self::$error_map[$result['name']])) ? self::$error_map[$result['name']] : Exceptions\Error::class;
        return new $class($result['error'], $result['code']);
    }

    public function log($msg)
    {
        if ($this->debug) {
            error_log($msg);
        }
    }
}
