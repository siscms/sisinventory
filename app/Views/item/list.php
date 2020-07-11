<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header card-header-text card-header-warning">
                    <div class="card-text">
                        <h4 class="card-title"><strong>Daftar Barang</strong>
                        </h4>
                    </div>
                    <button class="btn btn-success btn-round float-right" data-toggle="modal" data-target="#addModal">
                        <i class="material-icons">add_circle_outline</i> Tambah baru
                    </button>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover datatablesInit">
                        <thead class="text-warning">
                            <th>Nama</th>
                            <th>Foto</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item) : ?>
                                <tr>
                                    <td><?= $item['item_name'] ?></td>
                                    <td><img src="<?= $item['item_image'] ?>" alt=""></td>
                                    <td><?= $item['item_purchase_price'] ?></td>
                                    <td><?= $item['item_selling_price'] ?></td>
                                    <td><?= $item['item_stock'] ?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-info">Detail</button>
                                        <button type="button" class="btn btn-sm btn-warning">Edit</button>
                                        <button type="button" class="btn btn-sm btn-danger">Hapus</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah barang baru</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input type="item_name" required class="form-control" placeholder="Masukkan nama barang">
                                </div>
                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail img-raised">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                                    <div>
                                        <span class="btn btn-raised btn-round btn-default btn-file">
                                            <span class="fileinput-new">Select image</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" id="file" accept="image/x-png,image/jpeg" onchange="Filevalidation()" name="..." />
                                        </span>
                                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col">
                                        <input type="number" required class="form-control" placeholder="Harga beli barang">
                                    </div>
                                    <div class="col">
                                        <input type="number" required class="form-control" placeholder="Harga jual barang">
                                    </div>
                                    <div class="col">
                                        <input type="number" required class="form-control" placeholder="Stok">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script> 
    Filevalidation = () => { 
        var fi = document.getElementById('file'); 
        // Check if any file is selected. 
        if (fi.files.length > 0) { 
            for (const i = 0; i <= fi.files.length - 1; i++) { 
  
                const fsize = fi.files.item(i).size; 
                const file = Math.round((fsize / 1024)); 
                // The size of the file. 
                if (file >= 100) { 
                    alert( 
                      "File too Big, please select a file less than 100 Kb"); 
                      $('#file').val('')
                } 
            } 
        } 
    } 
</script>
</div>
<?= $this->endSection(); ?>