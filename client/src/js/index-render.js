var renderArea = document.querySelector("#render-space");

async function renderDressMaterial() {
  console.log("Fired Material function");

  renderArea.innerHTML = "";

  const response = await fetch(
    "https://shreedeepaksarees.com/server/api/products/dressMaterials/retrieve.php?"
  );
  const json = await response.json();
  const array = json.data;
  console.log(array);
  array.map((x) => {
    console.log(x);
    appendData(x,'dress-materials');
  });
}

async function renderKurti() {
  console.log("Firing function");

  renderArea.innerHTML = "";

  const response = await fetch(
    "https://shreedeepaksarees.com/server/api/products/kurtis/retrieve.php?"
  );
  const json = await response.json();
  const array = json.data;
  array.map((x) => {
    appendData(x);
  }); 
}

async function renderLeggings() {
  console.log("Fired function");

  renderArea.innerHTML = "";

  const response = await fetch(
    "https://shreedeepaksarees.com/server/api/products/leggings/retrieve.php?"
  );
  const json = await response.json();
  const array = json.data;
  array.map((x) => {
    appendData(x);
  });


}

async function renderSaree() {
  console.log("Fired function");

  renderArea.innerHTML = "";

  const response = await fetch(
    "https://shreedeepaksarees.com/server/api/products/sarees/retrieve.php?"
  );
  const json = await response.json();
  const array = json.data;
  array.map((x) => {
    appendData(x);
  });

}

async function renderGhagra() {
  console.log("Fired function");

  renderArea.innerHTML = "";

  const response = await fetch(
    "https://shreedeepaksarees.com/server/api/products/ghagra/retrieve.php?"
  );
  const json = await response.json();
  const array = json.data;
  array.map((x) => {
    appendData(x);
  });
}
  // var cartButtons = document.querySelectorAll(".cart-button");
  // var wishButtons = document.querySelectorAll(".wish-button");

  // for (const wishButton of wishButtons) {
  //   wishButton.addEventListener("click", async function (event) {
  //     console.log("clicked");
  //     const product_id = wishButton.id;
  //     console.log(product_id);
  //     const response = await fetch(
  //       "https://shreedeepaksarees.com/server/api/products/ghagra/retrieve.php?productid=" +
  //         product_id
  //     );
  //     const json = await response.json();
  //     const object = json.data;
  //     console.log(object);
  //     const data = {
  //       product_category: "ghagra",
  //       productid: object.productid,
  //       selected_quantity: object.quantity,
  //       selected_size: object.size,
  //       selected_colors: object.colors,
  //     };
  //     console.log(data);

  //     fetch("https://shreedeepaksarees.com/server/api/user/wishlist/add.php", {
  //       method: "POST",
  //       headers: {
  //         "Content-Type": "application/json",
  //       },
  //       body: JSON.stringify(data),
  //     })
  //       .then((response) => response.json())
  //       .then((data) => {
  //         console.log("Success:", data);
  //       })
  //       .catch((error) => {
  //         console.error("Error:", error);
  //       });
  //   });
  // }

  // for (const cartButton of cartButtons) {
  //   cartButton.addEventListener("click", async function (event) {
  //     console.log("clicked");
  //     const product_id = cartButton.id;
  //     console.log(product_id);
  //     const response = await fetch(
  //       "https://shreedeepaksarees.com/server/api/products/ghagra/retrieve.php?productid=" +
  //         product_id
  //     );
  //     const json = await response.json();
  //     const object = json.data;
  //     console.log(object);
  //     const data = {
  //       product_category: "ghagra",
  //       productid: object.productid,
  //       selected_quantity: object.quantity,
  //       selected_size: object.size,
  //       selected_colors: object.colors,
  //     };

  //     fetch("https://shreedeepaksarees.com/server/api/user/cart/add.php", {
  //       method: "POST",
  //       headers: {
  //         "Content-Type": "application/json",
  //       },
  //       body: JSON.stringify(data),
  //     })
  //       .then((response) => response.json())
  //       .then((data) => {
  //         console.log("Success:", data);
  //       })
  //       .catch((error) => {
  //         console.error("Error:", error);
  //       });
  //   });
  // }
//}

async function renderDresses() {
  console.log("Fired dress Function");

  renderArea.innerHTML = "";

  const response = await fetch(
    "https://shreedeepaksarees.com/server/api/products/readymadeDresses/retrieve.php?"
  );
  const json = await response.json();
  const array = json.data;
  array.map((x) => {
    console.log(x);
    appendData(x);
  });

  // var cartButtons = document.querySelectorAll('.cart-button');
  // var wishButtons = document.querySelectorAll('.wish-button');

  // for (const wishButton of wishButtons) {
  //    wishButton.addEventListener('click', async function (event) {
  //         console.log('clicked');
  //         const product_id =wishButton.id;
  //         console.log(product_id);
  //         const response = await fetch('https://shreedeepaksarees.com/server/api/products/readymadeDresses/retrieve.php?productid=' + product_id);
  //         const json = await response.json();
  //         const object = json.data;
  //         console.log(object);
  //         const data = {
  //             "product_category": object.product_category,
  //             "productid": object.productid,
  //             "selected_quantity": object.quantity,
  //             "selected_size": object.size,
  //             "selected_colors": object.colors,
  //         }
  //         console.log(data);

  //         fetch('https://shreedeepaksarees.com/server/api/user/wishlist/add.php', {
  //             method: 'POST',
  //             headers: {
  //                 'Content-Type': 'application/json',
  //             },
  //             body: JSON.stringify(data),
  //         })
  //             .then(response => response.json())
  //             .then(data => {
  //                 console.log('Success:', data);
  //             })
  //             .catch((error) => {
  //                 console.error('Error:', error);
  //             });
  //     })
  // }

  // for (const cartButton of cartButtons) {
  //     cartButton.addEventListener('click', async function (event) {
  //         console.log('clicked');
  //         const product_id = cartButton.id;
  //         console.log(product_id);
  //         const response = await fetch('https://shreedeepaksarees.com/server/api/products/readymadeDresses/retrieve.php?productid=' + product_id);
  //         const json = await response.json();
  //         const object = json.data;
  //         console.log(object);
  //         const data = {
  //             "product_category": object.product_category,
  //             "productid": object.productid,
  //             "selected_quantity": object.quantity,
  //             "selected_size": object.size,
  //             "selected_colors": object.colors,
  //             "selected_length": object.length,
  //             "selected_width": object.width,
  //         }

  //         fetch('https://shreedeepaksarees.com/server/api/user/cart/add.php', {
  //             method: 'POST',
  //             headers: {
  //                 'Content-Type': 'application/json',
  //             },
  //             body: JSON.stringify(data),
  //         })
  //             .then(response => response.json())
  //             .then(data => {
  //                 console.log('Success:', data);
  //             })
  //             .catch((error) => {
  //                 console.error('Error:', error);
  //             });
  //     })
  // }
}

async function renderBlouses() {
  console.log("Fired function");

  renderArea.innerHTML = "";

  const response = await fetch(
    "https://shreedeepaksarees.com/server/api/products/readymadeDresses/retrieve.php?"
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
        "https://shreedeepaksarees.com/server/api/products/readymadeDresses/retrieve.php?productid=" +
          product_id
      );
      const json = await response.json();
      const object = json.data;
      console.log(object);
      const data = {
        product_category: object.product_category,
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
        "https://shreedeepaksarees.com/server/api/products/readymadeDresses/retrieve.php?productid=" +
          product_id
      );
      const json = await response.json();
      const object = json.data;
      console.log(object);
      const data = {
        product_category: object.product_category,
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
}

async function renderPalazzos() {
  console.log("Fired function");

  renderArea.innerHTML = "";

  const response = await fetch(
    "https://shreedeepaksarees.com/server/api/products/plazzos/retrieve.php?"
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
        "https://shreedeepaksarees.com/server/api/products/plazzos/retrieve.php?productid=" +
          product_id
      );
      const json = await response.json();
      const object = json.data;
      console.log(object);
      const data = {
        product_category: "plazzos",
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
        "https://shreedeepaksarees.com/server/api/products/plazzos/retrieve.php?productid=" +
          product_id
      );
      const json = await response.json();
      const object = json.data;
      console.log(object);
      const data = {
        product_category: object.product_category,
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
}

function appendData(productElement, product = "saree") {
  const productBody = document.querySelector("#render-space");

  const column = document.createElement("div");
  column.classList.add("col-lg-4");
  column.classList.add("col-md-6");

  const listItem = document.createElement("div");
  listItem.classList.add("single-product");
  listItem.classList.add("list-item");

  const img = document.createElement("img");
  img.classList.add("img-fluid");
  img.src = productElement.image1;

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

  const buyButtonLink = document.createElement("a");
  buyButtonLink.href =
    "https://shreedeepaksarees.com/client/products/"+product+".html?product_id="+productElement.productid;
  console.log(buyButtonLink.href);
  const buyButton = document.createElement("button");
  buyButton.innerHTML = "View Product";
  buyButton.classList.add("btn");
  buyButton.classList.add("btn-primary");

  buyButtonLink.appendChild(buyButton);
  bottom.appendChild(buyButtonLink);

  // wishButton.appendChild(wishButtonIcon);
  // bottom.appendChild(wishButton);

  listItem.appendChild(img);
  listItem.appendChild(productDetails);
  listItem.appendChild(bottom);

  column.appendChild(listItem);
  productBody.appendChild(column);
}

renderSaree();
