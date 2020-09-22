$("#login-btn").on("click", function (event) {
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
        "https://testing1.thestrategybook.com/deepak-ecommerce/server/api/user/login.php",
      type: "POST",
      data: JSON.stringify(body),
      success: function (response) {
        console.log(response);
        location.replace(
          "https://harshgoel05.github.io/deepak-ecommerce/client/adminportal.html"
        );
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
// FrontDesk => Add client, Trainer ( employee, time)
// Admin => All menus

$("#logout-btn").click(function (e) {
  e.preventDefault();
  var url =
    "https://testing1.thestrategybook.com/deepak-ecommerce/server/api/logout.php";

  $.ajax({
    url: url,
    type: "GET",
    crossDomain: true,
    success: function (response) {
      localStorage.removeItem("status");
      localStorage.removeItem("role");
      localStorage.removeItem("user");
      location.replace(
        "https://harshgoel05.github.io/deepak-ecommerce/client/login.html"
      );
    },
    error: function (xhr, status) {
      console.log("error", xhr, status);
      alert("Some unknown error occured");
    },
  });
});