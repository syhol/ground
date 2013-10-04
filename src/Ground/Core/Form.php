<?php
namespace Ground\Core;

use \Ground\Core\Abstracts\FieldAbstract;
use \Ground\Core\Interfaces\FormInterface;
use \Ground\Core\Interfaces\WriterInterface;

/**
 * Standard ground form
 *
 * @author Simon Holloway <holloway.sy@gmail.com>
 */
class Form extends FieldAbstract implements FormInterface
{
    protected $method = 'POST';
    
    protected $action;

    public function __construct($id)
    {
        $this->setId($id);
        $this->setOption('title-tag', 'h3');
    }

    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }
    
    public function getAction()
    {
        return $this->action;
    }

    public function getChildrenMarkup(WriterInterface $writer = null)
    {
        $html = '';

        $html .= '<form';
        $html .= ' action="' . $this->getAction() . '"';
        $html .= ' method="' . $this->getMethod() . '"';
        $html .= ' name="' . $this->getId() . '"';
        $html .= '>';
        
        foreach ($this as $field) {
            $html .= $field->getMarkup($writer);
        }

        $html .= '<input type="hidden" name="' . $this->getId() . '-submitted-token" value="true">';

        $html .= '</form>';

        return $html;
    }

    public function isSubmitted()
    {
        return isset($_REQUEST[$this->getId() . '-submitted-token']);
    }
    
    public function submit()
    {
        //Do Stuff
    }
}
