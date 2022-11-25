<?php
function nicelikGetir($parametreler){ //$tabloAdi, $kosullar, $kosulDegiskenleri
    GLOBAL $db;
    $sorgu_dizgesi = "
        SELECT 
            count(*) as sayi
        FROM " . $parametreler['tabloAdi'] . "
        WHERE " . $parametreler['kosullar'];
    $sorgu = $db->prepare($sorgu_dizgesi);
    $sorgu->execute($parametreler['kosulDegiskenleri']);
    $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    $sonuc = count($sonuc) != 0 ? $sonuc[0] : false;
    return $sonuc['sayi'];
}

function nicelikGosterge($secenekler)
{
    ?>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon <?= $secenekler['renkSinifAdi'] ?>"><i class="<?= $secenekler['iconSinifAdi'] ?>"></i></span>

            <div class="info-box-content">
                <span class="info-box-text"><?= $secenekler['nicelikAdi'] ?></span>
                <span class="info-box-number"><?= $secenekler['nicelikDegeri'] ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
<?php
}