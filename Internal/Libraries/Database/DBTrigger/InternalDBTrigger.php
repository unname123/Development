<?php namespace ZN\Database;

class InternalDBTrigger extends Connection implements InternalDBTriggerInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Trigger
    //--------------------------------------------------------------------------------------------------------
    //
    // @var object
    //
    //--------------------------------------------------------------------------------------------------------
    protected $trigger;

    //--------------------------------------------------------------------------------------------------------
    // Database Manipulation Methods Başlangıç
    //--------------------------------------------------------------------------------------------------------

    public function __construct($settings = [])
    {
        parent::__construct($settings);

        $this->trigger = $this->_drvlib('Trigger', $settings);
    }

    //--------------------------------------------------------------------------------------------------------
    // user()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $user
    //
    //--------------------------------------------------------------------------------------------------------
    public function user(String $user) : InternalDBTrigger
    {
        $this->trigger->user($user);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // when()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $type: BEFORE, AFTER
    //
    //--------------------------------------------------------------------------------------------------------
    public function when(String $type) : InternalDBTrigger
    {
        $this->trigger->when($type);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // event()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $type: INSERT, UPDATE, DELETE
    //
    //--------------------------------------------------------------------------------------------------------
    public function event(String $type) : InternalDBTrigger
    {
        $this->trigger->event($type);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // order()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $type: FOLLOWS, PRECEDES
    //
    //--------------------------------------------------------------------------------------------------------
    public function order(String $type, String $name) : InternalDBTrigger
    {
        $this->trigger->order($type, $name);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // body()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $args: BEGIN $arg1; $arg2; .... $arg3; END;
    //
    //--------------------------------------------------------------------------------------------------------
    public function body(...$args) : InternalDBTrigger
    {
        $this->trigger->body(...$args);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // createTrigger()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    //
    //--------------------------------------------------------------------------------------------------------
    public function createTrigger(String $name)
    {
        $query = $this->trigger->createTrigger($name);

        return $this->_runQuery($query);
    }

    //--------------------------------------------------------------------------------------------------------
    // create()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    //
    //--------------------------------------------------------------------------------------------------------
    public function create(String $name)
    {
        return $this->createTrigger($name);
    }

    //--------------------------------------------------------------------------------------------------------
    // dropTrigger()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    //
    //--------------------------------------------------------------------------------------------------------
    public function dropTrigger(String $name)
    {
        $query = $this->trigger->dropTrigger($name);

        return $this->_runQuery($query);
    }

    //--------------------------------------------------------------------------------------------------------
    // dropTrigger()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    //
    //--------------------------------------------------------------------------------------------------------
    public function drop(String $name)
    {
        return $this->dropTrigger($name);
    }
}
