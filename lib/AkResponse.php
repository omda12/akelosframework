<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

// +----------------------------------------------------------------------+
// | Akelos Framework - http://www.akelos.org                             |
// +----------------------------------------------------------------------+
// | Copyright (c) 2002-2006, Akelos Media, S.L.  & Bermi Ferrer Martinez |
// | Released under the GNU Lesser General Public License, see LICENSE.txt|
// +----------------------------------------------------------------------+

require_once(AK_LIB_DIR.DS.'AkObject.php');

/**
 * @package AkelosFramework
 * @subpackage AkActionController
 * @author Bermi Ferrer <bermi a.t akelos c.om>
 * @copyright Copyright (c) 2002-2006, Akelos Media, S.L. http://www.akelos.org
 * @license GNU Lesser General Public License <http://www.gnu.org/copyleft/lesser.html>
 */
class AkResponse extends AkObject
{
    var $_resutl_stack = array();
    var $_headers = array();
    var $_headers_sent = array();
    var $body = '';

    function set($data, $id = null)
    {
        if(isset($id)){
            $this->_resutl_stack[$id] = $data;
        }else{
            $this->_resutl_stack[] = $data;
        }
    }

    function &get($id)
    {
        if(isset($this->_resutl_stack[$id])){
            return $this->_resutl_stack[$id];
        }
        return false;
    }

    function getAll()
    {
        return $this->_resutl_stack;
    }

    function addHeader()
    {
        $args = func_get_args();
        if(!empty($args[1])){
            $this->_headers[$args[0]] = $args[1];
        }elseif (!empty($args[0]) && is_array($args[0])){
            $this->_headers = array_merge($this->_headers,$args[0]);
        }elseif (!empty($args[0])){
            $this->_headers[] = $args[0];
        }
    }

    function outputResults()
    {
         Ak::profile('Started sending response'.__CLASS__.'::'.__FUNCTION__.' '.__FILE__.' on line '.__LINE__);
        $this->sendHeaders();
        if(is_object($this->body) && method_exists($this->body,'stream')){
            $this->body->stream();
        }else{
            echo $this->body;
        }
    }

    function sendHeaders($terminate_if_redirected = true)
    {
        /**
         * Fix a problem with IE 6.0 on opening downloaded files:
         * If Cache-Control: IE removes the file it just downloaded from 
         * its cache immediately 
         * after it displays the "open/save" dialog, which means that if you 
         * hit "open" the file isn't there anymore when the application that 
         * is called for handling the download is run, so let's workaround that
         */
        if(isset($this->_headers['Cache-Control']) && $this->_headers['Cache-Control'] == 'no-cache'){
            $this->_headers['Cache-Control'] = 'private';
        }
        if(!empty($this->_headers['Status'])){
            $status = $this->_getStatusHeader($this->_headers['Status']);
            array_unshift($this->_headers,  $status ? $status : (strstr('HTTP/1.1 '.$this->_headers['Status'],'HTTP') ? $this->_headers['Status'] : 'HTTP/1.1 '.$this->_headers['Status']));
            unset($this->_headers['Status']);
        }
        
        if(!empty($this->_headers) && is_array($this->_headers)){
            foreach ($this->_headers as $k=>$v){
                $header = trim((!is_numeric($k) ? $k.': ' : '').$v);
                $this->_headers_sent[] = $header;
                if(strtolower(substr($header,0,9)) == 'location:'){
                    $_redirected = true;
                    if(AK_DESKTOP){
                        $javascript_redirection = '<title>'.Ak::t('Loading...').'</title><script type="text/javascript">location = "'.substr($header,9).'";</script>';
                        continue;
                    }
                }
                if(strtolower(substr($header,0,13)) == 'content-type:'){
                    $_has_content_type = true;
                }
                header($header);
            }
        }
        
        if(empty($_has_content_type) && defined('AK_CHARSET') && (empty($_redirected) || (!empty($_redirected) && !empty($javascript_redirection)))){
            header('Content-Type: text/html; charset='.AK_CHARSET);
            $this->_headers_sent[] = 'Content-Type: text/html; charset='.AK_CHARSET;
        }
        
        if(!empty($javascript_redirection)){
            echo $javascript_redirection;
        }
        
        $terminate_if_redirected ? (!empty($_redirected) ? exit() : null) : null;
    }
    
    function deleteHeader($header)
    {
        unset($this->_headers[$header]);
    }

    /**
    * Redirects to given $url, after turning off $this->autoRender.
    *
    * @param unknown_type $url
    */
    function redirect ($url)
    {
        $this->autoRender = false;
        if(!empty($this->_headers['Status']) && substr($this->_headers['Status'],0,3) != '301'){
            $this->_headers['Status'] = 302;    
        }
        $this->addHeader('Location', $url);
        $this->sendHeaders();
    }


    function _getStatusHeader($status_code)
    {
        $status_codes = array (
        100 => "HTTP/1.1 100 Continue",
        101 => "HTTP/1.1 101 Switching Protocols",
        200 => "HTTP/1.1 200 OK",
        201 => "HTTP/1.1 201 Created",
        202 => "HTTP/1.1 202 Accepted",
        203 => "HTTP/1.1 203 Non-Authoritative Information",
        204 => "HTTP/1.1 204 No Content",
        205 => "HTTP/1.1 205 Reset Content",
        206 => "HTTP/1.1 206 Partial Content",
        300 => "HTTP/1.1 300 Multiple Choices",
        301 => "HTTP/1.1 301 Moved Permanently",
        302 => "HTTP/1.1 302 Found",
        303 => "HTTP/1.1 303 See Other",
        304 => "HTTP/1.1 304 Not Modified",
        305 => "HTTP/1.1 305 Use Proxy",
        307 => "HTTP/1.1 307 Temporary Redirect",
        400 => "HTTP/1.1 400 Bad Request",
        401 => "HTTP/1.1 401 Unauthorized",
        402 => "HTTP/1.1 402 Payment Required",
        403 => "HTTP/1.1 403 Forbidden",
        404 => "HTTP/1.1 404 Not Found",
        405 => "HTTP/1.1 405 Method Not Allowed",
        406 => "HTTP/1.1 406 Not Acceptable",
        407 => "HTTP/1.1 407 Proxy Authentication Required",
        408 => "HTTP/1.1 408 Request Time-out",
        409 => "HTTP/1.1 409 Conflict",
        410 => "HTTP/1.1 410 Gone",
        411 => "HTTP/1.1 411 Length Required",
        412 => "HTTP/1.1 412 Precondition Failed",
        413 => "HTTP/1.1 413 Request Entity Too Large",
        414 => "HTTP/1.1 414 Request-URI Too Large",
        415 => "HTTP/1.1 415 Unsupported Media Type",
        416 => "HTTP/1.1 416 Requested range not satisfiable",
        417 => "HTTP/1.1 417 Expectation Failed",
        500 => "HTTP/1.1 500 Internal Server Error",
        501 => "HTTP/1.1 501 Not Implemented",
        502 => "HTTP/1.1 502 Bad Gateway",
        503 => "HTTP/1.1 503 Service Unavailable",
        504 => "HTTP/1.1 504 Gateway Time-out"
        );
        return empty($status_codes[$status_code]) ? false : $status_codes[$status_code];
    }
}


function &AkResponse()
{
    $null = null;
    $AkResponse =& Ak::singleton('AkResponse', $null);
    return $AkResponse;
}

?>
