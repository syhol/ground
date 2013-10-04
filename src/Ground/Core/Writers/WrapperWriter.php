<?php
namespace Ground\Core\Writers;

use \Ground\Core\Interfaces\FieldInterface;
use \Ground\Core\Abstracts\WriterAbstract;

/**
 * Standard ground validator, use ground rules to extend
 *
 * @author Simon Holloway <holloway.sy@gmail.com>
 */
class WrapperWriter extends WriterAbstract
{
    public function beforeField(FieldInterface $field)
    {
        $html = '';
        $attrstring = '';
        
        $attributes = $this->getAttributes($field);

        foreach ($attributes as $attr => $value) {
            $attrstring .= ' ' . $attr . '="' . $value . '"';
        }

        $html .= '<' . $this->getConTag($field) . $attrstring . '>';

        $html .= parent::beforeField($field);

        return $html;
    }

    public function afterChildren(FieldInterface $field)
    {
        $html = '';

        $html .= parent::afterChildren($field);
        
        $html .= '</' . $this->getConTag($field) . '>';

        return $html;
    }

    private function getConTag(FieldInterface $field)
    {
        $contag = 'div';
        if ($field->getOption('container-tag')) {
            $contag = $field->getOption('container-tag');
        }
        return $contag;
    }

    private function getAttributes(FieldInterface $field)
    {
        $attributes = array();

        $classes = $this->getClasses($field);

        if (false == empty($classes)) {
            $attributes['class'] = implode(' ', $classes);
        }

        if ($extraattrs = $field->getOption('container-attributes')) {
            foreach ($extraattrs as $attr => $value) {
                $attributes[$attr] = $value;
            }
        }

        return $attributes;
    }

    private function getClasses(FieldInterface $field)
    {
        $classes = array();

        $classes[] = 'ground-field';

        $fieldclass = get_class($field);
        $fieldclass = str_replace('\\', '-', $fieldclass);
        $fieldclass = strtolower($fieldclass);
        $classes[] = $fieldclass;

        $errors = $field->getErrors();
        if (false === empty($errors)) {
            $classes[] = 'has-errors';
        }

        $extraclasses = $field->getOption('container-classes');
        if (is_array($extraclasses)) {
            $classes = array_merge($classes, $extraclasses);
        } elseif (is_string($extraclasses)) {
            $extraclasses = explode(' ');
            $classes = array_merge($classes, $extraclasses);
        }

        return $classes;
    }
}
