//toggle the visibility of the new task form
function toggleNewTask() {
    var newID = document.getElementById("new_task_form");
    if (newID.style.display === "none") {
        newID.style.display = "block";
    } else {
        newID.style.display = "none";
    }
}

//toggle the visibility of the edit task form
function toggleEditTask() {
    var editID = document.getElementById("edit_task_form");
    if (editID.style.display === "none") {
        editID.style.display = "block";
    } else {
        editID.style.display = "none";
    }
}