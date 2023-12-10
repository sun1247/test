## 專安內容
幣別匯率轉換

## 安裝

> 請務必依據你的專案來調整內容。

以下將會引導你如何安裝此專案到你的電腦上。

### 下載XAMPP
PHP + Apache + MariaDB懶人包
```bash
https://www.apachefriends.org/zh_tw/download.html
```

### 安裝composar

下載網址
```bash
https://getcomposer.org/download/
```

### 取得專案

```bash
git clone git@github.com:hsiangfeng/README-Example-Template.git
```

### 下載Laravel安裝器
開啟Terminal，輸入以下指令
```bash
composer global require laravel/installer
```

將下載的專案放進xampp/htdocs
生成應用金鑰，開啟Terminal，切換到新建立的專案資料夾，請輸入指令
```bash
php artisan key:generate
```

### 設定本地化網域
告訴此網域需要由哪個專案資料夾來接手，作法是修改httpd-vhost.conf，路徑應根據您的狀況作調整
```bash
//XAMPP資料夾\apache\conf\extra\httpd-vhosts.conf
 
<VirtualHost *:80>
    DocumentRoot "c:\xampp\htdocs\app_name\public"  
    ServerName laravel.test       
    <Directory "c:\xampp\htdocs\app_name\public">
        Options FollowSymLinks
        AllowOverride None
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>
```
要求Apache開啟時需讀取httpd-vhosts.conf，作法是修改 XAMPP資料夾\apache\conf\original\httpd.conf。找到httpd-vhosts.conf那一行，把前面的#註解移除
重開Apache服務，訪問http://laravel.test，看能否順利開啟

### 運行專案

```bash
php artisan serve
```

### 開啟專案

在瀏覽器網址列輸入以下即可看到畫面

```bash
http://localhost:8000/
```

### 呼叫api
打開瀏覽器並貼上
```bash
http://localhost:8000/api/exchangeRate?source=JPY&target=USD&amount=10
```
即可成功呼叫

`注意`
參數:source, target, amount為必填
source, target幣別只支援 TWD, USD, JPY



