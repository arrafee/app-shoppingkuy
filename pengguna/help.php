<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>help</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
    body{
        background-color: #385170;
        font-family: Helvetica;
    }
  .accordion{
  width: 90%;
  max-width: 1000px;
  margin: 2rem auto;
  }
  h1 {
  text-align: center;
  margin: 2rem 0;
  font-size: 2.5rem;
  color:white;
    }
.btn-success{
    margin-top: 10px;
    background-color:#00204a;
    color: white;
}
.accordion-button{
    background-color:#00204a;
    color: white;
}
  </style>
  </head>
  <body>
  <h1> PUSAT BANTUAN </h1>
  <div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
      Ada berapa kategori produk yang dijual di ShoppingKuy?
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>Kami menawarkan 4 kategori produk</strong> diantaranya ada Female, Male, Kids, dan Accesorries
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Bagaimana untuk metode pembayaran?
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>Transfer</strong> sekarang hanya metode pembayaran transfer yang kita tawarkan.
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        Apakah barang di toko ini akan selalu update dengan trend?
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>Yes</strong> karena di toko kami menganut sistem trendi.
      </div>
    </div>
  </div>
  <a href="home.php"  class="btn btn-success">kembali</a> 
</div>
  </body>
</html>