# todolistapp

A LAMP to-do list app.

I find myself making to-do lists in text files on my computer a whole lot. I used to use Evernote, but there were some problems with it, and it cost money if you wanted to use it on multiple devices. Not to mention that there were issues with privacy and even data loss. So I decided against that. Now I'm making my own to-do list app. It's useful for keeping track of college assignments and whatnot, and also useful for getting more experience with Linux, Apache, MySQL, and PHP.

## How it works

A to-do list consists of items. Each item is something you want done. An item can have a Priority and description.

Here are some examples:

1. Laundry
2. Get groceries
3. Take out trash
4. Finish database class homework
5. Install software updates on server
6. Make doctor appointment
7. Go to the gym
8. Check bank statement

In its simplest form, each item in the list only has two things: a number for a priority, and a string for a description. You can probably make a more complicated to-do list, but this keeps it simple for now.

This will use CRUD, meaning Create, Read, Update, and Delete. You can add new items to the list, view items on the list, update/edit items (such as changing priority or the description), and removing items once you've finished them.

The app is web-based, and consists of a front-end that uses HTML and CSS, and a back-end consisting of a LAMP server running PHP code and connecting to a MySQL database.  

## How to use it

Make a todolist folder in your server's htdocs folder, and then put all the files from this repo in it. 

Go here to learn how to set up the database: [Link](https://github.com/0x416c616e/todolistapp/blob/master/database_setup.md)

Use it like this:

```
localhost/todolistapp/todolist.php?auth=password
```
