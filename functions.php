<?php

namespace Audentio\OpisClosureWrapper;

function serialize($data)
{
    SerializableClosure::enterContext();
    SerializableClosure::wrapClosures($data);
    $data = \serialize($data);
    SerializableClosure::exitContext();

    return $data;
}

function unserialize($data, array $options = null)
{
    SerializableClosure::enterContext();
    $data = ($options === null || \PHP_MAJOR_VERSION < 7)
        ? \unserialize($data)
        : \unserialize($data, $options);
    SerializableClosure::unwrapClosures($data);
    SerializableClosure::exitContext();
    return $data;
}
