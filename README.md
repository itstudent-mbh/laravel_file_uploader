# User-ACL-package
User access Controller package for laravel


# Install 
```bash
composer require mbhanife/laravel-users-acl
```

```bash
php artisan migrate 
```

# Use
Add ' use HasRole ' to user model  

Add new role 
Just set name for that
```bash
Role::create(['name' => 'role name']);
```

Add new permission
```bash
Permission::create('name' => 'permission name')
```

Attach permission to role 
```bash
$role = Role::find(x);
$role->givePermissions(['permission name 1','permission name 2',...])
```


Attach role to user
```bash
$user = user::find(x);
$user->giveRoles(['role name 1','role name 2',...])
```



Use permissions in controller 
```bash
if ($user->can('permission name')) {
    do somethings
}
```
