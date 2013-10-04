<?php
namespace Ground\Core\Interfaces;

/**
 * Defines an interface for a ground validator
 *
 * @author Simon Holloway <holloway.sy@gmail.com>
 */
interface ValidatorInterface
{
    public function validateField(FieldInterface $field);

    public function addRule(RuleInterface $rule);
    public function removeRule(RuleInterface $rule);
    public function getRules();
    public function getRule($ruleid);

    public function resetErrors();
    public function hasErrors();
}
