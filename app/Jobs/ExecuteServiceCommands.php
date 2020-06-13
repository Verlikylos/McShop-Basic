<?php

namespace App\Jobs;

use App\Models\Service;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use xPaw\SourceQuery\SourceQuery;

class ExecuteServiceCommands implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    private $service;
    private $playerName;
    
    /**
     * Create a new job instance.
     *
     * @param  Service  $service
     * @param  string  $playerName
     */
    public function __construct(Service $service, string $playerName)
    {
    
        $this->service = $service;
        $this->playerName = $playerName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $this->service->redeem($this->playerName);
        } catch (\Exception $exception) {
            $this->fail($exception);
        }
    }
}
