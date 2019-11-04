<?php

namespace Tests\Concerns;

use InvalidArgumentException;
use ReflectionMethod;
use ReflectionProperty;

/**
 * Trait NonPublicAccessible
 *
 * Help access to non-public property and method of an object
 *
 * @package     Tests\Concerns
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 */
trait NonPublicAccessible
{
    /**
     * Get a non public property of an object
     *
     * @param  object $obj       Instantiated object that we will get property on.
     * @param  string $property  Property name for getting
     * @return mixed             Value of property
     * @throws \InvalidArgumentException
     * @throws \ReflectionException
     */
    protected function getNonPublicProperty($obj, string $property)
    {
        if (!is_object($obj)) {
            throw new InvalidArgumentException('The first argument must be an object.');
        }
        $ref = new ReflectionProperty(get_class($obj), $property);
        $ref->setAccessible(true);

        return $ref->getValue($obj);
    }

    /**
     * Set value for a non public property of an object
     *
     * @param  object $obj       Instantiated object that we will set property on.
     * @param  string $property  Property name for setting
     * @param  mixed  $value     Value for set to property
     * @return void
     * @throws \InvalidArgumentException
     * @throws \ReflectionException
     */
    protected function setNonPublicProperty($obj, string $property, $value)
    {
        if (!is_object($obj)) {
            throw new InvalidArgumentException('The first argument must be an object.');
        }

        $ref = new ReflectionProperty(get_class($obj), $property);
        $ref->setAccessible(true);
        $ref->setValue($obj, $value);
    }

    /**
     * Call protected/private method of a class.
     *
     * @param  object $obj     Instantiated object that we will run method on.
     * @param  string $method  Method name to call
     * @param  array  $params  Array of parameters to pass into method.
     * @return mixed           Method return.
     * @throws \InvalidArgumentException
     * @throws \ReflectionException
     */
    protected function invokeNonPublicMethod($obj, string $method, ...$params)
    {
        if (!is_object($obj)) {
            throw new InvalidArgumentException('The first argument must be an object.');
        }

        $ref = new ReflectionMethod($obj, $method);
        $ref->setAccessible(true);

        return $ref->invokeArgs($obj, $params);
    }
}
