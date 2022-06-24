<?php

namespace Audentio\OpisClosureWrapper;

use Opis\Closure\SerializableClosure as BaseSerializableClosure;
use SplObjectStorage;

class SerializableClosure extends BaseSerializableClosure
{
    public static function wrapClosures(&$data, SplObjectStorage $storage = null)
    {
        if (
            !$data instanceof \Closure
            && !is_array($data)
            && !$data instanceof \stdClass
            && (is_object($data) && !$data instanceof static)
        ) {
            if (PHP_VERSION >= 7.1) {
                if ($data instanceof \DateTime) {
                    return;
                }
            }
        }

        parent::wrapClosures($data, $storage);
    }
}