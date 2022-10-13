<?php

namespace Contracts;

use ReflectionClass;

/**
 * 枚举常量抽象类
 *
 * @author jw
 * @since 2021-12-14
 */
abstract class AbstractConstants
{
    public static function all()
    {
        $className = get_called_class();
        $reflectionClass = new ReflectionClass($className);
        return $reflectionClass->getConstants();
    }
}