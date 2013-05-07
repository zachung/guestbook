1、本範例為《PHP+MySQL動態網站開發》一書第17章的範例。

2、執行前，將 mysql\data\vote 文件夾複製到MySQL安裝目錄的data文件夾內。預設root密碼為空。如需修改為用戶自己的用戶名和密碼連接資料庫，可修改conn.php文對應件的敘述。

3、本例程使用了mail()函數發送郵件，使用mail()函數需要設定PHP環境，修改php.ini的[mail function] 區段，定義所使用的mail server地址。

最常見的是Windows Server 2003上安裝Exchange或者IMail等郵件伺服器產品，
啟用SMTP服務後：
[mail function] 
SMTP=localhost 
sendmail_from=me@localhost.com
關鍵是SMTP=這，設置為一個有權使用SMTP的郵件伺服器的IP地址就可以了。