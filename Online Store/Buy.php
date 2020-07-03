<?php session_start(); ?>
<?php if (isset($_SESSION['username'])):?><?php
      $user = $_SESSION['username'];?>
      <?php endif?>
<?php include "include/connect.php"; ?>

<!doctype html>
<html lang="en">

<head>
  <title>N's online store</title>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="scripts/jquery-3.5.1.min.js"></script>

 

</head>

<body class="body_main">

<button class ="btn btn-primary" id = "top">Back to top</button>

  <div id='container_main'><!--Container main is the main wrapper for the content to be displayed within the page, including the nav and the secondary nav, itis also the target of the main Vue instance-->
   <div id="wrapper"> <!-- The wrapper includes all nav bar content. -->
      <img id = "logo" src="images/logo.png" alt="logo" title="logo"> <!-- Company Logo-->
      <div>
      <?php
      $user = 1;?>


        


      </div>
      <nav class="navbar navbar-expand-lg navbar-light "><!--this Section includes a responsive bootstrap navbar-->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#"><span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#">Home</a>
            </li>
            <!-- Example single danger button -->
          </ul>

           
          </div>
        </div>
      </nav>
    </div>
    <div id="product_menu"><!--This div contains the second nav bar with the different selection options for product categories -->
      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle margin" type="button" id="products" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Products
        </button> <!--Each button makes a call to the changestate function, displaying the products selected by the consumer -->
        <div class="dropdown-menu" aria-labelledby="products">
          <a class="dropdown-item" href="#"> <button type="button" class="btn btn-outline-secondary product_button" @click="changestate('pens')">Pens</button></a>
          <a class="dropdown-item" href="#"><button type="button" class="btn btn-outline-secondary product_button" @click="changestate('pencils')">Pencils</button></a>
          <a class="dropdown-item" href="#"><button type="button" class="btn btn-outline-secondary product_button" @click="changestate('scissors')">Sciccors</button></a>
          <a class="dropdown-item" href="#"><button type="button" class="btn btn-outline-secondary product_button" @click="changestate('pencilCase')">Pencil cases</button></a>
          <a class="dropdown-item" href="#"><button type="button" class="btn btn-outline-secondary product_button" @click="changestate('eraser')">Erasers</button></a>
          <a class="dropdown-item" href="#"><button type="button" class="btn btn-outline-secondary product_button" @click="changestate('highlighters')">Highlighters</button></a>
          <a class="dropdown-item" href="#"> <button type="button" class="btn btn-outline-secondary product_button" @click="changestate('rulers')">Rulers</button></a>
          <a class="dropdown-item" href="#"><button type="button" class="btn btn-outline-secondary product_button" @click="changestate('wbm')">White board markers</button></a>
        </div>
      </div>
      <div class="dropdown"><!--Each button makes a call to the changestate function, displaying the products selected by the consumer -->
        <button class="btn btn-secondary dropdown-toggle margin" type="button" id="productT" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Productivity
        </button>
        <div class="dropdown-menu productivity" aria-labelledby="productT">
          <a class="dropdown-item" href="#"><button class="btn secondary product_button" @click="changestate('apps')">To do app</button></a>
          <a class="dropdown-item" href="#"><button class="btn secondary product_button" @click="changestate('apps')">Quiz yourself</button></a>
          <a class="dropdown-item" href="#"><button class=" btn secondary product_button" @click="changestate('apps')">Study calendar</button></a>
        </div>
      </div>
      <button id="extra_info" class="btn btn-secondary extra_info margin">
        Contact us
      </button>
      <button id="team_members" class="btn btn-secondary " type="button" @click="changestate('team')">
        Our Team
      </button>
    </div>
    <div id = 'cart_items'>
    <?php
      $total= 0;
      $purchase = array();
  $stmt_show = $mysqli->prepare("SELECT * FROM cart where user_no =?");//this statement fetches the products in the users cart and show them at a checkout
 $stmt_show ->bind_param('i',$user);
 $stmt_show ->execute();
 $result = $stmt_show ->get_result();
 ?>

     <div class ="cart_main"> <h3 class ="cart_header">Cart items: </h3> 
     
    <?php  while($rows = $result->fetch_assoc()):?>
        <?php if ( $rows['purchased'] < 1):?>
       <div class ="cart_style" id = "<?php echo $rows['product_name']."product"?>"><img src ="images/<?php echo $rows['image']?>"><p><?php echo $rows['product_name']?> Quantity: <input id ="<?php echo $rows['product_name']."value"?>" class = "cart_quantity" type= "number" value = "<?php echo $rows['quantity']?>"> <br><div><button id ='<?php echo $rows['product_name']?>' onclick ="update(this)" class ="btn btn-primary small-b">update</button><button id ='<?php echo $rows['product_name']."delete"?>' value ='<?php echo $rows['product_name']?>' class ="btn btn-primary small-b"  onclick = "deleteC(this)">delete</button></div></div>
     <?php $total+=($rows['quantity']*$rows['price']);?>
     <?php array_push($purchase,$rows['id']);?>
     

    
   
<?php endif?>
<?php endwhile?>

</div>
    </div>
    </div>
    <div id = "paynow">
    <h4 id = "total">Total:R <?php echo $total?>,00</h4>
    <button id = "purchasebutton" class =" small-b btn btn-primary pay_button" onclick="purchaseT()"><span class ="btn_cart">Purchase</span></button>
    <form method="post" action="index.php">
              <button type="submit" value = "submit" class=" small-b btn btn-primary"><!--This button uses an ajax call to insert the data into the database and can be viewed from the checkout dom  -->
              View more products
              </button>
      </form>
    </div>
    </div>
      <!--The following section build the dom, giving each category a unique state tha displays products in the category selected, a php mysql query is run to fetch information from the database and the echo'd out to populate the dom  -->

    
    
    </div>
    <footer id='footer_cart'>
      <h4>Contact us</h4><!--This section includes the footer,with all necessary contact info-->
      <div id='footer_main'>
        <div id='follow'>
          <h6>
            Follow us on</h6>
          <br>
          <img src="images/f_logo_RGB-Blue_58.png" title = "facebook" alt="facebook"><img src="images/IG_Glyph_Fill.png" title = "Instagram" alt="Instagram">
        </div>
        <div>
          <h6>Where to find us</h6>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3311.326339016506!2d18.420408714923894!3d-33.90699962847317!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1dcc67599abb5bb3%3A0xcc1a97af54b0520b!2sV%20%26%20A%20Waterfront%2C%20Victoria%20%26%20Alfred%20Waterfront%2C%20Cape%20Town%2C%208001!5e0!3m2!1sen!2sza!4v1590252637837!5m2!1sen!2sza" width="400" height="290" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
        <form id="contact_us" onsubmit="event.preventDefault()"><!--This from submits sanitized entries into a contact database to ensure that the company can communicate with any special requests-->
          <h6>Send us a message, and we'll reply as soon as possible</h6>
          <div class="form-group">
            <label for="">Name</label>
            <input type="text" class="form-control" name="email" id="" aria-describedby="helpId" placeholder="Enter your name">
            <label for="">Email</label>
            <input type="text" class="form-control" name="name" id="" aria-describedby="helpId" placeholder="Enter your email">
            <br>
            <textarea placeholder="Enter your enquiry" name="text_contact" id="text_contact" cols="30" rows="3"></textarea>
            <button class="btn btn-primary" onclick="user_contact()">Contact</button>
        </form>
      </div>
  </div>
 
  </footer>
  </div>
          </div>
         

<!--Required cdn's-->

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="scripts/products.js"></script>
 
</body>
<script> 
function update(value){
     product = value.id;
    let item = document.getElementById(product+"value").value;
    
    $.ajax({
        type:'post',
        url:'include/cartItems.php',
        data:{product:product,quantity:item},
        success:function(data){
           document.getElementById('total').innerHTML= "Total:R "+data+",00"
        }
    })
}
function deleteC(dvalue){
    product = dvalue.value;
    let item = document.getElementById(product+"value").value;
    $.ajax({
        type:'post',
        url:'include/deleteItems.php',
        data:{product:product,item:item},
        success:function(data){
            document.getElementById('total').innerHTML= "Total:R "+data+",00";
            document.getElementById(product+'product').style.display='none';
       console.log(data);
          }
    });
}
let obj = <?php echo json_encode($purchase);?>;
function purchaseT(){
    
    $.ajax({
        type:'post',
        url:'include/purchase.php',
        data:{product:obj},
        success:function(data){
          document.getElementById('total').innerHTML= data;
          document.getElementById('purchasebutton').disabled= true;
          
        }
    });
}
</script>
<script>
    function user_contact() {
      //this function send info to the contact database using an  ajax call
      let form = $('#contact_us').serialize();
      $.ajax({
        type: 'POST',
        url: 'include/contact.php',
        data: form,
        success: function(data) {
          $("#footer_main").html(data);


        }
      });
    }
  </script>
    <script>

let buttonmy = document.getElementById('top');
window.onscroll = function(){functionscroll()};

function functionscroll(){
  if(document.body.scrollTop > 320 || document.documentElement.scrollTop > 320)
  {
    buttonmy.style.display ='block';
  }else{
    buttonmy.style.display="none";
  }

}

</script>

<script>
$(document).ready(function(){
  $('#top').click(function(){
    $('html,body').animate({
      scrollTop: $('#logo').offset().top},200)
  });
});</script>
</html>