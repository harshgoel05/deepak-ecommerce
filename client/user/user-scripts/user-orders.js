var url =
  "https://testing1.thestrategybook.com/deepak-ecommerce/server/api/user/orders/retrieve.php";

$.ajax({
  url: url,
  type: "GET",
  crossDomain: true,
  success: function (response) {
    response.data.forEach((product,index) => {
      product.item.forEach((item,i) => {

        // Function for fetching the image
       
          // var pp = item.image1.replace('\\', '');
          // $('#image').attr('src', `data:image/png;base64,${pp}`);
          

          // Converting integer value of status to string
          var status 
          
          if(product.order_status == 0)
          status="Placed"
          else if(product.order_status == 1)
          status= "Out For Delivery"
          else if(product.order_status == 2)
          status= "Delivered"
          else if(product.order_status == 3)
          status= "Cancelled"
          else if(product.order_status == 4)
          status= "Returned"

     
          $(".main_cart").append(
        `<div class="card p-4">
        
        <div class="row">
          <!-- cart images div -->
          <div
            class="col-md-5 col-11 mx-auto bg-light d-flex justify-content-center align-items-center shadow product_img"
          >
            <img
              
              src="https://assets.myntassets.com/h_560,q_90,w_420/v1/assets/images/9565501/2019/5/8/aa78186a-9c04-4e42-b5b8-6ce7bd9c3c401557311695707-Janasya-turquoise-blue-7861557311694458-1.jpg"
              class="img-fluid"
              alt="cart img"
            />
          </div>
          <!-- cart product details -->
          <div class="col-md-7 col-11 mx-auto px-4 mt-2" >
            <div class="row">
              <!-- product name  -->
              <div class="col-6 card-title">
                <h1 class="mb-4 product_name">${item.title} </h1>
                <p class="mb-2">${item.subtitle}</p>
                <br />
                <p class="mb-2">COLOR: ${item.selected_colors}</p>
                <p class="mb-2">STATUS : ${status}</p>
              </div>

              <div class="col-6">
                <ul class="pagination justify-content-end">d
                  <li class="page-item">
                    <h3>Rs. <span id="itemval">${item.price} </span></h3>
                  </li>
                </ul>
                <ul class="pagination justify-content-end">
                  <li class="page-item">
                    // ADD CANCEL AND RETURN BUTTON
                    // <a
                    //   href="#"
                    //   class="btn btn-lg btn1"
                    //   role="button"
                    //   aria-pressed="true"
                    //   style="background-color: rgb(240, 62, 86)"
                    //   ><b style="color: whitesmoke">Cancel</b></a
                    // >
                  </li>
                </ul>
              </div>
              <p class="mb-2">
                NOTE : Cannot be returned / exchanged after 10 days from
                delivery
              </p>
              <div class="progress-form">
                <br />
                <div class="progress-header">
                  <div class="header_title active">
                    <div class="title-progressed">Placed</div>
                    <div class="circle_container">
                      <div class="circle"></div>
                      <div class="right-line"></div>
                    </div>
                  </div>
                  <div class="header_title">
                    <div class="title">Shipped</div>
                    <div class="circle_container">
                      <div class="left-line"></div>
                      <div class="circle"></div>
                      <div class="right-line"></div>
                    </div>
                  </div>
                  <div class="header_title">
                    <div class="title">Delivered</div>
                    <div class="circle_container">
                      <div class="left-line"></div>
                      <div class="circle"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr />
        `
          
        
      );
      
    });
  });

    
  },
  error: function (xhr, status) {
    console.log("User Not logged in");
  },
});

//Shubhankar
