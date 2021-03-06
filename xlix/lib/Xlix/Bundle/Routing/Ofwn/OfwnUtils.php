<?php

/*
 * This file is part of the Xlix package.
 *
 * (c) Florian Kasper <xlix@khnetworks.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xlix\Bundle\Routing\Ofwn;

use Symfony\Component\HttpFoundation\Request;
use Xlix\Bundle\Config\ConfigManager;

/**
 * Basic utils
 *
 *
 * @author  Florian Kasper <xlix@khnetworks.com>
 * @see     http://version.xlix.eu
 *
 */
class OfwnUtils {

    public $config;
    public $configManager;

    /**
     * @var array responsecodes
     * @deprecated since version 0x02
     */
    public static $statuscodes = array(
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing', // RFC2518
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status', // RFC4918
        208 => 'Already Reported', // RFC5842
        226 => 'IM Used', // RFC3229
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => 'Reserved',
        307 => 'Temporary Redirect',
        308 => 'Permanent Redirect', // RFC-reschke-http-status-308-07
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot', // RFC2324
        422 => 'Unprocessable Entity', // RFC4918
        423 => 'Locked', // RFC4918
        424 => 'Failed Dependency', // RFC4918
        425 => 'Reserved for WebDAV advanced collections expired proposal', // RFC2817
        426 => 'Upgrade Required', // RFC2817
        428 => 'Precondition Required', // RFC6585
        429 => 'Too Many Requests', // RFC6585
        431 => 'Request Header Fields Too Large', // RFC6585
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates (Experimental)', // RFC2295
        507 => 'Insufficient Storage', // RFC4918
        508 => 'Loop Detected', // RFC5842
        510 => 'Not Extended', // RFC2774
        511 => 'Network Authentication Required', // RFC6585
    );

    public function __construct() {
        $this->configManager = $this->getConfig();
        $this->config = $this->configManager->getConfig();
    }

    /**
     * gets the current request base url 
     * 
     * @return string
     */
    public function getBaseUrl() {

        return self::getRequest()->getBaseUrl();
    }

    /**
     * gets the current request URI just a very simple function
     * 
     * @return string
     */
    public function getRequestUri() {
        return self::getRequest()->getRequestUri();
    }

    /**
     * gets everything after the prefix:
     * PREFIX = /web
     * URI = /web/access/restricted
     * will return /access/restricted
     * 
     * @return string
     * @todo write the function ;)
     */
    public function getCuttedRoute() {
        
    }

    /**
     * Calls hardcoded the configuration manager Class and gets the config array
     * 
     * @return object
     */
    public function getConfig() {
        return new ConfigManager('Resources/config/ofwn.yml');
    }

    /**
     * Calls hardcoded the Request Object from the Symfony2 package
     * 
     * @return Request
     * @todo Write my own Request Class
     */
    public static function getRequest() {
        return new Request($_GET, $_POST, pathinfo(2), $_COOKIE, $_FILES, $_SERVER);
    }

    /**
     * gets the response (symfony atm)
     * 
     * @return object
     * @todo Write my own Response class and first of all use a response;)
     */
    public function getResponse() {
        
    }

    ///isSes
    /**
     * checks if $instance is an object
     * 
     * @param mixed $instance
     * @return boolean
     */
    public function isClass($instance) {
        return is_object($instance);
    }

    /**
     * checks if a directory is existing and writeable!
     * 
     * @param string $directory
     * @return boolean
     */
    public function isExDir($directory) {
        return is_dir($directory) && is_writable($directory);
    }

    /**
     * gets a HTTP STATUS MESSAGE from a status code
     * 
     * @param int $code
     * @return string
     */
    public static function getStatusCodeMessage($code) {
        return self::$statuscodes[$code];
    }

}