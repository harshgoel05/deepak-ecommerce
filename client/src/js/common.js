$(".footer").load("https://shreedeepaksarees.com/client/common/footer.html");

$(".div-nav").load("https://shreedeepaksarees.com/client/common/navbar.html");

$("#nav-logout").click(function (e) {
  e.preventDefault();
  var url = "https://shreedeepaksarees.com/server/api/logout.php";

  $.ajax({
    url: url,
    type: "GET",
    crossDomain: true,
    success: function (response) {
      window.location.href =
        "https://shreedeepaksarees.com/client/user/login.html";
    },
    error: function (xhr, status) {
      console.log("error", xhr, status);
      alert("Some unknown error occured, Please try after some time.");
    },
  });
});
