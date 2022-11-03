let editeTask = (e, id) => {
    //afficher modal
    $("#modal-task").modal("show");
    document.getElementById("task-save-btn").style.display = "none";
    document.getElementById("task-update-btn").style.display = "block";
    document.getElementById("task-delete-btn").style.display = "block";

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
}

function addbtn() {
    document.getElementById("form-task").reset();
    document.getElementById("task-save-btn").style.display = "block";
    document.getElementById("task-update-btn").style.display = "none";
    document.getElementById("task-delete-btn").style.display = "none";
};

//validation des input

// const titleTask = document.getElementById('task-title')
// const priorityTask = document.getElementById('task-priority')
// const statusTask = document.getElementById('task-status')
// const dateTask = document.getElementById('task-date')
// const descriptionTask = document.getElementById('task-description')
// const form = document.getElementById('form-task')


// form.addEventListener('submit', (e) => {
//     let message = [];
//     if (titleTask.value === '' || titleTask.value === null) {
//         message.push("please fill the blanks ")
//     }
//     if (message.length > 0) {
//         e.preventDefault()
//     }
// })
