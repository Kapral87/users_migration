# Users migration

Service to migrate users from VK and HTTP API to get users info


## Getting Started

### Installation with docker

* Clone project from repository
```
git clone git@github.com:Kapral87/users_migration.git
```
Or download zip archive

* Copy .env.docker.example to .env

* Set variables in .env file (will be pass additional)
```
VK_USER_ID = {vk_user_id}
VK_APP_ACCESS_TOKEN = {vk_app_access_token}
```

* Execute commands to update dependencies
```
composer update
```

* Start docker container
```
./vendor/bin/sail up
```

* Generate app key
```
./vendor/bin/sail artisan key:generate
```

* Create the symbolic link to storage folder
```
./vendor/bin/sail artisan storage:link
```

* Migrate tables
```
./vendor/bin/sail artisan migrate
```

### Executing program

* Go to project directory in console
```
cd {project_directory}
```

{project_directory} - path to this project directory

* Execute command
```
./vendor/bin/sail artisan migrate:vkusers
```

* Send POST request to API endpoint http://localhost/api/v1/users to get all users

* Success response
```
{
    "data": [
        {
            "id": 1,
            "name": "Alexander Gulyaev",
            "email": "",
            "avatar": "http://users_migration.ru/storage/1014/1_avatar.jpg"
        },
        {
            "id": 2,
            "name": "Yury Tokarev",
            "email": "",
            "avatar": "http://users_migration.ru/storage/1015/2_avatar.jpg"
        },
        {
            "id": 3,
            "name": "Marina Leushina",
            "email": "",
            "avatar": "http://users_migration.ru/storage/1016/3_avatar.jpg"
        },
        ...
    ]
}
```

* Send POST request to API endpoint http://localhost/api/v1/users/{user_id} to get user info of user with passed user_id

{user_id} - int user id

* Success response
```
{
    "data": {
        "id": 1,
        "name": "Alexander Gulyaev",
        "email": "",
        "avatar": "http://users_migration.ru/storage/988/1_avatar.jpg"
    }
}
```

* Error response

```
{
    "error": {message}
}
```

message - error message

### Alternative Installation (without using docker)

* Clone project from repository
```
git clone git@github.com:Kapral87/users_migration.git
```
Or download zip archive

* Copy .env.example to .env and set variables
```
DB_DATABASE={db_name}
DB_USERNAME={user_name}
DB_PASSWORD={user_password}
```

* Set variables in .env file (will be pass additional)
```
VK_USER_ID = {vk_user_id}
VK_APP_ACCESS_TOKEN = {vk_app_access_token}
```

* Execute commands to install and update dependencies
```
composer install
composer update
```

* Migrate database structure
```
php artisan migrate
```


### Executing program (without using docker)

* Go to project directory in console
```
cd {project_directory}
```

{project_directory} - path to this project directory

* Execute command
```
php artisan migrate:vkusers
```

* Send POST request to API endpoint {current_project_domain}/api/v1/users to get all users

* Success response
```
{
    "data": [
        {
            "id": 1,
            "name": "Alexander Gulyaev",
            "email": "",
            "avatar": "http://users_migration.ru/storage/1014/1_avatar.jpg"
        },
        {
            "id": 2,
            "name": "Yury Tokarev",
            "email": "",
            "avatar": "http://users_migration.ru/storage/1015/2_avatar.jpg"
        },
        {
            "id": 3,
            "name": "Marina Leushina",
            "email": "",
            "avatar": "http://users_migration.ru/storage/1016/3_avatar.jpg"
        },
        ...
    ]
}
```

* Send POST request to API endpoint {current_project_domain}/api/v1/users/{user_id} to get user info of user with passed user_id

{user_id} - int user id

* Success response
```
{
    "data": {
        "id": 1,
        "name": "Alexander Gulyaev",
        "email": "",
        "avatar": "http://users_migration.ru/storage/988/1_avatar.jpg"
    }
}
```

* Error response

```
{
    "error": {message}
}
```

message - error message