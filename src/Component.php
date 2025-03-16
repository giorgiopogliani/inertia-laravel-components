<?php

namespace Performing\Inertia;

use Illuminate\Http\Request;

abstract class Component
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $reflection = new \ReflectionClass($this);
        $properties = $reflection->getProperties(\ReflectionProperty::IS_PUBLIC);

        foreach ($properties as $property) {
            $prop = $property->getName();
            if (request()->has($prop)) {
                $this->{$prop} = request()->get($prop);
            }
        }
    }

    public function toArray()
    {
        $headers = request()->headers->all();

        if (array_key_exists('x-inertia-action', $headers) && count($headers['x-inertia-action']) >= 1) {
            $name = $headers['x-inertia-action'][0];
            if (method_exists($this, $name)) {
                call_user_func([$this, $name]);
            }
        }

        $reflection = new \ReflectionClass($this);
        $properties = $reflection->getProperties(\ReflectionProperty::IS_PUBLIC);

        $data = [];
        foreach ($properties as $property) {
            $prop = $property->getName();
            $data[$prop] = $this->{$prop};
        }

        return $data;
    }
}
