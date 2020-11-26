<?php

namespace App\Jobs;

use App\Mail\ImageResizeEmail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\ImageManager;

class ResizeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    private $file;
    /**
     * @var array
     */
    private $formats;
    /**
     * @var User
     */
    private $user;

    /**
     * Create a new job instance.
     * @param string $file
     * @param array  $formats
     * @param string $user
     */
    public function __construct(string $file, array $formats, string $user)
    {
        $this->file = $file;
        $this->formats = $formats;
        $this->user = $user;
    }

    /**
     * Execute the job.
     * @return void
     */
    public function handle()
    {
        foreach ($this->formats as $size){
            $images  = new ImageManager(['driver', 'gd']);
            $images->make($this->file)
                ->fit($size, $size)
                ->contrast(65)
                ->save(public_path('uploads'). "/".pathinfo($this->file, PATHINFO_FILENAME). "_{$size}X{$size}.jpg")
            ;
        }
        Mail::to('scotttresor@gmail.com')->send(new ImageResizeEmail($this->user));
    }
}
