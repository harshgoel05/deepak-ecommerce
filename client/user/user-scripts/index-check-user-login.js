var url = "https://shreedeepaksarees.com/server/api/user/profile.php";

$.ajax({
  url: url,
  type: "GET",
  crossDomain: true,
  success: function (response) {
    //change navbar ( remove signup and login)
    console.log("User logged in");
    $("#nav-signin").css("display", "none");
    $("#nav-login").css("display", "none");
  },
  error: function (xhr, status) {
    console.log("User Not logged in");
    $("#nav-wishlist").css("display", "none");
    $("#nav-mycart").css("display", "none");
    $("#nav-logout").css("display", "none");
  },
});
