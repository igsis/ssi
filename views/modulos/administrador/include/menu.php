<li class="nav-item">
    <a href="<?= SERVERURL ?>administrador" class="nav-link">
        <i class="nav-icon fas fa-home"></i>
        <p>
            Início
        </p>
    </a>
</li>
<li class="nav-item has-treeview menu-open">
    <a href="#" class="nav-link active">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Acesso Administrativo
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?= SERVERURL ?>administrador/administrador_lista" class="nav-link" id="administrador_lista">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                    Gerenciar Administradores
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= SERVERURL ?>administrador/funcionarios" class="nav-link" id="funcionarios">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                    Gerenciar Funcionarios
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= SERVERURL ?>administrador/instituicao_lista" class="nav-link" id="instituicao_lista">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                    Gerenciar Instituições
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= SERVERURL ?>administrador/local_lista" class="nav-link" id="local_lista">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                    Gerenciar Locais
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= SERVERURL ?>administrador/categoria_lista" class="nav-link" id="categoria_lista">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                    Gerenciar Categorias
                </p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a href="<?= SERVERURL ?>administrador/chamado_cadastro" class="nav-link">
        <i class="fas fa-plus nav-icon"></i>
        <p>
            Novo chamado
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="<?= SERVERURL ?>administrador/chamado_lista" class="nav-link">
        <i class="fas fa-list-ol nav-icon"></i>
        <p>
            Lista chamados
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="<?= SERVERURL ?>administrador/chamado_busca" class="nav-link">
        <i class="fas fa-search nav-icon"></i>
        <p>
            Busca chamados
        </p>
    </a>
</li>