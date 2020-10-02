$.ajax({
  url:
    "https://testing1.thestrategybook.com/deepak-ecommerce/server/api/admin/profile.php",
  type: "GET",
  xhrFields: {
    withCredentials: true,
  },
  success: function (response, status, xhr) {
    console.log("Admin is logged in");
  },
  error: function (xhr, status) {
    console.log("error", xhr, status);
    window.location.replace("../../adminportal/login.html");
  },
});

$(".logout-admin-btn").click(function () {
  $.ajax({
    url:
      "https://testing1.thestrategybook.com/deepak-ecommerce/server/api/admin/logout.php",
    type: "GET",
    xhrFields: {
      withCredentials: true,
    },
    success: function (response, status, xhr) {
      console.log("Successfully logged out");
      window.location.replace(
        "https://testing1.thestrategybook.com/deepak-ecommerce/server/client/adminportal/login.html"
      );
    },
    error: function (xhr, status) {
      console.log("error", xhr, status);
      alert("Some unknown error occured");
    },
  });
});
