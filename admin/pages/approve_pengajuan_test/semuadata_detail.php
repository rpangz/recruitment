<link href="../../../assets/template/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../../../assets/css/main.css" />

<script type="text/javascript" src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <script type="text/javascript">
	  	$(function() {
		  var buttons     = $('#btn_3');
		  var printStyle  = $('#print');
		  var style;

		  buttons.click(function() {
		    style = 'div { color: ' + $(this).attr('class') + '};';
		    printStyle.text(style);
		    window.print();
		  });
		});
  </script>

  <style type="text/css">
	.fancybox-wrap { 
	  top: 40px !important; 
	  left: 10px !important; 
	}
    @media print {
      button {
        display: none;
      }
      #btn_3 {
        display: none;
      }
      #btn_2 {
        display: none;
      }
      div {
      font-family: Arial Black; 
	  color: red; font-size: 9pt;
      }
	  a[href]:after {
	    content: none !important;
	  }
    }
    @media screen {
      .red {
        color: black;
      }
      .green {
        color: green;
      }
    }
  </style>
<div style="page-break-after: always;">
    <?php include ('print_detail/datapribadi_detail.php'); ?>
</div>
<div>
    <?php include ('print_detail/datakeluarga_detail.php'); ?>
</div>
<div  style="page-break-after: before;">
	<div class="row">
		<div class="col-xs-12 col-sm-12"><h1>Data Pengalaman</h1></div>
	</div>
    <?php include ('print_detail/datapengalaman_detail.php'); ?>
</div>
<div style="page-break-before: always;">
	<div class="row">
		<div class="col-xs-12 col-sm-12"><h1>Skill &amp; Lain-Lain</h1></div>
	</div>

    <?php include ('print_detail/datalainlain_detail.php'); ?>
</div>

	<div class="row">
		<ul class="pager" style="vertical-align: top">
 			<li class="next"><a href="#step_3" id="btn_3" name="btn_2">PRINT</a></li>
		</ul>
	</div>

  <style type="text/css" media="print" id="print"></style>