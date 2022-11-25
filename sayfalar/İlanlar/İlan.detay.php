
<?php include_once bilesen('basil_icon'); ?>
<?php include bilesen('ilan_card'); ?>

<link rel="stylesheet" href="/assets/glightbox/glightbox.min.css" />
<style>
.glightbox-clean .gslide-description {
	background: black !important;
}
.gslide-description .gslide-title {
	font-size: 25px;
}
.gslide-description .gslide-desc{
	font-size: 18px;
}
.gslide-description .gslide-title, .gslide-description .gslide-desc {
	color: white !important;
}
</style>

<div class="container mt-4">

	<?php 
	if($kendi_sayfam && $ilan['onaylayan_kullanici'] == 0){
		?>
			<div class="alert alert-custom alert-primary fade show" role="alert">
				<div class="alert-icon"><i class="flaticon-warning"></i></div>
				<div class="alert-text">
					İlan sayfanız oluşturuldu. Ancak diğer kullanıcılar tarafından görülebilmesi için onaylanması gerekir.
					İlanınızı tamamladığınızda sayfanın en altında bulunan başvuruyu tamamla butonuna tıklayınız.
					İlanınızdaki bilgiler en kısa sürede destek personelimiz tarafından incelenip size gerekli geri dönüşte bulunulacaktır.
				</div>
				<div class="alert-close">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true"><i class="ki ki-close"></i></span>
					</button>	
				</div>
			</div>
		<?php
	}
	?>

	<div class="row">
		<div id="ilan_card_container" class="col-md-12">
			<?= ilan_card($hizmet['hizmet_adi'], $ilan, count($yorumlar)) ?>
		</div>
	</div>


<style>
.f-row .col:first-child {
	padding-left: 0;
	padding-right: 0;
}
.f-row .col {
	padding-right: 0;
}
.f-row .col:last-child {
	padding-right: 0;
}
</style>
	<div class="d-flex justify-content-between flex-wrap f-row">
		<?php
		if($kendi_sayfam || count($uzmanlik_alanlari) != 0){
		?>
		<div class="col">
			<div class="card card-custom card-stretch gutter-b">
				<!--begin::Header-->
				<div class="card-header border-0">
					<h3 class="card-title font-weight-bolder text-dark">Uzmanlık Alanı</h3>
					<div class="card-toolbar text-primary">
						<?=  $kendi_sayfam ? '<i class="icon-36 text-dark kapatBtn" id="uzmanlikAlaniKapatBtn">'. basil_icon("Outline", "Interface", "Cross") . '</i>' : '' ?>
					</div>
				</div>
				<!--end::Header-->
				<!--begin::Body-->
				<div class="card-body pt-2 d-flex align-items-start flex-rows flex-wrap">
												
								<?php				
								foreach ($uzmanlik_alanlari as $key => $uzmanlik_alani) {
									?>
										<div data-uzmanlik-id="<?= $uzmanlik_alani['id'] ?>" class="btn btn-sm btn-light m-1 uzmanlik_alani_kaldir">
											
												<?=  $kendi_sayfam ? '<i class="fa fa-times text-danger" data-uzmanlik-id="'.$uzmanlik_alani['id'].'" style="font-size: 1rem !important;"></i>' : '' ?>
												<?= $uzmanlik_alani['adi'] ?>
											
										</div>
									<?php
								}
								?>
						<?php
							if($kendi_sayfam){
								?>
									<div class="btn btn-sm btn-light" id="uzmanlikAlaniEkle">
										<i class="far fa-plus-square" style="font-size: 1rem !important;"></i> Uzmanlık Alanı Ekle
									</div>
								<?php
							}
						?>
				</div>
				<!--end::Body-->
			</div>
		</div>
		<?php
		}
		?>
	</div>

	<div class="row">
		<div class="col">
			<!--begin::Card-->
			<div class="card card-custom gutter-b">
				<!--begin::Header-->
				<div class="card-header border-0">
					<h3 class="card-title font-weight-bolder text-dark">Yorumlar</h3>
				</div>
				<!--end::Header-->
				<!--begin::Body-->
				<div class="card-body px-0 py-1">
					<div class="tab-content pt-2">
						<!--begin::Tab Content-->
						<div class="tab-pane active" id="kt_apps_contacts_view_tab_1" role="tabpanel">
							<div class="container">
								<form class="form">
									<div class="form-group">
										<textarea id="yorum_metni" class="form-control form-control-lg form-control-solid" id="exampleTextarea" rows="3" placeholder="Yorumunuzu Yazın" spellcheck="false" data-ms-editor="true"></textarea>
									</div>
									<div class="row">
										<div class="col">
											<a href="javascript:void(0)" id="yorumGonder" class="btn btn-sm btn-light-success">Yorum Ekle</a>
											<a href="javascript:void(0)" id="yorumIptal" class="btn btn-sm btn-clean">iptal</a>
										</div>
									</div>
								</form>
								<div class="separator separator-dashed my-10"></div>
								<!--begin::Timeline-->
								<div class="timeline timeline-3">
									<div class="timeline-items">

										<?php 
										foreach ($yorumlar as $key => $yorum) {
											?>
											<div class="timeline-item">
												<div class="timeline-media">
													<img alt="Pic" src="<?= $yorum['profil_resmi'] ?>">
												</div>
												<div class="timeline-content">
													<div class="d-flex align-items-center justify-content-between mb-3">
														<div class="mr-2">
															<a href="#" class="text-dark-75 text-hover-primary font-weight-bold"><?= ucfirst($yorum['isim']) . " " . ucfirst($yorum['soyisim']) ?></a>
															<span class="text-muted ml-2"><?= $yorum['olusturma_zamani'] ?></span>
															<!-- <span class="label label-light-success font-weight-bolder label-inline ml-2">etiket</span> -->
														</div>
													</div>
													<p class="p-0"><?= $yorum['yorum'] ?></p>
												</div>
											</div>
											<?php
										}
										?>



									</div>
								</div>
								<!--end::Timeline-->
							</div>
						</div>
						<!--end::Tab Content-->
					</div>
				</div>
				<!--end::Body-->
			</div>
			<!--end::Card-->
		</div>
	</div>
</div>

<?php
	if($kendi_sayfam && $ilan['onaylayan_kullanici'] == 0){
		?>
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="btn btn-sm btn-light-success" id="basvuruyuTamamla">
						Başvuruyu Tamamla
					</div>
				</div>
			</div>
		<?php
	}
	if($ilan['onaylayan_kullanici'] == 0 && getAktifRol() == "Destek" && !$kendi_sayfam){
		?>
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="btn btn-sm btn-light-success" id="basvuruyuOnayla">
						Başvuruyu Onayla
					</div>
				</div>
			</div>
		<?php
	}
?>

<script>
	$('#yorumGonder').on('click', (event) => {
		var form_data = new FormData();    
		form_data.append('yorum', $('#yorum_metni').val());
		form_data.append('kullanici_id', '<?= $kullanici['id'] ?>');
		form_data.append('ilan_id', '<?= $ilan_id ?>');

		return $.ajax({
			url: 'API/YorumGonder',
			data: form_data,
			processData: false,
			contentType: false,
			type: 'POST',
			success: function(data){
				console.log(data);
				if(data.durum == "Hata"){
					swal({
						title: "Hata!",
						text: data.mesaj,
						icon: "error",
						timer: 1337
					});
				}else if(data.durum == "Başarılı"){
					swal({
						title: "Başarılı!",
						text: data.mesaj,
						icon: "success",
						timer: 1337
					}).then(function() {
						window.location = window.location ;
					});
				}
			}
		});
	})
</script>
<?php
if($kendi_sayfam){
	?>
		<template id="uzmanlikAlaniTemplate" style="display: none;">
			<div style="padding: 5% 10%;">
					<div class="pb-5 pb-lg-15">
							<h3 id="popupTitle" class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Uzmanlık Alanlarını Düzenle</h3>
					</div>
					<style>
					.select2-container {
						z-index: 999999;
					}
					</style>
					<div class="form-group" style="text-align: left;">
						<label class="font-size-h6 font-weight-bolder text-dark">Uzmanlık Alanları: </label>
						<select  id="uzmanlikAlanlari" name="uzmanlikAlanlari" class="form-control select2" multiple="multiple" name="param">
							<?php
							var_dump($uzmanlik_alanlari_liste);
								foreach ($uzmanlik_alanlari_liste as $uzmanlik_alani) {
									?>
									<option value='<?= $uzmanlik_alani['adi']?>'><?= htmlspecialchars($uzmanlik_alani['adi']) ?></option>
									<?php
								}
							?>
							
						</select>
						<!-- <textarea id="uzmanlikAlanlari" type="text" name="uzmanlikAlanlari" autocomplete="off" placeholder="Andorid Uygulama Geliştirme, Web Tasarım, ... (virgül ',' ile ayırarak yazınız.)" class="form-control h-auto py-4 px-2"></textarea> -->
					</div>
					<script>
						$('#uzmanlikAlanlari').select2({
							placeholder: "uzmanlıklarınızı sırayla yazıp ENTER tuşuna basın!",
							tags: true
						});
					</script>
			</div>
    </template>
	<?php
}
?>
<script src="/assets/glightbox/glightbox.min.js"></script>

<?php 
if($kendi_sayfam){
	?>
		<script>
			$('.kapatBtn').on('click', function(event) {
				let parentCol = event.target.parentElement;
				while(typeof parentCol.className !== 'string' || parentCol.className.indexOf('col') < 0){
					parentCol = parentCol.parentElement;
				}
				parentCol.remove();
			});

			$('#uzmanlikAlaniEkle').on('click', function(event){
				var uzmanlikAlaniPopup = $('#uzmanlikAlaniTemplate').prop('content').firstElementChild.cloneNode(true);
				//$(sertifikaEklePopup).find('#sertifika_adi').val(sertifika_adi);

				swal({
					content: uzmanlikAlaniPopup,
					button: {
						text: "Uzmanlık Alanlarını Kaydet",
						closeModal: false,
					},
				}).then(swal_data => {
					if (!swal_data) throw null;
					var uzmanlikAlanlari = $('#uzmanlikAlanlari').val();

					var form_data = new FormData();
					form_data.append('ilan_id', <?= $ilan['id'] ?>);
					form_data.append('uzmanlikAlanlari', uzmanlikAlanlari);

					return $.ajax({
						url: 'API/UzmanlikAlanlariniKaydet',
						data: form_data,
						processData: false,
						contentType: false,
						type: 'POST',
						success: function(data){
							console.log(data);
							if(data.durum == "Hata"){
								swal({
									title: "Hata!",
									text: data.mesaj,
									icon: "error",
									timer: 1337
								});
							}else if(data.durum == "Başarılı"){
								swal({
									title: "Başarılı!",
									text: data.mesaj,
									icon: "success",
									timer: 1337
								}).then(function() {
									window.location = window.location ;
								});
							}
						}
					});
				})
			})
			
			$('.uzmanlik_alani_kaldir').on('click', function(event){
				var uzmanlik_id = event.target.dataset.uzmanlikId
				swal({
					title: "Uzmanlık alanını silmekte kararlı mısın?",
					icon: "warning",
					button: {
						text: "Sil",
						closeModal: false,
					},
					dangerMode: true,
				}).then(swal_data => {
					if (!swal_data) throw null;

					var form_data = new FormData();
					form_data.append('ilan_id', <?= $ilan['id'] ?>);
					form_data.append('uzmanlik_id', uzmanlik_id);

					return $.ajax({
						url: 'API/UzmanlikAlanlariniSil',
						data: form_data,
						processData: false,
						contentType: false,
						type: 'POST',
						success: function(data){
							console.log(data);
							if(data.durum == "Hata"){
								swal({
									title: "Hata!",
									text: data.mesaj,
									icon: "error",
									timer: 1337
								});
							}else if(data.durum == "Başarılı"){
								swal({
									title: "Başarılı!",
									text: data.mesaj,
									icon: "success",
									timer: 1337
								}).then(function() {
									window.location = window.location ;
								});
							}
						}
					});
				})
			})
		</script>
		<script src="assets/dashboard/js/pages/crud/forms/widgets/select2.js"></script>
	<?php
} 
?>