导出后台数据表
`
php artisan iseed admin_users,admin_roles,admin_permissions,admin_menu,admin_role_users,admin_role_permissions,admin_role_menu,admin_permission_menu,admin_settings,admin_extensions,admin_extension_histories
`

生成攻击用户
`
php artisan db:seed --class=AttackUserTableSeeder
`
