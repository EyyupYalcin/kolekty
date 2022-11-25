<?php
    function form_single_select_db($parametreler){
        ?>
            <select id="<?= $parametreler['id'] ?>" class="form-control selectpicker" onchange="<?= $parametreler['onchange'] ?>">
                <option value="0"><?= $parametreler['varsayilan'] ?></option>
                <?php
                    GLOBAL $db;
                    $sorgu_dizgesi = "SELECT * FROM " . $parametreler['veritabani']['tablo'] . " " . $parametreler['veritabani']['rawWhere'];
                    $sorgu = $db->prepare($sorgu_dizgesi);
                    $sorgu->execute();
                    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);

                    foreach($sonuclar as $sonuc){
                        {
                            if($parametreler['deger'] == $sonuc[$parametreler['veritabani']['value_kolon']]){
                                ?>
                                    <option value="<?= $sonuc[$parametreler['veritabani']['value_kolon']] ?>" selected><?= $sonuc[$parametreler['veritabani']['text_kolon']] ?></option>
                                <?php
                            }else{
                                ?>
                                    <option value="<?= $sonuc[$parametreler['veritabani']['value_kolon']] ?>"><?= $sonuc[$parametreler['veritabani']['text_kolon']] ?></option>
                                <?php
                            }
                        }
                    }
                ?>
            </select>
        <?php
    }