<?php trait RevolvingAbility
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    protected $revolvings;

    //--------------------------------------------------------------------------------------------------------
    // Call
    //--------------------------------------------------------------------------------------------------------
    //
    // Magic Call
    //
    //--------------------------------------------------------------------------------------------------------
    public function __call($method, $param)
    {
        $this->$method = $param[0] ?? NULL;

        $this->revolvings[$method] = $this->$method;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Call Static -> 5.3.4
    //--------------------------------------------------------------------------------------------------------
    //
    // Magic Call
    //
    //--------------------------------------------------------------------------------------------------------
    public static function __callStatic($method, $param)
    {
        return (new self)->__call($method, $param);
    }

    //--------------------------------------------------------------------------------------------------------
    // Default Variables
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function defaultVariables()
    {
        $vars = get_class_vars(get_called_class());

        foreach( $vars as $key => $var )
        {
            $this->$key = NULL;
        }
    }
}
