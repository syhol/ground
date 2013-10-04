<?php
namespace Ground\Core\Interfaces;

use \Ground\Core\Interfaces\WriterInterface;
use IteratorAggregate;
use Serializable;

/**
 * Defines an interface for a ground field
 *
 * @author Simon Holloway <holloway.sy@gmail.com>
 */
interface FieldInterface extends IteratorAggregate
{
    public function __construct($id);

    public function setId($id);
    public function getId();

    public function setParent(FieldInterface $field);
    public function getParent();

    public function getFullyQualifiedName();
    public function getFullyQualifiedId();

    public function setOption($key, $option);
    public function getOption($key);

    public function setValue($value);
    public function getValue();

    public function addError($error);
    public function removeError($error);
    public function getErrors();

    public function addRule($rule, $param = null, $message = null);
    public function removeRule($rule, $param = null, $message = null);
    public function getRules();
    
    public function getMarkup(WriterInterface $writer = null);
    public function getFieldMarkup();
    public function getChildrenMarkup();
    public function __toString();
    
    public function __clone();

    public function addField(FieldInterface $field);
    public function removeField(FieldInterface $field);
    public function getField($id);
    public function getFields();

    public function toArray();
    
    public function getIterator();
}
