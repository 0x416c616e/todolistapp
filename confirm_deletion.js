function confirmDeletion(delete_id, auth, mode, todo_item) {
    var message = "Are you sure you want to delete '" + todo_item + "'?";
    var choice = confirm(message);
    if (choice == true) {
        console.log("you pressed ok");
        var deletion_string = "delete.php?id=" + delete_id + "&auth=" + auth + "&mode=" + mode;
        //delete.php?id=%s&auth=%s&mode=$mode
        window.location.href = deletion_string;
    } else {
        console.log("you declined");
    }
}
