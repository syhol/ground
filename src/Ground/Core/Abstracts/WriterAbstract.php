<?php
namespace Ground\Core\Abstracts;

use \Ground\Core\Interfaces\FieldInterface;
use \Ground\Core\Interfaces\WriterInterface;

/**
 * Standard ground validator, use ground rules to extend
 *
 * @author Simon Holloway <holloway.sy@gmail.com>
 */
class WriterAbstract implements WriterInterface
{
    protected $decorating;

    
    public function __construct(WriterInterface $writer = null)
    {
        $this->decorating = $writer;
    }
    
    public function beforeField(FieldInterface $field)
    {
        $html = '';

        if ($this->decorating instanceof WriterInterface) {
            $html .= $this->decorating->beforeField($field);
        }

        return $html;
    }

    public function afterField(FieldInterface $field)
    {
        $html = '';

        if ($this->decorating instanceof WriterInterface) {
            $html .= $this->decorating->afterField($field);
        }

        return $html;
    }


    public function beforeChildren(FieldInterface $field)
    {
        $html = '';

        if ($this->decorating instanceof WriterInterface) {
            $html .= $this->decorating->beforeChildren($field);
        }

        return $html;
    }

    public function afterChildren(FieldInterface $field)
    {
        $html = '';

        if ($this->decorating instanceof WriterInterface) {
            $html .= $this->decorating->afterChildren($field);
        }
        
        return $html;
    }
}
