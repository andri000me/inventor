<script type="text/javascript" src="<?php base_url()?>assets/action/devisi.js"></script>
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
              <button type="button"  class="btn btn-outline-success btn-lg" title="klick here to add" data-toggle="modal" data-target="#exampleModal" onclick="createDevisi()">
            <i class="fa fa-plus" aria-hidden="true"></i>
            </button>
            </div>
  
            <div class="tile-body" >
            


              <div class="row">
              <div class="col-md-12">
              <div class="tile">
              <div class="tile-body">
              <div class="table-responsive">
              <table class="table table-hover table-bordered" id="tableId">
              <thead>
                <tr>
                  <th>Nama Devisi</th>
                  <th>No telphone</th>
                 
                  <th>action</th>
                </tr>
              </thead>
              <tbody>
              

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
            <h5 class="modal-title" id="exampleModalLabel">Create Devisi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="devisi/insert" id="createForm">
          <div class="modal-body">
            <div class="form-group">
            <label>nama devisi</label>
            <input type="text" name="nama_devisi" id="nama_devisi" placeholder="kode fakultas" class="form-control" autocomplete="off">
            </div>
            <div class="form-group">
            <label>telphone</label>
            <input type="text" name="no_tlp" id="no_tlp" placeholder="nama fakultas" class="form-control" autocomplete="off">
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
            <h5 class="modal-title" id="exampleModalLabel">Update Devisi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="devisi/update" id="updateForm">
          <div class="modal-body">
            <div class="form-group">
            <label>name</label>
            <input type="text" name="enama_devisi" id="enama_devisi" placeholder="entry your kode fakultas" class="form-control" autocomplete="off">
            </div>
            <div class="form-group">
            <label>address</label>
            <input type="text" name="eno_tlp" id="eno_tlp" placeholder="entry your nama fakultas" class="form-control" autocomplete="off">
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
