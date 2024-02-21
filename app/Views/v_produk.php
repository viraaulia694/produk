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