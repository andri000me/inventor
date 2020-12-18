   <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Blank Page</h1>
          <p>Start a beautiful journey here</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Blank Page</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
                   <div class="tile">
            <h3 class="tile-title">Update Barang</h3>
           
            <div class="tile-body">
              <form class="form-horizontal" action="<?php echo site_url('barang/update/')?><?php echo $news_item['id_barang'];?>" method="post">
                <div class="form-group row">
                  <label class="control-label col-md-3">kode barang </label>

                  <div class="col-md-4">
                    <input class="form-control" type="text" name="kode_barang" id="kode_barang" value="<?php echo $news_item['kode_barang']?>"  placeholder="Enter code">
                    <small><?php echo form_error('kode_barang'); ?></small>
                  </div>
                    

                  
                </div>
                <div class="form-group row">
                <label class="control-label col-md-3">Nama barang</label>
                  <div class="col-md-8">
                    <input class="form-control" type="text" name="nama_barang" id="nama_barang" value="<?php echo $news_item['nama_barang']?>" placeholder="nama barang">
                    <small><?php echo form_error('nama_barang'); ?></small>
                  </div>
                </div>

                 <div class="form-group row">
                <label class="control-label col-md-3">Jumlah barang</label>
                  <div class="col-md-2">
                    <input class="form-control" type="number" name="jumlah_barang" id="jumlah_barang" value="<?php echo $news_item['jumlah_barang']?>" placeholder="jumlah">
                    <small><?php echo form_error('jumlah_barang'); ?></small>
                  </div>
                </div>

                 <div class="form-group row">
                <label class="control-label col-md-3">Harga Beli</label>
                  <div class="col-md-6">
                    <input class="form-control" type="number" name="harga_beli" id="harga_beli" value="<?php echo $news_item['harga_beli']?>" placeholder="jumlah">
                    <small><?php echo form_error('harga_beli'); ?></small>
                  </div>
                </div>

                  <div class="form-group row">
                <label class="control-label col-md-3">Tanggal beli</label>
                  <div class="col-md-6">
                    <input class="form-control" type="date" name="tanggal_beli" id="tanggal_beli" value="<?php echo $news_item['tanggal_beli']?>" placeholder="jumlah">
                    <small><?php echo form_error('tanggal_beli'); ?></small>
                  </div>
                </div>




                 <div class="form-group row">
                  <label class="control-label col-md-3">Deskripsi Barang</label>
                  <div class="col-md-8">
                    <textarea class="form-control" rows="4" name="deskripsi_barang" id="deskripsi_barang" placeholder="Enter your deksripsi"><?php echo $news_item['deskripsi_barang']?></textarea>
                     <small><?php echo form_error('deskripsi_barang'); ?></small>
                  </div>
                </div>


                <div class="form-group row">
                  <label class="control-label col-md-3">Status Barang</label>
                  <div class="col-md-2">
                    <select class="form-control" name="status_barang">

                      <option value="<?php echo $news_item['status_barang']?>"><?php echo $news_item['status_barang']?></option>
                      
                     
                       
                      
                       <option value="baru"> baru</option>
                         <option value="bekas"> bekas</option>
                      
                    </select>
                    <small><?php echo form_error('status_barang'); ?></small>
                  </div>
                </div>
                  <div class="form-group row">
                  <label class="control-label col-md-3">Garansi Barang</label>
                  <div class="col-md-2">
                    <select class="form-control" name="garansi">

                      <option value="<?php echo $news_item['garansi']?>"><?php echo $news_item['garansi']?></option>
                      
                     
                       
                      
                       <option value="ya"> ya</option>
                         <option value="tidak"> tidak</option>
                      
                    </select>
                    <small><?php echo form_error('status_barang'); ?></small>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="control-label col-md-3">Kategori</label>
                  <div class="col-md-4">
                    <select class="form-control" name="id_kategori">

                      <option value="<?php echo $news_item['id_kategori']?>"><?php echo $news_item['nama_kategori']?></option>
                      
                      <?php foreach ($kategori as $key => $value ) {?>
                       
                      
                       <option value=" <?php echo $value['id_kategori'];?>"> <?php echo $value['nama_kategori'];?></option>

                       <?php };?>
                    </select>
                    <small><?php echo form_error('id_kategori'); ?></small>
                  </div>
                </div>
            <div class="tile-footer">
              <div class="row">
                <div class="col-md-8 col-md-offset-3">
                  <div class="text-center">
                  <button class="btn btn-primary" type="submit" ><i class="fa fa-fw fa-lg fa-check-circle"></i>Register</button>
                  </div>
                </div>
              </div>
            </div>
              </form>
            </div>
           
          </div>
            </div>
          </div>
        </div>
      </div>
    </main>
