Dim WinScriptHost
Set WinScriptHost = CreateObject("WScript.Shell")
WinScriptHost.Run Chr(34) & "C:\xampp\htdocs\DataBase\autopull.bat" & Chr(34), 0
Set WinScriptHost = Nothing