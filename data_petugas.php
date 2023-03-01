<div class="container-fluid">

    <!-- page heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Petugas</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a data-toggle="modal" data-target="#tambah" class="btn btn-primary btn-icon-split btn-sm mr-1">
                <span class="icon text-white-50"><i class="fas fa-clipboard-list"></i></span>
                <span class="text">Tambah Petugas</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="p-3 bg-gray-500 text-white">
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Nama Petugas</th>
                            <th>Telepon</th>
                            <th>Level</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($tampilpetugas as $tp) {
                            echo '<tr>
                                <td>' . $no++ . '</td>
                                <td>' . $tp['username'] . '</td>
                                <td>' . $tp['nama_petugas'] . '</td>
                                <td>' . $tp['telp'] . '</td>
                                <td>' . $tp['level'] . '</td>
                                <td>
                                <a data-toggle="modal" data-target="#edit' . $tp['id_petugas'] . '" class="btn btn-sm btn-warning">Edit</a>
                                <a data-toggle="modal" data-target="#hapusModal' . $tp['id_petugas'] . '" class="btn btn-sm btn-danger">Hapus</a></td>
                            </td>
                            </tr>';
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Modal tambah data petugas -->
    <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Petugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('petugas/registrasi_petugas') ?>" method="POST">
                        <div class="form-group row mb-4 mt-4 ml-3 mr-3">
                            <label for="nama_petugas" class="col-sm-3 col-form-label">Nama Petugas</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nama_petugas" id="nama_petugas">
                            </div>
                        </div>
                        <div class="form-group row mb-4 mt-4 ml-3 mr-3">
                            <label for="username" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="username" id="username">
                            </div>
                        </div>
                        <div class="form-group row mb-4 mt-4 ml-3 mr-3">
                            <label for="telp" class="col-sm-3 col-form-label">No Hp</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="telp" id="telp">
                            </div>
                        </div>
                        <div class="form-group row mb-4 mt-4 ml-3 mr-3">
                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal edit petugas -->
    <?php
    foreach ($tampilpetugas as $tp) {
        echo '<div class="modal fade" id="edit' . $tp['id_petugas'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Petugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="' . base_url('petugas/edit/' . $tp['id_petugas']) . '" method="post">
                        <div class="form-group row mb-4 mt-4 ml-3 mr-3">
                            <label for="nama_petugas" class="col-sm-3 col-form-label">Nama Petugas</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="' . $tp['nama_petugas'] . '" id="nama_petugas" name="nama_petugas">
                            </div>
                        </div>
                        <div class="form-group row mb-4 mt-4 ml-3 mr-3">
                            <label for="telp" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="' . $tp['username'] . '" id="username" name="username">
                            </div>
                        </div>
                        <div class="form-group row mb-4 mt-4 ml-3 mr-3">
                            <label for="telp" class="col-sm-3 col-form-label">No Hp</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="' . $tp['telp'] . '" id="telp" name="telp">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>';
    }

    ?>

    <!-- modalhapus -->
    <?php foreach ($tampilpetugas as $tp) {
        echo '<div class="modal fade" id="hapusModal' . $tp['id_petugas'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title text-gray-500" id="exampleModalLabel">hahahaha</h6>
                </div>
                <div class="modal-body text-gray-500">Woy yakin mau Hapus, tekan aja tombol "hapus", gitu aja kamu nanya. Terima Kasih ........</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a href="' . base_url('petugas/delete/' . $tp['id_petugas']) . '" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
        ';
    } ?>

</div>