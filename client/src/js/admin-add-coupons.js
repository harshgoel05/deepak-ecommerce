$("#admin-add-coupon-btn").on("click", function (event) {
  event.preventDefault();
  var form_data = $("#add_coupon_form").serializeArray();
  var body_data = {};
  let flag = 0;
  for (let i = 0; i < form_data.length; i++) {
    if (!form_data[i].value) {
      flag = 1;
      console.log("D", form_data[i]);
      break;
    } else {
      body_data[form_data[i].name] = form_data[i].value;
    }
  }
  if (body_data.type == "flat") {
    body_data.flat_off_amount = body_data.t_discount;
  } else if (body_data.type == "percentage") {
    body_data.flat_off_percentage = body_data.t_discount;
  }
  delete body_data["t_discount"];
  delete body_data["type"];
  console.log(body_data);
  console.log(flag);
  // if (flag != 0) {
  $.ajax({
    url:
      "https://testing1.thestrategybook.com/deepak-ecommerce/server/api/admin/coupons/add.php",
    type: "POST",
    data: JSON.stringify(body_data),
    success: function (response) {
      alert("Coupon addition successfull!");
    },
    error: function (xhr, status) {
      console.log("error", xhr, status);
      alert("Some unknown error occured.");
    },
  });
});
