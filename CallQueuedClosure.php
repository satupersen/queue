<?php

namespace Satupersen\Queue;

use Satupersen\Bus\Queueable;
use Satupersen\Contracts\Container\Container;
use Satupersen\Contracts\Queue\ShouldQueue;
use Satupersen\Foundation\Bus\Dispatchable;
use ReflectionFunction;

class CallQueuedClosure implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The serializable Closure instance.
     *
     * @var \Satupersen\Queue\SerializableClosure
     */
    public $closure;

    /**
     * Indicate if the job should be deleted when models are missing.
     *
     * @var bool
     */
    public $deleteWhenMissingModels = true;

    /**
     * Create a new job instance.
     *
     * @param  \Satupersen\Queue\SerializableClosure  $closure
     * @return void
     */
    public function __construct(SerializableClosure $closure)
    {
        $this->closure = $closure;
    }

    /**
     * Execute the job.
     *
     * @param  \Satupersen\Contracts\Container\Container  $container
     * @return void
     */
    public function handle(Container $container)
    {
        $container->call($this->closure->getClosure());
    }

    /**
     * Get the display name for the queued job.
     *
     * @return string
     */
    public function displayName()
    {
        $reflection = new ReflectionFunction($this->closure->getClosure());

        return 'Closure ('.basename($reflection->getFileName()).':'.$reflection->getStartLine().')';
    }
}
