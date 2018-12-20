<?php

namespace Sayla\Helper\Data;

use Sayla\Exception\ClassPropertyError;

abstract class StandardObject extends \stdClass
{
    protected const PROP_GET_METHOD_PREFIX = 'get';
    protected const PROP_ISSET_METHOD_PREFIX = 'isset';
    protected const PROP_METHOD_CACHE_KEY = null;
    protected const PROP_METHOD_SUFFIX = '';
    protected const PROP_SET_METHOD_PREFIX = 'set';
    protected const PROP_UNSET_METHOD_PREFIX = 'unset';
    private static $cache = [];

    public function __get($offset)
    {
        return $this->getPropertyValue($offset);
    }

    public function __set($offset, $value)
    {
        $this->setPropertyValue($offset, $value);
    }

    protected function getPropertyValue(string $propertyName)
    {
        $method = static::PROP_GET_METHOD_PREFIX . ucfirst($propertyName) . static::PROP_METHOD_SUFFIX;
        if ($this->methodExists($method)) {
            return $this->$method();
        } else {
            throw new ClassPropertyError('undefined property: ' . static::class . '.' . $propertyName);
        }
    }

    /**
     * @param $method
     * @return bool
     */
    private function methodExists($method): bool
    {
        if ($this->usingCache() && isset(self::$cache[static::PROP_METHOD_CACHE_KEY]['m_' . $method])) {
            return self::$cache[static::PROP_METHOD_CACHE_KEY]['m_' . $method];

        }
        $exists = method_exists(static::class, $method);
        if ($this->usingCache()) {
            self::$cache[static::PROP_METHOD_CACHE_KEY]['m_' . $method] = $exists;
        }
        return $exists;

    }

    /**
     * @return bool
     */
    private function usingCache(): bool
    {
        return static::PROP_METHOD_CACHE_KEY !== null;
    }

    protected function setPropertyValue(string $propertyName, $value): void
    {
        $method = static::PROP_SET_METHOD_PREFIX . ucfirst($propertyName) . static::PROP_METHOD_SUFFIX;
        if ($this->methodExists($method)) {
            $this->$method($value);
        } else {
            throw new ClassPropertyError('undefined property: ' . static::class . '.' . $propertyName);
        }
    }

    public function __isset($offset)
    {
        return $this->isPropertyValueSet($offset);
    }

    protected function isPropertyValueSet(string $propertyName)
    {
        if (isset($this->{$propertyName})) {
            return true;
        }
        $method = static::PROP_ISSET_METHOD_PREFIX . ucfirst($propertyName) . static::PROP_METHOD_SUFFIX;
        if ($this->methodExists($method)) {
            return $this->$method();
        }
        $method = static::PROP_GET_METHOD_PREFIX . ucfirst($propertyName) . static::PROP_METHOD_SUFFIX;
        return $this->propertyMethodHasReturnType($method);
    }

    protected function propertyMethodHasReturnType(string $method)
    {
        if ($this->usingCache() && isset(self::$cache[static::PROP_METHOD_CACHE_KEY]['r_' . $method])) {
            return self::$cache[static::PROP_METHOD_CACHE_KEY]['r_' . $method];
        }
        $hasReturnType = false;
        if ($this->methodExists($method)) {
            $reflection = new \ReflectionMethod(get_class($this), $method);
            $hasReturnType = $reflection->hasReturnType();
        }
        if ($this->usingCache()) {
            self::$cache[static::PROP_METHOD_CACHE_KEY]['r_' . $method] = $hasReturnType;
        }
        return $hasReturnType;
    }

    public function __unset($offset)
    {
        return $this->unsetPropertyValue($offset);
    }

    protected function unsetPropertyValue(string $propertyName)
    {
        $method = static::PROP_UNSET_METHOD_PREFIX . ucfirst($propertyName) . static::PROP_METHOD_SUFFIX;
        if ($this->methodExists($method)) {
            return $this->$method();
        } else {
            throw new ClassPropertyError('can not unset property: ' . static::class . '.' . $propertyName);
        }
    }

    protected function fillPropertyValues(iterable $items)
    {
        foreach ($items as $k => $v) {
            $this->setPropertyValue($k, $v);
        }
        return $this;
    }

}