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

             <div class="messages" id="messages">
              
            </div>

          <div class="tile">

         <div class="text-right">
              <a href="<?php base_url()?>barang/insert" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i>add</a>
            <?php echo $success;?>
            
            </div>
  
            <div class="tile-body" >
            


              <div class="row">
              <div class="col-md-12">
              <div class="tile">
              <div class="tile-body">
              <div class="table-responsive">
              <table class="table table-hover table-bordered table-sm" id="tableAset">
              <thead>
                <tr>
                  <th>no</th>
                  <th>kode barang</th>
                  <th>nama barang</th>
                  <th>kategori</th>
                  <th>jumlah</th>
                  <th>harga beli</th>
                  <th>tanggal beli</th>
                  <th>garansi</th>
                  <th>action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1;?>
                <?php foreach ($all as $key => $value) {?>
                  
                
                

                <tr>
                      <td><?php echo $no++?></td>
                      <td><?php echo $value['kode_barang'];?></td>
                      <td><?php echo $value['nama_barang'];?></td>
                      <td><?php echo $value['nama_kategori'];?></td>
                      <td style="text-align: center;"><span class="text-danger"><?php echo $value['jumlah_barang'];?></span></td>
                      <td><?php echo $value['harga_beli'];?></td>
                      <td><?php echo $value['tanggal_beli'];?></td>
                      <td><?php echo $value['garansi'];?></td>
                      <td><a href="<?php echo base_url()?>barang/get_id/<?php echo $value['id_barang'];?>" class="btn btn-outline-warning btn-sm">update</a></td>
                      
                    </tr>
              <?php };?>
              </tbody>
              </table>
              </div>
              </div>
              </div>
              </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </main>






    <!-- and modal -->
<script type="text/javascript">
  $(document).ready(function() {
    $('#tableAset').DataTable();
} );
</script>