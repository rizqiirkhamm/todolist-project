document.addEventListener("DOMContentLoaded", function () {
  displayTasks();
});

function displayTasks() {
  const todoList = document.getElementById("todos");
  todoList.innerHTML = "";

  fetch("backend.php")
    .then((response) => response.json())
    .then((data) => {
      data.forEach((tasks) => {
        const listArea = document.createElement("li");
        listArea.classList.add("todo");

        const listTask = document.createElement('p');
        listTask.textContent = tasks.task_name;
        if (tasks.completed === '1') {
            listTask.classList.add('completed');
        }
        
        const btnArea = document.createElement('div');
        btnArea.innerHTML = `<button class="button" onclick="toggleTask(${tasks.id})">Check</button>
        <button class="button" onclick="deleteTask(${tasks.id})">Delete</button>`;

       
        todoList.appendChild(listArea);
        listArea.appendChild(listTask);
        listArea.appendChild(btnArea);
       
      });
    });
}

function addTask() {
  const taskInput = document.getElementById("task");
  const task = taskInput.value.trim();
  if (task !== "") {
    fetch("backend.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        task,
      }),
    }).then(() => {
      taskInput.value = "";
      displayTasks();
    });
  }
}

function toggleTask(id) {
    fetch(`backend.php?id=${id}`, {
        method: 'PUT',
    })
    .then(() => displayTasks());
}

function deleteTask(id) {
    fetch(`backend.php?id=${id}`, {
            method: 'DELETE',
        })
        .then(() => displayTasks());
}

function deleteAll() {
    fetch(`backend.php`, {
        method: 'DELETE1',
    })
    .then(() =>displayTasks());
}

function toggleCompleted() {
  fetch(`backend.php`, {
      method: 'PUT1',
  })
  .then(response => {
      if (response.ok) {
          return response.json(); // Mengembalikan respons dalam bentuk JSON
      } else {
          throw new Error('Gagal mengubah status completed');
      }
  })
  .then(data => {
      // Menangani data yang diterima dari server setelah perubahan berhasil
      console.log('Data yang diterima:', data);

      // Ubah teks tombol berdasarkan status baru
      const button = document.getElementById('completedButton');
      button.textContent = (data.newStatus === 1) ? 'All Completed' : 'Completed';

      // Memanggil fungsi displayTasks atau melakukan operasi lain jika diperlukan
      displayTasks();
  })
  .catch(error => {
      console.error('Error:', error.message);
  });
}










