# Database setup instructions

This to-do list app needs a database and a table. You will need a LAMP server, or perhaps a local MAMP or WAMP stack. In any case, you need An Apache web server, MySQL database, and PHP. These are the instructions relating to the MySQL setup.

Firstly, use something like the mysql command line tool or MySQL Workbench to log into your root user for the database.

## Making the todoapp database

Use the following statements to make a database:

```
CREATE DATABASE todoapp;
USE todoapp;
```

Verify it with the following:

```
SHOW DATABASES;
```

You should now see a new database called todoapp.

## Making the todolist table

The to-do list app needs a table for the to-do items. They only need a number for priority and a to-do item field:

```
CREATE TABLE todolist(
    priority INT,
    todo_item VARCHAR(280) NOT NULL,
    item_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT
);
```

I made the priority optional, because maybe you have no clear deadline for something. But the todo_item can't be null, because even without a priotity, a to-do item needs a name or description. I chose 280 characters because that's the size of a tweet.

The reason why I let priority be duplicate (i.e. having two items in a to-do list with priority of 1) is because you might do multiple to-do things at the same time. For example, you might get an oil change and then go to the grocery store, all in the same trip. So having duplicate priority numbers means you can sort of group things. It's also easier than checking if things are duplicate.

item_id is only used by the database and to-do list app software, not the end user. It's a way to uniquely identify items.

## Rename the config file

The todolist.php file stores credentials in database_config.php.

This repo contains a file called database_config.php.EXAMPLE. You will need to rename this file to database_config.php and also put in your database credentials. database_config.php is excluded in the .gitignore so that you can't leak credentials.

## Putting a sample entry into the to-do list

Use the following query to make a test to-do list item in your to-do list app:

```
INSERT INTO todolist (priority, todo_item, item_id) VALUES (1, 'get groceries', 1);
```

Verify that it got put into the table:

```
SELECT * FROM todolist;
```

Try another one:

```
INSERT INTO todolist (priority, todo_item) VALUES (2, 'get oil change');
```

Now there will be two rows in the table.

View it again:

```
SELECT * FROM todolist;
```

## Making the second table: today

There is a section in the to-do list that will list what today's priorities are. Items in the to-do list have a numeric priority field.

So if your to-do list looks like this:

- 1 do something
- 40 do something else
- 70 do another thing
- 100 study for test
- 160 something else
- 300 go to grocery store
- 400 go to hardware store

Then you can do something like this:

Today's priorities: 1-300

The reason why I use big and spaced apart numbers in the priority list is because it makes it easier to insert new items in between them. 

For instance, if you wanted to put "go to mechanic" in between "do something" and "do something else", you could give it a priority of 20.

Create a new table called today:

```
CREATE TABLE today(
    today_range VARCHAR(64),
    today_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT
);
```

You'll really only be using a single row in the entire table. 

Now add the single row that will be used for this feature:

```
INSERT INTO today (today_range, today_id) VALUES ('0-0', 123);
```

Verify that you did it correctly with the following:

```
SELECT * FROM today;
```