<?php
class RedisCounter extends ARedisCounter
{
    public function setValue($value = 0)
    {
        $value = (int)$value;

        if ($this->name === null)
        {
            throw new CException(get_class($this)." requires a name!");
        }

        if ($value >= 0)
        {
            $this->_value = $value;
            $this->getConnection()->getClient()->set($this->name, $value);
        }
        else
        {
            throw new CException("Value must be equal or greater then zero!");
        }

        return $this->_value;
    }
}