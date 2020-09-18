<?php
namespace Oxylion\Core;

abstract class ServiceProviders implements ProvideInterface
{
    private array $config;

    /**
     * ServiceProviders constructor.
     * @param array $config config container.
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @inheritDoc
     */
    abstract public function provide();
}
