var url =
  "https://testing1.thestrategybook.com/deepak-ecommerce/server/api/user/profile.php";

$.ajax({
  url: url,
  type: "GET",
  crossDomain: true,
  success: function (response) {
    // $("#user-pp-img").attr(response.data.name);// fix image
    $("#user-name").html(response.data.name);
    $("#user-email").html(response.data.email);
    $("#user-num").html(
      `${response.data.mobile_no}<br>${response.data.alternate_mobile_no}<br>`
    );
    $("#user-add").html(
      `Addresss: ${response.data.address}<br>
       State: ${response.data.state}<br>
       City: ${response.data.city}<br>
       PinCode: ${response.data.pin_code}
       `
    );
  },
  error: function (xhr, status) {
    console.log("User Not logged in");
  },
});
