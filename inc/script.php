<!-- Jquery Library -->
<script type="text/javascript" src="<?= ROOT,ASSETS,JS; ?>jquery.min.js"></script>
<script type="text/javascript" src="<?= ROOT,ASSETS,JS; ?>jquery.ui.min.js"></script>
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>bootstrap/bootstrap.min.js"></script>
<!-- Modernizr Library For HTML5 And CSS3 -->
<script type="text/javascript" src="<?= ROOT,ASSETS,JS; ?>modernizr/modernizr.js"></script>
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>mmenu/jquery.mmenu.js"></script>
<script type="text/javascript" src="<?= ROOT,ASSETS,JS; ?>styleswitch.js"></script>
<!-- Library 10+ Form plugins-->
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>form/form.js"></script>
<!-- Datetime plugins -->
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>datetime/datetime.js"></script>
<!-- Library Chart-->
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>chart/chart.js"></script>
<!-- Library  5+ plugins for bootstrap -->
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>pluginsForBS/pluginsForBS.js"></script>
<!-- Library 10+ miscellaneous plugins -->
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>miscellaneous/miscellaneous.js"></script>
<!-- Library Themes Customize-->
<script type="text/javascript" src="<?= ROOT,ASSETS,JS; ?>caplet.custom.js"></script>

<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>datable/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>datable/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>toastr/toastr.js"></script>
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>inputmask/inputmask.js"></script>
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>inputmask/inputmask.extensions.js"></script>
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>inputmask/inputmask.date.extensions.js"></script>
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>inputmask/inputmask.numeric.extensions.js"></script>
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>inputmask/inputmask.phone.extensions.js"></script>
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>inputmask/inputmask.regex.extensions.js"></script>
<script type="text/javascript" src="<?= ROOT,ASSETS,PLUGINS; ?>inputmask/jquery.inputmask.js"></script>

<!-- APPEL DATATABLE -->
<script type="text/javascript">
    $('#listing-client').dataTable();
    $('#listing-devis').dataTable();
    $('#listing-facture').dataTable();
    $('#listing-projet').dataTable();
    $('#listing-license').dataTable();
    $('#listing-ticket').dataTable();
    $('#listing-famille').dataTable();
    $('#listing-article').dataTable();
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#masked_phone').inputmask("mask", {"mask": "0033999999999"});
        $('#masked_cp').inputmask("mask", {"mask": "99999"});
    });
</script>