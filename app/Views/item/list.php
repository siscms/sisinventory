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
                    <button type="button" class="btn btn-success btn-round float-right" onclick="onBtnAdd()">
                        <i class="material-icons">add_circle_outline</i> Tambah baru
                    </button>
                    <br>
                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><?= session()->getFlashdata('success') ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('failed')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?= $validation->listErrors() ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
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
                            <?php foreach ($items as $item) :
                                $dataItem = implode("','", $item);
                            ?>
                                <tr>
                                    <td><?= $item['item_name'] ?></td>
                                    <td><img src="/uploads/<?= $item['item_image'] ?>" width="150" height="100" alt=""></td>
                                    <td><?= $item['item_purchase_price'] ?></td>
                                    <td><?= $item['item_selling_price'] ?></td>
                                    <td><?= $item['item_stock'] ?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-info" onclick="onBtnDetail('<?= $dataItem; ?>')">Detail</button>
                                        <button type="button" class="btn btn-sm btn-warning" onclick="onBtnEdit('<?= $dataItem; ?>')">Edit</button>
                                        <button type="button" class="btn btn-sm btn-danger" onclick="onBtnDelete(<?= $item['item_id'] ?>)">Hapus</button>
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
                        <form action="/item/add" method="POST" id="itemAdd" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah barang baru</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input name="item_name" type="text" required class="form-control" placeholder="Masukkan nama barang">
                                </div>
                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail img-raised">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                                    <div>
                                        <span class="btn btn-raised btn-round btn-default btn-file">
                                            <span class="fileinput-new">Select image</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" id="file" accept="image/x-png,image/jpeg" onchange="Filevalidation()" name="item_image" />
                                        </span>
                                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col">
                                        <input name="item_purchase_price" type="number" required class="form-control" placeholder="Harga beli barang">
                                    </div>
                                    <div class="col">
                                        <input name="item_selling_price" type="number" required class="form-control" placeholder="Harga jual barang">
                                    </div>
                                    <div class="col">
                                        <input name="item_stock" type="number" required class="form-control" placeholder="Stok">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success" id="btnSave">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <form action="/item/edit" method="POST" id="itemAdd" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit barang</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input id="editName" name="item_name" type="text" required class="form-control" placeholder="Masukkan nama barang">
                                    <input id="editId" name="id" type="hidden">
                                </div>
                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail img-raised">
                                        <img id="editImage" class="img-rounded img-thumbnail" width="720" height="auto" rel="nofollow" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                                    <div>
                                        <span class="btn btn-raised btn-round btn-default btn-file">
                                            <span class="fileinput-new">Select image</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" id="fileEdit" accept="image/x-png,image/jpeg" onchange="Filevalidationedit()" name="item_image" />
                                        </span>
                                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col">
                                        <input id="editPurchasePrice" name="item_purchase_price" type="number" required class="form-control" placeholder="Harga beli barang">
                                    </div>
                                    <div class="col">
                                        <input id="editSellingPrice" name="item_selling_price" type="number" required class="form-control" placeholder="Harga jual barang">
                                    </div>
                                    <div class="col">
                                        <input id="editStock" name="item_stock" type="number" required class="form-control" placeholder="Stok">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success" id="btnSave">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" id="detailModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail barang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h2 id="dataName"></h2>
                            <img id="dataImage" class="img-rounded img-thumbnail" src="/uploads/<?= $item['item_image'] ?>" alt="">
                            <table class="table table-hover datatablesInit">
                                <tbody class="text-info">
                                    <tr>
                                        <td><strong>Harga Beli</strong></td>
                                        <td></td>
                                        <td id="dataPurchasePrice"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Harga Jual</strong></td>
                                        <td></td>
                                        <td id="dataSellingPrice"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Stok</strong></td>
                                        <td></td>
                                        <td id="dataStock"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="deleteModal" role="dialog">
                <div class="modal-dialog" role="document">
                    <form action="/item/delete" method="POST">
                        <?= csrf_field() ?>
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Hapus Barang</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Apakah anda yakin akan menghapus data ini?</p>
                                <input type="hidden" name="id" id="idDelete" value="">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        onBtnAdd = () => {

            $('#addModal').modal({
                backdrop: true
            })
        }

        onBtnDelete = (id) => {

            $('#idDelete').val(id)
            $('#deleteModal').modal({
                backdrop: true
            })
        }

        onBtnDetail = (id, name, image, purchase_price, selling_price, stock) => {

            $('#dataName').html(name)
            $('#dataPurchasePrice').html(purchase_price)
            $('#dataSellingPrice').html(selling_price)
            $('#dataStock').html(stock)
            $('#dataImage').attr('src', '/uploads/' + image);
            $('#detailModal').modal("show")
        }

        onBtnEdit = (id, name, image, purchase_price, selling_price, stock) => {

            $('#editId').val(id)
            $('#editName').val(name)
            $('#editPurchasePrice').val(purchase_price)
            $('#editSellingPrice').val(selling_price)
            $('#editStock').val(stock)
            $('#editImage').attr('src', '/uploads/' + image);
            $('#editModal').modal("show")
        }

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

        Filevalidationedit = () => {
            var fi = document.getElementById('fileEdit');
            // Check if any file is selected. 
            if (fi.files.length > 0) {
                for (const i = 0; i <= fi.files.length - 1; i++) {

                    const fsize = fi.files.item(i).size;
                    const file = Math.round((fsize / 1024));
                    // The size of the file. 
                    if (file >= 100) {
                        alert(
                            "File too Big, please select a file less than 100 Kb");
                        $('#fileEdit').val('')
                    }
                }
            }
        }
    </script>
</div>
<?= $this->endSection(); ?>