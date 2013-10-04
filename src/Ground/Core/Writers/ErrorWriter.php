<?php
namespace Ground\Core\Writers;

use \Ground\Core\Interfaces\FieldInterface;
use \Ground\Core\Abstracts\WriterAbstract;

/**
 * Standard ground validator, use ground rules to extend
 *
 * @author Simon Holloway <holloway.sy@gmail.com>
 */
class ErrorWriter extends WriterAbstract
{
    public function afterField(FieldInterface $field)
    {
        $html = '';

        $html .= parent::afterField($field);
        
        $errors = $field->getErrors();

        if (false === empty($errors)) {
            $html .= '<div class="errors">' . implode('<br>', $errors) . '</div>';
        }

        return $html;
    }
}
