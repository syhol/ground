<?php
namespace Ground\Core\Writers;

use \Ground\Core\Interfaces\FieldInterface;
use \Ground\Core\Abstracts\WriterAbstract;

/**
 * Standard ground validator, use ground rules to extend
 *
 * @author Simon Holloway <holloway.sy@gmail.com>
 */
class TitleDescriptionWriter extends WriterAbstract
{
    public function beforeField(FieldInterface $field)
    {
        $html = '';

        $titletag = 'strong';
        if ($field->getOption('title-tag')) {
            $titletag = $field->getOption('title-tag');
        }

        if (false == is_null($field->getOption('title'))) {
            $html .= '<' . $titletag . '>' . $field->getOption('title') . '</' . $titletag . '>';
        }

        $descriptiontag = 'p';
        if ($field->getOption('description-tag')) {
            $descriptiontag = $field->getOption('description-tag');
        }

        if (false == is_null($field->getOption('description'))) {
            $html .= '<' . $descriptiontag . '>' . $field->getOption('description') . '</' . $descriptiontag . '>';
        }

        $html .= parent::beforeField($field);

        return $html;
    }
}
