@echo off
if %1%==deploy (
    GOTO DEPLOY
)
if %1%==redeploy (
    GOTO REDEPLOY
)
:DONE
EXIT

:REDEPLOY
start /wait py auto/storage_fresh.py
start /wait php artisan route:clear
start /wait php artisan cache:clear
start /wait php artisan migrate:fresh --seed
start php artisan serve
GOTO DONE

:DEPLOY
start php artisan serve
GOTO DONE
