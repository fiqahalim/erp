### Requirements

-   **SERVER**: Apache 2 or NGINX.
-   **RAM**: 3 GB or higher.
-   **PHP**: 7.3 or higher.
-   **For MySQL users**: 5.7.23 or higher.
-   **For MariaDB users**: 10.2.7 or Higher.
-   **Node**: 8.11.3 LTS or higher.
-   **Composer**: 1.6.5 or higher.

### Installation and Configuration

##### Execute these commands below, in order

```
composer create-project krayin/laravel-crm
```

-   Find **.env** file in root directory and change the **APP_URL** param to your **domain**.

-   Also, Configure the **Mail** and **Database** parameters inside **.env** file.

```
php artisan krayin-crm:install
```

**To execute Krayin**:

##### On server:

Warning: Before going into production mode we recommend you uninstall developer dependencies.
In order to do that, run the command below:

> composer install --no-dev

```
Open the specified entry point in your hosts file in your browser or make an entry in hosts file if not done.
```

##### On local:

```
php artisan route:clear
php artisan serve
```


**How to log in as admin:**

> _http(s)://example.com/admin/login_

```
email:admin@example.com
password:admin123
```

### Screenshot
![image](https://user-images.githubusercontent.com/93239445/185532856-30c4b7d0-21b3-4182-8c36-192e97837a11.png)

![image](https://user-images.githubusercontent.com/93239445/185532921-8bcf4486-b1e8-4ca2-8240-8d06f6f17716.png)

