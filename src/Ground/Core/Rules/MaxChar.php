<?php
namespace Ground\Core\Rules;

use \Ground\Core\Interfaces\RuleInterface;
use \Ground\Core\Interfaces\FieldInterface;

/**
 * Max character limit rule
 *
 * @author Simon Holloway <holloway.sy@gmail.com>
 */
class MaxChar implements RuleInterface
{
    public function getId()
    {
        return 'max-char';
    }

    public function getDefaultMessage(FieldInterface $field, $maxchar = 0)
    {
        return 'This field must be no more than ' . $maxchar . ' characters';
    }

    public function check(FieldInterface $field, $maxchar = 0)
    {
        $value = (string)$field->getValue();
        return (is_string($value) && strlen($value) <= $maxchar);
    }
}
