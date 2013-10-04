<?php
namespace Ground\Core;

use Ground\Core\Interfaces\FieldInterface;
use Exception;

/**
 *
 * @author Simon Holloway <holloway.sy@gmail.com>
 */
class Generator
{
    private $content;

    private $types = array(
        'text' => 'Ground\\Core\\Fields\\TextBox',
        'form' => 'Ground\\Core\\Form'
    );

    public function __construct($array)
    {
        $this->content = $array;
    }

    public function get()
    {
        return $this->createFromArray($this->content);
    }

    private function createFromArray($array)
    {
        $isa = is_array($array);
        $hast = isset($array['type']);
        $hasid = isset($array['id']);
        if (false == $isa || false == $hast || false == $hasid) {
            return false;
        }

        /**
         * Create field based on type here
         */
        if (isset($this->types[$array['type']])) {
            $field = new $this->types[$array['type']]($array['id']);
        } elseif (class_exists($array['type'])) {
            $field = new $array['type']($array['id']);
        } else {
            return false;
        }

        unset($array['id']);
        unset($array['type']);

        foreach ($array as $key => $value) {

            if ('fields' == $key) {
                foreach ($value as $childarray) {
                    $newfield = $this->createFromArray($childarray);
                    if ($newfield instanceof FieldInterface) {
                        $field->addField($newfield);
                    }
                }
                continue;
            }

            if (is_callable(array($field, 'set'. ucfirst($key)))) {
                $method = 'set'. ucfirst($key);
                $cufaparam = (is_array($value)) ? $value : array($value);
                call_user_func_array(array($field, $method), $cufaparam);
                continue;
            }

            if (substr($key, -1) == 's') {
                $singular = substr($key, 0, -1);
                $method = 'add'. ucfirst($singular);
                if (is_callable(array($field, $method))) {
                    foreach ($value as $subvalue) {
                        $cufaparam = (is_array($subvalue))
                            ? $subvalue : array($subvalue);
                        call_user_func_array(array($field, $method), $cufaparam);
                    }
                    continue;
                }
            }
            

            $field->setOption($key, $value);
        }
        
        return $field;
    }

    public static function usingArray($array)
    {
        return new self($array);
    }

    public static function usingArrayFile($file)
    {
        if (false == is_readable($file)) {
            throw new Exception('File not readable: "' . $file . '"');
        }

        $array = include($file);

        if (is_null($array)) {
            throw new Exception('Array not present in file: "' . $file . '"');
        }

        return new self($array);
    }

    public static function usingJsonString($json)
    {
        $array = json_decode($json, true);

        if (is_null($array)) {
            throw new Exception('Json not valid in file: "' . $file . '"');
        }

        return new self($array);
    }

    public static function usingJsonFile($file)
    {
        if (false == is_readable($file)) {
            throw new Exception('File not readable: "' . $file . '"');
        }

        $json = file_get_contents($file);

        $array = json_decode($json, true);

        if (is_null($array)) {
            throw new Exception('Json not valid in file: "' . $file . '"');
        }

        return new self($array);
    }
}
