# Документация:
Располагаете файл QueryBuilder.php с классом QueryBuilder в нужном месте вашего проекта.

Подключаете файл QueryBuilder.php. Например:
```php
include_once __DIR__ . '/../Components/QueryBuilder/QueryBuilder.php ';
```

Доступные методы класса Validate:
  + getAll($table); - получить все записи из таблицы
$table – название таблицы в БД. Тип string.

  + getOne($table, $id); - получить одну запись из таблицы по id
$table - название таблицы в БД. Тип string.
$id – id записи в таблице БД. Тип integer.

  + create($table, $data); - создать новую запись в таблице
$table - название таблицы в БД. Тип string.
$data – данные для новой записи в поле таблицы БД. Тип ассоциативный массив.

  + update($table, $data, $id); - изменить запись в таблице по id
$table - название таблицы в БД. Тип string.
$data – данные для изменения одной записи таблицы БД.  Тип ассоциативный массив.
$id - id записи в таблице БД. Тип integer.

  + delete($table, $id); - удалить запись в таблице по id
$table - название таблицы в БД. Тип string.
$id - id записи в таблице БД. Тип integer.


Пример использования компонента:

Создаем массив с настройками подключения к БД:
```php
$configDB = [
    'mysql' => [
        'host' => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'database' => 'my_project'
    ]
];
```

Создаем экземпляр объекта и передаем в класс QueryBuilder массив с настройками подключения к БД:
```php
$users = new QueryBuilder($configDB['mysql']);
```

Пример удаления одной записи, id которой равен 24 из таблицы ‘users’:
```php
$users->delete('users', 24);
```

Пример изменения записи в таблице ‘users’, id которой равен 24:
```php
$users->update('users', [                        //первый параметр название таблицы
    'username' => 'Kate Doe',                    //второй параметр это ассоциативный массив формата ключ => значение
    'password' => 'ExamplePasswordChange',       //где ключ это название поля в таблице, а значение
    'email' => 'example-post@site.com',          //это новые данные для поля
    'data_register_user' => '21/01/2021'
], 24);        			                  //третий параметр это id изменяемой записи
```


Пример создания одной новой записи в таблице ‘users’:
```php
$users->create('users', [                         //первый параметр название таблицы
        'username' => 'John Doe',                 //второй параметр это ассоциативный массив формата ключ => значение
        'password' => 'ExamplePassword',          //где ключ это название поля в таблице, а значение
        'email' => 'example@site.com',            //это данные для новой записи
        'data_register_user' => '12/01/2021'
]);
```

Пример получения одной записи из таблицы ‘users’, id которой равен 20. Получаем запись в виде ассоциативного массива и выводим удобным для нас образом:
```php
$users = $users->getOne('users', 20);      
    echo $users['id'] . '<br>';       		//ключи массива равны названию полей в таблице БД
    echo $users['username'] . '<br>';
    echo $users['email'] . '<br>';
    echo $users['data_register_user'] . '<br>';
    echo $users['status_user'] . '<br>';
    echo '<br>';
```

Пример получения всех записей из таблицы ‘users’. Получаем все записи в виде ассоциативного массива с вложенными массивами, перебираем и выводим например через конструкцию foreach:
```php
$users = $users->getAll('users');
foreach ($users as $value) {
    echo $value['id'] . '<br>'; 		//ключи массива равны названию полей в таблице БД
    echo $value['username'] . '<br>';
    echo $value['email'] . '<br>';
    echo $value['data_register_user'] . '<br>';
    echo $value['status_user'] . '<br>';
    echo '<br>';
}
```
