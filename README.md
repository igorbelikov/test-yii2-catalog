Установка
-------------------

Инициализация:
```
php init
```

Настройка (бд):
```
common/config/main-local.php
```

Миграции:
```
php yii migrate --migrationPath=@mdm/upload/migrations
php yii migrate --migrationPath=@vendor/gilek/yii2-gtreetable/migrations
php yii migrate
```
