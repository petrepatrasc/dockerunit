<?php


namespace DockerUnit\Core\Validator;

/**
 * Defines interaction with validator services.
 *
 * @package DockerUnit\Core\Validator
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
interface ValidatorInterface
{
    public function validate($data);
}
