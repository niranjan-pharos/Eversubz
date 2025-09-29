<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Crawler\Crawler;
use Spatie\Crawler\CrawlObservers\CrawlObserver;
use Psr\Http\Message\UriInterface;
use Psr\Http\Message\ResponseInterface;
use Illuminate\Support\Facades\Log;

class DetectBrokenLinks extends Command
{
    protected $signature = 'detect:broken-links';
    protected $description = 'Detect broken links in the website';

    public function handle()
    {
        Crawler::create()
            ->setCrawlObserver(new class extends CrawlObserver {
                public function willCrawl(UriInterface $url, ?string $linkText): void
                {
                    echo "Crawling: " . (string)$url . "\n";
                }

                public function crawled(
                    UriInterface $url,
                    ResponseInterface $response,
                    ?UriInterface $foundOnUrl = null,
                    ?string $linkText = null
                ): void {
                    if ($response->getStatusCode() >= 400) {
                        $message = "Broken link found: {$url} (status: {$response->getStatusCode()})";
                        Log::error($message); // Log to Laravel's log file
                        echo $message . "\n";
                    }
                }

                public function crawlFailed(
                    UriInterface $url,
                    \GuzzleHttp\Exception\RequestException $exception,
                    ?UriInterface $foundOnUrl = null,
                    ?string $linkText = null
                ): void {
                    $message = "Crawling failed for: {$url}";
                    Log::error($message); // Log to Laravel's log file
                    echo $message . "\n";
                }
            })
            ->setMaximumDepth(10)
            ->startCrawling('https://eversabz.com');
    }
}
