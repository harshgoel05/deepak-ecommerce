$(document).ready(function () {
  var ord_stat;
  var items;
  $.ajax({
    url: "https://shreedeepaksarees.com/server/api/admin/orders/retrieve.php",
    type: "GET",
    success: function (response) {
      if (response.data) {
        response.data.forEach((ord, index) => {
          if (ord.order_status) {
            if (ord.order_status == "0") ord_stat = "Placed";
            else if (ord.order_status == "1") ord_stat = "Shipped";
            else if (ord.order_status == "2") ord_stat = "Delivered";
            else if (ord.order_status == "3") ord_stat = "Cancelled";
            else if (ord.order_status == "4") ord_stat = "Returned";
          }
          if (ord.items && ord.items.length > 0) {
            ord.items.forEach((it, index) => {
              item = `
              -------------------------------<br>
              Product No. ${index + 1}<br>
              quantity : ${it.selected_quantity} <br>
              colors : ${it.selected_colors} <br>
              Size : ${it.selected_size} <br>
              length : ${it.selected_length} <br>
              Width : ${it.selected_width} <br>
                ----------------------------<br>
              `;
            });
          }
          //console.log(ord_stat);
          //console.log(ord.order_status);
          $("tbody").append(`
          <tr>
          <td>${ord.order_id}</td>
          <td>Name: <br> ${ord.delivery_person_name}<br>Phone no: <br> ${ord.delivery_mobile_no}<br>Address: <br> ${ord.delivery_address}<br> Email: <br>${ord.delivery_email}</td>
          <td>${item}</td>
          <td>${ord.ts_create}</td>
          <td>${ord.coupon_code}</td>
          <td>${ord.total_amount}</td>
          <td>${ord.final_amount}</td>
          <td>${ord_stat}</td>
          <td>
            <button
              type="button"
              class="btn btn-secondary m-shipped"
              id="${ord.order_id}"
            >
              Shipped</button
            >&nbsp;&nbsp;
            <button
              type="button"
              class="btn btn-success m-delivered"
              id="${ord.order_id}"
            >
              Delivered
            </button><br><br>
            <button
              type="button"
              class="btn btn-danger m-cancel"
              id="${ord.order_id}"
            >
              Cancelled
            </button>
            &nbsp;&nbsp;
            <button
              type="button"
              class="btn btn-danger m-return"
              id="${ord.order_id}"
            >
              Returned
            </button>
          </td>
        </tr>
                  `);
        });
        $("#example").DataTable();
        $(".m-shipped").click(function () {
          let order_id = $(this)[0].id;
          //console.log(order_id);
          $.ajax({
            url:
              "https://shreedeepaksarees.com/server/api/admin/orders/update.php",
            type: "POST",
            data: JSON.stringify({
              order_id: order_id,
              update: {
                order_status: 1,
              },
            }),
            success: function (response, status, xhr) {
              alert("Status Updated");
              window.location.reload();
            },
            error: function (xhr, status) {
              console.log("error", xhr, status);
              alert("Error while updating status!");
            },
          });
        });
        $(".m-delivered").click(function () {
          let order_id = $(this)[0].id;
          //console.log(order_id);
          $.ajax({
            url:
              "https://shreedeepaksarees.com/server/api/admin/orders/update.php",
            type: "POST",
            data: JSON.stringify({
              order_id: order_id,
              update: {
                order_status: 2,
              },
            }),
            success: function (response, status, xhr) {
              alert("Status Updated");
              window.location.reload();
            },
            error: function (xhr, status) {
              console.log("error", xhr, status);
              alert("Error while updating status!");
            },
          });
        });
        $(".m-cancel").click(function () {
          let order_id = $(this)[0].id;
          //console.log(order_id);
          $.ajax({
            url:
              "https://shreedeepaksarees.com/server/api/admin/orders/update.php",
            type: "POST",
            data: JSON.stringify({
              order_id: order_id,
              update: {
                order_status: 3,
              },
            }),
            success: function (response, status, xhr) {
              alert("Status Updated");
              window.location.reload();
            },
            error: function (xhr, status) {
              console.log("error", xhr, status);
              alert("Error while updating status!");
            },
          });
        });
        $(".m-return").click(function () {
          let order_id = $(this)[0].id;
          //console.log(order_id);
          $.ajax({
            url:
              "https://shreedeepaksarees.com/server/api/admin/orders/update.php",
            type: "POST",
            data: JSON.stringify({
              order_id: order_id,
              update: {
                order_status: 4,
              },
            }),
            success: function (response, status, xhr) {
              alert("Status Updated");
              window.location.reload();
            },
            error: function (xhr, status) {
              console.log("error", xhr, status);
              alert("Error while updating status!");
            },
          });
        });
      } else {
        alert("No coupon found");
      }
    },
    error: function (xhr, status) {
      console.log("error", xhr, status);
      $("#example").DataTable();
    },
  });
});
