<?php
namespace Oxycore\Core;

interface ProvideInterface
{
    /**
     * @return object provided Service.
     */
    public function provide();
}