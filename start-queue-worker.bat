@echo off
cd /D C:\xampp\htdocs

REM Start the queue worker and log output with --daemon flag for continuous operation
"C:\xampp\php\php.exe" artisan queue:work --daemon --sleep=3 --tries=3 --max-time=3600 >> "storage\logs\queue-worker.log" 2>&1
