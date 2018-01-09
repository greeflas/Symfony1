Symfony 1 demo project
======================

This is demo project for learning the Symfony 1 framework.

## Create project structure

`$ sh symfony.sh generate:project project_name`

| Dir name  | Description                               |
|-----------|-------------------------------------------|
| apps/     | Contains all application of the project   |
| cache/    | Cache of the framework                    |
| config/   | Configuration files                       |
| lib/      | Libs and classes of the project           |
| log/      | Log files                                 |
| plugins/  | Installed plugins                         |
| test/     | Test files                                |
| web/      | Root web directory                        |

## Create application

`$ ./symfony generate:app frontend`

| Dir name      | Description                           |
|---------------|---------------------------------------|
| config/       | Configuration files of application    |
| lib/          | Libs and classes of the application   |
| modules/      | MVC                                   |
| templates/    | Global templates of application       |

## Install plugins

`$ ./symfony plugin:install sfDoctrineGuardPlugin`

## Run application

`$ cd project_name/web && ln -s ../lib/vendor/symfony/data/web/sf/ sf`

`$ php -S 127.0.0.1:8080`

## Run tests

`$ ./symfony test:unit`