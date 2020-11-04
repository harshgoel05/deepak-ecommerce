async function populateArea() {
  var requestOptions = {
    method: "GET",
    redirect: "follow",
  };
  var totalprice = 0;
  var product_total_amt = document.getElementById("product_total_amt");
  var shipping_charge = document.getElementById("shipping_charge");
  var total_cart_amt = document.getElementById("total_cart_amt");

  const response = await fetch(
    "https://shreedeepaksarees.com/server/api/user/cart/retrieve.php",
    requestOptions
  );
  const json = await response.json();
  const cartItems = json.data;
  console.log(cartItems);

  // Alert for Empty Cart
  if (cartItems.length === 0) alert("Your Cart is Empty");

  cartItems.map((cartItem) => {
    console.log(parseInt(cartItem.price * cartItem.selected_quantity));
    console.log(totalprice);
    totalprice = parseInt(totalprice) + parseInt(cartItem.price * cartItem.selected_quantity);
    console.log(totalprice);

    totalprice = totalprice * 10;
    totalprice = totalprice / 10;
    append(cartItem);
  });
  console.log(totalprice);

  product_total_amt.innerHTML = parseInt(totalprice);
  total_cart_amt.innerHTML =
    parseInt(product_total_amt.innerHTML) ;
}
function append(cartItem) {
  console.log(cartItem);
  const image = cartItem.image1;
  const textboxid = "textbox" + cartItem.productid;
  const itemval = "itemval" + cartItem.productid;
  //const deleteid = 'delete'+cartItem.productid ;
  console.log(itemval);
  const root = document.querySelector(".root");
  console.log(image);
  var constAmt = parseInt(cartItem.price) * parseInt(cartItem.selected_quantity);
  root.innerHTML =
    root.innerHTML +
    `<div class="card p-4" id=${cartItem.productid}> <div class="row"> <div class="col-md-5 col-11 mx-auto bg-light d-flex justify-content-center align-items-center shadow product_img"> <img src=${image} class="img-fluid" alt="cart img" /> </div> <div class="col-md-7 col-11 mx-auto px-4 mt-2"> <div class="row"> <div class="col-6 card-title"> <h1 class="mb-4 product_name">${cartItem.title}</h1><p class="mb-2">COLOR: ${cartItem.selected_colors}</p> <p class="mb-3">SIZE: ${cartItem.selected_size}</p> </div>         <div class="col-6"> <ul class="pagination justify-content-end prices"> <li class="page-item"> <button id=${cartItem.productid} selected_size=${cartItem.size1} selected_colors=${cartItem.selected_colors} product_category=${cartItem.product_category} class="page-link" onclick="decreaseNumber(id, this)"> <i class="fas fa-minus"></i> </button> </li> <li class="page-item"> <input disabled type="text" name="" class="page-link" value=${cartItem.selected_quantity} id="textbox" /> </li> <li class="page-item"> <button id=${cartItem.productid} selected_size=${cartItem.size1} selected_colors=${cartItem.selected_colors} product_category=${cartItem.product_category} class="page-link" onclick="increaseNumber(id, this)"> <i class="fas fa-plus"></i> </button> </li> </ul> </div>
    </div> <div class="row"> <div class="col-8 d-flex justify-content-between remove_wish"> <a class="rem" onclick="deleteBlock(${cartItem.productid})"><i class="fas fa-trash-alt"></i> REMOVE<br />ITEM</a> <a class="wish" onclick="sendToCart(${cartItem.productid})"><i class="fas fa-heart" style="margin-right: 5px"></i>MOVE TO<br />WISHLIST </a> </div> <div class="col-4 d-flex justify-content-end price_money"> <h3>Rs <span id=${itemval}>${constAmt} </span></h3> </div> </div> </div> </div> </div>`;
}

window.addEventListener("load", async function () {
  console.log("script loaded");
  await populateArea();
});

const deleteBlock = async (productid) => {
  console.log(productid);

  var requestOptions = {
    method: "GET",
    redirect: "follow",
  };

  const response = await fetch(
    "https://shreedeepaksarees.com/server/api/user/cart/retrieve.php",
    requestOptions
  );
  const json = await response.json();
  const array = json.data;
  array.map((element) => {
    if (element.productid == productid) {
      object = element;
    }
  });
  console.log(object);
  var raw = {
    product_category: object.product_category,
    productid: object.productid,
    selected_quantity: object.selected_quantity,
    selected_colors: object.selected_quantity,
    selected_size: object.selected_size,
    selected_width: object.selected_width,
    selected_length: object.selected_length,
  };
  raw = JSON.stringify(raw);
  console.log(JSON.stringify(object));
  var requestOptions = {
    method: "POST",
    body: JSON.stringify(object),
    redirect: "follow",
  };

  fetch(
    "https://shreedeepaksarees.com/server/api/user/cart/remove.php",
    requestOptions
  )
    .then((response) => response.text())
    .then((result) => {console.log(result)
      window.location = 'https://shreedeepaksarees.com/client/user/cart.html';
    })
    .catch((error) => console.log("error", error));

  console.log(raw);
};

const sendToCart = async (productid) => {
  console.log(productid);

  var requestOptions = {
    method: "GET",
    redirect: "follow",
  };

  const response = await fetch(
    "https://shreedeepaksarees.com/server/api/user/cart/retrieve.php",
    requestOptions
  );
  const json = await response.json();
  const array = json.data;
  array.map((element) => {
    if (element.productid == productid) {
      object = element;
    }
  });
  console.log(object);
  var raw = {
    product_category: object.product_category,
    productid: object.productid,
    selected_quantity: object.selected_quantity,
    selected_colors: object.selected_quantity,
    selected_size: object.selected_size,
    selected_width: object.selected_width,
    selected_length: object.selected_length,
  };
  raw = JSON.stringify(raw);
  console.log(JSON.stringify(object));
  var requestOptions = {
    method: "POST",
    body: JSON.stringify(object),
    redirect: "follow",
  };

  fetch(
    "https://shreedeepaksarees.com/server/api/user/cart/add.php",
    requestOptions
  )
    .then((response) => response.text())
    .then((result) => console.log(result))
    .catch((error) => console.log("error", error));

  console.log(raw);
};
