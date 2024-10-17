// function for pagination
function pagination(totalPages, currentPage) {
  let pageList = "";
  if (totalPages > 1) {
    currentPage = parseInt(currentPage);
    const prevClass = currentPage === 1 ? "disabled" : "";
    const nextClass = currentPage === totalPages ? "disabled" : "";
    pageList += `
            <ul class="pagination justify-content-center ">
                <li class="page-item ${prevClass}"><a class="page-link" data-page="${
      currentPage - 1
    }" href="#">Previous</a></li>`;
    for (let i = 1; i <= totalPages; i++) {
      const activeClass = currentPage === i ? "active" : "";
      pageList += `<li class="page-item ${activeClass}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
    }

    pageList += `         
                <li class="page-item"><a class="page-link ${nextClass}" data-page="${
      currentPage + 1
    }" href="#">Next</a></li>
            </ul>
        `;
  }

  $("#pagination").html(pageList);
}

// function to get users from database
function getUserRow(user) {
  let userRow = "";
  if (user) {
    const avatar = user.photo || "default_avatar.jpg";

    userRow = `
		<tr>
      		<td><img class="profile-img" src="./uploads/${avatar}" alt="avatar" </td>
      		<td class="mt-5">${user.name}</td>
      		<td>${user.email}</td>
      		<td>${user.mobile}</td>
      		<td>
				<a 
      				href="#"
      				class="me-3 profile"
					data-bs-target="#userViewModal"
      				data-bs-toggle="modal"
      				data-id=${user.id}
      				title="View profile" 
      			><i class="fas fa-eye text-success"></i>
      			</a>
      			<a 
      				href="#"
      				class="me-3 edituser"
      				data-bs-target="#usermodal"
      				data-bs-toggle="modal"
      				data-id=${user.id}
      				title="Edit"
      			><i class="fas fa-edit text-info"></i></a>
      			<a 
      				href="#"
      				class="me-3 deleteuser"
      				data-id=${user.id}
      				title="Delete"
      			><i class="fas fa-trash-alt text-danger"></i></a>
      		</td>
    	</tr>`;
  }

  return userRow;
}

// getting users
function getUsers() {
  const pageNumber = $("#currentPage").val();
  $.ajax({
    url: "/projects/CRUD/ajax.php",
    type: "GET",
    dataType: "json",
    data: { page: pageNumber, action: "getAllUsers" },
    beforeSend: () => console.log("Wait... data is loading"),
    success: (response) => {
      if (response.success) {
        if (response.data) {
          let usersList = "";
          $.each(response.data, function (index, user) {
            usersList += getUserRow(user);
          });
          $("#userTable tbody").html(usersList);
          let totalUsers = response.count;
          let totalPages = Math.ceil(totalUsers / 4);
          pagination(totalPages, pageNumber);
        }
      } else {
        //console.log("Failed: ", response.message);
      }
    },
    error: (request, error) => console.log("Error: ", error),
  });
}

$(document).ready(() => {
  // Adding users
  $(document).on("submit", "#addForm", function (event) {
    event.preventDefault();
    //$(':input[type="submit"]').prop("disabled", true);
    // AJAX call
    $.ajax({
      url: "/projects/CRUD/ajax.php",
      type: "POST",
      dataType: "json",
      data: new FormData(this),
      processData: false,
      contentType: false,
      beforeSend: () => {
        console.log("Wait... data is loading");
      },
      success: (response) => {
        if (response.success) {
          console.log("Success: ", response.message);
          $("#userModal").modal("hide");
          $("#addForm")[0].reset();
        } else {
          console.log("Failed: ", response.message);
        }
      },
      error: (request, error) => console.log("Error: ", error),
    });
  });

  // on click event for pagination
  $(document).on("click", "ul.pagination li a", function (event) {
    event.preventDefault();

    const pageNumber = $(this).data("page");
    $("#currentPage").val(pageNumber);
    getUsers();
    $(this).parent().siblings().removeClass("active");
    $(this).parent().addClass("active");
  });

  // on click event for editing
  $(document).on("click", "a.edituser", function () {
    const userId = $(this).data("id");

    $.ajax({
      url: "/projects/CRUD/ajax.php",
      type: "GET",
      dataType: "json",
      data: { id: userId, action: "editUserData" },
      beforeSend: () => console.log("Wait... data is loading"),
      success: ({ success, message, data }) => {
        console.log(message);
        if (success) {
          $("#userId").val(data.id);
          $("#username").val(data?.name);
          $("#email").val(data?.email);
          $("#mobile").val(data?.mobile);
        } else {
          console.log("Failed: ", message);
        }
      },
      error: (request, error) => console.log("Error: ", error),
    });
  });

  // calling getUsers fun
  getUsers();
});
