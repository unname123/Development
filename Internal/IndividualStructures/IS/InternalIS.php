<?php namespace ZN\IndividualStructures;

use Arrays, Strings, Support, Chars, Filters;

class InternalIS implements InternalISInterface
{
    //--------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------

    protected $dataTypes = ['cookie', 'session', 'get', 'post', 'env', 'server'];

    //--------------------------------------------------------------------------------------------------
    // Magig Call -> 5.3.11 - 5.3.2[edited]
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $method
    // @param array  $parameters
    //
    //--------------------------------------------------------------------------------------------------
    public function __call($method, $parameters)
    {
        if( function_exists($ctype = 'ctype_' . $method) )
        {
            return $ctype((string) $parameters[0]);
        }

        // 5.3.2[edited]
        if( Arrays::valueExists($this->dataTypes, $method) )
        {
            return Filters::$method($parameters[0]);
        }

        $methods = Strings::splitUpperCase($realMethod = $method);
        $method  = implode('_', Arrays::lowerCase($methods));
        $method  = 'is_' . $method;

        if( ! function_exists($method) )
        {
            Support::classMethod(__CLASS__, $realMethod);
        }

        return $method(...$parameters);
    }

    //--------------------------------------------------------------------------------------------------
    // timeZone() -> 5.2.6
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $timezone
    //
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------
    public function timeZone(String $timezone) : Bool
    {
        return Arrays::valueExists(timezone_identifiers_list(), $timezone);
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
    public function phpVersion(String $version = '5.2.4')
    {
        return (bool) version_compare(PHP_VERSION, $version, '>=');
    }

    //--------------------------------------------------------------------------------------------------
    // isImport()
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $path
    //
    // @return Bool
    //
    //--------------------------------------------------------------------------------------------------
    public function import(String $path) : Bool
    {
        return in_array( realpath(suffix($path, '.php')), get_required_files() );
    }

    //--------------------------------------------------------------------------------------------------
    // isUrl()
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $url
    //
    // @return Bool
    //
    //--------------------------------------------------------------------------------------------------
    public function url(String $url) : Bool
    {
        return preg_match('#^(\w+:)?//#i', $url);
    }

    //--------------------------------------------------------------------------------------------------
    // isEmail()
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $email
    //
    // @return Bool
    //
    //--------------------------------------------------------------------------------------------------
    public function email(String $email) : Bool
    {
        return preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email);
    }

    //--------------------------------------------------------------------------------------------------
    // isChar()
    //--------------------------------------------------------------------------------------------------
    //
    // @param mixed $str
    //
    // @return Bool
    //
    //--------------------------------------------------------------------------------------------------
    public function char($str) : Bool
    {
        return is_scalar($str);
    }

    //--------------------------------------------------------------------------------------------------
    // isRealNumeric()
    //--------------------------------------------------------------------------------------------------
    //
    // @param numeric $num = 0
    //
    // @return Bool
    //
    //--------------------------------------------------------------------------------------------------
    public function realNumeric($num = 0) : Bool
    {
        return ! is_string($num) && is_numeric($num);
    }

    //--------------------------------------------------------------------------------------------------
    // isDeclaredClass()
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $class
    //
    // @return Bool
    //
    //--------------------------------------------------------------------------------------------------
    public function declaredClass(String $class) : Bool
    {
        return in_array(strtolower($class), array_map('strtolower', get_declared_classes()));
    }

    //--------------------------------------------------------------------------------------------------
    // isHash()
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $type
    //
    // @return Bool
    //
    //--------------------------------------------------------------------------------------------------
    public function hash(String $type) : Bool
    {
        $hashAlgos = Arrays::addLast(hash_algos(), ['super', 'golden']);

        return in_array($type, $hashAlgos);
    }

    //--------------------------------------------------------------------------------------------------
    // isCharset()
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $charset
    //
    // @return Bool
    //
    //--------------------------------------------------------------------------------------------------
    public function charset(String $charset) : Bool
    {
        return array_search(strtolower($charset), array_map('strtolower', mb_list_encodings()), true);
    }

    //--------------------------------------------------------------------------------------------------
    // isArray
    //--------------------------------------------------------------------------------------------------
    //
    // @param mixed $array
    //
    // @return Bool
    //
    //--------------------------------------------------------------------------------------------------
    public function array($array) : Bool
    {
        return ! empty($array) && is_array($array);
    }
}
