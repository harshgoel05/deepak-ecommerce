$.ajax({
  url: "https://shreedeepaksarees.com/server/api/admin/profile.php",
  type: "GET",
  xhrFields: {
    withCredentials: true,
  },
  success: function (response, status, xhr) {
    console.log("Admin is logged in");
  },
  error: function (xhr, status) {
    console.log("error", xhr, status);
    // window.location.href =
    //   "https://shreedeepaksarees.com/client/adminportal/login.html";
  },
});

$(".logout-admin-btn").click(function (e) {
  e.preventDefault();
  var url = "https://shreedeepaksarees.com/server/api/logout.php";

  $.ajax({
    url: url,
    type: "GET",
    crossDomain: true,
    success: function (response) {
      window.location.href =
        "https://shreedeepaksarees.com/client/adminportal/login.html";
    },
    error: function (xhr, status) {
      console.log("error", xhr, status);
      alert("Some unknown error occured");
    },
  });
});
