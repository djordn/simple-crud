# simple-crud
Just a simple CRUD

Copie o arquivo .env.example para .env ( com o . ( ponto ) mesmo )

Execute o arquivo start.sh e espere pra ver a mensagem:

```sh

Document root is /opt/public
Press Ctrl-C to quit.

```

Abra uma outra janela/terminal e execute o comando:

```sh
$ docker exec -it php ash
```


Voce estará dentro do container php.
Execute os comandos:

 
```sh
$ composer install 
```

E depois o comando:


```sh
$ php artisan migrate 
```

Deverá ver algo parecido com

```sh
/opt # php artisan migrate
Migration table created successfully.
Migrating: 2017_12_19_030819_create_users_table
Migrated:  2017_12_19_030819_create_users_table
/opt # 
```
Teste a inserção de um usuario
```sh
curl -X PUT \
  http://localhost/user \
  -H 'cache-control: no-cache' \
  -H 'content-type: application/json' \
  -H 'postman-token: db81cde6-6cab-9b8d-358f-e5d94581d50a' \
  -d '{
	
	"name" : "Jordan Sousa",
	"username" : "djordn"
	
}'
```

Se tudo deu certo, você deverá ver uma mensagem parecida com essa:

```sh
{"data":{"status":"SUCCESS","message":"User created successfully!","status_code":201}}% 
```

Abra o seu navegador e acesse: http://localhost/users

Você deverá ver o usuario criado:

```sh
 [
  {
    id: 1,
    name: "Jordan Sousa",
    username: "djordn",
    created_at: "2017-12-19 16:39:34",
    updated_at: "2017-12-19 16:39:34"
  }
]
```
