<?php
namespace Oxycore\Core;

abstract class ServiceProviders implements ProvideInterface
{
    protected array $config;

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