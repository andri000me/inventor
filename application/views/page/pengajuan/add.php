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
            <h3 class="tile-title">Add Pengajuan Aset</h3>
           
            <div class="tile-body">
              <form class="form-horizontal" action="<?php echo site_url('pengajuan/insert')?>" method="post">
                <div class="form-group row">
                  <label class="control-label col-md-3">deskripsi pengajuan </label>

                  <div class="col-md-8">
                    <textarea class="form-control" type="text" name="deskripsi_pengajuan" id="deskripsi_pengajuan" value="<?php echo set_value('deskripsi_pengajuan')?>"  placeholder="Enter deskripsi"></textarea>
                    <small><?php echo form_error('deskripsi_pengajuan'); ?></small>
                  </div>
                    

                  
                </div>
             

                 <div class="form-group row">
                  <label class="control-label col-md-3">barang</label>
                  <div class="col-md-8">
                    <select class="form-control" name="id_barang" id="id_barang">
                      <optgroup label="Select barang">
                      <option value=""></option>
                      
                      <?php foreach ($barang as $key => $value ) {?>
                       
                      
                       <option value=" <?php echo $value['id_barang'];?>"><?php echo $value['nama_barang'];?>  - <?php echo $value['deskripsi_barang'];?></option>

                       <?php };?>
                       </optgroup>
                    </select>
                    <small><?php echo form_error('id_barang'); ?></small>
                  </div>
                </div>

                   <div class="form-group row">
                <label class="control-label col-md-3">jumlah barang</label>
                  <div class="col-md-2">
                    <input class="form-control" type="number" min="1" name="jumlah_barang" id="jumlah_barang" value="<?php echo set_value('jumlah_barang')?>" placeholder="0">
                    <small><?php echo form_error('jumlah_barang'); ?></small>
                  </div>
                </div>

              
            <div class="tile-footer">
              <div class="row">
                <div class="col-md-8 col-md-offset-3">
                  <div class="text-center">
                  <button class="btn btn-primary" type="submit" ><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
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
<script type="text/javascript" src="<?php echo base_url()?>assets/js/plugins/select2.min.js"></script>
<script type="text/javascript">
   $('#id_barang').select2();
</script>