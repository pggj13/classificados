<div class="container" id="my_advert">
    <h1>Meus Anúncios</h1>
    <a href="<?php echo BASE_URL ?>/my_adverts/add_adverts" class="btn btn-default">Adicionar Anúncios</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Fotos</th>
                <th>Titulo</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($advert as $advs): ?>
                <tr>
                    <?php if (!empty($advs['imagem'])) { ?>
                        <td><img src="/assets/images/adverts/<?php echo $advs['imagem'] ?>" border="0" height="70"width="70"</td>
                    <?php } else { ?>
                        <td><img src="/assets/images/default.jpg" border="0" height="70"width="70"</td>
                    <?php }
                    ?>                    
                    <td><a href="<?php echo BASE_URL ?>/my_adverts/products/<?php echo $advs['id']; ?>"><?php echo utf8_encode($advs['titulo']); ?></a></td>
                    <td><?php echo 'R$ ' . number_format($advs['valor'], 2); ?></td>
                    <td>
                        <button class="btn btn-danger"data-target="#mymodal" onclick="delete_advert()">Excluir</button>
                        <a href="<?php BASE_URL ?>/my_adverts/update/<?php echo $advs['id'] ?>" class="btn btn-danger">Editar</a></td>
                </tr>
            <?php endforeach; ?>
        </thead>
    </table>

</div>
<!--
Este é a modal para verificar se o usuario 
deseja mesmo excluir um anúncio
-->
<div class="fundo"></div>
<div class="delete_advert"style="display: none" id="modal_delete">
    <center>
        <strong>Deseja excluir o Anúncio?</strong><br/><br/>
        <a href="<?php BASE_URL ?>/my_adverts/delete/<?php echo $advs['id'] ?>" class="btn btn-danger">Excluir</a>
        <a href="<?php BASE_URL ?>/my_adverts" class="btn btn-danger">Cancelar</a>
    </center> 
</div>