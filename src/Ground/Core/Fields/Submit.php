<?php
namespace Ground\Core\Fields;

use \Ground\Core\Abstracts\FieldAbstract;

/**
 * A submit button for ground
 *
 * @author Simon Holloway <holloway.sy@gmail.com>
 */
class Submit extends FieldAbstract
{
    public function getFieldMarkup()
    {
        $html = '';

        $label = $this->getOption('title') ? : 'Submit';

        $html .= '<input type="submit" value="' . $label . '">';

        return $html;
    }
}
