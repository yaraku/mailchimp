<?php

namespace Mailchimp;

class Mailchimp
{
    public $apikey;
    public $ch;
    public $root  = 'https://api.mailchimp.com/2.0';
    public $debug = false;

    public static $error_map = array(
        "ValidationError" => Mailchimp\Exceptions\ValidationError::class,
        "ServerError_MethodUnknown" => Mailchimp\Exceptions\ServerError\MethodUnknown::class,
        "ServerError_InvalidParameters" => Mailchimp\Exceptions\ServerError\InvalidParameters::class,
        "Unknown_Exception" => Mailchimp\Exceptions\Unknown\Exception::class,
        "Request_TimedOut" => Mailchimp\Exceptions\Request\TimedOut::class,
        "Zend_Uri_Exception" => Mailchimp\Exceptions\Zend\Uri\Exception::class,
        "PDOException" => Mailchimp\Exceptions\PDOException::class,
        "Avesta_Db_Exception" => Mailchimp\Exceptions\Avesta\Db\Exception::class,
        "XML_RPC2_Exception" => Mailchimp\Exceptions\XML\RPC2\Exception::class,
        "XML_RPC2_FaultException" => Mailchimp\Exceptions\XML\RPC2\FaultException::class,
        "Too_Many_Connections" => Mailchimp\Exceptions\Too\Many\Connections::class,
        "Parse_Exception" => Mailchimp\Exceptions\Parse\Exception::class,
        "User_Unknown" => Mailchimp\Exceptions\User\Unknown::class,
        "User_Disabled" => Mailchimp\Exceptions\User\Disabled::class,
        "User_DoesNotExist" => Mailchimp\Exceptions\User\DoesNotExist::class,
        "User_NotApproved" => Mailchimp\Exceptions\User\NotApproved::class,
        "Invalid_ApiKey" => Mailchimp\Exceptions\Invalid\ApiKey::class,
        "User_UnderMaintenance" => Mailchimp\Exceptions\User\UnderMaintenance::class,
        "Invalid_AppKey" => Mailchimp\Exceptions\Invalid\AppKey::class,
        "Invalid_IP" => Mailchimp\Exceptions\Invalid\IP::class,
        "User_DoesExist" => Mailchimp\Exceptions\User\DoesExist::class,
        "User_InvalidRole" => Mailchimp\Exceptions\User\InvalidRole::class,
        "User_InvalidAction" => Mailchimp\Exceptions\User\InvalidAction::class,
        "User_MissingEmail" => Mailchimp\Exceptions\User\MissingEmail::class,
        "User_CannotSendCampaign" => Mailchimp\Exceptions\User\CannotSendCampaign::class,
        "User_MissingModuleOutbox" => Mailchimp\Exceptions\User\MissingModuleOutbox::class,
        "User_ModuleAlreadyPurchased" => Mailchimp\Exceptions\User\ModuleAlreadyPurchased::class,
        "User_ModuleNotPurchased" => Mailchimp\Exceptions\User\ModuleNotPurchased::class,
        "User_NotEnoughCredit" => Mailchimp\Exceptions\User\NotEnoughCredit::class,
        "MC_InvalidPayment" => Mailchimp\Exceptions\MC\InvalidPayment::class,
        "List_DoesNotExist" => Mailchimp\Exceptions\List\DoesNotExist::class,
        "List_InvalidInterestFieldType" => Mailchimp\Exceptions\List\InvalidInterestFieldType::class,
        "List_InvalidOption" => Mailchimp\Exceptions\List\InvalidOption::class,
        "List_InvalidUnsubMember" => Mailchimp\Exceptions\List\InvalidUnsubMember::class,
        "List_InvalidBounceMember" => Mailchimp\Exceptions\List\InvalidBounceMember::class,
        "List_AlreadySubscribed" => Mailchimp\Exceptions\List\AlreadySubscribed::class,
        "List_NotSubscribed" => Mailchimp\Exceptions\List\NotSubscribed::class,
        "List_InvalidImport" => Mailchimp\Exceptions\List\InvalidImport::class,
        "MC_PastedList_Duplicate" => Mailchimp\Exceptions\MC\PastedList\Duplicate::class,
        "MC_PastedList_InvalidImport" => Mailchimp\Exceptions\MC\PastedList\InvalidImport::class,
        "Email_AlreadySubscribed" => Mailchimp\Exceptions\Email\AlreadySubscribed::class,
        "Email_AlreadyUnsubscribed" => Mailchimp\Exceptions\Email\AlreadyUnsubscribed::class,
        "Email_NotExists" => Mailchimp\Exceptions\Email\NotExists::class,
        "Email_NotSubscribed" => Mailchimp\Exceptions\Email\NotSubscribed::class,
        "List_MergeFieldRequired" => Mailchimp\Exceptions\List\MergeFieldRequired::class,
        "List_CannotRemoveEmailMerge" => Mailchimp\Exceptions\List\CannotRemoveEmailMerge::class,
        "List_Merge_InvalidMergeID" => Mailchimp\Exceptions\List\Merge\InvalidMergeID::class,
        "List_TooManyMergeFields" => Mailchimp\Exceptions\List\TooManyMergeFields::class,
        "List_InvalidMergeField" => Mailchimp\Exceptions\List\InvalidMergeField::class,
        "List_InvalidInterestGroup" => Mailchimp\Exceptions\List\InvalidInterestGroup::class,
        "List_TooManyInterestGroups" => Mailchimp\Exceptions\List\TooManyInterestGroups::class,
        "Campaign_DoesNotExist" => Mailchimp\Exceptions\Campaign\DoesNotExist::class,
        "Campaign_StatsNotAvailable" => Mailchimp\Exceptions\Campaign\StatsNotAvailable::class,
        "Campaign_InvalidAbsplit" => Mailchimp\Exceptions\Campaign\InvalidAbsplit::class,
        "Campaign_InvalidContent" => Mailchimp\Exceptions\Campaign\InvalidContent::class,
        "Campaign_InvalidOption" => Mailchimp\Exceptions\Campaign\InvalidOption::class,
        "Campaign_InvalidStatus" => Mailchimp\Exceptions\Campaign\InvalidStatus::class,
        "Campaign_NotSaved" => Mailchimp\Exceptions\Campaign\NotSaved::class,
        "Campaign_InvalidSegment" => Mailchimp\Exceptions\Campaign\InvalidSegment::class,
        "Campaign_InvalidRss" => Mailchimp\Exceptions\Campaign\InvalidRss::class,
        "Campaign_InvalidAuto" => Mailchimp\Exceptions\Campaign\InvalidAuto::class,
        "MC_ContentImport_InvalidArchive" => Mailchimp\Exceptions\MC\ContentImport\InvalidArchive::class,
        "Campaign_BounceMissing" => Mailchimp\Exceptions\Campaign\BounceMissing::class,
        "Campaign_InvalidTemplate" => Mailchimp\Exceptions\Campaign\InvalidTemplate::class,
        "Invalid_EcommOrder" => Mailchimp\Exceptions\Invalid\EcommOrder::class,
        "Absplit_UnknownError" => Mailchimp\Exceptions\Absplit\UnknownError::class,
        "Absplit_UnknownSplitTest" => Mailchimp\Exceptions\Absplit\UnknownSplitTest::class,
        "Absplit_UnknownTestType" => Mailchimp\Exceptions\Absplit\UnknownTestType::class,
        "Absplit_UnknownWaitUnit" => Mailchimp\Exceptions\Absplit\UnknownWaitUnit::class,
        "Absplit_UnknownWinnerType" => Mailchimp\Exceptions\Absplit\UnknownWinnerType::class,
        "Absplit_WinnerNotSelected" => Mailchimp\Exceptions\Absplit\WinnerNotSelected::class,
        "Invalid_Analytics" => Mailchimp\Exceptions\Invalid\Analytics::class,
        "Invalid_DateTime" => Mailchimp\Exceptions\Invalid\DateTime::class,
        "Invalid_Email" => Mailchimp\Exceptions\Invalid\Email::class,
        "Invalid_SendType" => Mailchimp\Exceptions\Invalid\SendType::class,
        "Invalid_Template" => Mailchimp\Exceptions\Invalid\Template::class,
        "Invalid_TrackingOptions" => Mailchimp\Exceptions\Invalid\TrackingOptions::class,
        "Invalid_Options" => Mailchimp\Exceptions\Invalid\Options::class,
        "Invalid_Folder" => Mailchimp\Exceptions\Invalid\Folder::class,
        "Invalid_URL" => Mailchimp\Exceptions\Invalid\URL::class,
        "Module_Unknown" => Mailchimp\Exceptions\Module\Unknown::class,
        "MonthlyPlan_Unknown" => Mailchimp\Exceptions\MonthlyPlan\Unknown::class,
        "Order_TypeUnknown" => Mailchimp\Exceptions\Order\TypeUnknown::class,
        "Invalid_PagingLimit" => Mailchimp\Exceptions\Invalid\PagingLimit::class,
        "Invalid_PagingStart" => Mailchimp\Exceptions\Invalid\PagingStart::class,
        "Max_Size_Reached" => Mailchimp\Exceptions\Max\Size\Reached::class,
        "MC_SearchException" => Mailchimp\Exceptions\MC\SearchException::class,
        "Goal_SaveFailed" => Mailchimp\Exceptions\Goal\SaveFailed::class,
        "Conversation_DoesNotExist" => Mailchimp\Exceptions\Conversation\DoesNotExist::class,
        "Conversation_ReplySaveFailed" => Mailchimp\Exceptions\Conversation\ReplySaveFailed::class,
        "File_Not_Found_Exception" => Mailchimp\Exceptions\File\Not\Found\Exception::class,
        "Folder_Not_Found_Exception" => Mailchimp\Exceptions\Folder\Not\Found\Exception::class,
        "Folder_Exists_Exception" => Mailchimp\Exceptions\Folder\Exists\Exception::class,
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
            throw new Mailchimp_Error('You must provide a MailChimp API key');
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
            throw new Mailchimp_HttpError("API call to $url failed: " . curl_error($ch));
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
            throw new Mailchimp_Error('We received an unexpected error: ' . json_encode($result));
        }

        $class = (isset(self::$error_map[$result['name']])) ? self::$error_map[$result['name']] : 'Mailchimp_Error';
        return new $class($result['error'], $result['code']);
    }

    public function log($msg)
    {
        if ($this->debug) {
            error_log($msg);
        }
    }
}
