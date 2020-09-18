<?php
namespace Oxycore\Framework\Kernel;

use Oxycore\Framework\HttpFoundation\Request;
use Oxycore\Framework\HttpFoundation\Response;
use Oxycore\Framework\Routing\Router;

interface KernelInterface
{
    public function handle(Request $request);
}