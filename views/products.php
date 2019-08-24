<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3"> 
            <div class="carousel slide" data-ride="carousel" id="meuCarousel">
                <div class="carousel-inner" role="listbox">
                    <?php foreach ($advert['fotos'] as $chave => $foto): ?>
                        <div class="item <?php echo($chave == '0') ? 'active' : '' ?>">
                            <img src="<?php echo BASE_URL ?>/assets/images/adverts/<?php echo $foto['url_imagem'] ?>"/>
                        </div>
                    <?php endforeach;?>
                </div>
                <a class="left carousel-control"href="#meuCarousel" role="button"data-slide="prev"><span><</span></a>
                <a class="right carousel-control"href="#meuCarousel" role="button"data-slide="next"><span>></span></a>
            </div>
        </div>
        <div class="col-sm-7">
            <h1><?php echo $advert['titulo'];?></h1>
            <h4><?php echo utf8_encode($advert['categoria']);?></h4>
            <p><?php echo $advert['descricao'];?></p><br/>
            <h3><?php echo'R$ '. $advert['valor'];?></h3>
            <h4>Telefone: <?php echo $advert['telefone'];?></h4>
        </div>
    </div>
</div>