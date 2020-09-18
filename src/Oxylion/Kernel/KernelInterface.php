<?php
namespace Oxylion\Kernel;

use Oxylion\HttpFoundation\Request;

interface KernelInterface
{
    public function handle(Request $request);
}
