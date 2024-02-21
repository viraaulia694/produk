<?= $this->extend('template/admin'); ?>

<?= $this->section('content'); ?>
  <body>
    <h1>Data Produk</h1>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
            <div class="card">  
            <div class="card-header">
                Tambah Data
            </div>
            <div class="card-body">
                <form>
                <div class="row mb-3">
                    <label for="nama_produk" class="col-sm-4 col-form-label">Nama Produk</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama_produk">
                    <input type="hidden" id="status">
                    <input type="hidden" id="id_produk">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="harga" class="col-sm-4 col-form-label">Harga</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="harga">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="stok" class="col-sm-4 col-form-label">Stok</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="stok">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" id="simpan">Simpan</button>
                </form>
            </div>
            </div>
            </div>
            <div class="col-sm-6">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="showData">
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="<?= base_url()?>adminlte/plugins/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            tampil_data();

            function tampil_data(){
                $.ajax({ //setelah isi ajax, tambah routes
                    url: 'produk/tampil',
                    type: 'get',
                    dataType: 'json',
                    success: function(data)
                    {
                        console.log(data);
                        var HTML = '';
                        var i;
                        var no = 0;
                        if(data.length == 0) {
                            HTML += '<tr>' + 
                                    '<td colspan = "5" class = "text-center"> Data pada tabel masih kosong</td>'+
                                    '</tr>'
                                    $('#showData').html(HTML);
                        }else{
                            for (var i = 0; i < data.length; i++) {
                            no++;
                            HTML += '<tr>' +
                                '<td>' + no + '</td>' +
                                '<td>' + data[i].nama_produk + '</td>' +
                                '<td>' + data[i].harga + '</td>' +
                                '<td>' + data[i].stok + '</td>' +
                                '<td>' +
                                    '<button id="edit" data-id="' + data[i].id_produk + '" class="btn btn-warning">Edit</button>' + 
                                    '&nbsp;&nbsp;' + 
                                    '<button id="hapus" data-id="' + data[i].id_produk + '" class="btn btn-danger">Hapus</button>' +
                                '</td>' +
                                '</tr>';
                                $('#showData').html(HTML);
                        }
                        }
                    }
                });
            }

                        $('#simpan').on('click', function(e){
                            e.preventDefault();
                            
                            var namaProduk = $('#nama_produk').val();
                            var harga = $('#harga').val();
                            var stok = $('#stok').val();
                            var status = $('#status').val();
                            var id = $('#id_produk').val();
                           

                            if (status == '') {
                                $.ajax({
                                url: 'produk/simpan',
                                type: 'post',
                                data: {namaProduk: namaProduk, harga: harga, stok: stok},
                                success: function(data){
                                    $('#nama_produk').val('');
                                    $('#harga').val('');
                                    $('#stok').val('');

                                    tampil_data();
                                }
                            })
                            } else if (status == 'update') {
                                $.ajax({
                                    url: 'produk/update',
                                    type: 'post',
                                    data: {id: id, namaProduk: namaProduk, harga: harga, stok: stok},
                                    success: function(data){
                                        $('#nama_produk').val('');
                                        $('#harga').val('');
                                        $('#stok').val('');
                                        $('#status').val('');

                                        tampil_data();
                                    }
                                })
                                
                            }
                        }); //end simpan
                        
                        //edit
                        $('#showData').on('click', '#edit', function(e){
                            e.preventDefault();

                            var id = $(this).data('id');
                            
                            $.ajax({
                                url: 'produk/edit',
                                type: 'get',
                                dataType: 'json',
                                data: {id: id}, //sebelah kanan dari controller, sebelah kiri dari var

                                success: function(data){
                                    console.log(data);
                                    $('#id_produk').val(data.id_produk);
                                    $('#nama_produk').val(data.nama_produk);
                                    $('#harga').val(data.harga);
                                    $('#stok').val(data.stok);
                                    $('#status').val('update');
                                }
                            })
                        });

                        //update
                        $('#update').on('click',function(e) {
                            e.preventDefault();

                            var namaProduk = $(this).data('namaProduk');
                            var harga = $(this).data('namaProduk');
                            var stok = $(this).data('namaProduk');

                            $.ajax({
                                url: 'produk/update',
                                type: 'post',
                                data: {namaProduk: namaProduk, harga: harga, stok:stok},
                                success:function(data) {
                                    $('#nama_produk').val('');
                                    $('#harga').val('');
                                    $('#stok').val('');

                                    tampil_data();
                                }
                            })
                        }) //end update

                        //delete
                        $('#showData').on('click','#hapus', function(e){
                            e.preventDefault();

                            var id = $(this).data('id');
                            console.log('Berhasil Dihapus');
                            

                            $.ajax({
                            method : 'post',
                            url : 'produk/delete',
                            data : {id: id},
                            success : function(data){
                                
                                tampil_data();
                                $('id_produk').focus();
                            }
                            
                            })

                        });
                        //end delete
                    
        });
    </script>
</body>
<?= $this->endSection(); ?>


<!-- view penjualan
<?= $this->extend('template/admin'); ?>

<?= $this->section('content'); ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD Table Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="col-sm-4">
        <h2>Data Pelanggan</h2>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-5">
                <div class="card card-info">
                    <div class="card-header">
                        Tambah Data
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row mb-3">
                                <label for="tgl_penjualan" class="col-sm-4 col-form-label">Tanggal Penjualan</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" id="tgl_penjualan" name="tgl_penjualan" value="<?php echo date('Y-m-d'); ?>" readonly>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" id="total_harga" name="total_harga" readonly>
                            <div class="row mb-3">
                                <label for="id_pelanggan" class="col-sm-4 col-form-label">ID Pelanggan</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="id_pelanggan" name="id_pelanggan">
                                        <option value="">Pilih ID Pelanggan</option>
                                        <?php foreach ($pelanggan as $item) : ?>
                                            <option value="<?= $item->id_pelanggan; ?>"><?= $item->id_pelanggan; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" id="simpan">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>


            <div class="col-sm-7">
                <div class="card card-info">
                    <div class="card-header">
                        Daftar Pelanggan
                    </div>
                    <div class="card-body">
                        <div class="custom-scroll" style="max-height: 500px; overflow-y: auto;">
                            <div class="table-responsive" style="overflow-x: auto; overflow-y: auto; white-space: nowrap;">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>ID Penjualan</th>
                                            <th>Tanggal Penjualan</th>
                                            <th>Total Harga</th>
                                            <th>ID Pelanggan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="showData">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?= base_url() ?>adminlte/plugins/jquery/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function() {
                tampil_data();

                function tampil_data() {
                    $.ajax({
                        url: 'penjualan/tampil',
                        type: 'get',
                        dataType: 'json',
                        success: function(data) {
                            var HTML = '';
                            var i;
                            var no = 0;

                            if (data.length == 0) {
                                HTML += '<tr>' +
                                    '<td colspan = "5" class = "text-center"> Data pada tabel masih kosong </td>' +
                                    '</tr>'
                                $('#showData').html(HTML);
                            } else {
                                for (i = 0; i < data.length; i++) {
                                    no++;
                                    HTML += '<tr>' +
                                        '<td>' + no + '</td>' +
                                        '<td>' + data[i].id_penjualan + '</td>' +
                                        '<td>' + data[i].tgl_penjualan + '</td>' +
                                        '<td>' + data[i].total_harga + '</td>' +
                                        '<td>' + data[i].id_pelanggan + '</td>' +
                                        '<td>' +
                                        // '<button id="edit" data-id="' + data[i].id_penjualan + '" class="btn btn-warning">Edit</button>' + ' ' +
                                        // '<button id="hapus" data-id="' + data[i].id_penjualan + '" class="btn btn-danger">Hapus</button>' +
                                        '</td>' +
                                        '</tr>'
                                }
                                $('#showData').html(HTML);
                            }
                        }
                    })
                }

                $('#simpan').on('click', function(e) {
                    e.preventDefault();

                    var tgl = $('#tgl_penjualan').val();
                    var total = $('#total_harga').val();
                    var idPelanggan = $('#id_pelanggan').val();
                    var id = $('#id_penjualan').val();

                    $.ajax({
                        url: 'penjualan/simpan',
                        type: 'post',
                        data: {
                            tgl: tgl,
                            total: total,
                            idPelanggan: idPelanggan,
                        },
                        success: function(data) {
                            $('#tgl_penjualan').val('');
                            $('#total_harga').val('');
                            $('#id_pelanggan').val('');
                            tampil_data();
                        }
                    })
                });
                // end simpan
            })
        </script>
</body>

</html>

<?= $this->endSection(); ?> -->


<!-- view login
<?= $this->extend ('/template/t_login'); ?>
<?= $this->section ('content'); ?>

<body class = "text-center">
    // Begin Page Content
        <div class="container py-5">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <main class="form-signin">
                        <?php if(!empty(session()->getFlashdata('error'))): ?>
                        <div class ="alert alert-warning alert-dismissible fade show" role="alert">
                            <?php echo session()->getFlashdata('error'); ?>
                        </div>
                        <?php endif; ?>
                        <form method="post" action="<?=base_url();?>login/process">
                            <?=csrf_field();?>
                            <h1 class="h3 mb-3 fw-normal">Login</h1>
                            <input type="text" name="username" id="username" placeholder="Username" class="form-control mb-3 required autofocus">
                            <input type="password" name="password" id="password" placeholder="Password" class="form-control mb-3 required">
                            <button type="submit" class="w-100 btn btn-lg btn-primary">Login</button>
                            <p class ="mt-5 mb-3 text-muted">&copy;Login Ci-4</p>
                        </form>
                    </main>
                </div>
            </div>
        </div>
</body> -->
<?= $this->endSection ('content'); ?> 


<!-- view register
<?= $this->extend ('/template/t_login'); ?>
<?= $this->section ('content'); ?>
    <h3>Tambah Data</h3>
<body class = "d-flex flex-column h-100">
    Begin Page Content-->
    <!-- <main class ="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Register Form</h1>
            Silahkan Daftarkan Identitas Anda 
            <hr/>
            <?php if(!empty(session()->getFlashdata('error'))):?>
            <div class="alert alert warning alert-dismissible fade show" role="alert">
                <?php echo session()->getFlashdata('error');?>
            </div>
            <?php endif; ?>
            <form method="post" action="<?=base_url();?>register/process">
                <?=csrf_field();?>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3">
                    <label for="password_conf" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_conf" name="password_conf">
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
            </hr>
        </div>
    </main>
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">Footer.</span>
        </div>
    </footer>
</body> -->
<?= $this->endSection ('content'); ?> 


<!-- template login
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://getbootstrap.com/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Sticky Footer Navbar Template for Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sticky-footer-navbar/">

    Bootstrap core CSS
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    Custom styles for this template
    <link href="https://getbootstrap.com/docs/4.0/sticky-footer-navbar.css" rel="stylesheet">
  </head>

  <body>

    <header>
      Fixed navbar
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Fixed navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li>
          </ul>
          <form class="form-inline mt-2 mt-md-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>
    </header>

    <?= $this->renderSection('content'); ?>

    <footer class="footer">
      <div class="container">
      </div>
    </footer>

    Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
  <!-- </body>
</html> -->
