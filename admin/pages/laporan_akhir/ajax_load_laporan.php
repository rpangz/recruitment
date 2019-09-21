<?php
include('../../koneksi.php');
//echo $tglawal;
//echo $tglakir;
$tglawal=date('Y-m-d',strtotime(str_replace('/', '-', $_GET['cstartDate'])));
$tglakir=date('Y-m-d',strtotime(str_replace('/', '-', $_GET['cendDate'])));

?> 
  
            <table id="example" class="table table-bordered" width="100%">
                <thead>
                    <tr>
                        <th width="5%">No.</th>
                        <th width="5%">KODE TEST</th>
                        <th width="20%">NAMA CALON KARYAWAN</th>
                        <th width="5%">TANGGAL PSIKOTEST</th>
                        <th width="5%">KODE CABANG</th>
                        <th width="5%">NAMA CABANG </th>
                        <th width="10%">SUMBER DATA LAMARAN</th>
                        <th width="10%">NO TELP</th>
                        <th width="10%">PENDIDIKAN</th>
                        <th width="15%">HASIL PSIKOTEST</th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                    $sql = mysql_query("
                            SELECT a.id_calon_karyawan,UPPER(a.nama_lengkap) nama,DATE_FORMAT(a.create_time,'%d/%m/%Y') createtime,b.kodecbg,b.nama namacbg,
                            a.sumber_lamaran,a.telp1,SUBSTRING_INDEX(SUBSTRING_INDEX(c.scr , '|', 2 ),'|',-1) pendidikan,a.hasil_test
                            FROM datapribadi_ck a, hris.cabang_konven b,
                            (SELECT MIN(CONCAT(create_time,'|',pendidikan,'|',id_calon_karyawan)) scr FROM datasekolah_ck GROUP BY id_calon_karyawan) c
                            WHERE a.id_calon_karyawan=SUBSTRING_INDEX(SUBSTRING_INDEX(c.scr , '|', 3 ),'|',-1) AND a.kodecbg=b.kodecbg and a.status='approve2' and date(create_time) >='" .  $_GET['cstartDate'] . "'  AND date(create_time) <='" . $_GET['cendDate'] . "'
                        ");
                    $no = 1;
                    while ($row = mysql_fetch_row($sql)) {
                      $id_calon_karyawan=$row[0];
                    ?>


                    <tr>
                        <td width="5%"><?php echo $no;?></td>
                        <td width="5%">
                          <a data-fancybox-href="pages/approve_pengajuan_test/semuadata_detail.php?id_calon_karyawan=<?php echo  $row[0];?>" href="javascript:;" class="fancybox">
                          <?php echo $row[0];?>
                          </a>
                        </td>
                        <td width="20%"><?php echo $row[1];?></td>
                        <td width="5%"><?php echo $row[2];?></td>
                        <td width="5%"><?php echo $row[3];?></td>
                        <td width="5%"><?php echo $row[4];?></td>
                        <td width="10%"><?php echo $row[5];?></td>
                        <td width="10%"><?php echo $row[6];?></td>
                        <td width="10%"><?php echo $row[7];?></td>
                        <td width="15%"><?php echo $row[8];?></td>
                    </tr>

                    <?php
                        $no++;
                        }
                    ?>
                </tbody>
            </table> 