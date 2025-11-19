# Скрипт для публикации пакета на GitHub

Write-Host "=== Публикация Media Manager на GitHub ===" -ForegroundColor Green
Write-Host ""

$packageDir = $PSScriptRoot
$gitPath = "C:\Program Files\Git\bin\git.exe"

if (-not (Test-Path $gitPath)) {
    Write-Host "ОШИБКА: Git не найден!" -ForegroundColor Red
    Write-Host "Установите Git или укажите правильный путь в скрипте." -ForegroundColor Yellow
    exit 1
}

Set-Location $packageDir

# Проверка инициализации git
if (-not (Test-Path ".git")) {
    Write-Host "Инициализация git репозитория..." -ForegroundColor Yellow
    & $gitPath init
}

# Проверка remote
$remote = & $gitPath remote get-url origin 2>&1
if ($LASTEXITCODE -ne 0) {
    Write-Host "Добавление remote origin..." -ForegroundColor Yellow
    & $gitPath remote add origin https://github.com/letoceiling-coder/media-manager.git
} else {
    Write-Host "Remote уже настроен: $remote" -ForegroundColor Green
}

# Добавление файлов
Write-Host "Добавление файлов..." -ForegroundColor Yellow
& $gitPath add .

# Коммит
Write-Host "Создание коммита..." -ForegroundColor Yellow
$commitMessage = Read-Host "Введите сообщение коммита (или нажмите Enter для 'Initial release: Media Manager v1.0.0')"
if ([string]::IsNullOrWhiteSpace($commitMessage)) {
    $commitMessage = "Initial release: Media Manager v1.0.0"
}
& $gitPath commit -m $commitMessage

# Создание тега
Write-Host "Создание тега v1.0.0..." -ForegroundColor Yellow
& $gitPath tag -a v1.0.0 -m "Release version 1.0.0"

# Отправка на GitHub
Write-Host "Отправка на GitHub..." -ForegroundColor Yellow
Write-Host "Внимание: Убедитесь, что репозиторий создан на GitHub!" -ForegroundColor Cyan
$confirm = Read-Host "Продолжить отправку? (y/n)"
if ($confirm -eq "y" -or $confirm -eq "Y") {
    & $gitPath push -u origin main
    if ($LASTEXITCODE -eq 0) {
        & $gitPath push --tags
        Write-Host ""
        Write-Host "=== Пакет успешно опубликован! ===" -ForegroundColor Green
        Write-Host "Репозиторий: https://github.com/letoceiling-coder/media-manager" -ForegroundColor Cyan
    } else {
        Write-Host "ОШИБКА: Не удалось отправить на GitHub!" -ForegroundColor Red
        Write-Host "Проверьте:" -ForegroundColor Yellow
        Write-Host "1. Репозиторий создан на GitHub" -ForegroundColor Yellow
        Write-Host "2. У вас есть права на запись" -ForegroundColor Yellow
        Write-Host "3. Настроена аутентификация GitHub" -ForegroundColor Yellow
    }
} else {
    Write-Host "Отправка отменена." -ForegroundColor Yellow
}

Write-Host ""

