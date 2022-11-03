
<?php
//INCLUDE DATABASE FILE
require('database.php');

//SESSSION IS A WAY TO STORE DATA TO BE USED ACROSS MULTIPLE PAGES
session_start();

//ROUTING
if (isset($_POST['save']))        saveTask();
if (isset($_POST['update']))      updateTask();
if (isset($_POST['delete']))      deleteTask();

function countertasks($numeroStatus)
{
  //SQL SELECT 
  $requete = "SELECT * from tasks where status_id=$numeroStatus;";
  global $con;
  $query = mysqli_query($con, $requete);

  return mysqli_num_rows($query);
}

function getTasks($numeroStatus)
{
  //CODE HERE
  $requete = "SELECT tasks.id , tasks.title,types.name 
    AS 'typeName',tasks.type_id,priorities.name 
    AS 'priorityName',tasks.priority_id,tasks.status_id,tasks.task_datetime,tasks.description 
    FROM tasks, types ,priorities  
    WHERE tasks.type_id = types.id 
    AND tasks.priority_id = priorities.id";
  //SQL SELECT 
  global $con;
  $query = mysqli_query($con, $requete);
  $inpro = '';
  $todo = '';
  $done = '';

  foreach ($query as $count => $row) {
    if ($row['status_id'] == 1) {
      $todo .= '
        <button  onclick="editeTask(this, ' . $row['id'] . ')" dataStatus="' . $row['status_id'] . '" class=" Task bg-white w-100 d-flex border-0 pb-2">
          <div class="px-2 text-start mt-3 ">
            <i class="text-start fa-regular fa-circle-question text-success fa-lg"></i>
          </div>
          <div class="text-start mt-2">
            <div class="h6">' . $row['title'] . '</div>
            <div class="text-start">
              <div dataDate="' . $row['task_datetime'] . '"># ' . $count + 1 . ' created ' . $row['task_datetime'] . '</div>
              <div title="' . $row['description'] . '" class="text-truncate" style="max-width: 16rem;">' . $row['description'] . '</div> </div>
            <div class="">
              <span class="btn btn-primary" style="font-size: 0.6rem; padding: 2px 6px" dataPriority="' . $row['priority_id'] . '">' . $row['priorityName'] . '</span>
              <span class="btn btn-gray-400 text-dark" style="font-size: 0.6rem; padding: 2px 6px" dataType="' . $row['type_id'] . '">' . $row['typeName'] . '</span>
              </div>
          </div>
      </button>';
    } else if ($row['status_id'] == 2) {
      $inpro .= '
            <button onclick="editeTask(this, ' . $row['id'] . ')" dataStatus="' . $row['status_id'] . '" class=" Task bg-white w-100 d-flex border-0 pb-2">
            <div class="px-2 text-start mt-3 ">
            <i class="text-start fa fa-circle-notch text-success fa-lg"></i></div>
            <div class="text-start mt-2">
              <div class="h6">' . $row['title'] . '</div>
              <div class="text-start">
                <div dataDate="' . $row['task_datetime'] . '"># ' . $count + 1 . ' created ' . $row['task_datetime'] . '</div> <div
                title="' . $row['description'] . '" class="text-truncate" style="max-width: 16rem;">' . $row['description'] . '</div>
              </div>
              <div class="">
                <span class="btn btn-primary" style="font-size: 0.6rem; padding: 2px 6px" dataPriority="' . $row['priority_id'] . '">' . $row['priorityName'] . '</span>
                <span class="btn btn-gray-400 text-dark" style="font-size: 0.6rem; padding: 2px 6px" dataType="' . $row['type_id'] . '">' . $row['typeName'] . '</span>
                </div>
            </div>
          </button>';
    } elseif ($row['status_id'] == 3) {
      $done .= '
                <button onclick="editeTask(this, ' . $row['id'] . ')" dataStatus="' . $row['status_id'] . '" class=" Task bg-white w-100 d-flex border-0 pb-2">
                <div class="px-2 text-start mt-3 ">
                <i class="text-start far fa-check-circle text-success fa-lg"></i>
                  </div>
                <div class="text-start mt-2">
                  <div class="h6">' . $row['title'] . '</div>
                  <div class="text-start">
                    <div dataDate="' . $row['task_datetime'] . '">#' . $count + 1 . ' created ' . $row['task_datetime'] . '</div>
                    <div
                    title="' . $row['description'] . '" class="text-truncate" style="max-width: 16rem;">' . $row['description'] . '
                  </div>
                  </div>
                  <div class="">
                    <span class="btn btn-primary" style="font-size: 0.6rem; padding: 2px 6px" dataPriority="' . $row['priority_id'] . '">' . $row['priorityName'] . '</span>
                    <span class="btn btn-gray-400 text-dark" style="font-size: 0.6rem; padding: 2px 6px" dataType="' . $row['type_id'] . '">' . $row['typeName'] . '</span>
                    </div>
                </div>
              </button>';
    }
  }
  if ($numeroStatus == 1) {
    return $todo;
  }
  if ($numeroStatus == 2) {
    return $inpro;
  }
  if ($numeroStatus == 3) {
    return $done;
  }
}

function saveTask()
{
  //CODE HERE
  $title = $_POST['title'];
  $type = $_POST['task-type'];
  $priority = $_POST['priority'];
  $status = $_POST['status'];
  $date = $_POST['date'];
  $description = $_POST['description'];
  if (empty($title) || empty($type) || empty($priority) || empty($status) || empty($date) || empty($description)) {
    $_SESSION['ERROR'] = " PLEASE fill the blanks!";
    header('location: index.php');
  }
  //SQL INSERT
  $requete = "INSERT INTO tasks(`title`, `type_id`, `status_id`, `priority_id`, `task_datetime`, `description`) 
        VALUES ('$title','$type ','$status ','$priority','$date','$description')";
  global $con;
  $query = mysqli_query($con, $requete);
  if ($query) {
    $_SESSION['message'] = "Task has been added successfully !";
    header('location: index.php');
  }
}

function updateTask()
{
  //CODE HERE
  $id = $_POST['task-id'];
  $title = $_POST['title'];
  $type = $_POST['task-type'];
  $priority = $_POST['priority'];
  $status = $_POST['status'];
  $date = $_POST['date'];
  $description = $_POST['description'];

  // REQUETE SQL 
  $requete = "UPDATE tasks SET `title`='$title',`type_id`='$type',`status_id`='$status',
    `priority_id`='$priority',`task_datetime`='$date',`description`='$description' WHERE id =$id";
  global $con;
  $query = mysqli_query($con, $requete);
  if ($query) {
    $_SESSION['message'] = "Task has been updated successfully !";
    header('location: index.php');
  }
}

function deleteTask()
{
  //CODE HERE
  $id = $_POST['task-id'];
  //SQL DELETE
  $requete = "DELETE FROM `tasks` WHERE id =$id";
  global $con;
  $query = mysqli_query($con, $requete);
  if ($query) {
    $_SESSION['message'] = "Task has been updated successfully !";
    header('location: index.php');
  }
}
