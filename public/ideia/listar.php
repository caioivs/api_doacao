<div style="display: flex; justify-content: space-between; align-items: center;">
    <h3>Ideias da Comunidade</h3>
    <!-- Botão Criar só aparece se logado -->
    <?php if(isset($_SESSION['usuario_id'])): ?>
        <a href="/mvc_votacao/ideia/formulario" class="btn btn-primary">+ Nova Ideia</a>
    <?php endif; ?>
</div>

<table>
    <thead>
        <tr>
            <th>Votos</th>
            <th>Título</th>
            <th>Descrição</th>
            <th>Autor</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if(isset($lista) && !empty($lista)) { foreach($lista as $ideia) { ?>
        <tr>
            <td style="text-align: center; font-weight: bold; font-size: 18px;">
                <?= $ideia['total_votos'] ?>
            </td>
            <td><?= htmlspecialchars($ideia['titulo']) ?></td>
            <td><?= htmlspecialchars($ideia['descricao']) ?></td>
            <td style="font-size: 12px; color: #666;"><?= htmlspecialchars($ideia['autor']) ?></td>
            <td>
                <?php if(isset($_SESSION['usuario_id'])): ?>
                    <!-- Botão Votar -->
                    <a href="/mvc_votacao/ideia/votar?id=<?= $ideia['id'] ?>" class="btn btn-success" style="font-size: 10px;">Votar</a>
                    
                    <!-- Editar/Excluir (Poderia verificar se é o autor, mas vou deixar liberado conforme pedido simples) -->
                    <a href="/mvc_votacao/ideia/formulario?id=<?= $ideia['id'] ?>" class="btn btn-warning" style="font-size: 10px;">Editar</a>
                    <a href="/mvc_votacao/ideia/excluir?id=<?= $ideia['id'] ?>" class="btn btn-danger" style="font-size: 10px;" onclick="return confirm('Tem certeza?');">Excluir</a>
                <?php else: ?>
                    <span style="font-size: 10px; color: #999;">Faça login para interagir</span>
                <?php endif; ?>
            </td>
        </tr>
        <?php }} else { echo "<tr><td colspan='5'>Nenhuma ideia encontrada.</td></tr>"; } ?>
    </tbody>
</table>