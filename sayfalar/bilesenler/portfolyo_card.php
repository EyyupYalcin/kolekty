<?php include_once bilesen('basil_icon') ?>
<style>
  .portfolyo_card img {
    height: 200px;
    width: auto;
    border-radius: .75rem;
  }
  .portfolyo_card .fa-edit {
    position: absolute;
    top: 0;
    right: 0;
    background: #3f3f3f;
    color: white;
    padding: .4rem;
    border-radius: 0 .75rem 0 .75rem;
  }
</style>

<?php 
function portfolyo_card($params, $kendi_portfolyom){
  ?>
    <div class="portfolyo_card mr-2 position-relative">
      <a class="glightbox" data-portfolyo-id="<?= $params['id'] ?>" data-glightbox="title: <?= htmlspecialchars($params['adi']) ?>; description: <?= htmlspecialchars(preg_replace('~[\r\n]+~',' ',$params['aciklama'])) ?>; descPosition: right; type: image" href="<?= htmlspecialchars($params['resim']) ?>" >
        <img alt="<?= htmlspecialchars($params['adi']) ?>" src="<?= htmlspecialchars($params['resim']) ?>" />
      </a>
      
      <?php if($kendi_portfolyom){
        ?>
          <i id="portfolyo_duzenle_<?= $params['id'] ?>" class="portfolyo_duzenle fa fa-edit icon-lg"></i>
        <?php
      }?>
    </div>
  <?php
}
?>

<script>
  $(document).ready(function(){

  })
</script>