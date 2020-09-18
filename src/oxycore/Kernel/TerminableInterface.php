<?php
namespace Oxycore\Kernel;

interface TerminableInterface
{
    public function terminate($request);
}