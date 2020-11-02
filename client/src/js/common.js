$(".footer").load(
  "https://testing1.thestrategybook.com/deepak-ecommerce/client/common/footer.html"
);

$(".div-nav").load(
  "https://testing1.thestrategybook.com/deepak-ecommerce/client/common/navbar.html"
);

$("#nav-logout").click(function (e) {
  e.preventDefault();
  var url =
    "https://testing1.thestrategybook.com/deepak-ecommerce/server/api/logout.php";

  $.ajax({
    url: url,
    type: "GET",
    crossDomain: true,
    success: function (response) {
      window.location.href =
        "https://testing1.thestrategybook.com/deepak-ecommerce/client/user/login.html";
    },
    error: function (xhr, status) {
      console.log("error", xhr, status);
      alert("Some unknown error occured, Please try after some time.");
    },
  });
});
