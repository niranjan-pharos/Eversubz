param(
    [string]$ProjectPath = "C:\xampp\htdocs\",  
    [string]$PhpPath = "C:\xampp\php\php.exe"   
)


Set-Location $ProjectPath

$logDir = Join-Path $ProjectPath "storage\logs"
if (-not (Test-Path $logDir)) {
    New-Item -ItemType Directory -Path $logDir -Force
}

$logFile = Join-Path $logDir "queue-worker.log"
$errorLogFile = Join-Path $logDir "queue-worker-error.log"

function Write-Log {
    param([string]$Message, [string]$Type = "INFO")
    $timestamp = Get-Date -Format "yyyy-MM-dd HH:mm:ss"
    $logMessage = "[$timestamp] [$Type] $Message"
    Add-Content -Path $logFile -Value $logMessage
    Write-Output $logMessage
}

function Write-ErrorLog {
    param([string]$Message)
    $timestamp = Get-Date -Format "yyyy-MM-dd HH:mm:ss"
    $logMessage = "[$timestamp] [ERROR] $Message"
    Add-Content -Path $errorLogFile -Value $logMessage
    Add-Content -Path $logFile -Value $logMessage
    Write-Error $logMessage
}

try {
    Write-Log "Laravel Queue Worker starting..."
    Write-Log "Project Path: $ProjectPath"
    Write-Log "PHP Path: $PhpPath"
    
    if (-not (Test-Path $PhpPath)) {
        Write-ErrorLog "PHP executable not found at: $PhpPath"
        exit 1
    }
    
    if (-not (Test-Path "artisan")) {
        Write-ErrorLog "Laravel artisan file not found in: $ProjectPath"
        exit 1
    }
    
    Write-Log "Clearing Laravel caches..."
    & $PhpPath artisan config:clear 2>&1 | Add-Content -Path $logFile
    
    Write-Log "Starting queue worker with database connection..."
    & $PhpPath artisan queue:work database --tries=3 --timeout=300 --memory=128 --verbose 2>&1 | Add-Content -Path $logFile
    
    Write-Log "Queue worker process ended."
    
} catch {
    Write-ErrorLog "Exception occurred: $($_.Exception.Message)"
    Write-ErrorLog "Stack trace: $($_.ScriptStackTrace)"
    exit 1
}
