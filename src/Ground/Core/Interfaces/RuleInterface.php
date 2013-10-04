<?php
namespace Ground\Core\Interfaces;

/**
 * Defines an interface for a ground rule
 *
 * @author Simon Holloway <holloway.sy@gmail.com>
 */
interface RuleInterface
{
    public function getId();
    public function getDefaultMessage(FieldInterface $field);
    public function check(FieldInterface $field);
}
