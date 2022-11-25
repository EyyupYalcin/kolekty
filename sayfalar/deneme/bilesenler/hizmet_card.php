<style>
@keyframes moveToLeft {
    0% {
        opacity: 0;
        width: 0px;
    }

    100% {
        opacity: 1.0;
        width: calc(100% - 3rem);
    }
}

.user-circle {
    position: absolute;
    left: 10px;
    top: 10px;
    z-index: 99;
}

.user-circle:hover {
    background: rgba(0, 0, 0, 0.3);
    padding: 1px 1rem 1px 1px;
    border-radius: 0.75rem 0.75rem;
}

.user-circle:hover>.user-circle-text {
    display: inline-block;
    animation: moveToLeft 2s ease;
    animation-fill-mode: forwards;
}

.user-circle-img {
    display: inline-block;
    margin-right: 1rem;
    float: left;
}

.user-circle-text {
    text-overflow: "▮";
    white-space: nowrap;
    overflow: hidden;
    display: none;
    opacity: 0;
    width: 0px;
    pointer-events: none;
    float: left;
    line-height: calc(2rem);
}

.hizmet-title {
    position: absolute;
    left: 0px;
    bottom: 0px;
}
</style>
<?php
function hizmet_card($hizmet){
    ?>
    <a href="/Hizmet-Sağlayıcı-Ol/<?= seoURL($hizmet['hizmet_adi']) ?>/<?= $hizmet['id'] ?>">
        <div class="card shadow-lg mt-2 mb-2">
            <div class="widget-header card-widget" style="position: relative;">
                <div style="background: url('<?= $hizmet['tanitim_gorsel'] ?>'); background-size: cover; height: 200px; border-radius: .25rem .25rem 0 0; background-position: center center;" /></div>
                <?php 
                /*
                <div class="user-circle" onclick="location.href = '/Profil/<?= $egitmen['id'] ?>';">
                    <img class="user-circle-img img-circle" style="height: 2rem;" src="<?= $egitmen['profil_resmi'] ?>"
                        alt="<?= ucfirst($egitmen['isim']) . " " . ucfirst($egitmen['soyisim']) ?> Profil Fotoğrafı">
                    <div class="user-circle-text">
                        <span
                            class="text-white text-right"><?= ucfirst($egitmen['isim']) . " " . ucfirst($egitmen['soyisim']) ?>
                            </h3>
                    </div>
                </div>
                */
                ?>
                <h3 onclick="location.href = '/Hizmet-Sağlayıcı-Ol/<?= seoURL($hizmet['hizmet_adi']) ?>/<?= $hizmet['id'] ?>';" class="p-2 text-bold hizmet-title text-white bg-dark"><?= $hizmet['hizmet_adi'] ?></h3>
            </div>

            <!-- <div class="card-footer" style="padding: .75rem 1.25rem;">
                <div class="row">
                    <button type="button" class="btn btn-primary">Hizmet Seç</button>
                </div>
            </div> -->
        </div>
</a>
    <?php
}
?>