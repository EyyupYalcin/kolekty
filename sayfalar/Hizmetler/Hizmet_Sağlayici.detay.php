
<?php include bilesen('portfolyo_card'); ?>
<?php include_once bilesen('basil_icon'); ?>
<?php include bilesen('hizmet_saglayici_profil_card'); ?>

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

<div class=" mt-4"> <?php // container class'ı sildim çünkü yatay padding'den dolayı hizza bozuluyordu ?>

	<?php 
	if($kendi_sayfam && $hizmet_saglayici['onaylayan_kullanici'] == 0 && $hizmet_saglayici['durum'] == 1){
		?>
			<div class="alert alert-custom alert-primary fade show" role="alert">
				<div class="alert-icon"><i class="flaticon-warning"></i></div>
				<div class="alert-text">
					Hizmet sayfanız oluşturuldu. Ancak diğer kullanıcılar tarafından görülebilmesi için onaylanması gerekir.
					Hizmet profilinizi tamamladığınızda sayfanın en altında bulunan başvuruyu tamamla butonuna tıklayınız.
					Hizmet sayfanızdaki bilgiler en kısa sürede destek personelimiz tarafından incelenip size gerekli geri dönüşte bulunulacaktır.
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

	<?php 
	if($kendi_sayfam && $hizmet_saglayici['onaylayan_kullanici'] == 0 && $hizmet_saglayici['durum'] == 2){
		?>
			<div class="alert alert-custom alert-primary fade show" role="alert">
				<div class="alert-icon"><i class="flaticon-warning"></i></div>
				<div class="alert-text">
					Hizmet Sayfanız Destek kullanıcılarımız tarafından incelenmek üzere gönderildi. En kısa sürede size geri dönüş yapılacaktır.
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


	<?php 
	if($kendi_sayfam && $hizmet_saglayici['onaylayan_kullanici'] != 0 && $hizmet_saglayici['durum'] == 3){
		?>
			<div class="alert alert-custom alert-primary fade show" role="alert">
				<div class="alert-icon"><i class="flaticon-warning"></i></div>
				<div class="alert-text">
					Hizmet Sayfanız Destek kullanıcılarımız tarafından onaylanmıştır. Dilerseniz sayfanın en altında bulunan düzenle butonuna tıklayarak hizmet sayfanızı düzenleyebilirsiniz.
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
		<div id="hizmet_saglayici_card_container" class="col-md-12">
			<?= hizmet_saglayici_profil_card($hizmet['hizmet_adi'], $hizmet_saglayici, count($yorumlar)) ?>
		</div>
	</div>

	<?php 
	if($kendi_sayfam || count($portfolyolar) != 0){
	?>

	<div class="row">
		<div class="col-lg-12">
			<div class="card card-custom card-stretch gutter-b">
				<!--begin::Header-->
				<div class="card-header border-0">
					<h3 class="card-title font-weight-bolder text-dark">Portfolyo</h3>
					<div class="card-toolbar text-primary">
					<?= "" // $kendi_sayfam ? '<button class="btn btn-sm btn-light-primary py-2 px-5" id="portfolyoEkleBtn">Portfolyo Ekle</button>' :'' ?>
					<?= $kendi_sayfam ? '<i class="icon-36 text-dark kapatBtn" id="portfolyoKapatBtn">'. basil_icon("Outline", "Interface", "Cross") . '</i>' : '' ?>
					</div>
				</div>
				<!--end::Header-->
				<!--begin::Body-->
				<style>
					#portfolyoEkle {
						display: flex;
						flex-direction: column;
						justify-content: center;
						padding: 0 2rem;
						/* border-radius: .75rem;
						background: silver;
						color: #3F4254;*/
						text-align: center;
						font-size: 15px; 
						margin: 2rem 1rem;
					}
					#portfolyoEkle:hover {
						/* background: darkgray; */
						/* color: white; */
					}
					#portfolyoEkle i {
						/* color: #3F4254; */
						padding: 0;
						font-size: 3rem !important;
					}
					#portfolyoEkle i::before {
						margin: 0 auto;
					}
					#portfolyoEkle:hover i::before {
						content: "";
						font-weight: 500;
						margin: 0 auto;
						/* color: white; */
					}
				</style>
				<div class="card-body pt-2" style="min-height: 200px;">
					<div class="d-flex flex-row h-100 pb-2 scroll scroll-pull horizontal_scroll" data-scroll="true" data-suppress-scroll-x="false" data-suppress-scroll-y="true">
						<?php
						
							foreach ($portfolyolar as $key => $portfolyo) {
								portfolyo_card($portfolyo, $kendi_sayfam);
							}
							if($kendi_sayfam){
								?>
									<div class="btn btn-sm btn-light" id="portfolyoEkle">
											<i class="far fa-plus-square"></i> Portfolyo Oluştur
									</div>
								<?php
							}
						
						?>
					</div>
					<script>
                    // mousewheel eventini manipüle ederek axisleri değiştirir. Siz tekerleği aşağı çevirirsiniz scroll yönü sağa doğru olur.
                    $('.horizontal_scroll').on('mousewheel', (e) => {
                        $(e.target).closest('.horizontal_scroll')[0].scrollLeft += e.deltaY * - 25;
                    })
					</script>
				</div>
				<!--end::Body-->
			</div>
		</div>

		<div class="col-lg-12" style="display: none;"> <!-- Bunu kaldıracaktık sanırım görünmez yaptım -->
			<div class="card card-custom card-stretch gutter-b">
				<!--begin::Header-->
				<div class="card-header border-0">
					<h3 class="card-title font-weight-bolder text-dark">Fiyatlar</h3>
					<div class="card-toolbar text-primary">
						<?=  $kendi_sayfam ? '<i class="icon-36 text-dark kapatBtn" id="fiyatlarKapatBtn">'. basil_icon("Outline", "Interface", "Cross") . '</i>' : '' ?>
					</div>
				</div>
				<!--end::Header-->
				<!--begin::Body-->
				<div class="card-body pt-2" style="min-height: 200px;"></div>
				<!--end::Body-->
			</div>
		</div>
	</div>

	<?php
	}
	?>
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
		if($kendi_sayfam || count($egitimler) != 0){
		?>
		<div class="col">
			<div class="card card-custom card-stretch gutter-b">
				<!--begin::Header-->
				<div class="card-header border-0">
					<h3 class="card-title font-weight-bolder text-dark">Eğitim ve Sertifikalar</h3>
					<div class="card-toolbar text-primary">
						<?=  $kendi_sayfam ? '<i class="icon-36 text-dark kapatBtn" id="sertifikalarKapatBtn">'. basil_icon("Outline", "Interface", "Cross") . '</i>' : '' ?>
					</div>
				</div>
				<!--end::Header-->
				<style>
				/*
					#sertifikaEkle {
						padding: 0 2rem;
						border-radius: .75rem;
						background: silver;
						color: #3F4254;
						text-align: center;
						font-size: 15px; 
					}
					#sertifikaEkle:hover {
					 background: darkgray;
						color: white; 
					}
					#sertifikaEkle i {
					 color: #3F4254; 
					}
					#sertifikaEkle:hover i::before {
						content: "";
						font-weight: 900;
						color: white; 
					} */
				</style>
				<!--begin::Body-->
				<div class="card-body pt-2 d-flex  align-items-center justify-content-between flex-column sertifikalar">
					<div class="table-responsive">
						<table class="table table-borderless table-vertical-center">
							<thead>
								<tr>
									<?php if($kendi_sayfam || getAktifRol() == "Destek") echo '<th class="p-0 w-40px"></th>'; ?>
									<th class="p-0 min-w-200px"></th>
									<?php if($kendi_sayfam || getAktifRol() == "Destek") echo '<th class="p-0 w-40px"></th>'; ?>
									<?php if($kendi_sayfam) echo '<th class="p-0 w-40px"></th>'; ?>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($egitimler as $key => $egitim) {
									//sertifika_card($egitim, $kendi_sayfam);
									?>
										<tr>
											<?php if($kendi_sayfam || getAktifRol() == "Destek"){
												?>
													<td class="text-left pl-0">
														<span class="svg-icon svg-icon-md svg-icon-success">
															<?php
																if(is_null($egitim['onay'])){
																	echo '<i class="fas fa-question-circle icon-lg text-dark-50"></i>';
																}else if($egitim['onay']){
																	echo '<i class="fas fa-check-circle icon-lg text-success"></i>';
																}else{
																	echo '<i class="fas fa-times-circle icon-lg text-danger"></i>';
																}
															?>
														</span>
													</td>
												<?php
											} ?>

											<td class="text-left">
												<span class="text-dark-75 font-weight-bolder d-block font-size-lg"><?= $egitim['adi'] ?></span>
												<!-- <span class="text-muted font-weight-bold">Paid</span> -->
											</td>

											<?php if($kendi_sayfam || getAktifRol() == "Destek"){
												?>
													<td class="text-right pr-0">
														<div class="btn btn-icon btn-light btn-sm">
															<span class="svg-icon svg-icon-md svg-icon-success">
																<a href="<?= $egitim['dosya'] ?>"><i class="fa fa-download icon-lg"></i></a>
															</span>
														</div>
													</td>
												<?php
											} ?>

											<?php if($kendi_sayfam){
												?>
													<td class="text-right pr-0">
														<div class="btn btn-icon btn-light btn-sm">
															<span class="svg-icon svg-icon-md svg-icon-success">
																<i data-sertifika-adi="<?= $egitim['adi'] ?>" data-sertifika-id="<?= $egitim['id'] ?>" class="sertifika_duzenle fa fa-edit icon-lg"></i>
															</span>
														</div>
													</td>
												<?php
											} ?>
										</tr>
										<div></div>
									<?php
								}
								?>
							</tbody>
						</table>
					</div>
						<?php
							if($kendi_sayfam){
								?>
									<div class="btn btn-sm btn-light" id="sertifikaEkle">
										<i class="far fa-plus-square" style="font-size: 1rem !important;"></i> Sertifika Ekle
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

<?php 
if($hizmet_saglayici['onaylayan_kullanici'] != 0){
	?>
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
	<?php
}
?>

</div>

<?php
	if($kendi_sayfam && $hizmet_saglayici['onaylayan_kullanici'] == 0 && $hizmet_saglayici['durum'] == 1 && getAktifRol() == "Hizmet Sağlayıcı"){
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
	if($hizmet_saglayici['onaylayan_kullanici'] == 0 && getAktifRol() == "Destek" && !$kendi_sayfam){
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
		form_data.append('hizmet_saglayici_id', '<?= $hizmet_saglayici_id ?>');

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
    <template id="portfolyoEkleTemplate" style="display: none;">
        <div style="padding: 5% 10%;">
            <div class="pb-5 pb-lg-15">
                <h3 id="popupTitle" class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Portfolyo Oluştur</h3>
            </div>

            <div class="form-group" style="text-align: left;">
							<label class="font-size-h6 font-weight-bolder text-dark">İsim: </label>
							<input id="portfolyo_adi" type="text" name="portfolyo_adi" autocomplete="off" class="form-control h-auto py-4 px-2">
            </div>

            <div class="form-group" style="text-align: left;">
							<label class="font-size-h6 font-weight-bolder text-dark">Açıklama Metni: </label>
							<textarea  id="portfolyo_aciklama" type="text" name="portfolyo_aciklama" autocomplete="off" class="form-control h-auto py-4 px-2"></textarea>
            </div>

						<div class="form-group" style="text-align: left;">
							<label class="font-size-h6 font-weight-bolder text-dark">Görsel: </label>
							<input id="portfolyo_resim" type="file" name="portfolyo_resim" autocomplete="off" class="form-control h-auto py-4 px-2">
            </div>

						<div style="text-align: right;">
							<button id="#portfolyo_sil_btn" class="btn btn-danger d-none">Sil</button>
						</div>
        </div>
    </template>

		<template id="sertifikaEkleTemplate" style="display: none;">
			<div style="padding: 5% 10%;">
					<div class="pb-5 pb-lg-15">
							<h3 id="popupTitle" class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Sertifika Ekle</h3>
					</div>

					<div class="form-group" style="text-align: left;">
						<label class="font-size-h6 font-weight-bolder text-dark">İsim: </label>
						<input id="sertifika_adi" type="text" name="sertifika_adi" autocomplete="off" class="form-control h-auto py-4 px-2">
					</div>

					<div class="form-group" style="text-align: left;">
						<label class="font-size-h6 font-weight-bolder text-dark">Belge: </label>
						<input id="sertifika_belge" type="file" name="sertifika_belge" autocomplete="off" class="form-control h-auto py-4 px-2">
					</div>

					<div style="text-align: right;">
						<button id="#sertifika_sil_btn" class="btn btn-danger d-none">Sil</button>
					</div>
			</div>
    </template>

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

			$('#portfolyoEkle').on('click', function(event) {
				var portfolyoEklePopup = $('#portfolyoEkleTemplate').prop('content').firstElementChild.cloneNode(true);
				swal({
					content: portfolyoEklePopup,
					button: {
						text: "Portfolyo Ekle",
						closeModal: false,
					},
				}).then(swal_data => {
					if (!swal_data) throw null;
					var portfolyo_adi = $('#portfolyo_adi').val();
					var portfolyo_aciklama = $('#portfolyo_aciklama').val();
					var portfolyo_resim = $('#portfolyo_resim')[0].files[0]

					var form_data = new FormData();    
					form_data.append('portfolyo_adi', portfolyo_adi);
					form_data.append('portfolyo_aciklama', portfolyo_aciklama);
					form_data.append('hizmet_saglayici_id', <?= $hizmet_saglayici['id'] ?>);
					form_data.append('portfolyo_resim', portfolyo_resim);

					return $.ajax({
						url: 'API/Portfolyo_Ekle',
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

			$('.portfolyo_duzenle').on('click', function(event){
				var dict = {}
				
				event.target.previousElementSibling.dataset.glightbox.split('; ').forEach(ikili => {
					let key = ikili.split(': ')[0]
					let val = ikili.split(': ')[1]
					dict[key] = val
				})
				
				var portfolyoDuzenlePopup = $('#portfolyoEkleTemplate').prop('content').firstElementChild.cloneNode(true);
				$(portfolyoDuzenlePopup).find('#portfolyo_adi').val(dict['title']);
				$(portfolyoDuzenlePopup).find('#portfolyo_aciklama').val(dict['description']);
				$(portfolyoDuzenlePopup).find('#popupTitle').text("Portfolyo Düzenle");
				$(portfolyoDuzenlePopup)[0].lastElementChild.firstElementChild.className = "btn btn-danger";
				var portfolyo_id = event.target.previousElementSibling.dataset.portfolyoId;
				$(portfolyoDuzenlePopup)[0].lastElementChild.firstElementChild.onclick = function(){portfolyo_sil(portfolyo_id)};
				swal({
					content: portfolyoDuzenlePopup,
					buttons: {
						text: "Portfolyo Güncelle",
						closeModal: false,
					}
				}).then(swal_data => {
					if (!swal_data) throw null;
					var portfolyo_adi = $('#portfolyo_adi').val();
					var portfolyo_aciklama = $('#portfolyo_aciklama').val();
					var portfolyo_resim = $('#portfolyo_resim')[0].files[0]

					var form_data = new FormData();    
					form_data.append('portfolyo_id', portfolyo_id);
					form_data.append('portfolyo_adi', portfolyo_adi);
					form_data.append('portfolyo_aciklama', portfolyo_aciklama);
					form_data.append('hizmet_saglayici_id', <?= $hizmet_saglayici['id'] ?>);
					form_data.append('portfolyo_resim', portfolyo_resim);

					return $.ajax({
						url: 'API/Portfolyo_Duzenle',
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

			function portfolyo_sil(portfolyo_id){
				var form_data = new FormData();    
				form_data.append('portfolyo_id', portfolyo_id);

				return $.ajax({
					url: 'API/Portfolyo_Sil',
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
			}
			
			$('#sertifikaEkle').on('click', function(event){
				var sertifikaEklePopup = $('#sertifikaEkleTemplate').prop('content').firstElementChild.cloneNode(true);
				swal({
					content: sertifikaEklePopup,
					button: {
						text: "Sertifika Ekle",
						closeModal: false,
					},
				}).then(swal_data => {
					if (!swal_data) throw null;
					var sertifika_adi = $('#sertifika_adi').val();
					var sertifika_belge = $('#sertifika_belge')[0].files[0]

					var form_data = new FormData();
					form_data.append('kullanici_id', <?= $kullanici['id'] ?>);
					form_data.append('sertifika_adi', sertifika_adi);
					form_data.append('sertifika_belge', sertifika_belge);

					return $.ajax({
						url: 'API/Sertifika_Ekle',
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

			$('.sertifika_duzenle').on('click', function(event){
				var sertifikaEklePopup = $('#sertifikaEkleTemplate').prop('content').firstElementChild.cloneNode(true);
				var sertifika_id = event.target.dataset.sertifikaId;
				var sertifika_adi = event.target.dataset.sertifikaAdi;
				$(sertifikaEklePopup).find('#sertifika_adi').val(sertifika_adi);
				$(sertifikaEklePopup).find('#popupTitle').text("Sertifika Düzenle");
				$(sertifikaEklePopup)[0].lastElementChild.firstElementChild.className = "btn btn-danger";
				
				$(sertifikaEklePopup)[0].lastElementChild.firstElementChild.onclick = function(){sertifika_sil(sertifika_id)};
				swal({
					content: sertifikaEklePopup,
					button: {
						text: "Sertifika Düzenle",
						closeModal: false,
					},
				}).then(swal_data => {
					if (!swal_data) throw null;
					var sertifika_adi = $('#sertifika_adi').val();
					var sertifika_belge = $('#sertifika_belge')[0].files[0]

					var form_data = new FormData();
					form_data.append('kullanici_id', <?= $kullanici['id'] ?>);
					form_data.append('sertifika_id', sertifika_id);
					form_data.append('sertifika_adi', sertifika_adi);
					form_data.append('sertifika_belge', sertifika_belge);

					return $.ajax({
						url: 'API/Sertifika_Duzenle',
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

			function sertifika_sil(sertifika_id){
				var form_data = new FormData();    
				form_data.append('sertifika_id', sertifika_id);

				return $.ajax({
					url: 'API/Sertifika_Sil',
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
			}

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
					form_data.append('hizmet_saglayici_id', <?= $hizmet_saglayici['id'] ?>);
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
					form_data.append('hizmet_saglayici_id', <?= $hizmet_saglayici['id'] ?>);
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
<script>
			var lightbox = GLightbox();
</script>

<?php 
	if($kendi_sayfam && $hizmet_saglayici['onaylayan_kullanici'] == 0){
		?>
			<script>
				$('#basvuruyuTamamla').on('click', function(event){
					swal({
						title: "Başvuruyu tamamlamak istediğine emin misin?",
						icon: "warning",
						button: {
							text: "Tamamla",
							closeModal: false,
						},
						dangerMode: true,
					}).then(swal_data => {
						if (!swal_data) throw null;

						var form_data = new FormData();
						form_data.append('hizmet_saglayici_id', <?= $hizmet_saglayici['id'] ?>);

						return $.ajax({
							url: 'API/BasvuruyuTamamla',
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
		<?php
	}
?>

<?php
if(getAktifRol() == "Destek"){
	?>
<script>
			$('#basvuruyuOnayla').on('click', function(event){
				var form_data = new FormData();
				form_data.append('hizmet_saglayici_id', '<?= $hizmet_saglayici['id'] ?>');

				$.ajax({
					url: 'API/HizmetSaglayiciOnayla',
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
}
?>
