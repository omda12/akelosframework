<?php

// If you need to customize the framework default settings or specify internationalization options,
// edit the files config/testing.php, config/development.php, config/production.php

/**
 * This function sets a constant and returns it's value. If constant has been already defined it
 * will reutrn its original value. 
 * 
 * Returns null in case the constant does not exist
 *
 * @param string $name
 * @param mixed $value
 */
function ak_define($name, $value = null)
{
    $name = strtoupper($name);
    $name = substr($name,0,3) == 'AK_' ? $name : 'AK_'.$name;
    return  defined($name) ? constant($name) : (is_null($value) ? null : (define($name, $value) ? $value : null));
}


defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('AK_BASE_DIR') ? null : define('AK_BASE_DIR', str_replace(DS.'config'.DS.'boot.php','',__FILE__));
defined('AK_CONFIG_DIR') ? null : define('AK_CONFIG_DIR', AK_BASE_DIR.DS.'config');

// If you need to customize the framework default settings or specify internationalization options,
// edit the files config/testing.php, config/development.php, config/production.php
if(AK_ENVIRONMENT != 'setup'){
    $akdb = $database_settings[strtolower(AK_ENVIRONMENT)];
    $dsn = $akdb['type'] == 'sqlite' ?
    'sqlite://'.urlencode($akdb['database_file']).'/?persist' :
    $akdb['type'].'://'.$akdb['user'].':'.$akdb['password'].'@'.$akdb['host'].
    (empty($akdb['port'])?'':':'.$akdb['port']).
    '/'.$akdb['database_name'].
    (!empty($akdb['options'])?'?'.$akdb['options']:'');

    require_once(AK_CONFIG_DIR.DS.AK_ENVIRONMENT.'.php');
}

unset($environment, $database_settings, $akdb);


// Locale settings ( you must create a file at /config/locales/ using en.php as departure point)
// Please be aware that your charset needs to be UTF-8 in order to edit the locales files
// auto will enable all the locales at config/locales/ dir
defined('AK_AVAILABLE_LOCALES') ? null : define('AK_AVAILABLE_LOCALES', 'auto');


// Set these constants in order to allow only these locales on web requests
// defined('AK_ACTIVE_RECORD_DEFAULT_LOCALES') ? null : define('AK_ACTIVE_RECORD_DEFAULT_LOCALES','en,es');
// defined('AK_APP_LOCALES') ? null : define('AK_APP_LOCALES','en,es');
// defined('AK_PUBLIC_LOCALES') ? null : define('AK_PUBLIC_LOCALES','en,es');

defined('AK_URL_REWRITE_ENABLED') ? null : define('AK_URL_REWRITE_ENABLED', true);

defined('AK_TIME_DIFFERENCE') ? null : define('AK_TIME_DIFFERENCE', 0); // Time difference from the webserver

// COMMENT THIS LINE IF YOU DONT WANT THE FRAMEWORK TO CONNECT TO THE DATABASE ON EACH REQUEST AUTOMATICALLY
defined('AK_WEB_REQUEST_CONNECT_TO_DATABASE_ON_INSTANTIATE') ? null : define('AK_WEB_REQUEST_CONNECT_TO_DATABASE_ON_INSTANTIATE', true);

defined('AK_CLI') ? null : define('AK_CLI', php_sapi_name() == 'cli');
defined('AK_WEB_REQUEST') ? null : define('AK_WEB_REQUEST', !empty($_SERVER['REQUEST_URI']));
defined('AK_REQUEST_URI') ? null : define('AK_REQUEST_URI', isset($_SERVER['REQUEST_URI']) ?
$_SERVER['REQUEST_URI'] :
$_SERVER['PHP_SELF'] .'?'.(isset($_SERVER['argv']) ? $_SERVER['argv'][0] : $_SERVER['QUERY_STRING']));

defined('AK_DEBUG') ? null : define('AK_DEBUG', AK_ENVIRONMENT == 'production' ? 0 : 1);

@error_reporting(AK_DEBUG ? E_ALL : 0);

defined('AK_CACHE_HANDLER') ? null : define('AK_CACHE_HANDLER', 2);

defined('AK_APP_DIR') ? null : define('AK_APP_DIR', AK_BASE_DIR.DS.'app');
defined('AK_APIS_DIR') ? null : define('AK_APIS_DIR', AK_APP_DIR.DS.'apis');
defined('AK_MODELS_DIR') ? null : define('AK_MODELS_DIR', AK_APP_DIR.DS.'models');
defined('AK_CONTROLLERS_DIR') ? null : define('AK_CONTROLLERS_DIR', AK_APP_DIR.DS.'controllers');
defined('AK_VIEWS_DIR') ? null : define('AK_VIEWS_DIR', AK_APP_DIR.DS.'views');
defined('AK_HELPERS_DIR') ? null : define('AK_HELPERS_DIR', AK_APP_DIR.DS.'helpers');
defined('AK_ELEMENTS_DIR') ? null : define('AK_ELEMENTS_DIR', AK_VIEWS_DIR.DS.'elements');
defined('AK_CACHE_DIR') ? null : define('AK_CACHE_DIR',AK_BASE_DIR.DS.'cache');
defined('AK_COMPONENTS_DIR') ? null : define('AK_COMPONENTS_DIR',AK_BASE_DIR.DS.'components');
defined('AK_PUBLIC_DIR') ? null : define('AK_PUBLIC_DIR', AK_BASE_DIR.DS.'public');
defined('AK_TEST_DIR') ? null : define('AK_TEST_DIR', AK_BASE_DIR.DS.'test');
defined('AK_SCRIPT_DIR') ? null : define('AK_SCRIPT_DIR',AK_BASE_DIR.DS.'script');

defined('AK_DEFAULT_LAYOUT') ? null : define('AK_DEFAULT_LAYOUT', 'application');

// Paths below this point refer to the Akelos Framework components.
defined('AK_FRAMEWORK_DIR') ? null : define('AK_FRAMEWORK_DIR', AK_BASE_DIR);
defined('AK_CONTRIB_DIR') ? null : define('AK_CONTRIB_DIR',AK_FRAMEWORK_DIR.DS.'vendor');
defined('AK_VENDOR_DIR') ? null : define('AK_VENDOR_DIR', AK_CONTRIB_DIR);
defined('AK_DOCS_DIR') ? null : define('AK_DOCS_DIR',AK_FRAMEWORK_DIR.DS.'docs');
defined('AK_LIB_DIR') ? null : define('AK_LIB_DIR',AK_FRAMEWORK_DIR.DS.'lib');


defined('AK_CONFIG_INCLUDED') ? null : define('AK_CONFIG_INCLUDED',true);
defined('AK_FW') ? null : define('AK_FW',true);

if(AK_ENVIRONMENT != 'setup'){
    defined('AK_UPLOAD_FILES_USING_FTP') ? null : define('AK_UPLOAD_FILES_USING_FTP', !empty($ftp_settings));
    defined('AK_READ_FILES_USING_FTP') ? null : define('AK_READ_FILES_USING_FTP', false);
    defined('AK_DELETE_FILES_USING_FTP') ? null : define('AK_DELETE_FILES_USING_FTP', !empty($ftp_settings));
    defined('AK_FTP_AUTO_DISCONNECT') ? null : define('AK_FTP_AUTO_DISCONNECT', !empty($ftp_settings));

    if(!empty($ftp_settings)){
        defined('AK_FTP_PATH') ? null : define('AK_FTP_PATH', $ftp_settings);
        unset($ftp_settings);
    }
}

@ini_set("arg_separator.output","&");

@ini_set("session.name","AK_SESSID");
@ini_set("include_path",(AK_LIB_DIR.PATH_SEPARATOR.AK_MODELS_DIR.PATH_SEPARATOR.AK_CONTRIB_DIR.DS.'pear'.PATH_SEPARATOR.ini_get("include_path")));
defined('AK_PHP5') ? null : define('AK_PHP5', version_compare(PHP_VERSION, '5', '>=') == 1 ? true : false);

if(!AK_CLI && AK_WEB_REQUEST){

    defined('AK_SITE_URL_SUFFIX') ? null : define('AK_SITE_URL_SUFFIX',
    '/'.str_replace(array(join(DS,array_diff((array)@explode(DS,AK_BASE_DIR),
    (array)@explode('/',AK_REQUEST_URI))), AK_BASE_DIR, DS),'',AK_BASE_DIR));

    defined('AK_AUTOMATIC_SSL_DETECTION') ? null : define('AK_AUTOMATIC_SSL_DETECTION', 1);

    defined('AK_PROTOCOL') ? null : define('AK_PROTOCOL',isset($_SERVER['HTTPS']) ? 'https://' : 'http://');
    defined('AK_HOST') ? null : define('AK_HOST', $_SERVER['SERVER_NAME'] == 'localhost' ? $_SERVER['SERVER_ADDR'] : $_SERVER['SERVER_NAME']);
    defined('AK_REMOTE_IP') ? null : define('AK_REMOTE_IP',(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']);
    $port = ($_SERVER['SERVER_PORT'] != 80 && AK_PROTOCOL == 'http://') ||
    ($_SERVER['SERVER_PORT'] != 443 && AK_PROTOCOL == 'https://')
    ? (empty($_SERVER['SERVER_PORT']) ? '' : ':'.$_SERVER['SERVER_PORT']) : '';


    $suffix = '';
    if(defined('AK_SITE_HTPSS_URL_SUFFIX') && isset($_SERVER['HTTPS'])){
        $suffix = AK_SITE_HTPSS_URL_SUFFIX;
        $port = strstr(AK_SITE_HTPSS_URL_SUFFIX,':') ? '' : $port;
    }elseif(defined('AK_SITE_URL_SUFFIX') && AK_SITE_URL_SUFFIX != ''){
        $suffix = AK_SITE_URL_SUFFIX;
        $port = strstr(AK_SITE_URL_SUFFIX,':') ? '' : $port;
    }
    if(!defined('AK_SITE_URL')){
        defined('AK_SITE_URL') ? null : define('AK_SITE_URL', trim(AK_PROTOCOL.AK_HOST, '/').$port.$suffix);
        defined('AK_URL') ? null : define('AK_URL', AK_SITE_URL);
    }else{
        if(AK_AUTOMATIC_SSL_DETECTION){
            defined('AK_URL') ? null : define('AK_URL', str_replace(array('https://','http://'),AK_PROTOCOL, AK_SITE_URL).$port.$suffix);
        }else{
            defined('AK_URL') ? null : define('AK_URL', AK_SITE_URL.$port.$suffix);
        }
    }
    defined('AK_CURRENT_URL') ? null : define('AK_CURRENT_URL', substr(AK_SITE_URL,0,strlen($suffix)*-1).AK_REQUEST_URI);

    unset($suffix, $port);
    defined('AK_COOKIE_DOMAIN') ? null : define('AK_COOKIE_DOMAIN', AK_HOST);
    // ini_set('session.cookie_domain', AK_COOKIE_DOMAIN);

}else{
    defined('AK_PROTOCOL') ? null : define('AK_PROTOCOL','http://');
    defined('AK_HOST') ? null : define('AK_HOST', 'localhost');
    defined('AK_REMOTE_IP') ? null : define('AK_REMOTE_IP','127.0.0.1');
    defined('AK_SITE_URL') ? null : define('AK_SITE_URL', 'http://localhost');
    defined('AK_URL') ? null : define('AK_URL', 'http://localhost/');
    defined('AK_CURRENT_URL') ? null : define('AK_CURRENT_URL', 'http://localhost/');
    defined('AK_COOKIE_DOMAIN') ? null : define('AK_COOKIE_DOMAIN', AK_HOST);
}

defined('AK_SESSION_HANDLER') ? null : define('AK_SESSION_HANDLER', 0);
defined('AK_SESSION_EXPIRE') ? null : define('AK_SESSION_EXPIRE', 600);
defined('AK_SESSION_NAME') ? null : define('AK_SESSION_NAME', 'AK_SESSID');

defined('AK_DESKTOP') ? null : define('AK_DESKTOP', AK_SITE_URL == 'http://akelos');

defined('AK_ASSET_HOST') ? null : define('AK_ASSET_HOST','');

if(!defined('AK_ASSET_URL_PREFIX')){
    defined('AK_ASSET_URL_PREFIX') ? null : define('AK_ASSET_URL_PREFIX',str_replace(array(AK_BASE_DIR,'\\','//'),array('','/','/'), AK_PUBLIC_DIR));
}


defined('AK_DEV_MODE') ? null : define('AK_DEV_MODE', AK_ENVIRONMENT == 'development');
defined('AK_AUTOMATICALLY_UPDATE_LANGUAGE_FILES') ? null : define('AK_AUTOMATICALLY_UPDATE_LANGUAGE_FILES', AK_DEV_MODE);
defined('AK_ENABLE_PROFILER') ? null : define('AK_ENABLE_PROFILER', false);
defined('AK_PROFILER_GET_MEMORY') ? null : define('AK_PROFILER_GET_MEMORY',false);

$ADODB_CACHE_DIR = AK_CACHE_DIR;

/**
 * Mode types for error reporting and loggin
 */
defined('AK_MODE_DISPLAY') ? null : define('AK_MODE_DISPLAY', 1);
defined('AK_MODE_MAIL') ? null : define('AK_MODE_MAIL', 2);
defined('AK_MODE_FILE') ? null : define('AK_MODE_FILE', 4);
defined('AK_MODE_DATABASE') ? null : define('AK_MODE_DATABASE', 8);
defined('AK_MODE_DIE') ? null : define('AK_MODE_DIE', 16);

defined('AK_LOG_EVENTS') ? null : define('AK_LOG_EVENTS', false);

defined('AK_ROUTES_MAPPING_FILE') ? null : define('AK_ROUTES_MAPPING_FILE', AK_CONFIG_DIR.DS.'routes.php');
defined('AK_OS') ? null : define('AK_OS', (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' ? 'WINDOWS' : 'UNIX'));
defined('AK_CHARSET') ? null : define('AK_CHARSET', 'UTF-8');

require_once(AK_LIB_DIR.DS.'Ak.php');

/*
if(!AK_CLI && (AK_DEBUG || AK_ENVIRONMENT == 'setup')){
    include_once(AK_LIB_DIR.DS.'AkDevelopmentErrorHandler.php');
    $__AkDevelopmentErrorHandler = new AkDevelopmentErrorHandler();
    set_error_handler(array(&$__AkDevelopmentErrorHandler, 'raiseError'));
}
*/

defined('AK_ACTION_CONTROLLER_DEFAULT_REQUEST_TYPE') ? null : define('AK_ACTION_CONTROLLER_DEFAULT_REQUEST_TYPE', 'web_request');
defined('AK_ACTION_CONTROLLER_DEFAULT_ACTION') ? null : define('AK_ACTION_CONTROLLER_DEFAULT_ACTION', 'index');

require_once(AK_LIB_DIR.DS.'AkActionController.php');

?>
