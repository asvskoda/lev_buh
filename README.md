## lev_buh.local
### Создание локальной копии проекта
```
переключится на ветку develop

git clone https://github.com/asvskoda/lev_buh
make init
```

### Настройка
#### Добавление имен хостов
```
echo '127.0.0.1 lev_buh.local' | sudo tee -a /etc/hosts
echo