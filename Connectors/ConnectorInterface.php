<?php

namespace Satupersen\Queue\Connectors;

interface ConnectorInterface
{
    /**
     * Establish a queue connection.
     *
     * @param  array  $config
     * @return \Satupersen\Contracts\Queue\Queue
     */
    public function connect(array $config);
}
