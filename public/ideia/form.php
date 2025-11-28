<?php
    // Verifica se é edição
    $isEdit = isset($ideia);
    $titulo = $isEdit ? $ideia['titulo'] : '';
    $descricao = $isEdit ? $ideia['descricao'] : '';
    $id = $isEdit ? $ideia['id'] : '';
?>

<h3><?= $isEdit ? 'Editar Ideia' : 'Nova Ideia' ?></h3>

<form action="/mvc_votacao/ideia/salvar" method="POST">
    <!-- Campo oculto para o ID (se for edição) -->
    <input type="hidden" name="id" value="<?= $id ?>">

    <label>Título:</label>
    <input type="text" name="titulo" value="<?= $titulo ?>" required>
    
    <label>Descrição:</label>
    <textarea name="descricao" rows="5" required><?= $descricao ?></textarea>
    
    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="/mvc_votacao/ideia/listar" class="btn btn-danger">Cancelar</a>
</form>