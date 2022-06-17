<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="col-lg-8">

            <?= form_open_multipart('user/pendidikan'); ?>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Institusi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="institusi" name="institusi">
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Jenjang</label>
                <div class="col-sm-10">
                    <select name="jenjang" id="jenjang" class="form-control">
                        <?php foreach($jenjang as $data){?>
                            <option value="<?= $data->id_jenjang ?>"><?= $data->nama?></option>
                        <?php } ?>
                    </select>
                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Tahun Masuk</label>
                <div class="col-sm-10">
                <input type="date" class="form-control" id="" name="tahun_masuk" value="">
                    
                    <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Tahun Keluar</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="" name="tahun_keluar" value="">
                    <?= form_error('tanggal_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>


            </form>


        </div>
    </div>

    <div class="row">
        <div class="col-12">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Institusi</th>
      <th scope="col">Jenjang</th>
      <th scope="col">Tahun Masuk</th>
      <th scope="col">Tahun Keluar</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $no=1; foreach($pendidikan as $data){ ?>
    <tr>
      <th scope="row"><?= $no ?></th>
      <td><?=$data->institusi?></td>
      <td><?=$data->nama?></td>
      <td><?=$data->tahun_masuk?></td>
      <td><?=$data->tahun_keluar?></td>
      <td><a type="button" href="<?= base_url() ?>user/prosesDeletePendidikan/<?= $data->id_pendidikan ?>" class="btn btn-danger">Delete</a></td>
    </tr>
    <?php $no++;} ?>
  </tbody>
</table>
        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content --> 