<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="col-lg-8">

            <?= form_open_multipart('user/document'); ?>
            
            <div class="form-group row">
                <div class="col-sm-2">Document</div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="document" name="document">
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>


            </form>


        </div>
    </div>
    <div class="row">
        <?php foreach($document as $data){ $no = 1; ?>
        <div class="col-lg-4">
           <div class="card text-center">
            <div class="card-header">
                Document <?= $no ?>
            </div>
            <div class="card-body">
                <p class="card-text"><?=$data->nama_file;?></p>
                <a href="<?php base_url()?>../assets/document/<?=$data->nama_file?>" class="btn btn-primary">Download</a>
            </div>
            </div>
        </div>
    <?php $no++; } ?>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content --> 