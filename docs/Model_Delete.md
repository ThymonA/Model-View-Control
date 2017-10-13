##[ Class ] _Model_->delete();
Model is a class that makes it easy to interact with your database. 

#### Example 1 (Delete all records that contains one record)
If you want to delete all users with Id 1

| Id | Username | Password | Email             |
|---:|:--------:|:--------:|:-----------------:|
|1   | User1    | Passwd1  | user1@example.com |
|2   | User2    | Passwd2  | user2@example.com |
|3   | User3    | Passwd3  | user3@example.com |
|4   | User4    | Passwd1  | user1@example.com |
|5   | User5    | Passwd2  | user2@example.com |
|6   | User6    | Passwd3  | user3@example.com |
```php
$model = new model();
$model->table('Users')->delete([
    'id' => 1
]);
```
Table after executing query

| Id | Username | Password | Email             |
|---:|:--------:|:--------:|:-----------------:|
|2   | User2    | Passwd2  | user2@example.com |
|3   | User3    | Passwd2  | user3@example.com |
|4   | User4    | Passwd2  | user1@example.com |
|5   | User5    | Passwd2  | user2@example.com |
|6   | User6    | Passwd2  | user3@example.com |

#### Example 2 (Delete all records that contains two record)
If you want to delete all users that contains the following records (Password = Passwd2 AND Email = user2@example.com)

| Id | Username | Password | Email             |
|---:|:--------:|:--------:|:-----------------:|
|1   | User1    | Passwd2  | user1@example.com |
|2   | User2    | Passwd2  | user2@example.com |
|3   | User3    | Passwd2  | user3@example.com |
|4   | User4    | Passwd2  | user1@example.com |
|5   | User5    | Passwd2  | user2@example.com |
|6   | User6    | Passwd2  | user3@example.com |
```php
$model = new model();
$model->table('Users')->delete([
    'Password' => 'Passwd2', 
    'Email' => 'user1@example.com'
]);
```
Table after executing query

| Id | Username | Password | Email             |
|---:|:--------:|:--------:|:-----------------:|
|2   | User2    | Passwd2  | user2@example.com |
|3   | User3    | Passwd2  | user3@example.com |
|5   | User5    | Passwd2  | user2@example.com |
|6   | User6    | Passwd2  | user3@example.com |

#### Example 3 (Delete all records with "OR" statement)
If you want to delete all users that contains (Password = Passwd1 or Passwd3)

| Id | Username | Password | Email             |
|---:|:--------:|:--------:|:-----------------:|
|1   | User1    | Passwd1  | user1@example.com |
|2   | User2    | Passwd2  | user2@example.com |
|3   | User3    | Passwd3  | user3@example.com |
|4   | User4    | Passwd1  | user1@example.com |
|5   | User5    | Passwd2  | user2@example.com |
|6   | User6    | Passwd3  | user3@example.com |
```php
$model = new model();
$model->table('Users')->delete([
    'Password' => [
        'Passwd1',
        'Passwd2'
    ]
]);
```
Table after executing query

| Id | Username | Password | Email             |
|---:|:--------:|:--------:|:-----------------:|
|2   | User2    | Passwd2  | user2@example.com |
|5   | User5    | Passwd2  | user2@example.com |

#### Overview of functions and corresponding query
_1_ . 
```php
$model = new model();
$model->table('Users')->delete([
    'id' => 1
]);
```
```mysql
DELETE FROM `users` WHERE `Id` = 1
```
_2_.
```php
$model = new model();
$model->table('Users')->delete([
    'Password' => 'Passwd2', 
    'Email' => 'user1@example.com'
]);
```
```mysql
DELETE FROM `users` WHERE `Password` = 'Passwd2' AND `Email` = 'user1@example.com'
```
_3_.
```php
$model = new model();
$model->table('Users')->delete([
    'Password' => [
        'Passwd1',
        'Passwd2'
    ]
]);
```
```mysql
DELETE FROM `users` WHERE (`Password` = 'Passwd1' OR `Password` = 'Passwd2')
```
_4_.
```php
$model = new model();
$model->table('Users')->delete([
    'Password' => [
        'Passwd1',
        'Passwd2'
    ],
    'Email' => [
        'user1@example.com',
        'user2@example.com'
    ]
]);
```
```mysql
DELETE FROM `users` WHERE (`Password` = 'Passwd1' OR `Password` = 'Passwd2') AND (`Email` = 'user1@example.com' OR `Email` = 'user2@example.com')
```
_5_.
```php
$model = new model();
$model->table('Users')->delete([
    'Password' => [
        'Passwd1',
        'Passwd2'
    ],
    'Email' => 'user1@example.com'
]);
```
```mysql
DELETE FROM `users` WHERE (`Password` = 'Passwd1' OR `Password` = 'Passwd2') AND `Email` = 'user1@example.com'
```

With Model->delete() You can use infinite "OR" or "AND" statements in to delete data in your database