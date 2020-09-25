$(document).ready(function () {
  $.ajax({
    url:
      "https://testing1.thestrategybook.com/deepak-ecommerce/server/api/products/pants/retrieve.php",
    type: "GET",
    success: function (response) {
      response.data.forEach((product, index) => {
        console.log(escape(product.title));
        $("tbody").append(`
                <tr>
                <th
                  scope="row"
                  style="padding-bottom: 20px; padding-top: 20px"
                >
                  ${index + 1}
                </th>
                <td>${product.productid || "N/A"}</td>
                <td>${product.title || "N/A"}</td>
                <td>
                  <button type="button" class="btn btn-primary edit-btn" id = ${
                    product.productid
                  }>
                    Update
                  </button>
                </td>
                <td>
                  <button type="button" class="btn btn-danger delete-btn"  id = ${
                    product.productid
                  }>Delete</button>
                </td>
              </tr>      
                `);
      });
    },
    error: function (xhr, status) {
      console.log("error", xhr, status);
    },
  });
});
