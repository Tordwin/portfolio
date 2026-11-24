[CmdletBinding()]
param(
    [ValidateRange(1, 65535)]
    [int]$Port = 8080,
    [switch]$Check
)

$ErrorActionPreference = 'Stop'
$phpPath = Join-Path $PSScriptRoot '.local\php\php.exe'
if (-not (Test-Path -LiteralPath $phpPath)) {
    $phpCommand = Get-Command php -CommandType Application -ErrorAction SilentlyContinue
    if (-not $phpCommand) {
        throw 'PHP is missing. Install PHP or extract the Windows PHP ZIP to .local\php. See README.md for setup instructions.'
    }
    $phpPath = $phpCommand.Source
}

& $phpPath --version
if ($LASTEXITCODE -ne 0) {
    throw 'PHP could not start. Check the PHP installation and its Visual C++ runtime requirements (see README.md).'
}

$phpFiles = @(Get-ChildItem -LiteralPath $PSScriptRoot -Filter '*.php' -File)
$phpFiles += @(Get-ChildItem -LiteralPath (Join-Path $PSScriptRoot 'data') -Filter '*.php' -File)
foreach ($file in $phpFiles) {
    & $phpPath -l $file.FullName
    if ($LASTEXITCODE -ne 0) { exit $LASTEXITCODE }
}

if ($Check) { exit 0 }

Write-Host "Portfolio: http://127.0.0.1:$Port (Ctrl+C to stop)"
& $phpPath -S "127.0.0.1:$Port" -t $PSScriptRoot
exit $LASTEXITCODE
