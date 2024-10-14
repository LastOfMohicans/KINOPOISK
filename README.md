# KINOPOISK PURE PHP PROJECT
## In this project i used lando. Configuration file: .lando.yml

# STEP 1 Create docker containers with lando.
```lando start```

# STEP 2 CREATE DARABASES.
## You need installed cmake in you operation system, paste below coomand in the terminal.
```make up```

* This command run migrations into file migrate_up.php and create necessary databases.

* For buck up paste in the terminal ```make down```

# HELP COMMANDS:
```docker exec -it kinopoisk_appserver_1 bash```

```docker ps --format "ID: {{.ID}}, Name: {{.Names}}"```

```docker ps --format "{{.Names}}"```

```ln -s $PWD/storage/ $PWD/public/storage```
