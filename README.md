# Absen Scan RFID

![alt text](https://github.com/nadoyo69/Absen_RFID/blob/master/assets/img2.png?raw=true)


## Infotmation
```
-- Website --
Codeigniter 3
Bootstrap 4
Pusher(real time)

-- Alat Absensi --
Nodemcu
RFID
Buzzer
Jumper
Breadboard
```

## Credential


```txt
-- Url Admin --
http://127.0.0.1/Admin
Username = Nadoyo
Password = Nadoyo
```
![alt text](https://github.com/nadoyo69/Absen_RFID/blob/master/assets/img3.png?raw=true)

## .htaccss (apache/httpd)
```.htaccess
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]
```

## Telegram
Buat Bot Menggunakan Bot Father

```php
https://api.telegram.org/bot<YourBOTToken>/getUpdates

{"ok":true,"result":[{"update_id":123123,
"message":{"message_id":123123,"from":{"id":123123,"is_bot":false,
"first_name":"Nadoyo","username":"Nadoyo","language_code":"en"},
"chat":{"id":123123,"first_name":"Nadoyo","username":"Nadoyo","type":"private"}, 
"date":123123,"text":"/start","entities":[{"offset":0,"length":6,"type":"bot_command"}]}}]}


$botToken = <YourBOTToken>; 
$chatId = 123123; 
```
![alt text](https://github.com/nadoyo69/Absen_RFID/blob/master/assets/img.png?raw=true)

## Pusher Real Time
```
Daftar Puser di https://pusher.com/
```


