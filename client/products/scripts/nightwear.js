function appendData(productElement) {
  const productBody = document.querySelector(".product_body");

  const column = document.createElement("div");
  column.classList.add("col-lg-4");
  column.classList.add("col-md-6");

  const listItem = document.createElement("div");
  listItem.classList.add("single-product");
  listItem.classList.add("list-item");

  const img = document.createElement("img");
  img.classList.add("img-fluid");
  img.src = productElement.img1;

  const productDetails = document.createElement("div");
  productDetails.classList.add("product-details");
  const title = document.createElement("h6");
  const subtitle = document.createElement("h6");
  subtitle.innerHTML = productElement.subtitle;
  title.innerHTML = productElement.title;
  productDetails.appendChild(title);
  productDetails.appendChild(subtitle);
  const priceBox = document.createElement("div");
  priceBox.classList.add("price");
  const priceVal = document.createElement("h6");
  priceVal.innerHTML = "RS " + productElement.price;
  priceBox.appendChild(priceVal);
  productDetails.appendChild(priceBox);

  const bottom = document.createElement("div");
  bottom.classList.add("prd-bottom");

  const cartButton = document.createElement("a");
  cartButton.href = "#";
  cartButton.classList.add("social-info");
  cartButton.classList.add("cart-button");
  const cartButtonIcon = document.createElement("i");
  cartButton.id = productElement.productid;
  cartButtonIcon.classList.add("fa");
  cartButtonIcon.classList.add("fa-shopping-bag");
  cartButtonIcon.style.color = "orange";

  const wishButton = document.createElement("a");
  wishButton.href = "#";
  wishButton.classList.add("social-info");
  wishButton.classList.add("wish-button");
  const wishButtonIcon = document.createElement("i");
  wishButton.id = productElement.productid;
  wishButtonIcon.classList.add("fa");
  wishButtonIcon.classList.add("fa-heart");
  wishButtonIcon.style.color = "crimson";

  cartButton.appendChild(cartButtonIcon);
  bottom.appendChild(cartButton);

  wishButton.appendChild(wishButtonIcon);
  bottom.appendChild(wishButton);

  listItem.appendChild(img);
  listItem.appendChild(productDetails);
  listItem.appendChild(bottom);

  column.appendChild(listItem);
  productBody.appendChild(column);
}

window.addEventListener("load", async function () {
  const response = await fetch(
    "https://shreedeepaksarees.com/server/api/products/nightwear/retrieve.php?"
  );
  const json = await response.json();
  const array = json.data;
  array.map((x) => {
    appendData(x);
  });

  var cartButtons = document.querySelectorAll(".cart-button");
  var wishButtons = document.querySelectorAll(".wish-button");

  for (const wishButton of wishButtons) {
    wishButton.addEventListener("click", async function (event) {
      console.log("clicked");
      const product_id = wishButton.id;
      console.log(product_id);
      const response = await fetch(
        "https://shreedeepaksarees.com/server/api/products/nightwear/retrieve.php?productid=" +
          product_id
      );
      const json = await response.json();
      const object = json.data;
      console.log(object);
      const data = {
        product_category: "nightwear",
        productid: object.productid,
        selected_quantity: object.quantity,
        selected_size: object.size,
        selected_colors: object.colors,
        selected_length: object.length,
        selected_width: object.width,
      };
      console.log(data);

      fetch("https://shreedeepaksarees.com/server/api/user/wishlist/add.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      })
        .then((response) => response.json())
        .then((data) => {
          console.log("Success:", data);
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    });
  }

  for (const cartButton of cartButtons) {
    cartButton.addEventListener("click", async function (event) {
      console.log("clicked");
      const product_id = cartButton.id;
      console.log(product_id);
      const response = await fetch(
        "https://shreedeepaksarees.com/server/api/products/nightwear/retrieve.php?productid=" +
          product_id
      );
      const json = await response.json();
      const object = json.data;
      console.log(object);
      const data = {
        product_category: "nightwear",
        productid: object.productid,
        selected_quantity: object.quantity,
        selected_size: object.size,
        selected_colors: object.colors,
        selected_length: object.length,
        selected_width: object.width,
      };

      fetch("https://shreedeepaksarees.com/server/api/user/cart/add.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      })
        .then((response) => response.json())
        .then((data) => {
          console.log("Success:", data);
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    });
  }
});
