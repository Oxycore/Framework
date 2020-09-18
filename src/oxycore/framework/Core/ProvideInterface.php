<?php
namespace Oxycore\Framework\Core;

interface ProvideInterface
{
    /**
     * @return object provided Service.
     */
    public function provide();
}