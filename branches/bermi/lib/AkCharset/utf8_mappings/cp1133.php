<?php

/**
*@file cp1133.php
* CP1133 Mapping and Charset implementation.
*
*/

//
// +----------------------------------------------------------------------+
// | Akelos PHP Application Framework                                     |
// +----------------------------------------------------------------------+
// | Copyright (c) 2002-2005, Akelos Media, S.L.  http://www.akelos.org/  |
// | Released under the GNU Lesser General Public License                 |
// +----------------------------------------------------------------------+
// | You should have received the following files along with this library |
// | - COPYRIGHT (Additional copyright notice)                            |
// | - DISCLAIMER (Disclaimer of warranty)                                |
// | - README (Important information regarding this library)              |
// +----------------------------------------------------------------------+
//





/**
* CP1133  driver for Charset Class
*
* Charset::cp1133 provides functionality to convert
* CP1133 strings, to UTF-8 multibyte format and vice versa.
*
* @package AKELOS
* @subpackage Localize
* @author Bermi Ferrer Martinez <bermi@akelos.org>
* @copyright Copyright (c) 2002-2005, Akelos Media, S.L. http://www.akelos.org
* @license GNU Lesser General Public License <http://www.gnu.org/copyleft/lesser.html>
* @link http://www.unicode.org/Public/MAPPINGS/ Original Mapping taken from Unicode.org
* @since 0.1
* @version $Revision 0.1 $
*/
class cp1133 extends AkCharset
{


	// ------ CLASS ATTRIBUTES ------ //



	// ---- Private attributes ---- //


	/**
	* CP1133 to UTF-8 mapping array.
	*
	* @access private
	* @var    array    $_toUtfMap
	*/
	var $_toUtfMap = array(0=>0,1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,11=>11,12=>12,13=>13,14=>14,15=>15,16=>16,17=>17,18=>18,19=>19,20=>20,21=>21,22=>22,23=>23,24=>24,25=>25,26=>26,27=>27,28=>28,29=>29,30=>30,31=>31,32=>32,33=>33,34=>34,35=>35,36=>36,37=>37,38=>38,39=>39,40=>40,41=>41,42=>42,43=>43,44=>44,45=>45,46=>46,47=>47,48=>48,49=>49,50=>50,51=>51,52=>52,53=>53,54=>54,55=>55,56=>56,57=>57,58=>58,59=>59,60=>60,61=>61,62=>62,63=>63,64=>64,65=>65,66=>66,67=>67,68=>68,69=>69,70=>70,71=>71,72=>72,73=>73,74=>74,75=>75,76=>76,77=>77,78=>78,79=>79,80=>80,81=>81,82=>82,83=>83,84=>84,85=>85,86=>86,87=>87,88=>88,89=>89,90=>90,91=>91,92=>92,93=>93,94=>94,95=>95,96=>96,97=>97,98=>98,99=>99,100=>100,101=>101,102=>102,103=>103,104=>104,105=>105,106=>106,107=>107,108=>108,109=>109,110=>110,111=>111,112=>112,113=>113,114=>114,115=>115,116=>116,117=>117,118=>118,119=>119,120=>120,121=>121,122=>122,123=>123,124=>124,125=>125,126=>126,127=>127,128=>128,129=>129,130=>130,131=>131,132=>132,133=>133,134=>134,135=>135,136=>136,137=>137,138=>138,139=>139,140=>140,141=>141,142=>142,143=>143,144=>144,145=>145,146=>146,147=>147,148=>148,149=>149,150=>150,151=>151,152=>152,153=>153,154=>154,155=>155,156=>156,157=>157,158=>158,159=>159,160=>160,161=>3713,162=>3714,163=>3716,164=>3719,165=>3720,166=>3754,167=>3722,168=>3725,169=>3732,170=>3733,171=>3734,172=>3735,173=>3737,174=>3738,175=>3739,176=>3740,177=>3741,178=>3742,179=>3743,180=>3745,181=>3746,182=>3747,183=>3749,184=>3751,185=>3755,186=>3757,187=>3758,191=>3759,192=>3760,193=>3762,194=>3763,195=>3764,196=>3765,197=>3766,198=>3767,199=>3768,200=>3769,201=>3772,202=>3761,203=>3771,204=>3773,208=>3776,209=>3777,210=>3778,211=>3779,212=>3780,213=>3784,214=>3785,215=>3786,216=>3787,217=>3788,218=>3789,219=>3782,221=>3804,222=>3805,223=>8365,240=>3792,241=>3793,242=>3794,243=>3795,244=>3796,245=>3797,246=>3798,247=>3799,248=>3800,249=>3801,252=>162,253=>172,254=>166);
		

	/**
	*  UTF-8 to CP1133 mapping array.
	*
	* @access private
	* @var    array    $_fromUtfMap
	*/
	var $_fromUtfMap = null;


	// ------------------------------



	// ------ CLASS METHODS ------ //


	// ---- Public methods ---- //


	/**
	* Encodes given CP1133 string into UFT-8
	*
	* @access public
	* @see UtfDecode
	* @param    string    $string CP1133 string
	* @return    string    UTF-8 string data
	*/
	function _Utf8StringEncode($string)
	{
		return parent::_Utf8StringEncode($string, $this->_toUtfMap);
	
	}// -- end of &Utf8StringEncode -- //

	/**
	* Decodes given UFT-8 string into CP1133
	*
	* @access public
	* @see UtfEncode
	* @param    string    $string UTF-8 string
	* @return    string    CP1133 string data
	*/
	function _Utf8StringDecode($string)
	{
		$this->_LoadInverseMap();
		return parent::_Utf8StringDecode($string, $this->_fromUtfMap);
	}// -- end of &Utf8StringDecode -- //
		
		
	// ---- Private methods ---- //
		
	/**
	* Flips $this->_toUtfMap to $this->_fromUtfMap
	*
	* @access private
	* @return	null
	*/
	function _LoadInverseMap()
	{
		static $loaded;
		if(!isset($loaded)){
			$loaded = true;
			$this->_fromUtfMap = array_flip($this->_toUtfMap);
		}
	}// -- end of _LoadInverseMap -- //
	
}

?>