# DeepPermission

### Step 1: Install DeepPermission

composer require libressltd/deeppermission

### Step 2: Add service provider to config/app.php

LIBRESSLtd\DeepPermission\DeepPermissionServiceProvider::class, 
LIBRESSLtd\LBForm\LBFormServiceProvider::class,

### Step 3: Publish vendor

php artisan vendor:publish --tag=deeppermission --force

### Step 4: Add following line to User Model (Remember to move User.php to app/Models) or you can find the newest version in vendor/libresslt/deeppermission/src/User.php
	
	
```php

class User extends Authenticatable
{
    use DPUserModelTrait;
}


```

Add this row in the end of scripts.blade.php 

```php
@yield('dp_script')
```

### Step 5 (optional): If you want a user pass all the permission, add LIBRE_DP_ADMIN_ID to your .env file

```bash
LIBRE_DP_ADMIN_ID={{user_id}}
#for example
LIBRE_DP_ADMIN_ID=1

```
