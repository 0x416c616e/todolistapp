function putIdInForm(item_id, todo_item) {
    document.getElementById("item_id").value = item_id;
    document.getElementById("todo_item").value = todo_item;
}
function clearNew() {
    document.getElementById("priority").value = "";
    document.getElementById("task").value = "";
}
function clearEdit() {
    document.getElementById("item_id").value = "";
    document.getElementById("todo_item").value = "";
}