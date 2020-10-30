$.ajax({
    url:
      "https://testing1.thestrategybook.com/deepak-ecommerce/server/api/user/profile.php",
    type: "GET",
    xhrFields: {
      withCredentials: true,
    },
    success: function (response, status, xhr) {
      console.log("user is logged in");
    },
    error: function (xhr, status) {
      console.log("error", xhr, status);
      window.location.href =
        "https://testing1.thestrategybook.com/deepak-ecommerce/client/user/login.html";
    },
  });
  
  $(".logout-user-btn").click(function (e) {
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
        alert("Some unknown error occured");
      },
    });
  });
  