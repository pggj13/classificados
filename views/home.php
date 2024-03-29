<div class="jumbotron">
    <h2>Nós temos Hoje <?php echo ($count_adverts < 1) ? "$count_adverts anuncio" : "$count_adverts anuncios" ?></h2>
    <p>E mais de <?php echo $count_user; ?> usúarios cadastrados</p>
</div>
<div class="row">
    <div class="col-sm-3">
        <h4>Pesquisa Avançada</h4>
        <form method="GET">
            <div class="form-group">
                <label for="categoria">Categorias:</label>
                <select id="categoria" name="filtros[categorias]" class="form-control">
                    <option></option>
                    <?php foreach ($category as $cat): ?>
                        <option value="<?php echo $cat['id']; ?>"<?php echo($cat['id'] == $filtros['categorias']) ? 'selected = "selected"' : '' ?>><?php echo utf8_encode($cat['nome_cat']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="precos">Preço:</label>
                <select id="preco" name="filtros[preco]" class="form-control">
                    <option></option>
                    <option value="0-50"<?php echo($filtros['preco'] == '0-50') ? 'selected = "selected"' : '' ?>>R$ 0 - 50</option>
                    <option value="51-100"<?php echo($filtros['preco'] == '51-100') ? 'selected = "selected"' : '' ?> >R$ 51 - 100</option>
                    <option value="101-200"<?php echo($filtros['preco'] == '101-200') ? 'selected = "selected"' : '' ?>>R$ 101 - 200</option>
                    <option value="201-500"<?php echo($filtros['preco'] == '201-500') ? 'selected = "selected"' : '' ?>>R$ 201 - 500</option>
                </select>
            </div>
            <div class="form-group">
                <label for="conservacao">Estado de Conservação:</label>
                <select id="preco" name="filtros[estado]" class="form-control">
                    <option></option>
                    <option value="1"<?php echo($filtros['estado'] == '1') ? 'selected = "selected"' : '' ?>>Ruim</option>
                    <option value="2"<?php echo($filtros['estado'] == '2') ? 'selected = "selected"' : '' ?>>Bom</option>
                    <option value="3"<?php echo($filtros['estado'] == '3') ? 'selected = "selected"' : '' ?>>Ótimo</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-info" value="Buscar"/>
            </div>
        </form>
    </div>
    <div class="col-sm-9">
        <h4>Últimos Anúncios</h4>
        <table class="table table-striped">
            <tbody>
                <?php foreach ($get_last_adverts as $advs): ?>
                    <tr>
                        <?php if (!empty($advs['url'])) { ?>
                            <td><img src="/assets/images/adverts/<?php echo $advs['url'] ?>" border="0" height="60"width="60"</td>
                        <?php } else { ?>
                            <td><img src="/assets/images/default.jpg" border="0" height="60"width="60"</td>
                        <?php }
                        ?>
                        <td><a href="<?php echo BASE_URL ?>/my_adverts/products/<?php echo $advs['id']; ?>"><?php echo utf8_encode($advs['titulo']); ?></a></td>
                        <td><?php echo 'R$ ' . number_format($advs['valor'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <ul class="pagination">
            <?php for ($q = 1; $q <= $total_adverts; $q++): ?>
                <li class="<?php echo($p == $q) ? 'active' : '' ?>"><a href="index.php?<?php
                    $w = $_GET;
                    $w['p'] = $q;
                    echo http_build_query($w);
                    ?>"><?php echo $q ?></a></li>
                <?php endfor; ?>
        </ul>
    </div>
</div>
