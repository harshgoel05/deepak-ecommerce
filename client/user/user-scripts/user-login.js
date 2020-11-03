$("#user-logout-btn").click(function (e) {
  e.preventDefault();
  var url = "https://shreedeepaksarees.com/server/api/user/profile.php";

  $.ajax({
    url: url,
    type: "GET",
    crossDomain: true,
    success: function (response) {
      window.location.href =
        "https://shreedeepaksarees.com/client/user/profile.html";
    },
    error: function (xhr, status) {
      console.log("error", xhr, status);
    },
  });
});

$("#user-login-btn").on("click", function (event) {
  event.preventDefault();
  var email = $("#email").val();
  var pass = $("#pass").val();
  console.log(email, pass);
  if (email && pass) {
    let body = {
      email: email,
      password: pass,
    };
    $.ajax({
      url: "https://shreedeepaksarees.com/server/api/user/login.php",
      type: "POST",
      data: JSON.stringify(body),
      success: function (response) {
        console.log(response);
        window.location.href =
          "https://shreedeepaksarees.com/client/user/profile.html";
      },
      error: function (xhr, status) {
        console.log("error", xhr, status);
        alert("Please check the credentials");
      },
    });
  } else {
    alert("Please enter all the details");
  }
});
