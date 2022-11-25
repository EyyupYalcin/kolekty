<?php
    $ust_id = 0;
    function getAltKategoriler($ust_id_par){
        global $hizmetler, $ust_id;
        $ust_id = $ust_id_par;
        return array_filter($hizmetler, function($v, $k) {
            global $ust_id;
            return $v['ust_id'] == "".$ust_id;
        }, ARRAY_FILTER_USE_BOTH);
    }

    function render_hizmet($hizmet){
        $alt_kategoriler = getAltKategoriler($hizmet['id']);
        if(count($alt_kategoriler) != 0){
            ?>
                <optgroup label="<?= $hizmet['hizmet_adi'] ?>" data-max-options="2">
                    <?php 
                        foreach ($alt_kategoriler as $key => $hizmet) {
                            render_hizmet($hizmet);
                        }
                    ?>
                </optgroup>
            <?php
        }else{
            ?>
                <option value="<?= $hizmet['id'] ?>"><?= $hizmet['hizmet_adi'] ?></option>
            <?php
        }
    }
    
    function hizmetler_select($select_id){
        ?>
        <select id="<?= $select_id ?>" class="form-control">
            <?php
                $temel_hizmetler = getAltKategoriler(0);
                foreach ($temel_hizmetler as $key => $hizmet) {
                   render_hizmet($hizmet);
                }
            ?>
        </select>
        <?php
    }
?>