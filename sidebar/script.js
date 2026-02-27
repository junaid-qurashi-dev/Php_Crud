$(document).ready(function () {
  function loaddata(page, query = "", status = "") {
    let url = "Crud/ajax-load.php";
    let data = {
      type: "fetch",
      page: page,
      query: query,
      status: status,
    };
    customAjax(url, data, studentFetch);
    function studentFetch(response) {
      $("#data").html(response.table);
      $("#pagination").html(response.pagination);
    }
  }
  loaddata(1);

  /* ===============================
        PAGINATION
     =============================== */
  $(document).on("click", ".page-link", function (e) {
    e.preventDefault();

    var page = $(this).data("page");
    var search = $("#search_input").val();
    var status = $("#status_filter").val();

    loaddata(page, search, status);
  });

  /* ===============================
        LIVE SEARCH BUTTON
     =============================== */
  $("#search_btn").click(function () {
    var search = $("#search_input").val();
    var status = $("#status_filter").val();

    loaddata(1, search, status);
  });

  /* ===============================
        STATUS FILTER
     =============================== */
  $("#status_filter").change(function () {
    var status = $(this).val();
    var search = $("#search_input").val();

    loaddata(1, search, status);
  });
  $(document).ready(function () {
    // Status toggle AJAX with distinct SweetAlerts
    $(document).on("change", ".status-toggle", function () {
      var student_id = $(this).data("id");
      var status = $(this).is(":checked") ? "active" : "inactive";

      $.ajax({
        url: "Crud/code.php", // update file
        type: "POST",
        data: {
          status_update: true,
          stu_id: student_id,
          status: status,
        },
        success: function (response) {
          if (status === "active") {
            Swal.fire({
              icon: "success", // green tick
              title: "Activated!",
              text: "Student is now ACTIVE ✅",
              showConfirmButton: false,
              timer: 2000,
            });
          } else {
            Swal.fire({
              icon: "warning", // yellow/orange exclamation
              title: "Deactivated!",
              text: "Student is now INACTIVE ⏸️",
              showConfirmButton: false,
              timer: 2000,
            });
          }

          // Reload table to sync toggle state
          if (typeof loaddata === "function") loaddata(1);
        },
        error: function (xhr, status, error) {
          Swal.fire({
            icon: "error",
            title: "Oops!",
            text: "Failed to update status!",
          });
          console.log("AJAX Error:", error);
        },
      });
    });
  });
});
