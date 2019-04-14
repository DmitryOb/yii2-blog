# requirements

1. http server (for example apache)
2. php >= 5.4
3. mysql >= 5.6
4. composer

# installation
1. git clone https://github.com/DmitryOb/yii2-blog.git
2. composer install
3. create DB name like "yii2basic"
4. config DB in /config/db.php
5. run migrate in terminal:
6. php yii migrate/down all --interactive=0
7. php yii migrate --interactive=0
8. go to /admin and create article