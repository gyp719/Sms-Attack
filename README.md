短信轰炸机~实现批量发送短信，仅用于学习交流，娱乐使用，共同学习，请勿做违法行为，如果用于非法用途，后果自负。

获取代码  
`git clone git@github.com:gyp719/Sms-Attack.git ./`

安装组件  
`composer install`

`cp .env.example .env`

`php artisan key:generate`

执行数据库迁移

`php artisan migrate:refresh --seed`

启动访问  
`http://sms-attack.test`

导出后台数据表
```
php artisan iseed admin_users,admin_roles,admin_permissions,admin_menu,admin_role_users,admin_role_permissions,admin_role_menu,admin_permission_menu,admin_settings,admin_extensions,admin_extension_histories --force
```

导出短信模版
```
php artisan iseed sms_templates --force
```

生成攻击用户
```
php artisan db:seed --class=AttackUserTableSeeder
```

Horizon 队列管理工具
```
php artisan horizon
```
