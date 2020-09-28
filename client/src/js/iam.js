$("#add-btn").on("click", function (event) {
  event.preventDefault();
  var username = $("#username").val();
  var pass = $("#pass").val();
  console.log(username, pass);
  if (username && pass) {
    let body = {
      email: username,
      password: pass,
    };
    $.ajax({
      url:
        "https://testing1.thestrategybook.com/deepak-ecommerce/server/api/admin/add.php",
      type: "POST",
      data: JSON.stringify(body),
      success: function (response) {
        console.log(response);
        alert("Admin added sucessfully!");
      },
      error: function (xhr, status) {
        console.log("error", xhr, status);
        alert("Some unknown error occured");
      },
    });
  } else {
    alert("Please enter all the details");
  }
});
