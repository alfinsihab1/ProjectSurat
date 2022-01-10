<div class="span3 desktop-only">
  <div class="sidebar">
    <ul class="widget widget-menu unstyled">
      <li>
        <a href="<?php echo $arsipsurat;?>">
          <i class="menu-icon icon-dashboard"></i>Dashboard
        </a>
      </li>
      <?php if($aksesusr == 0){ ?>

    <ul class="widget widget-menu unstyled">
      <li>
        <a href="users.php">
          <i class="menu-icon icon-group"></i> Manage User
        </a>
      </li>
    </ul>
    <ul class="widget widget-menu unstyled">
      <li>
        <a href="proses/view_kode.php">
          <i class="menu-icon icon-group"></i> Daftar Jenis Surat
        </a>
      </li>
    </ul>

    <?php } 
    else{
    ?>
      <li>
        <a href="<?php echo $inbox;?>">
          <i class="menu-icon icon-arrow-down"></i>Surat Masuk
        </a>
      </li>

      <li>
        <a href="<?php echo $outbox;?>">
          <i class="menu-icon icon-arrow-up"></i>Surat Keluar
        </a>
      </li>
    </ul>

    <?php }?>


    <ul class="widget widget-menu unstyled">
      <li>
        <a href="proses/editpwd.php">
          <i class="menu-icon icon-cog"></i>Ubah Password
        </a>
      </li>

      <li>
        <a href="include/logout.php">
          <i class="menu-icon icon-signout"></i>Logout
        </a>
      </li>
    </ul>
  </div>
</div>