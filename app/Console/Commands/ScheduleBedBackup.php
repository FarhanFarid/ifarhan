<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\BedManagementBackup;
use Illuminate\Support\Facades\Log;

class ScheduleBedBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:bed-schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup bed schedule from API every 1 minute';


    public function handle()
    {
        try {
            $uri = env('BED_SEARCH');
            $client = new \GuzzleHttp\Client(['defaults' => ['verify' => false]]);
        
            $response = $client->request('GET', $uri);
            $statusCode = $response->getStatusCode();
        
            $content = json_decode($response->getBody(), true);
        
            if (isset($content['WardList']) && is_array($content['WardList']) && count($content['WardList']) > 0) {
        
                $jsonString = json_encode($content['WardList'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        
                BedManagementBackup::truncate();
        
                $store = new BedManagementBackup();
                $store->backup = $jsonString;
                $store->created_at = Carbon::now();
                $store->save(); 
        
                $this->info('Bed backup updated successfully.');
        
            } else {
                Log::warning('WardList not found or empty in API response. Backup not updated.');
                $this->warn('WardList missing — skipped update, used existing backup.');
            }
        
        } catch (\Exception $e) {
            Log::error($e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
        
            $this->error('Failed to update bed backup (API error).');
        }
        
    }
}
