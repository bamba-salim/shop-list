<?php

abstract class DTO
{

    static public function build_list($array): array
    {
        return array_map(get_called_class() . "::builder", array_keys($array), array_values($array));
    }

    static public function builder($id, $values)
    {
        return call_user_func(get_called_class() . "::build", $id, (object)$values);
    }

    abstract static public function build($id, $object);

    abstract static public function buildToSave($inputs);
}