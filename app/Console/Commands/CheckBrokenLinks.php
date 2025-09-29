<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class CheckBrokenLinks extends Command
{
    protected $signature = 'check:broken-links';
    protected $description = 'Check for broken or empty links in the project';

    public function handle()
    {
        $directory = resource_path('views'); // Path to your Laravel views directory

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($directory)
        );

        foreach ($iterator as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'blade.php') {
                $contents = file_get_contents($file);

                if (preg_match_all('/<a\s+[^>]*href=["\'](.*?)["\'][^>]*>/i', $contents, $matches)) {
                    foreach ($matches[1] as $link) {
                        if (empty($link) || $link === '#') {
                            $this->info("Invalid href found in {$file}: '{$link}'");
                        }
                    }
                }
            }
        }

        $this->info("Check complete.");
    }
}