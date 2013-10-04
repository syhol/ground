<?php
namespace Ground\Core\Fields;

use \Ground\Core\Abstracts\FieldAbstract;
use \Ground\Core\Interfaces\FieldInterface;
use \Ground\Core\Interfaces\WriterInterface;

/**
 * A repeatable container for ground
 *
 * @author Simon Holloway <holloway.sy@gmail.com>
 */
class Multi extends FieldAbstract
{
    public function addField(FieldInterface $field)
    {
        $field->setId(count($this->getFields()));
        
        return parent::addField($field);
    }

    public function getChildrenMarkup(WriterInterface $writer = null)
    {
        $html = '';

        $html .= '<div class="multi-conatiner">';

        foreach ($this as $section) {
            $html .= $section->getMarkup($writer);
        }

        $html .= '</div>';

        return $html;
    }
}
