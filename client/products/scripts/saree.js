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
    //console.log(data);
    //console.log($("#i1")[0].src);
    $("#i1")[0].src = data.image1;
    $("#i2")[0].src = data.image2;
    $("#i3")[0].src = data.image3;
    $("#i4")[0].src = data.image4;
    $("#i5")[0].src = data.image5;
    $("#i6")[0].src = data.image6;

    $("#title").html(data.title);
    $("#sub-title").html(data.subtitle);
    $("#price").html(`Rs. ${data.price}`);
    $("#des").html(data.description);
    $("#sub-cat").html(data.subcategory);
    // const occ = `${data.occasion1}, ${data.occasion2}, ${data.occasion3}, ${data.occasion4}, ${data.occasion5}, ${data.occasion6}, ${data.occasion7}, `;
    const occ = `${data.occasion1}`;

    $("#occasaion").html(occ);
    // const washcare = `${data.washcare1}, ${data.washcare2}, ${data.washcare3}`;
    const washcare = `${data.washcare1}`;

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


async function addToCart() {
  console.log('Cart function fired');
  let id = product_id.slice(0, product_id.length - 1);
  const response = await fetch(
    "https://shreedeepaksarees.com/server/api/products/sarees/retrieve.php?productid=" +
    id
  );
  const json = await response.json();
  const data = json.data;
  //console.log(json.data);
  //console.log(id);
  var raw =

  {
    "product_category": "sarees",
    "productid": id,
    "selected_quantity": data.quantity,
    "selected_size": data.size1,
    "selected_colors": "red",
    "selected_length": data.length,
    "selected_width": data.width
  }
  console.log(raw);
  raw = JSON.stringify(raw);

  var requestOptions = {
    method: 'POST',
    body: raw,
    redirect: 'follow'
  };
  
  fetch("https://shreedeepaksarees.com/server/api/user/cart/add.php", requestOptions)
    .then(response => response.json())
    .then(result => {
      if(result.success == true)
        alert('Added To Cart!');
      else
        alert('Please login to perform this action');
      console.log(result);
    })
    .catch(error => console.log('error', error));

}

async function addToWishList() {
  console.log('Wishlist function fired');
  let id = product_id.slice(0, product_id.length - 1);
  const response = await fetch(
    "https://shreedeepaksarees.com/server/api/products/sarees/retrieve.php?productid=" +
    id
  );
  const json = await response.json();
  const data = json.data;
  //console.log(json.data);
  //console.log(id);
  var raw =

  {
    "product_category": "sarees",
    "productid": id,
    "selected_quantity": data.quantity,
    "selected_size": data.size1,
    "selected_colors": "red",
    "selected_length": data.length,
    "selected_width": data.width
  }
  console.log(raw);
  raw = JSON.stringify(raw);

  var requestOptions = {
    method: 'POST',
    body: raw,
    redirect: 'follow'
  };
  
  fetch("https://shreedeepaksarees.com/server/api/user/wishlist/add.php", requestOptions)
    .then(response => response.json())
    .then(result => {
      if(result.success == true)
        alert('Added To Wishlist!');
      else
        alert('Please login to perform this action');
      console.log(result);
    })
    .catch(error => console.log('error', error));
}