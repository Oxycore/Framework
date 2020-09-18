<?php
namespace Oxycore\Framework\Kernel;

interface TerminableInterface
{
    public function terminate($request);
}