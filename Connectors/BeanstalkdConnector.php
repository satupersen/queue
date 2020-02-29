<?php

namespace Satupersen\Queue\Connectors;

use Satupersen\Queue\BeanstalkdQueue;
use Pheanstalk\Connection;
use Pheanstalk\Pheanstalk;

class BeanstalkdConnector implements ConnectorInterface
{
    /**
     * Establish a queue connection.
     *
     * @param  array  $config
     * @return \Satupersen\Contracts\Queue\Queue
     */
    public function connect(array $config)
    {
        return new BeanstalkdQueue(
            $this->pheanstalk($config),
            $config['queue'],
            $config['retry_after'] ?? Pheanstalk::DEFAULT_TTR,
            $config['block_for'] ?? 0
        );
    }

    /**
     * Create a Pheanstalk instance.
     *
     * @param  array  $config
     * @return \Pheanstalk\Pheanstalk
     */
    protected function pheanstalk(array $config)
    {
        return Pheanstalk::create(
            $config['host'],
            $config['port'] ?? Pheanstalk::DEFAULT_PORT,
            $config['timeout'] ?? Connection::DEFAULT_CONNECT_TIMEOUT
        );
    }
}
