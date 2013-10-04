<?php
namespace Ground\Core;

use \Ground\Core\Interfaces\FieldInterface;
use \Ground\Core\Interfaces\ValidatorInterface;
use \Ground\Core\Interfaces\RuleInterface;

/**
 * Standard ground validator, use ground rules to extend
 *
 * @author Simon Holloway <holloway.sy@gmail.com>
 */
class Validator implements ValidatorInterface
{
    protected $rules = array();

    protected $haserrors = false;

    public function validateField(FieldInterface $field)
    {
        foreach ($field->getRules() as $fieldrule) {

            if ($rule = $this->getRule($fieldrule['rule'])) {

                if (false == $rule->check($field, $fieldrule['param'])) {

                    if (is_null($fieldrule['message'])) {
                        $message = $rule->getDefaultMessage(
                            $field,
                            $fieldrule['param']
                        );
                    } else {
                        $message = $fieldrule['message'];
                    }

                    $this->fail($message, $field);
                }
            }
        }

        foreach ($field as $child) {
            $this->validateField($child);
        }
    }

    public function addRule(RuleInterface $rule)
    {
        $this->rules[] = $rule;

        return $this;
    }

    public function removeRule(RuleInterface $rule)
    {
        if (false !== ($key = array_search($rule, $this->rules, true))) {
            unset($this->rules[$key]);
        }

        return $this;
    }

    public function getRules()
    {
        return $this->rules;
    }

    public function getRule($ruleid)
    {
        foreach ($this->rules as $rule) {
            if ($rule->getId() == $ruleid) {
                return $rule;
            }
        }

        return false;
    }
    
    protected function fail($message, $field)
    {
        $this->haserrors = true;

        $field->addError($message);
    }

    public function resetErrors()
    {
        $this->haserrors = false;
    }

    public function hasErrors()
    {
        return $this->haserrors;
    }
}
