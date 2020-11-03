$.ajax({
  url: "https://shreedeepaksarees.com/server/api/user/wishlist/retrieve.php",
  type: "GET",
  crossDomain: true,
  success: function (response) {
    console.log(response);
    $("#wishlist-cont").append(`
<div class="card p-4">
<div class="row">
  <!-- cart images div -->
  <div
    class="col-md-6 col-11 mx-auto bg-light d-flex shadow product_img"
  >
    <img
      src="https://assets.myntassets.com/h_560,q_90,w_420/v1/assets/images/9565501/2019/5/8/aa78186a-9c04-4e42-b5b8-6ce7bd9c3c401557311695707-Janasya-turquoise-blue-7861557311694458-1.jpg"
      class="img-fluid"
      alt="cart img"
    />
  </div>
  <!-- cart product details -->
  <div class="col-md-6 col-11 px-4 pt-1 mt-5">
    <div class="row">
      <!-- product name  -->
      <div class="col-6 card-title">
        <h1 class="mb-4 product_name">Blue Zara Shirt</h1>
        <p class="mb-2">SHIRT - BLUE</p>
        <p class="mb-2">COLOR: BLUE</p>
        <p class="mb-3">SIZE: M</p>
      </div>
    </div>
    <!-- //remover move and price -->
    <div class="row">
      <div class="col-8 d-flex justify-content-between remove_wish">
        <a class="rem"><i class="fas fa-trash-alt"></i> REMOVE ITEM</a>
        <a class="bag"
          ><i class="fas fa-shopping-bag"></i>MOVE TO BAG
        </a>
      </div>
    </div>
  </div>
</div>
</div>
`);
  },
  error: function (xhr, status) {
    alert("Error while fetching wishlist");
    console.log(status);
  },
});

var product_total_amt = document.getElementById("product_total_amt");
var shipping_charge = document.getElementById("shipping_charge");

//DECREASE QUANTITY
const decreaseNumber = (incdec, itemprice) => {
  var itemval = document.getElementById(incdec);
  var itemprice = document.getElementById(itemprice);
  console.log(itemprice.innerHTML);
  // console.log(itemval.value);
  if (itemval.value <= 0) {
    itemval.value = 0;
    alert("Negative quantity not allowed");
  } else {
    itemval.value = parseInt(itemval.value) - 1;
    itemval.style.background = "#fff";
    itemval.style.color = "#000";
    itemprice.innerHTML = parseInt(itemprice.innerHTML) - 15;
    product_total_amt.innerHTML = parseInt(product_total_amt.innerHTML) - 15;
    total_cart_amt.innerHTML =
      parseInt(product_total_amt.innerHTML) +
      parseInt(shipping_charge.innerHTML);
  }
};

//INCREASE QUANTITY
const increaseNumber = (incdec, itemprice) => {
  var itemval = document.getElementById(incdec);
  var itemprice = document.getElementById(itemprice);
  // console.log(itemval.value);
  if (itemval.value >= 5) {
    itemval.value = 5;
    alert("max 5 allowed");
    itemval.style.background = "red";
    itemval.style.color = "#fff";
  } else {
    itemval.value = parseInt(itemval.value) + 1;
    itemprice.innerHTML = parseInt(itemprice.innerHTML) + 15;
    product_total_amt.innerHTML = parseInt(product_total_amt.innerHTML) + 15;
    total_cart_amt.innerHTML =
      parseInt(product_total_amt.innerHTML) +
      parseInt(shipping_charge.innerHTML);
  }
};
