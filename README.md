# requirements

1. http server (for example apache)
2. php >= 5.4
3. mysql >= 5.6
4. composer

# installation
1. git clone https://github.com/DmitryOb/yii2-blog.git
2. composer install
2. create DB name like "yii2basic"
3. config DB in /config/db.php
4. run migrate in terminal:
php yii migrate/down all --interactive=0
php yii migrate --interactive=0