 <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?php echo base_url()?>assets/images/x.png" style="max-width: 50px; height: 30px" alt="<?php echo $this->session->userdata('level');?>">
        <div>
          <p class="app-sidebar__user-name"><?php echo $this->session->userdata('nama_pegawai');?></p>
          <p class="app-sidebar__user-designation"><?php echo $this->session->userdata('email');?></p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item" href="<?php base_url()?>"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
       
       
       <?php if ($this->session->userdata('level')==='super') {?>
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Master</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?php echo base_url()?>barang"><i class="icon fa fa-circle-o"></i> Barang</a></li>
            <li><a class="treeview-item" href="<?php echo base_url()?>devisi"><i class="icon fa fa-circle-o"></i> Devisi</a></li>
            <li><a class="treeview-item" href="<?php echo base_url()?>kategori"><i class="icon fa fa-circle-o"></i> Kategori</a></li>
            <li><a class="treeview-item" href="<?php echo base_url()?>pegawai"><i class="icon fa fa-circle-o"></i> Pegawai</a></li>
          </ul>
        </li>
       <?php }?>
      
         <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Aset</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?php echo base_url()?>pengajuan"><i class="icon fa fa-circle-o"></i> Pengajuan Aset</a></li>
            
            
          </ul>
        </li>
        <li><a class="app-menu__item" href="<?php echo base_url()?>aset"><i class="app-menu__icon fa fa-file-code-o"></i><span class="app-menu__label">doc</span></a></li>
      </ul>
    </aside>