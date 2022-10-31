let editeTask = (e, id) => {
    //afficher modal
    $("#modal-task").modal("show");
    let selectedTitleTask = e.children[1].children[0].textContent;
    let selectedDateTask = e.children[1].children[1].children[0].getAttribute("dataDate");
    let selectedDescriptionTask = e.children[1].children[1].children[1].textContent;
    let selectedpriorityTask = e.children[1].children[2].children[0].getAttribute('dataPriority');
    let selectedtypeTask = e.children[1].children[2].children[1].getAttribute('dataType');


    document.getElementById("task-title").value = selectedTitleTask;
    document.getElementById("task-type-" + selectedtypeTask).checked = true;
    document.getElementById("task-priority").value = selectedpriorityTask;
    document.getElementById("task-status").value = e.getAttribute("dataStatus");
    document.getElementById("task-date").value = selectedDateTask;
    document.getElementById("task-description").value = selectedDescriptionTask;
    document.getElementById("task-id").value = id;

    // textInput.value = selectedDateTask.textContent;
    // textInput.value = selectedDescriptionTask.innerHTML;
    // textInput.value = selectedpriorityTask.innerHTML;
    // textInput.value = selectedtypeTask.innerHTML;
}