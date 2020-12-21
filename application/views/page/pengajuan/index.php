   
 
   <?php if ($this->session->userdata('level')==='super') {?>
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
                  
                  <th>nama barang</th>
                  <th>devisi</th>
                  <th>jumlah</th>
                 
                  <th>tanggal pengajuan</th>
                  <th>status pengajuan</th>
                  
                  <th>action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1;?>
                <?php foreach ($all as $key => $value) {?>
                  
                
                

                <tr>
                      <td><?php echo $no++?></td>
                   
                      <td><?php echo $value['nama_barang'];?></td>
                       <td><?php echo $value['nama_devisi'];?></td>
                      <td><?php echo $value['jumlah_pengajuan'];?></td>
                 
                      <td><?php echo $value['tanggal_pengajuan'];?></td>
                      <td class="text-danger"><?php echo $value['status_pengajuan']?'<span class="badge badge-pill badge-success">selesai </span> ':'<span class="badge badge-pill badge-warning">proses</span>   <a href="./pengajuan/get_id/'.$value['id_pengajuan'].'" >update</a>  ';?>&nbsp; &nbsp;<small><?php echo $value['catatan'];?></small></td>
                 
                      <td>
                       
                       

                         <a type="button" class="btn btn-outline-warning btn-sm" title="klick here on change" onclick="updatePengajuan('<?php echo $value['id_pengajuan']?>')" data-toggle="modal" data-target="#updateModal">  <span class="fa fa-pencil-square-o"></span></a>

                      </td>
                      
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
   <?php }?>
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
              <a href="<?php base_url()?>pengajuan/insert" class="btn btn-info btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>add</a>
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
                 <th>kode</th>
                  <th>nama barang</th>
                  <th>jumlah</th>
                 
                  <th>tanggal pengajuan</th>
                  <th>status pengajuan</th>
                  
                 
                </tr>
              </thead>
              <tbody>
                <?php $no=1;?>
                <?php foreach ($all as $key => $value) {?>
                  
                
                

                <tr>
                      <td><?php echo $no++?></td>
                       <td><?php echo $value['kode_pengajuan'];?></td>
                      <td><?php echo $value['nama_barang'];?></td>
                      <td><?php echo $value['jumlah_pengajuan'];?></td>
                 
                      <td><?php echo $value['tanggal_pengajuan'];?></td>
                      <td class="text-danger"><?php echo $value['status_pengajuan']?'<span class="badge badge-pill badge-success">selesai</span> ':'<span class="badge badge-pill badge-warning">proses</span>   <a href="./pengajuan/getid/'.$value['id_pengajuan'].'" ><i class="fa fa-link" aria-hidden="true"></i>
update</a>  ';?>&nbsp; &nbsp;<small><?php echo $value['catatan'];?></small></td>
                 
                      
                      
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




  <!-- Modal update -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cek Pengajuan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="pengajuan/update" id="updateForm">
          <div class="modal-body">
            <div class="form-group">
            <label> catatan</label>
            <input type="text" name="ecatatan" id="ecatatan" placeholder="catatan" class="form-control" autocomplete="off">

            </div>

             <div class="form-group">
            <label> jumlah pengajuan</label>
            <input type="number" name="jumlah_pengajuan" id="jumlah_pengajuan" placeholder="catatan" class="form-control" autocomplete="off">

            </div>

          <div class="custom-control custom-checkbox mr-sm-2">
        <input type="checkbox" class="custom-control-input" id="status" name="status" >
        <label class="custom-control-label" for="status">cheklist jika anda setuju</label>
      </div>
          </div>
          <div class="modal-footer">
           
            <button type="submit" class="btn btn-outline-warning" id="submit"><i class="fa fa-save" aria-hidden="true"> Save</i> </button>
          </div>
      </form>
        </div>
      </div>
    </div>
    <!-- and modal -->
<script type="text/javascript" src="<?php base_url()?>assets/action/peng.js"></script>

    <!-- and modal -->
<script type="text/javascript">
  $(document).ready(function() {
    $('#tableAset').DataTable();
} );
</script>