<div class="container">
    <h1>Editar anuncio</h1>
    <?php if (isset($aviso) && !empty($aviso)): ?>
        <div class="alert alert-danger" id="aviso"><center><?php echo $aviso ?></center></div>
    <?php endif; ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="titulo">Titulo</label>
            <input type="text" value="<?php echo $advert['titulo']; ?>"name="titulo" id="titulo"class="form-control"/>
        </div>
        <div class="form-group">
            <label for="valor">Valor</label>
            <input type="text" value="<?php echo $advert['valor']; ?>"name="valor" id="valor"class="form-control"/>
        </div>
        <div class="form-group">
            <label for="categoria">Categoria</label>
            <select class="form-control" name="categoria">
                <option></option>
                <?php foreach ($category as $cat): ?>
                    <option value="<?php echo $cat['id'] ?>"<?php echo ($advert['id_categoria'] == $cat['id']) ? 'selected = "selected"' : '' ?>><?php echo utf8_encode($cat['nome_cat']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="valor">Estado de conservação</label><br/>
            <input type="radio" name="estado" value="1"<?php echo ($advert['estado'] == '1') ? 'checked = "checked"' : '' ?>/> Ruim<br/>
            <input type="radio" name="estado" value="2"<?php echo ($advert['estado'] == '2') ? 'checked = "checked"' : '' ?>/> Bom<br/>
            <input type="radio" name="estado" value="3"<?php echo ($advert['estado'] == '3') ? 'checked = "checked"' : '' ?>/> Ótimo
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea class="form-control" name="descricao"><?php echo $advert['descricao']; ?></textarea>
        </div>
        <div class="form-group">
            <input type="file" name="imagem[]" id="imagem" multiple/>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Fotos do Anúncio</div>
            <div class="panel-body">
                <?php foreach ($advert['fotos'] as $adv): ?>
                    <div class="foto_item">
                        <img src="<?php echo BASE_URL ?>/assets/images/adverts/<?php echo $adv['url_imagem'] ?>"height="80"width="120" class="img-thumbnail"border="0"/><br/><br/>
                        <a href="<?php echo BASE_URL ?>/my_adverts/delete_photo/<?php echo $adv['id'] ?>" class="btn btn-default">Excluir imagem</a>
                    </div>
                <?php endforeach; ?>
            </div>  
        </div>
        <input type="submit"value="Fazer Anúncio" class="btn btn-default"/>

    </form>
</div>