<div class="container">
    <h1>Adiciona anuncio</h1>
    <?php if (isset($aviso) && !empty($aviso)): ?>
        <div class="alert alert-danger" id="aviso"><center><?php echo $aviso ?></center></div>
    <?php endif; ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="titulo">Titulo</label>
            <input type="text" name="titulo" id="titulo"class="form-control"/>
        </div>
        <div class="form-group">
            <label for="valor">Valor</label>
            <input type="text" name="valor" id="valor"class="form-control"/>
        </div>
        <div class="form-group">
            <label for="categoria">Categoria</label>
            <select class="form-control" name="categoria">
                <option></option>
                <?php foreach ($category as $cat): ?>
                    <option value="<?php echo $cat['id'] ?>"><?php echo utf8_encode($cat['nome_cat']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="valor">Estado de conservação</label><br/>
            <input type="radio" name="estado" value="1"/> Ruim<br/>
            <input type="radio" name="estado" value="2"/> Bom<br/>
            <input type="radio" name="estado" value="3"/> Ótimo
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea class="form-control" name="descricao"></textarea>
        </div>
        <div class="form-group">
            <input type="file" name="imagem[]" id="imagem" multiple/>
        </div>
        <input type="submit"value="Fazer Anúncio" class="btn btn-default"/>
    </form>
</div>