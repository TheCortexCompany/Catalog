<?php
namespace Cortex\Model\Entity\User;

final class UserId
{
    private $value;

    public function __construct( $value )
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return (string) $this->value;
    }
}