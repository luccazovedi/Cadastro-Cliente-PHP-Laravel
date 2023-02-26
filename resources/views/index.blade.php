<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Cadastro de Clientes</title>
</head>
<body>
    <h1>Cadastro de Clientes</h1>
    <form>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome"><br><br>

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf"><br><br>

        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento"/><br><br>
        <label for="sexo">Sexo:</label>
        <select id="sexo" name="sexo">
            <option value="Masculino">Masculino</option>
            <option value="Feminino">Feminino</option>
            <option value="Outro">Outro</option>
        </select><br><br>

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco"><br><br>

        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado"><br><br>

        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade"><br><br>

        <button type="button" onclick="cadastrarCliente()">Cadastrar</button>
    </form>

<hr>

<h2>Lista de Clientes</h2>
<ul id="lista-clientes"></ul>

<script>
      // Função que cadastra um novo cliente
    function cadastrarCliente() {
        let nome = document.getElementById('nome').value;
        let cpf = document.getElementById('cpf').value;
        let data_nascimento = document.getElementById('data_nascimento').value;
        let sexo = document.getElementById('sexo').value;
        let endereco = document.getElementById('endereco').value;
        let estado = document.getElementById('estado').value;
        let cidade = document.getElementById('cidade').value;

        let cliente = {
            nome: nome,
            cpf: cpf,
            data_nascimento: data_nascimento,
            sexo: sexo,
            endereco: endereco,
            estado: estado,
            cidade: cidade
        };

        fetch('/clientes', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(cliente)
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            listarClientes();
        })
        .catch(error => console.error(error));
    }

    // Função que lista todos os clientes cadastrados
    function listarClientes() {
        fetch('/api/clientes')
        .then(response => response.json())
        .then(data => {
            let listaClientes = document.getElementById('lista-clientes');
            listaClientes.innerHTML = '';

            data.forEach(cliente => {
                let li = document.createElement('li');
                li.appendChild(document.createTextNode(cliente.nome));
                listaClientes.appendChild(li);
            });
        })
        .then(data => console.log(data))
        .catch(error => console.error(error));
    }

    listarClientes();
</script>
</body>
</html>
