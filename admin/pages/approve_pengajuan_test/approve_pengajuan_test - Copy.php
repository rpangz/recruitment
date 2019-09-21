<?php
include('session.php');
include('koneksi.php');
include('ajaxkirim_approve_ck.php');
include('ajaxkirim_approve_ck_final.php');
?>

<style type="text/css">
</style>
<?php
if(isset($status_id))
{
// jika level USER
if ($status_id == "ADMIN" )
{   
?>

            <table id="example" class="table table-bordered" width="100%">
                <thead>
                    <tr>
                        <th width="5%">ID CK</th>
                        <th width="10%">NAMA CK</th>
                        <th width="10%">DATA PRIBADI</th>
                        <th width="10%">DATA KELUARGA</th>
                        <th width="5%">DATA PENGALAMAN</th>
                        <th width="5%">SKILL&LAIN2</th>
                        <th width="5%">ACTION</th>
                    </tr>
                </thead>
            
                <tbody>
                    <?php
                    $sql = mysql_query("
                    SELECT b.id_calon_karyawan,c.id_calon_karyawan,d.id_calon_karyawan,e.id_calon_karyawan,f.id_calon_karyawan,a.*
                    FROM datapribadi_ck a
                    LEFT JOIN datakeluarga_ck b ON a.id_calon_karyawan=b.id_calon_karyawan
                    LEFT JOIN datapengalaman_ck c ON a.id_calon_karyawan=c.id_calon_karyawan
                    LEFT JOIN datasekolah_ck d ON a.id_calon_karyawan=d.id_calon_karyawan
                    LEFT JOIN dataskill_ck e ON a.id_calon_karyawan=e.id_calon_karyawan
                    LEFT JOIN datasutri_ck f ON a.id_calon_karyawan=f.id_calon_karyawan
                    where a.status!='approve' and a.status!='approve2' and a.status='useradm_approve'
                    group by a.id_calon_karyawan");
                    $no = 1;
                    while ($r = mysql_fetch_row($sql)) {
                    $id = $r['id'];
                    ?>


                    <tr align='left'>
                        <td><?php echo  $r[5];?></td>
                        <td><?php echo  $r[7]; ?></td>
                        <td align="center">
                            <a data-fancybox-href="pages/approve_pengajuan_test/datapribadi_detail.php?id_calon_karyawan=<?php echo  $r[5];?>" href="javascript:;" class="fancyboxB"><input type="submit" name="detail" value="detail"></a>
                        </td>
                        <td align="center">
                            <a data-fancybox-href="pages/approve_pengajuan_test/datakeluarga_detail.php?id_calon_karyawan=<?php echo  $r[5];?>" href="javascript:;" class="fancyboxB"><input type="submit" name="detail" value="detail"></a>
                        </td>
                        <td align="center">
                            <a data-fancybox-href="pages/approve_pengajuan_test/datapengalaman_detail.php?id_calon_karyawan=<?php echo  $r[5];?>" href="javascript:;" class="fancyboxB"><input type="submit" name="detail" value="detail"></a>
                        </td>
                        <td align="center" style="vertical-align: center;">
                            <a data-fancybox-href="pages/approve_pengajuan_test/datalainlain_detail.php?id_calon_karyawan=<?php echo  $r[5];?>" href="javascript:;" class="fancyboxB"><input type="submit" name="detail" value="detail"></a>
                        </td>
                        <td align="center">
                        <?php 
                        $tgl_lahir = date("dmY", strtotime($r[9])); ?>

                        <?php if ($r[0]=="" || $r[0]=="" || $r[2]=="" || $r[3]=="" || $r[0]=="" || $r[5]=="" ) {
                            echo "";
                        }
                        else
                        {
                        ?>
                        <input type="hidden" id="password_test<?php echo  $r[5];?>" value="<?php echo  $tgl_lahir?>">
                        <ul class="pager" style="vertical-align: center">                        
                            <li class="btn" style="left: 35%">
                            <a href="#" id="<?php echo  $r[5];?>" onClick="save_approve_final(this.id)" id="btn_3" name="btn_3">APPROVE</a> 
                            </li>
                            <br>
                            <li class="btn">
                            <a data-fancybox-href="pages/approve_pengajuan_test/semuadata_detail.php?id_calon_karyawan=<?php echo  $r[5];?>" href="javascript:;" class="fancybox">PRINT</a>
                            </li>
                        </ul>
                        <?php
                        }
                        ?>

                        <form method="post" onsubmit="return confirm('Yakin Ingin Menghapus?');" action="pages/approve_pengajuan_test/hapus_pengajuan.php">
                            <input type="hidden" value="<?php echo  $r[5];?>" name="id_calon_karyawan">
                            <ul class="pager" style="vertical-align: top">                        
                                <li class="btn">
                                <button name="hapus">Hapus</button> 
                                </li>
                            </ul>
                        </form>

                        </td>
                    </tr>
                    <?php
						$no++;
						}
					?>
                    
                </tbody>
            </table>



  <style type="text/css" media="print" id="print"></style>
<?php
 
}
else{ 
?>


            <table id="example" class="table table-bordered" width="100%">
                <thead>
                    <tr>
                        <th width="5%">ID CK</th>
                        <th width="10%">NAMA CK</th>
                        <th width="10%">DATA PRIBADI</th>
                        <th width="10%">DATA KELUARGA</th>
                        <th width="5%">DATA PENGALAMAN</th>
                        <th width="5%">SKILL&LAIN2</th>
                        <th width="5%">ACTION</th>
                    </tr>
                </thead>
            
                <tbody>
                    <?php
                    $sql = mysql_query("
                    SELECT b.id_calon_karyawan,c.id_calon_karyawan,d.id_calon_karyawan,e.id_calon_karyawan,f.id_calon_karyawan,a.*
                    FROM datapribadi_ck a
                    LEFT JOIN datakeluarga_ck b ON a.id_calon_karyawan=b.id_calon_karyawan
                    LEFT JOIN datapengalaman_ck c ON a.id_calon_karyawan=c.id_calon_karyawan
                    LEFT JOIN datasekolah_ck d ON a.id_calon_karyawan=d.id_calon_karyawan
                    LEFT JOIN dataskill_ck e ON a.id_calon_karyawan=e.id_calon_karyawan
                    LEFT JOIN datasutri_ck f ON a.id_calon_karyawan=f.id_calon_karyawan
                    where a.status!='approve' and a.status!='approve2' and a.status='DONE'
                    group by a.id_calon_karyawan");
                    $no = 1;
                    while ($r = mysql_fetch_row($sql)) {
                    $id = $r['id'];
                    ?>


                    <tr align='left'>
                        <td><?php echo  $r[5];?></td>
                        <td><?php echo  $r[7]; ?></td>
                        <td align="center">
                            <a data-fancybox-href="pages/approve_pengajuan_test/datapribadi_detail.php?id_calon_karyawan=<?php echo  $r[5];?>" href="javascript:;" class="fancybox"><input type="submit" name="detail" value="detail"></a>
                        </td>
                        <td align="center">
                            <a data-fancybox-href="pages/approve_pengajuan_test/datakeluarga_detail.php?id_calon_karyawan=<?php echo  $r[5];?>" href="javascript:;" class="fancybox"><input type="submit" name="detail" value="detail"></a>
                        </td>
                        <td align="center">
                            <a data-fancybox-href="pages/approve_pengajuan_test/datapengalaman_detail.php?id_calon_karyawan=<?php echo  $r[5];?>" href="javascript:;" class="fancybox"><input type="submit" name="detail" value="detail"></a>
                        </td>
                        <td align="center" style="vertical-align: center;">
                            <a data-fancybox-href="pages/approve_pengajuan_test/datalainlain_detail.php?id_calon_karyawan=<?php echo  $r[5];?>" href="javascript:;" class="fancybox"><input type="submit" name="detail" value="detail"></a>
                        </td>
                        <td align="center">
                        <?php 
                        $tgl_lahir = date("dmY", strtotime($r[9])); ?>

                        <?php if ($r[0]=="" || $r[0]=="" || $r[2]=="" || $r[3]=="" || $r[0]=="" || $r[5]=="" ) {
                            echo "";
                        }
                        else
                        {
                        ?>
                        <input type="hidden" id="password_test<?php echo  $r[5];?>" value="<?php echo  $tgl_lahir?>">
                        <ul class="pager" style="vertical-align: center">                        
                            <li class="btn" style="left: 35%">
                            <a href="#" id="<?php echo  $r[5];?>" onClick="save_approve(this.id)" id="btn_3" name="btn_3">APPROVE</a> 
                            </li>
                            <br>
                            <li class="btn">
                            <a data-fancybox-href="pages/approve_pengajuan_test/semuadata_detail.php?id_calon_karyawan=<?php echo  $r[5];?>" href="javascript:;" class="fancybox">PRINT</a>
                            </li>
                        </ul>
                        <?php
                        }
                        ?>

                        <form method="post" onsubmit="return confirm('Yakin Ingin Menghapus?');" action="pages/approve_pengajuan_test/hapus_pengajuan.php">
                            <input type="hidden" value="<?php echo  $r[5];?>" name="id_calon_karyawan">
                            <ul class="pager" style="vertical-align: top">                        
                                <li class="btn">
                                <button name="hapus">Hapus</button> 
                                </li>
                            </ul>
                        </form>

                        </td>
                    </tr>
                    <?php
                        $no++;
                        }
                    ?>
                    
                </tbody>
            </table>



  <style type="text/css" media="print" id="print"></style>


<?php
}

}
?>
