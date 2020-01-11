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
    todo_item VARCHAR(280) NOT NULL
);
```

I made the priority optional, because maybe you have no clear deadline for something. But the todo_item can't be null, because even without a priotity, a to-do item needs a name or description. I chose 280 characters because that's the size of a tweet.

The reason why I let priority be duplicate (i.e. having two items in a to-do list with priority of 1) is because you might do multiple to-do things at the same time. For example, you might get an oil change and then go to the grocery store, all in the same trip. So having duplicate priority numbers means you can sort of group things. It's also easier than checking if things are duplicate.

