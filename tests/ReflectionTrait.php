<?php
declare(strict_types=1);

namespace Tests;

trait ReflectionTrait
{
    /**
     * @param object $object
     * @param string $attribute
     * @return mixed
     * @throws \ReflectionException
     */
    public function getPrivateProperty(object $object, string $attribute)
    {
        $reflection = new \ReflectionObject($object);
        $property = $reflection->getProperty($attribute);
        $property->setAccessible(true);

        return $property->getValue($object);
    }

    /**
     * @param object $object
     * @param string $attribute
     * @param mixed $value
     * @throws \ReflectionException
     */
    public function setPrivateProperty(object $object, string $attribute, $value): void
    {
        $reflection = new \ReflectionObject($object);
        $property = $reflection->getProperty($attribute);
        $property->setAccessible(true);
        $property->setValue($object, $value);
    }
}
