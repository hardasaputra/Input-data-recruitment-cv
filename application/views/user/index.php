<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="card mb-3 col-lg-8">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $user['name']; ?></h5>
                    <p class="card-text"><?= $user['email']; ?></p>
                    <p class="card-text">Alamat: <?= $user['alamat']; ?></p>
                    <p class="card-text">Tanggal Lahir: <?= $user['tanggal_lahir']; ?></p>
                    <p class="card-text">Jenis Kelamin: <?= $user['jenis_kelamin']; ?></p>
                    <p class="card-text">Summary: <?= $user['summary']; ?></p>

                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3 col-lg-8">
        <div class="row no-gutters">
           <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Pendidikan</h5>
                    <?php foreach($pendidikan as $data){ ?>
                    <p class="card-text">Nama Institusi: <?= $data->institusi; ?></p>
                    <p class="card-text">Jenjang: <?= $data->nama ?></p>
                    <p class="card-text">Tanggal Masuk: <?= $data->tahun_masuk ?></p>
                    <p class="card-text mb-5">Tanggal Keluar: <?= $data->tahun_masuk ?></p>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3 col-lg-8">
        <div class="row no-gutters">
           <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Pekerjaan</h5>
                    <?php foreach($pekerjaan as $data){ ?>
                    <p class="card-text">Nama Kantor: <?= $data->nama_kantor; ?></p>
                    <p class="card-text">Posisi: <?= $data->posisi ?></p>
                    <p class="card-text">Lokasi: <?= $data->lokasi ?></p>
                    <p class="card-text">Tahun Masuk: <?= $data->tahun_masuk ?></p>
                    <p class="card-text">Tahun Keluar: <?= $data->tahun_keluar ?></p>
                    <p class="card-text mb-5">Deskripsi: <?= $data->deskripsi ?></p>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content --> 