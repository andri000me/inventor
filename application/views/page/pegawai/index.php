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
              <a href="<?php base_url()?>pegawai/insert" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i>add</a>
            <?php echo $success;?>
            
            </div>
  
            <div class="tile-body" >
            


              <div class="row">
              <div class="col-md-12">
              <div class="tile">
              <div class="tile-body">
              <div class="table-responsive">
              <table class="table table-hover table-bordered table-sm" id="tablePegawai">
              <thead>
                <tr>
                  <th>no</th>
                  <th>Npp</th>
                  <th>nama pegawai</th>
                  <th>Devisi</th>
                  <th>action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1;?>
                <?php foreach ($all as $key => $value) {?>
                  
                
                

                <tr>
                      <td><?php echo $no++?></td>
                      <td><?php echo $value['npp'];?></td>
                      <td><?php echo $value['nama_pegawai'];?></td>
                      <td><?php echo $value['nama_devisi'];?></td>
                      <td><a href="<?php echo base_url()?>pegawai/get_id/<?php echo $value['id_user'];?>" class="btn btn-outline-warning btn-sm">update</a></td>
                      
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





<!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create Pegawai</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="pegawai/insert" id="createForm">
          <div class="modal-body">
            <div class="form-group">
            <label>nama pegawai</label>
            <input type="text" name="nama_pegawai" id="nama_pegawai" placeholder="pegawai" class="form-control" autocomplete="off">
            </div>
            <div class="form-group">
            <label>npp</label>
            <input type="text" name="npp" id="npp" placeholder="nomor pokok" class="form-control" autocomplete="off">
            </div>


                <div class="form-group">
                    <label for="exampleSelect1">devisi</label>
                    <select class="form-control" id="id_devisi" name="id_devisi">
                      <option>choice</option>
                      <option>2</option>
                     
                    </select>
                  </div>


          </div>
          <div class="modal-footer">
           
            <button type="submit" class="btn btn-outline-primary" id="submit"><i class="fa fa-save" aria-hidden="true"> Save</i></button>
          </div>
      </form>
        </div>
      </div>
    </div>
    <!-- and modal -->





  <!-- Modal update -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Pegawai</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="pegawai/update" id="updateForm">
          <div class="modal-body">
            <div class="form-group">
            <label>name</label>
            <input type="text" name="enama_pegawai" id="enama_pegawai" placeholder="nama pegawai" class="form-control" autocomplete="off">
            </div>
            <div class="form-group">
            <label>npp</label>
            <input type="text" name="enpp" id="enpp" placeholder="npp" class="form-control" autocomplete="off">
            </div>

                <div class="form-group">
                    <label for="exampleSelect1">devisi</label>
                    <select class="form-control" id="eid_devisi" name="eid_devisi">
                      
                     
                     
                    </select>
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
<script type="text/javascript">
  $(document).ready(function() {
    $('#tablePegawai').DataTable();
} );
</script>