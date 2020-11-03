var url = "https://shreedeepaksarees.com/server/api/user/profile.php";

$.ajax({
  url: url,
  type: "GET",
  crossDomain: true,
  success: function (response) {
    // $("#user-pp-img").html(response.data.image);// fix image
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
