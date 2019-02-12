<?php
session_start();

spl_autoload_register(function($class) {
    include 'classes/' . $class . '.php';
});

Usuarios::verificarLogin();

?>

<?php include 'header.php'; ?>
    <body>
        
        <?php
        
        $os = new OS();
        $clientes = new Clientes();
        $tec = new Tecnicos();
        
        $idCli = filter_input(INPUT_POST, 'nome');
        $situacao = filter_input(INPUT_POST, 'situacao');
        $equip = filter_input(INPUT_POST, 'equip');
        $defeito = filter_input(INPUT_POST, 'defeito');
        $tecnico = filter_input(INPUT_POST, 'tecnico');
        
        if (isset($_POST['cadastrar'])) {
            $os->setIdCli($idCli);
            $os->setSituacao($situacao);
            $os->setEquip($equip);
            $os->setDefeito($defeito);
            $os->setTecnico($tecnico);
            
            if ($os->insert()) {
                header('location: os.php');
            }
        }
        
        ?>
        
        <?php include 'menu.php'; ?>

        <section class="container">

            <h1 class="center">Nova Ordem de Serviço</h1>
            <form class="form" method="post">

                <label>Nome do cliente</label>
                <select name="nome" class="input-text">
                    <option selected disabled>--Selecione o nome do cliente--</option>
                    <?php foreach ($clientes->findAll() as $res): ?>
                        <option value="<?= $res->id; ?>"><?= $res->nome; ?></option>
                    <?php endforeach; ?>
                </select>

                <input type="hidden" name="situacao" value="Aguardando diagnóstico" class="input-text" required>

                <label for="equip">Equipamento</label>
                <input type="text" id="equip" name="equip" class="input-text" required>

                <label for="defeito">Defeito</label>
                <input type="text" id="defeito" name="defeito" class="input-text" required>

                <label>Técnico</label>
                <select name="tecnico" class="input-text">
                    <option selected disabled>--Selecione o técnico--</option>
                    <?php foreach ($tec->findAll() as $res): ?>
                        <option value="<?= $res->id; ?>"><?= $res->nome; ?></option>
                    <?php endforeach; ?>
                </select>

                <!--<label for="valor">Valor(R$)</label>
                <input type="text" id="valor" name="valor" class="input-text">-->

                <input type="submit" name="cadastrar" value="Cadastrar OS" class="btn-4">

            </form>

        </section>
    </body>
</html>