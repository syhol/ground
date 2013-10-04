<?php
namespace Ground\Core\Abstracts;

use \Ground\Core\Interfaces\FieldInterface;
use \Ground\Core\Interfaces\WriterInterface;
use ArrayIterator;

/**
 * Standard ground field
 *
 * @author Simon Holloway <holloway.sy@gmail.com>
 */
abstract class FieldAbstract implements FieldInterface
{
    protected $id;
 
    protected $parent;

    protected $options = array();
    
    protected $value;
    
    protected $errors = array();
    
    protected $rules = array();

    protected $fields = array();

    public function __construct($id)
    {
        $this->setId($id);
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setParent(FieldInterface $field)
    {
        $this->parent = $field;
    }

    public function getParent()
    {
        return $this->parent instanceof FieldInterface ? $this->parent : false;
    }

    public function getFullyQualifiedName()
    {
        $fqname = $this->getId();
        
        $parent = $this;
        while (false !== ($parent = $parent->getParent())) {
            $fqname =  $parent->getId() . '-' . $fqname;
        }
        
        return $fqname;
    }

    public function getFullyQualifiedId()
    {
        $fqid = '';
        
        $parent = $this;
        while (false !== $parent->getParent()) {
            $parent = $parent->getParent();
            if (false !== $parent->getParent()) {
                $fqid = '[' . $parent->getId() . ']' . $fqid;
            } else {
                $fqid =  $parent->getId() . $fqid;
            }
        }

        $fqid .= '[' . $this->getId() . ']';
        
        return $fqid;
    }

    public function setOption($key, $option)
    {
        $this->options[$key] = $option;

        return $this;
    }

    public function getOption($key)
    {
        return isset($this->options[$key]) ? $this->options[$key] : null;
    }

    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function addError($error)
    {
        $this->errors[] = $error;

        return $this;
    }

    public function removeError($error)
    {
        if (false !== ($key = array_search($error, $this->errors, true))) {
            unset($this->errors[$key]);
        }

        return $this;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function addRule($rule, $param = null, $message = null)
    {
        $this->rules[] = array(
            'rule' => $rule,
            'param' => $param,
            'message' => $message
        );

        return $this;
    }

    public function removeRule($rule, $param = null, $message = null)
    {
        $rulearray = array(
            'rule' => $rule,
            'param' => $param,
            'message' => $message
        );

        if (false !== ($key = array_search($rulearray, $this->rules, true))) {
            unset($this->rules[$key]);
        }

        return $this;
    }

    public function getRules()
    {
        return $this->rules;
    }
    
    public function getMarkup(WriterInterface $writer = null)
    {
        $html = '';

        if ($writer instanceof WriterInterface) {
            $html .= $writer->beforeField($this);
        }

        $html .= $this->getFieldMarkup();
        
        if ($writer instanceof WriterInterface) {
            $html .= $writer->afterField($this);
        }
        
        if ($writer instanceof WriterInterface) {
            $html .= $writer->beforeChildren($this);
        }
        
        $html .= $this->getChildrenMarkup($writer);
        
        if ($writer instanceof WriterInterface) {
            $html .= $writer->afterChildren($this);
        }

        return $html;
    }
    
    public function getFieldMarkup()
    {
        return '';
    }
    
    public function getChildrenMarkup(WriterInterface $writer = null)
    {
        $html = '';

        foreach ($this as $child) {
            $html .= $child->getMarkup($writer);
        }

        return $html;
    }

    public function __toString()
    {
        return $this->getMarkup();
    }

    public function __clone()
    {
        foreach ($this->fields as $field) {
            $this->removeField($field);
            $this->addField(clone $field);
        }

        $this->parent = false;
    }

    public function addField(FieldInterface $field)
    {
        $field->setParent($this);

        $this->fields[] = $field;

        return $this;
    }

    public function removeField(FieldInterface $field)
    {
        if (false !== ($key = array_search($field, $this->fields, true))) {
            unset($this->fields[$key]);
        }

        return $this;
    }

    public function getField($id)
    {
        foreach ($this->fields as $field) {
            if ($field->getId() === $id) {
                return $field;
            }
        }

        foreach ($this->fields as $field) {
            if (false !== ($foundfield = $field->getField($id))) {
                return $foundfield;
            }
        }

        return false;
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function toArray()
    {
        return (array)$this;
    }
    
    public function getIterator()
    {
        return new ArrayIterator($this->getFields());
    }
}
