
<?php include bilesen('hizmet_saglayici_card'); ?>
<?php include bilesen('hizmet_saglayici_profil_card'); ?>
<style>
#hizmet_saglayici_profil_card{
    flex-direction: column;
}

</style>
<div class="container mt-4">
	<div class="row">
		<div id="hizmet_saglayici_card_container" class="col-md-12">
			<?= hizmet_saglayici_profil_card($hizmet['hizmet_adi'], $hizmet_saglayici, count($yorumlar)) ?>
		</div>
	</div>
</div>

<?php if(IS_AJAX_REQUEST){ ?>
    <a style="position: fixed; right: 10px; top: 10px; cursor: pointer;" class="btn btn-secondary" href='/<?= $hizmet['hizmet_adi'] ?>/<?= seoURL($hizmet_saglayici['adi']) ?>/<?= $hizmet_saglayici['id'] ?>'>
        <i class="fas fa-external-link-alt" style="font-size: x-large;"></i>
    </a>
    <!-- <script>
        $('#hizmet_saglayici_card_container')[0].className = "col-md-12";
        $('#hizmet_saglayici_tanitim')[0].className = "col-md-12";
        $('.add-to-cart').hide();
    </script> -->
<?php } ?>
