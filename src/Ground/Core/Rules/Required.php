<?php
namespace Ground\Core\Rules;

use \Ground\Core\Interfaces\RuleInterface;
use \Ground\Core\Interfaces\FieldInterface;

/**
 * Required field rule
 *
 * @author Simon Holloway <holloway.sy@gmail.com>
 */
class Required implements RuleInterface
{
    public function getId()
    {
        return 'required';
    }

    public function getDefaultMessage(FieldInterface $field)
    {
        return 'This field is required';
    }

    public function check(FieldInterface $field)
    {
        $value = $field->getValue();
        return false === empty($value);
    }
}
