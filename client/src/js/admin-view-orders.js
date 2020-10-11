$(document).ready(function () {
  $.ajax({
    url:
      "https://testing1.thestrategybook.com/deepak-ecommerce/server/api/products/find.php",
    type: "GET",
    success: function (response) {
      if (response.data) {
        response.data.forEach((product, index) => {
          $("tbody").append(`
          <tr>
          <td>${index}</td>
          <td>Yo sarees</td>
          <td>One-size</td>
          <td>Red</td>
          <td>sarees</td>
          <td>Paithani Sarees</td>
          <td>NIL</td>
          <td>NIL</td>
          <td>Rs. 3,800</td>
          <td>31/12.2020</td>
          <td>Ordered</td>
          <td>
            <button
              type="button"
              class="btn btn-primary updates"
              id="ordered"
            >
              Ordered</button
            >&nbsp;&nbsp;
            <button
              type="button"
              class="btn btn-secondary updates"
              id="shipped"
            >
              Shipped</button
            >&nbsp;&nbsp;
            <button
              type="button"
              class="btn btn-success updates"
              id="delivered"
            >
              Delivered
            </button>
          </td>
        </tr>
                  `);
        });
        // delete api inside the success for previous api
        $(".delete-btn").click(function () {
          console.log("hi");
          let coupon_code = $(this)[0].id;
          console.log(coupon_code);
          $.ajax({
            url:
              "https://testing1.thestrategybook.com/deepak-ecommerce/server/api/admin/coupons/remove.php",
            type: "POST",
            data: JSON.stringify({
              coupon_code: coupon_code,
            }),
            xhrFields: {
              withCredentials: true,
            },
            success: function (response, status, xhr) {
              alert("Coupon Deleted");
              window.location.reload();
            },
            error: function (xhr, status) {
              console.log("error", xhr, status);
              alert("Error deleting the coupon!");
            },
          });
        });
      } else {
        alert("No coupon found");
      }
    },
    error: function (xhr, status) {
      console.log("error", xhr, status);
    },
  });
});
