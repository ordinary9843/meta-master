<?php

namespace Ordinary9843;

class Master
{
    /** @var array */
    private $error = [];

    /**
     * @param string $error
     * 
     * @return void
     */
    public function setError(string $error): void
    {
        (!in_array($error, $this->error)) && $this->error[] = $error;
    }

    /**
     * @return array
     */
    public function getError(): array
    {
        return $this->error;
    }
}
