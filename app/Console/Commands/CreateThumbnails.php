<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Models\Event; // Replace with the correct namespace for your product model

class CreateThumbnails extends Command
{
    protected $signature = 'images:create-thumbnails';
    protected $description = 'Create thumbnails for existing product images';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Fetch all Events with their primary image
        $posts = Event::get();

        foreach ($posts as $post) {
            if ($post->main_image && $post->main_image) {
                $originalPath = storage_path('app/public/' . $post->main_image);

                // Check if the original image exists
                if (Storage::exists('public/' . $post->main_image)) {
                    // Define the path for the thumbnail
                    $thumbnailPath = 'event_images/thumb/' . basename($post->main_image);

                    // Create a resized image (thumbnail)
                    $resizedImage = Image::make($originalPath)->resize(450, null, function ($constraint) {
                        $constraint->aspectRatio(); // Maintain aspect ratio for height
                    });

                    // Save the thumbnail
                    Storage::disk('public')->put($thumbnailPath, (string) $resizedImage->encode());

                    $this->info("Thumbnail created for: " . $post->main_image);
                } else {
                    $this->error("Original image not found for: " . $post->main_image);
                }
            } else {
                $this->error("Primary image URL not set for post ID: " . $post->id);
            }
        }

        $this->info('Thumbnail creation process completed.');
    }
}
