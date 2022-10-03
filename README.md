# Peça Direta

## Instalação

Antes de executar a migração do Laravel, cria a tabela executando:
```sql
CREATE DATABASE pecadireta COLLATE Latin1_General_CI_AI
```

## Erro de Permissões

```bash
chmod -R 777 /var/task
chmod -R 777 /tmp
```

## Obter URL demo

```bash
./node_modules/.bin/lt --port 80 --subdomain pecadireta
```

## Obter URL demo
```bash
php artisan scout:flush "App\\Models\\Peca"
php artisan scout:import "App\\Models\\Peca"
```

## Configurar o Navicat 16

Instale o "Microsoft ODBC Driver 18 para SQL Server (x64)" encontrado em https://docs.microsoft.com/pt-br/sql/connect/odbc/download-odbc-driver-for-sql-server

```ini
Host: localhost,1433
Initial Database: master
Authentication: SQL Server Authentication
User Name: sa
Password: (Encontrado no docker-compose.yml)
```
