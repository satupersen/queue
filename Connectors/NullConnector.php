<?php

namespace Satupersen\Queue\Connectors;

use Satupersen\Queue\NullQueue;

class NullConnector implements ConnectorInterface
{
    /**
     * Establish a queue connection.
     *
     * @param  array  $config
     * @return \Satupersen\Contracts\Queue\Queue
     */
    public function connect(array $config)
    {
        return new NullQueue;
    }
}
