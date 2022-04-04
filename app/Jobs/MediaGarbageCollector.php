<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Console\Scheduling\Schedule;
use App\Models\Media;
use App\Models\PdfReport;
use Illuminate\Support\Facades\File;

class MediaGarbageCollector implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $medias = Media::whereJsonContains('meta->is_dicom', false)
        ->orWhereJsonContains('meta->is_test', true)->get();

        foreach($medias as $media) {
            $file = basename($media->path);
            $isAttached = PdfReport::where('file_name', $file)->exists();
            if(!$isAttached)
            File::delete(storage_path('app/'.$media->path));
        }
    }
}
