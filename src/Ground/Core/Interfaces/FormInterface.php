<?php
namespace Ground\Core\Interfaces;

/**
 * Defines an interface for a ground form
 *
 * @author Simon Holloway <holloway.sy@gmail.com>
 */
interface FormInterface extends FieldInterface
{
    public function setMethod($method);
    public function getMethod();

    public function setAction($action);
    public function getAction();

    public function isSubmitted();
    public function submit();
}
