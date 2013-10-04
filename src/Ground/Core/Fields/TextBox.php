<?php
namespace Ground\Core\Fields;

use \Ground\Core\Abstracts\FieldAbstract;

/**
 * Standard text box field for ground
 *
 * @author Simon Holloway <holloway.sy@gmail.com>
 */
class TextBox extends FieldAbstract
{
    public function getFieldMarkup()
    {
        $html = '';

        $html .= '<input type="text"';
        $html .= ' name="' . $this->getFullyQualifiedId() . '"';
        $html .= ' id="' . $this->getFullyQualifiedName() . '"';
        $html .= ' value="' . $this->getValue() . '"';
        if ($this->getOption('placeholder')) {
            $html .= ' placeholder="' . $this->getOption('placeholder') . '"';
        }
        $html .= '>';

        return $html;
    }
}
