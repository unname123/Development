<?php
//--------------------------------------------------------------------------------------------------
// Highest Level
//--------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// ZN_VERSION
//--------------------------------------------------------------------------------------------------
//
// @return ZN_VERSION
//
//--------------------------------------------------------------------------------------------------
define('ZN_VERSION', '4.6.0');

//--------------------------------------------------------------------------------------------------
// REQUIRED_PHP_VERSION
//--------------------------------------------------------------------------------------------------
//
// @return REQUIRED_PHP_VERSION
//
//--------------------------------------------------------------------------------------------------
define('REQUIRED_PHP_VERSION', '7.0.0');

//--------------------------------------------------------------------------------------------------
// Internal Constants Dir
//--------------------------------------------------------------------------------------------------
//
// Internal/Constants/
//
//--------------------------------------------------------------------------------------------------
define('INTERNAL_CONSTANTS_DIR', INTERNAL_DIR . 'Constants' . DS);

//--------------------------------------------------------------------------------------------------
// Internal Functions Dir
//--------------------------------------------------------------------------------------------------
//
// Internal/Functions/
//
//--------------------------------------------------------------------------------------------------
define('INTERNAL_FUNCTIONS_DIR', INTERNAL_DIR . 'Functions' . DS);

//--------------------------------------------------------------------------------------------------
// PROJECT_CONTROLLER_NAMESPACE
//--------------------------------------------------------------------------------------------------
//
// @return PROJECT_CONTROLLER_NAMESPACE
//
//--------------------------------------------------------------------------------------------------
define('PROJECT_CONTROLLER_NAMESPACE', 'Project\Controllers\\');

//--------------------------------------------------------------------------------------------------
// PROJECT_COMMANDS_NAMESPACE
//--------------------------------------------------------------------------------------------------
//
// @return PROJECT_COMMANDS_NAMESPACE
//
//--------------------------------------------------------------------------------------------------
define('PROJECT_COMMANDS_NAMESPACE', 'Project\Commands\\');

//--------------------------------------------------------------------------------------------------
// EXTERNAL_COMMANDS_NAMESPACE
//--------------------------------------------------------------------------------------------------
//
// @return EXTERNAL_COMMANDS_NAMESPACE
//
//--------------------------------------------------------------------------------------------------
define('EXTERNAL_COMMANDS_NAMESPACE', 'External\Commands\\');

//--------------------------------------------------------------------------------------------------
// DIRECTORY_INDEX
//--------------------------------------------------------------------------------------------------
//
// @return zeroneed.php
//
//--------------------------------------------------------------------------------------------------
define('DIRECTORY_INDEX', 'zeroneed.php');

//--------------------------------------------------------------------------------------------------
// INTERNAL_ACCESS
//--------------------------------------------------------------------------------------------------
//
// @return Static
//
//--------------------------------------------------------------------------------------------------
define('INTERNAL_ACCESS', 'Internal');

//--------------------------------------------------------------------------------------------------
// REQUEST_URI
//--------------------------------------------------------------------------------------------------
//
//  @return REQUEST_URI
//
//--------------------------------------------------------------------------------------------------
define('REQUEST_URI', $_SERVER['REQUEST_URI'] ?? NULL);

//--------------------------------------------------------------------------------------------------
// BASE_DIR
//--------------------------------------------------------------------------------------------------
//
// @return Uygulamanın bulunduğu dizinin yolu.
//
//--------------------------------------------------------------------------------------------------
define('BASE_DIR', explode(DIRECTORY_INDEX, $_SERVER['SCRIPT_NAME'])[0] ?? '/');

//--------------------------------------------------------------------------------------------------
// PROJECTS_DIR
//--------------------------------------------------------------------------------------------------
//
// @return Applications/
//
//--------------------------------------------------------------------------------------------------
define('PROJECTS_DIR', REAL_BASE_DIR.'Projects'.DS);

//--------------------------------------------------------------------------------------------------
// EXTERNAL_DIR
//--------------------------------------------------------------------------------------------------
//
// @return External/
//
//--------------------------------------------------------------------------------------------------
define('EXTERNAL_DIR', REAL_BASE_DIR.'External'.DS);

//--------------------------------------------------------------------------------------------------
// CLASSES_DIR
//--------------------------------------------------------------------------------------------------
//
// @return Internal/Classes/
//
//--------------------------------------------------------------------------------------------------
define('CLASSES_DIR', INTERNAL_DIR . 'Classes'.DS);

//--------------------------------------------------------------------------------------------------
// Import
//--------------------------------------------------------------------------------------------------
//
// Require Once
//
//--------------------------------------------------------------------------------------------------
function import(String $file)
{
    $constant = 'ImportFilePrefix' . $file;

    if( ! defined($constant) )
    {
        define($constant, true);

        return require $file;
    }
}

//--------------------------------------------------------------------------------------------------
// trace()
//--------------------------------------------------------------------------------------------------
//
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
//
//--------------------------------------------------------------------------------------------------
function trace(String $message)
{
    $style  = 'border:solid 1px #E1E4E5;';
    $style .= 'background:#FEFEFE;';
    $style .= 'padding:10px;';
    $style .= 'margin-bottom:10px;';
    $style .= 'font-family:Calibri, Ebrima, Century Gothic, Consolas, Courier New, Courier, monospace, Tahoma, Arial;';
    $style .= 'color:#666;';
    $style .= 'text-align:left;';
    $style .= 'font-size:14px;';

    $message = preg_replace('/\[(.*?)\]/', '<span style="color:#990000;">$1</span>', $message);

    $str  = "<div style=\"$style\">";
    $str .= $message;
    $str .= '</div>';

    exit($str);
}

//--------------------------------------------------------------------------------------------------
// isPhpVersion()
//--------------------------------------------------------------------------------------------------
//
// İşlev: Parametrenin geçerli php sürümü olup olmadığını kontrol eder.
// Parametreler: $version => Geçerliliği kontrol edilecek veri.
// Dönen Değerler: Geçerli sürümse true değilse false değerleri döner.
//
//--------------------------------------------------------------------------------------------------
function isPhpVersion(String $version = '5.2.4')
{
    return version_compare(PHP_VERSION, $version, '>=') ? true : false;
}

//--------------------------------------------------------------------------------------------------
// absoluteRelativePath()
//--------------------------------------------------------------------------------------------------
//
// Gerçek yolu yalın yola çevirir.
//
//--------------------------------------------------------------------------------------------------
function absoluteRelativePath(String $path = NULL)
{
    return str_replace([REAL_BASE_DIR, DS], [NULL, '/'], $path);
}
