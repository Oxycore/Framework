<?php
namespace Oxycore\Kernel;

use Oxycore\HttpFoundation\Request;

interface KernelInterface
{
    public function handle(Request $request);
}