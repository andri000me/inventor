
   <script type="text/javascript" src="<?php base_url()?>assets/action/kategori.js"></script>
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
              <button type="button"  class="btn btn-outline-success btn-lg" title="klick here to add" data-toggle="modal" data-target="#exampleModal" onclick="createKategori()">
            <i class="fa fa-plus" aria-hidden="true"></i>
            </button>
            </div>
  
            <div class="tile-body" >
            


              <div class="row">
              <div class="col-md-12">
              <div class="tile">
              <div class="tile-body">
              <div class="table-responsive">
              <table class="table table-hover table-bordered" id="tableKategori">
              <thead>
                <tr>
                  <th>Nama Kategori</th>
                 
                 
                  <th>action</th>
                </tr>
              </thead>
         
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
            <h5 class="modal-title" id="exampleModalLabel">Create Kategori</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="kategori/insert" id="createForm">
          <div class="modal-body">
            <div class="form-group">
            <label>nama kategori</label>
            <input type="text" name="nama_kategori" id="nama_kategori" placeholder="kategori" class="form-control" autocomplete="off">
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
            <h5 class="modal-title" id="exampleModalLabel">Update Kategori</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="kategori/update" id="updateForm">
          <div class="modal-body">
            <div class="form-group">
            <label>nama kategori</label>
            <input type="text" name="enama_kategori" id="enama_kategori" placeholder="kategori" class="form-control" autocomplete="off">
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
