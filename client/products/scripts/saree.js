async function retriveData(product_id) {
  const response = await fetch(
    "https://shreedeepaksarees.com/server/api/products/sarees/retrieve.php?productid=" +
      product_id
  );
  const json = await response.json();
  if (!json.success) {
    alert("Some unkown error has occured!");
  } else {
    const data = json.data;
    console.log(data);
    $("#title").html(data.title);
    $("#sub-title").html(data.subtitle);
    $("#price").html(`Rs. ${data.price}`);
    $("#des").html(data.description);
    $("#sub-cat").html(data.subcategory);
    const occ = `${data.occasion1}, ${data.occasion2}, ${data.occasion3}, ${data.occasion4}, ${data.occasion5}, ${data.occasion6}, ${data.occasion7}, `;
    $("#occasaion").html(occ);
    const washcare = `${data.washcare1}, ${data.washcare2}, ${data.washcare3}`;
    $("#wash-care").html(washcare);
    $("#type").html(data.type);
    $("#blousefabric").html(data.blousefabric);
    $("#blouse").html(data.blouse);
    $("#fabric").html(data.fabric);
    $("#length").html(data.length);
    $("#width").html(data.width);
    // size,colors left
    //image left
  }
}
const product_id = window.location.href.split("?product_id=")[1];
if (!product_id) {
  alert("Missing product id");
}
retriveData(product_id);
