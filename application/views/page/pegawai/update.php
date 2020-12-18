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
            <h3 class="tile-title">update Pegawai</h3>
           
            <div class="tile-body">
              <form class="form-horizontal" action="<?php echo site_url('pegawai/update/')?><?php echo $news_item['id_user'];?>" method="post">
             
            
         
                <div class="form-group row">
                  <label class="control-label col-md-3">npp </label>

                  <div class="col-md-8">
                    <input class="form-control" type="text" name="npp" id="npp" value=" <?php echo $news_item['npp'];?>"  placeholder="Enter npp">
                  
                    <small><?php echo form_error('npp'); ?></small>
                  </div>
                    

                  
                </div>
                <div class="form-group row">
                <label class="control-label col-md-3">Name</label>
                  <div class="col-md-8">
                    <input class="form-control" type="text" name="nama_pegawai" id="nama_pegawai" value=" <?php echo $news_item['nama_pegawai'];?>" placeholder="Enter full name">
                    <small><?php echo form_error('nama_pegawai'); ?></small>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">devisi</label>
                  <div class="col-md-8">
                    <select class="form-control" name="id_devisi" value="">

                      <option value="<?php echo $news_item['id_devisi'];?>"><?php echo $news_item['nama_devisi'];?></option>
                      
                      <?php foreach ($devisi as $key => $value ) {?>
                       
                      
                       <option value=" <?php echo $value['id_devisi'];?>"> <?php echo $value['nama_devisi'];?></option>

                       <?php };?>
                    </select>
                    <small><?php echo form_error('id_devisi'); ?></small>
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
