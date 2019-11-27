<?php 
require_once('../header.php');
require_once('../post/Crude.php');

$db = new Crude();

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

?>
        <main class="addpost-main container">
            <section class="addpost-content">
                <div class="form">
                    <div class="account">
                        <div class="title">
                            <h2>Listagem <a href="<?php echo DIRPAGE; ?>conta/inserir.php" style="color: #6495ED"> <i class="fas fa-plus-circle"></i></a></h2>
                        </div>
                        <table>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Categoria</th>
                                <th>Editar</th>
                                <th>Remover</th>
                            </tr>
                                <?php foreach($db->selectArticles() as $postagem): ?>
                            <tr>
                                <td class="img-table"><img src="<?php echo $postagem->imagem_destaque; ?>" width="250"></td>
                                <td><?php echo $postagem->id_postagem; ?></td>
                                <td><?php echo $postagem->titulo; ?></td>
                                <td>
                                    <?php foreach ($db->selectCategory($postagem->id_postagem) as $category): ?>
                                        <a href="#"><?php echo $category->nomeCategoria; ?></a><br>
                                    <?php endforeach;?>
                                </td>
                                <td><a href="<?php echo DIRPAGE;?>conta/edit.php?slug=<?php echo $postagem->slug; ?>"><i class="fas fa-edit"></i></a></td>
                                <td><a href="<?php echo DIRPAGE;?>conta/delete.php?id_postagem=<?php echo $postagem->id_postagem; ?>"><i class="fas fa-trash-alt"></i></a></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </section>
        </main>
    <?php require_once('../footer.php'); ?>