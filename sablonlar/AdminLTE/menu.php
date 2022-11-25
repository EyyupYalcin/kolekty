<?php
function menu($menu){
    foreach($menu as $item){
        if(isset($item['AltMenu'])){
            ?>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon <?= $item['icon'] ?>"></i>
                        <p>
                            <?= $item['Adı'] ?>
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php menu($item['AltMenu']); ?>
                    </ul>
                </li>
            <?php
        }else{
            ?>
                <li class="nav-item">
                    <a href="<?= $item['link'] ?>" class="nav-link">
                        <i class="<?= $item['icon'] ?> nav-icon"></i>
                        <p><?= $item['Adı'] ?></p>
                    </a>
                </li>
            <?php
        }
    }
}