echo off
REM This adds the folder containing php.exe to the path
PATH=%PATH%;C:\PHP5.6

REM Change Directory to the folder containing your script
CD C:\inetpub\wwwroot\site\test_api

REM Execute
php create_user.php