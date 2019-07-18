echo off
REM This adds the folder containing php.exe to the path
PATH=%PATH%;C:\PHP5.6

REM Change Directory to the folder containing your script
CD C:\inetpub\wwwroot\cpanel\wp-admin\poker-admin

REM Execute
php user_account_update.php