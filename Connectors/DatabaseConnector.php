<?php

namespace Satupersen\Queue\Connectors;

use Satupersen\Database\ConnectionResolverInterface;
use Satupersen\Queue\DatabaseQueue;

class DatabaseConnector implements ConnectorInterface
{
    /**
     * Database connections.
     *
     * @var \Satupersen\Database\ConnectionResolverInterface
     */
    protected $connections;

    /**
     * Create a new connector instance.
     *
     * @param  \Satupersen\Database\ConnectionResolverInterface  $connections
     * @return void
     */
    public function __construct(ConnectionResolverInterface $connections)
    {
        $this->connections = $connections;
    }

    /**
     * Establish a queue connection.
     *
     * @param  array  $config
     * @return \Satupersen\Contracts\Queue\Queue
     */
    public function connect(array $config)
    {
        return new DatabaseQueue(
            $this->connections->connection($config['connection'] ?? null),
            $config['table'],
            $config['queue'],
            $config['retry_after'] ?? 60
        );
    }
}
