//for editing
function putIdInForm(priority_edit, item_id, todo_item) {
    document.getElementById("priority_edit").value = priority_edit;
    document.getElementById("item_id").value = item_id;
    document.getElementById("todo_item").value = todo_item;
}
//clear new form
function clearNew() {
    document.getElementById("priority").value = "";
    document.getElementById("task").value = "";
}
//clear edit form
function clearEdit() {
    document.getElementById("item_id").value = "";
    document.getElementById("todo_item").value = "";
    document.getElementById("priority_edit").value = "";
}