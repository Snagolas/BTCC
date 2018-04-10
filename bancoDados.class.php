<?php
    class bancoDadosBTCC
    {
        private $usuario;
        private $senha;
        private $banco;
        private $host;

        //////////////////////////////////////////////// METODO CONSTRUTOR ////////////////////////////////////////////////
        public function __construct($usu, $senha, $host, $banco)
        {   
            $this->setUsuario($usu);
            $this->setSenha($senha);
            $this->setHost($host);
                $this->setBanco($banco);
        }
 
        //////////////////////////////////////////////// METODOS DO BANCO ////////////////////////////////////////////////

        //////////////////////////////////////////////// METODO DE CONEXAO COM O BANCO ///////////////////////////////////
        public function conectarBancoDados(){
            $conexao = mysqli_connect($this->getHost(), $this->getUsuario(), $this->getSenha())
            or die ("ERRO CONEXAO");
            if($conexao){
                mysqli_select_db($conexao, $this->getBanco())
                or die ("ERRO SELECT DATABASE");
                //echo "BANCO SELECIONADO COM SUCESSO";                            
            }            
            return $conexao;
        }

        //////////////////////////////////////////////// METODO PARA FECHAR CONEXAO ////////////////////////////////////////////////
        public function fecharConexao($conexao)
        {
            $closeCon = mysqli_close($conexao);            
        }

        //////////////////////////////////////////////// METODO PARA VERIFICAR LOGIN ////////////////////////////////////////////////
        public function realizarLogin($login, $senha){
            $conexao = $this->conectarBancoDados();
            $comandoSQL = "SELECT * FROM TB_LOGIN WHERE LG_LOGIN = '$login' AND LG_SENHA = '$senha'";
            //echo $comandoSQL;
            $result = mysqli_query($conexao, $comandoSQL);
            $linha = "";

            if(mysqli_num_rows($result) > 0)
            {                                
                while ($resultado = $result->fetch_array(MYSQLI_ASSOC))
                {   
                    $senha =  $resultado['LG_SENHA'];
                    $usuario = $resultado['LG_LOGIN'];
                    $codusu = $resultado['COD_USUARIO'];
                    $tipousu = $resultado['COD_CLASSIFICACAO'];                    

                    $linha = $usuario."*".$senha."*".$codusu."*".$tipousu;                                    
                }
                return $linha;            
            }
            else{
                return "0";
            }

            $closeCon = $this->fecharConexao($conexao);            
        }

        //////////////////////////////////////// METODO PARA BUSCAR AS RESERVAS NO BANCO ////////////////////////////////////////////               
        public function buscaReservas(){
                    
                $comandoSQL = "SELECT A.TCC_TITULO, A.TCC_CODIGO, B.USU_RM FROM tb_tcc A INNER JOIN tb_usuario B INNER JOIN tb_reservas C ON C.COD_USUARIO = B.ID_USUARIO AND C.COD_TCC = A.ID_TCC";                                                   
                $conexao = $this->conectarBancoDados();           
                //echo $comandoSQL;
                $result = mysqli_query($conexao, $comandoSQL);                            
                if(mysqli_num_rows($result) > 0)
                {                                      
                    while($buscar = $result->fetch_assoc()) {                    
                        echo "<tr>";
                        foreach ($buscar as $field => $value) {
                            echo '<td>'.$value.'</td>';
                        }
                        echo "</tr>";
                    }                        
                }
                else{
                    echo "<tr>";                    
                        echo '<td> SEM RESULTADOS </td>';                
                    echo "</tr>";
                }

                $closeCon = $this->fecharConexao($conexao);                                        
                        
        }

        /////////////////////////////////////////// METODO PARA BUSCAR AS RESERVAS NO BANCO /////////////////////////////////////////////
        public function buscaDevolucao(){

                date_default_timezone_set('America/Sao_Paulo');

                $comandoSQL = "SELECT A.TCC_TITULO, A.TCC_CODIGO, B.USU_RM FROM tb_tcc A INNER JOIN tb_usuario B INNER JOIN tb_devolucao C ON C.COD_USUARIO = B.ID_USUARIO AND C.COD_TCC = A.ID_TCC WHERE C.DATA_DEVOLUCAO = '".date("d/m")."'";                                        
                $conexao = $this->conectarBancoDados();           
                //echo $comandoSQL;
                $result = mysqli_query($conexao, $comandoSQL);                            
                if(mysqli_num_rows($result) > 0)
                {                                      
                    while($buscar = $result->fetch_assoc()) {                    
                        echo "<tr>";
                        foreach ($buscar as $field => $value) {
                            echo '<td>'.$value.'</td>';
                        }
                        echo "</tr>";
                    }                        
                }
                else{
                    echo "<tr>";                    
                        echo '<td> SEM RESULTADOS </td>';                
                    echo "</tr>";
                }

                $closeCon = $this->fecharConexao($conexao);                                        
                        
        }        

        /////////////////////// METODO PARA EXIBIR O RESULTADO DA PESQUISA DO ADMIN NO BANCO ///////////////////////////////////////////
        public function buscaResultadoAdmin($tipo, $campo){

                $usuario = "<table class='w3-table-all'>
                            <thead>
                              <tr class='w3-red'>
                                <th>Primeiro Nome</th>
                                <th>Ultimo Nome</th>
                                <th>CPF</th>
                                <th>RM</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Curso</th>
                                <th>Modulo</th>
                                <th>Periodo</th>
                                <th>Tipo</th>
                                <th>Modificar</th>
                              </tr>
                            </thead>";

                $tcc = "<table class='w3-table-all'>
                            <thead>
                              <tr class='w3-red'>
                                <th>Titulo</th>
                                <th>Código</th>
                                <th>Coleção</th>
                                <th>Condição</th>
                                <th>Autor</th>
                                <th>Disponibilidade</th>                               
                                <th>Modificar</th>
                              </tr>
                            </thead>";

                $reserva = "<table class='w3-table-all'>
                            <thead>
                              <tr class='w3-red'>
                                <th>Titulo</th>
                                <th>Código</th>
                                <th>Usuario</th>
                                <th>RM</th>                                
                              </tr>
                            </thead>";

                $devolucao = "<table class='w3-table-all'>
                            <thead>
                              <tr class='w3-red'>
                                <th>Titulo</th>
                                <th>Código</th>
                                <th>Usuario</th>
                                <th>RM</th>  
                                <th>Data de Entrega</th>                                
                              </tr>
                            </thead>";

                $sugestao = "<table class='w3-table-all'>
                            <thead>
                              <tr class='w3-red'>
                                <th>Curso</th>
                                <th>Sugestão</th>
                                <th>Modificar</th>                                                            
                              </tr>
                            </thead>";

                switch ($tipo) {
                    case '1':
                        echo $usuario;                        
                        $comandoSQL = "SELECT A.USU_FIRSTNAME, A.USU_LASTNAME, A.USU_CPF, A.USU_RM, A.USU_EMAIL, A.USU_TELEFONE, B.CRS_NOME, A.USU_MODULO, A.USU_PERIODO, C.CLSS_TIPO, A.ID_USUARIO FROM tb_usuario A INNER JOIN tb_curso B INNER JOIN tb_classificacao C ON A.COD_CURSO = B.ID_CURSO AND A.COD_CLASSIFICACAO = C.ID_CLASSIFICACAO WHERE A.USU_RM LIKE '%$campo%' ORDER BY A.ID_USUARIO DESC";  
                        break;

                    case '2':
                        echo $usuario;                        
                        $comandoSQL = "SELECT A.USU_FIRSTNAME, A.USU_LASTNAME, A.USU_CPF, A.USU_RM, A.USU_EMAIL, A.USU_TELEFONE, B.CRS_NOME, A.USU_MODULO, A.USU_PERIODO, C.CLSS_TIPO, A.ID_USUARIO FROM tb_usuario A INNER JOIN tb_curso B INNER JOIN tb_classificacao C ON A.COD_CURSO = B.ID_CURSO AND A.COD_CLASSIFICACAO = C.ID_CLASSIFICACAO WHERE A.USU_CPF LIKE '%$campo%' ORDER BY A.ID_USUARIO DESC";  
                        break;

                    case '3':
                        echo $usuario;                        
                        $comandoSQL = "SELECT A.USU_FIRSTNAME, A.USU_LASTNAME, A.USU_CPF, A.USU_RM, A.USU_EMAIL, A.USU_TELEFONE, B.CRS_NOME, A.USU_MODULO, A.USU_PERIODO, C.CLSS_TIPO, A.ID_USUARIO FROM tb_usuario A INNER JOIN tb_curso B INNER JOIN tb_classificacao C ON A.COD_CURSO = B.ID_CURSO AND A.COD_CLASSIFICACAO = C.ID_CLASSIFICACAO WHERE A.USU_FIRSTNAME LIKE '%$campo%' ORDER BY A.ID_USUARIO DESC";  
                        break;

                    case '4':
                        echo $usuario;                        
                        $comandoSQL = "SELECT A.USU_FIRSTNAME, A.USU_LASTNAME, A.USU_CPF, A.USU_RM, A.USU_EMAIL, A.USU_TELEFONE, B.CRS_NOME, A.USU_MODULO, A.USU_PERIODO, C.CLSS_TIPO, A.ID_USUARIO FROM tb_usuario A INNER JOIN tb_curso B INNER JOIN tb_classificacao C ON A.COD_CURSO = B.ID_CURSO AND A.COD_CLASSIFICACAO = C.ID_CLASSIFICACAO WHERE A.USU_LASTNAME LIKE '%$campo%' ORDER BY A.ID_USUARIO DESC";  
                        break;

                     case '5':
                        echo $tcc;                        
                        $comandoSQL = "SELECT A.TCC_TITULO, A.TCC_CODIGO, B.CLC_NOME, A.TCC_CONDICAO, C.USU_FIRSTNAME, A.TCC_DISPONIBILIDADE, A.ID_TCC FROM tb_tcc A INNER JOIN tb_colecao B INNER JOIN tb_usuario C ON A.COD_COLECAO = B.ID_COLECAO AND A.COD_USUARIO = C.ID_USUARIO WHERE A.TCC_CODIGO LIKE '%$campo%' ORDER BY A.ID_TCC DESC";  
                        break;

                    case '6':
                        echo $tcc;                        
                        $comandoSQL = "SELECT A.TCC_TITULO, A.TCC_CODIGO, B.CLC_NOME, A.TCC_CONDICAO, C.USU_FIRSTNAME, A.TCC_DISPONIBILIDADE, A.ID_TCC FROM tb_tcc A INNER JOIN tb_colecao B INNER JOIN tb_usuario C ON A.COD_COLECAO = B.ID_COLECAO AND A.COD_USUARIO = C.ID_USUARIO WHERE A.TCC_TITULO LIKE '%$campo%' ORDER BY A.ID_TCC DESC";  
                        break;

                    case '7':
                        echo $tcc;                        
                        $comandoSQL = "SELECT A.TCC_TITULO, A.TCC_CODIGO, B.CLC_NOME, A.TCC_CONDICAO, C.USU_FIRSTNAME, A.TCC_DISPONIBILIDADE, A.ID_TCC FROM tb_tcc A INNER JOIN tb_colecao B INNER JOIN tb_usuario C ON A.COD_COLECAO = B.ID_COLECAO AND A.COD_USUARIO = C.ID_USUARIO WHERE B.CLC_NOME LIKE '%$campo%' ORDER BY A.ID_TCC DESC";  
                        break;

                    case '8':
                        echo $reserva;                        
                        $comandoSQL = "SELECT A.TCC_TITULO, A.TCC_CODIGO, B.USU_FIRSTNAME, B.USU_RM FROM tb_tcc A INNER JOIN tb_usuario B INNER JOIN tb_reservas C ON C.COD_TCC = A.ID_TCC AND C.COD_USUARIO = B.ID_USUARIO ORDER BY C.ID_RESERVA DESC";  
                        break;

                    case '9':
                        echo $devolucao;                        
                        $comandoSQL = "SELECT A.TCC_TITULO, A.TCC_CODIGO, B.USU_FIRSTNAME, B.USU_RM, C.DATA_DEVOLUCAO FROM tb_tcc A INNER JOIN tb_usuario B INNER JOIN tb_devolucao C ON C.COD_TCC = A.ID_TCC AND C.COD_USUARIO = B.ID_USUARIO ORDER BY C.ID_DEVOLUCAO DESC";  
                        break;

                    case '10':
                        echo $usuario;                        
                        $comandoSQL = "SELECT A.USU_FIRSTNAME, A.USU_LASTNAME, A.USU_CPF, A.USU_RM, A.USU_EMAIL, A.USU_TELEFONE, B.CRS_NOME, A.USU_MODULO, A.USU_PERIODO, C.CLSS_TIPO, A.ID_USUARIO FROM tb_usuario A INNER JOIN tb_curso B INNER JOIN tb_classificacao C ON A.COD_CURSO = B.ID_CURSO AND A.COD_CLASSIFICACAO = C.ID_CLASSIFICACAO ORDER BY A.ID_USUARIO DESC";
                        break;

                    case '11':
                        echo $tcc;                        
                        $comandoSQL = "SELECT A.TCC_TITULO, A.TCC_CODIGO, B.CLC_NOME, A.TCC_CONDICAO, C.USU_FIRSTNAME, A.TCC_DISPONIBILIDADE, A.ID_TCC FROM tb_tcc A INNER JOIN tb_colecao B INNER JOIN tb_usuario C ON A.COD_COLECAO = B.ID_COLECAO AND A.COD_USUARIO = C.ID_USUARIO ORDER BY A.ID_TCC DESC";
                        break;

                    case '12':
                        echo $sugestao;                        
                        $comandoSQL = "SELECT A.CRS_NOME, B.SG_SUGESTAO, B.ID_SUGESTOES FROM TB_SUGESTOES B INNER JOIN TB_CURSO A ON B.COD_CURSOS = A.ID_CURSO ORDER BY B.ID_SUGESTOES DESC";
                        break;
                    
                    default:
                        echo $usuario;                        
                        $comandoSQL = "SELECT A.USU_FIRSTNAME, A.USU_LASTNAME, A.USU_CPF, A.USU_RM, A.USU_EMAIL, A.USU_TELEFONE, B.CRS_NOME, A.USU_MODULO, A.USU_PERIODO, C.CLSS_TIPO, A.ID_USUARIO FROM tb_usuario A INNER JOIN tb_curso B INNER JOIN tb_classificacao C ON A.COD_CURSO = B.ID_CURSO AND A.COD_CLASSIFICACAO = C.ID_CLASSIFICACAO ORDER BY A.ID_USUARIO DESC";
                        break;
                }

                                                      
                $conexao = $this->conectarBancoDados();           
                //echo $comandoSQL;
                $result = mysqli_query($conexao, $comandoSQL);                            
                if(mysqli_num_rows($result) > 0)
                {                                      
                    while($buscar = $result->fetch_assoc()) {                    
                        echo "<tr>";
                        foreach ($buscar as $field => $value) {
                            if($field == "TCC_DISPONIBILIDADE"){
                                if($value == "1"){
                                    $value = "DISPONIVEL";
                                }else{
                                    $value = "INDISPONIVEL (!)";
                                }
                            }
                            $value = utf8_encode($value);
                            if($field == "ID_USUARIO"){
                                echo "<td style='font-size: 12px;'><a href='../editarUsu.php?id=".$value."&edit=0' target='_blank'>Editar</a></td>";    
                            }else{
                                if($field == "ID_TCC"){
                                   echo "<td style='font-size: 12px;'><a href='../editarTCC.php?id=".$value."&edit=0' target='_blank'>Editar</a></td>";    
                                }else{
                                    if($field == "ID_SUGESTOES"){
                                        echo "<td style='font-size: 12px;'><a href='../editarSug.php?id=".$value."&edit=0' target='_blank'>Editar</a></td>";
                                    }else{
                                        echo "<td style='font-size: 12px;'>".$value."</td>";
                                    }                                    
                                }                                          
                            }                            
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                else{
                    echo "<tr>";                    
                        echo '<td> SEM RESULTADOS </td>';                
                    echo "</tr>";
                }

                $closeCon = $this->fecharConexao($conexao);                                        
                        
        }

        ////////////////////////// METODO PARA EXIBIR OS SELECTS DE ACORDO COM O BANCO /////////////////////////////////// 
        public function buscaSelect($tipo){
            $conexao = $this->conectarBancoDados();
            
            switch ($tipo) {
                case '1':
                    $comandoSQL = "SELECT * FROM tb_colecao";
                    break;

                case '2':
                    $comandoSQL = "SELECT * FROM tb_classificacao";
                    break;

                case '3':
                    $comandoSQL = "SELECT * FROM tb_curso";
                    break;

                case '4':
                    $comandoSQL = "SELECT ID_USUARIO, USU_FIRSTNAME FROM tb_usuario ORDER BY ID_USUARIO DESC";
                    break;                                          
            }

            $result = mysqli_query($conexao, $comandoSQL);

            if(mysqli_num_rows($result) > 0)
            {                                
                while ($resultado = $result->fetch_array(MYSQLI_NUM))
                {                       
                    echo "<option value='".$resultado[0]."'>".utf8_encode($resultado[1])."</option>";                                                                                    
                }                            
            }
            else{
                echo "<option disabled>ERRO</option>";
            }

            $closeCon = $this->fecharConexao($conexao);            
        }

        ///////////////////////// METODO PARA RETORNAR OS TCCS DO BANCO PARA VISUALIZAÇÃO DO USUARIO///////////////////////////
        public function exibirTccs($tipo, $campo){

            $tcc = "<table class='w3-table-all'>
                            <thead>
                              <tr class='w3-red'>
                                <th>Titulo</th>
                                <th>Código</th>
                                <th>Coleção</th>
                                <th>Condição</th>
                                <th>Autor</th>
                                <th>Disponibilidade</th>                               
                                <th>Modificar</th>
                              </tr>
                            </thead>";

            switch ($tipo) {
                case '1':
                    echo $tcc;                        
                    $comandoSQL = "SELECT A.TCC_TITULO, A.TCC_CODIGO, B.CLC_NOME, A.TCC_CONDICAO, C.USU_FIRSTNAME, A.TCC_DISPONIBILIDADE, A.ID_TCC FROM tb_tcc A INNER JOIN tb_colecao B INNER JOIN tb_usuario C ON A.COD_COLECAO = B.ID_COLECAO AND A.COD_USUARIO = C.ID_USUARIO WHERE A.TCC_CODIGO LIKE '%$campo%' ORDER BY A.ID_TCC DESC";  
                    break;

                case '2':
                    echo $tcc;                        
                    $comandoSQL = "SELECT A.TCC_TITULO, A.TCC_CODIGO, B.CLC_NOME, A.TCC_CONDICAO, C.USU_FIRSTNAME, A.TCC_DISPONIBILIDADE, A.ID_TCC FROM tb_tcc A INNER JOIN tb_colecao B INNER JOIN tb_usuario C ON A.COD_COLECAO = B.ID_COLECAO AND A.COD_USUARIO = C.ID_USUARIO WHERE A.TCC_TITULO LIKE '%$campo%' ORDER BY A.ID_TCC DESC";  
                    break;

                case '3':
                    echo $tcc;                        
                    $comandoSQL = "SELECT A.TCC_TITULO, A.TCC_CODIGO, B.CLC_NOME, A.TCC_CONDICAO, C.USU_FIRSTNAME, A.TCC_DISPONIBILIDADE, A.ID_TCC FROM tb_tcc A INNER JOIN tb_colecao B INNER JOIN tb_usuario C ON A.COD_COLECAO = B.ID_COLECAO AND A.COD_USUARIO = C.ID_USUARIO WHERE B.CLC_NOME LIKE '%$campo%' ORDER BY A.ID_TCC DESC";  
                    break;

                case '4':
                    echo $tcc;                        
                    $comandoSQL = "SELECT A.TCC_TITULO, A.TCC_CODIGO, B.CLC_NOME, A.TCC_CONDICAO, C.USU_FIRSTNAME, A.TCC_DISPONIBILIDADE, A.ID_TCC FROM tb_tcc A INNER JOIN tb_colecao B INNER JOIN tb_usuario C ON A.COD_COLECAO = B.ID_COLECAO AND A.COD_USUARIO = C.ID_USUARIO ORDER BY A.ID_TCC DESC";
                    break;
                
                default:
                    echo $tcc;                        
                    $comandoSQL = "SELECT A.TCC_TITULO, A.TCC_CODIGO, B.CLC_NOME, A.TCC_CONDICAO, C.USU_FIRSTNAME, A.TCC_DISPONIBILIDADE, A.ID_TCC FROM tb_tcc A INNER JOIN tb_colecao B INNER JOIN tb_usuario C ON A.COD_COLECAO = B.ID_COLECAO AND A.COD_USUARIO = C.ID_USUARIO ORDER BY A.ID_TCC DESC";
                    break;
            }

            $conexao = $this->conectarBancoDados();           
                //echo $comandoSQL;
                $result = mysqli_query($conexao, $comandoSQL);                            
                if(mysqli_num_rows($result) > 0)
                {                                      
                    while($buscar = $result->fetch_assoc()) {                    
                        echo "<tr>";
                        foreach ($buscar as $field => $value) {
                            if($field == "TCC_DISPONIBILIDADE"){
                                if($value == "1"){
                                    $value = "DISPONIVEL";
                                }else{
                                    $value = "INDISPONIVEL (!)";
                                }
                            }
                            $value = utf8_encode($value);                            
                                if($field == "ID_TCC"){
                                   echo "<td style='font-size: 12px;'><a href='../pagTcc.php?id=".$value."' target='_blank'>Vizualizar</a></td>";    
                                }else{
                                    echo "<td style='font-size: 12px;'>".$value."</td>";                                                                    
                                }                                          
                                                        
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                else{
                    echo "<tr>";                    
                        echo '<td> SEM RESULTADOS </td>';                
                    echo "</tr>";
                }

                $closeCon = $this->fecharConexao($conexao);                                 

        }        


        /////////////////////////// METODO PARA RETORNAR OS VALORES DO USUARIO PARA EDIÇÃO //////////////////////////
        public function buscaUsuario($id){
            $conexao = $this->conectarBancoDados();
            $comandoSQL = "SELECT B.CLSS_TIPO, A.USU_CPF, A.USU_RM, A.USU_EMAIL, A.USU_LASTNAME, A.USU_FIRSTNAME, A.USU_TELEFONE, C.CRS_NOME, A.USU_MODULO, A.USU_PERIODO, D.LG_LOGIN, D.LG_SENHA FROM tb_usuario A INNER JOIN tb_classificacao B INNER JOIN tb_curso C INNER JOIN tb_login D ON A.COD_CLASSIFICACAO = B.ID_CLASSIFICACAO AND A.COD_CURSO = C.ID_CURSO AND D.COD_USUARIO = A.ID_USUARIO WHERE A.ID_USUARIO = '$id'";
            $result = mysqli_query($conexao, $comandoSQL);

            if(mysqli_num_rows($result) > 0)
            {                
                $linha1 = "";
                while ($resultado = $result->fetch_array(MYSQLI_ASSOC))
                {   
                    $clss = $resultado['CLSS_TIPO'];
                    $cpf = $resultado['USU_CPF'];
                    $rm = $resultado['USU_RM'];
                    $email = $resultado['USU_EMAIL'];
                    $lastname = $resultado['USU_LASTNAME'];
                    $firstname = $resultado['USU_FIRSTNAME'];
                    $telefone = $resultado['USU_TELEFONE'];
                    $crs = $resultado['CRS_NOME'];
                    $modulo = $resultado['USU_MODULO'];
                    $periodo = $resultado['USU_PERIODO'];
                    $login = $resultado['LG_LOGIN'];
                    $senha = $resultado['LG_SENHA'];

                    $linha1 = $clss."/".$cpf."/".$rm."/".$email."/".$lastname."/".$firstname."/".$telefone."/".$crs."/".$modulo."/".$periodo."/".$login."/".$senha;                                                                   
                }
                return $linha1;            
            }
            else{
                return "0";
            }

            $closeCon = $this->fecharConexao($conexao);            
        }

        /////////////////////////// METODO PARA RETORNAR OS VALORES DO TCC PARA EDIÇÃO //////////////////////////
        public function buscaTcc($id){
            $conexao = $this->conectarBancoDados();
            $comandoSQL = "SELECT TCC_CODIGO, TCC_PALAVRACHAVE1, TCC_PALAVRACHAVE2, TCC_CONDICAO, TCC_DISPONIBILIDADE, TCC_TITULO, TCC_SINOPSE FROM tb_tcc WHERE ID_TCC = '$id'";
            $result = mysqli_query($conexao, $comandoSQL);

            if(mysqli_num_rows($result) > 0)
            {                
                $linha1 = "";
                while ($resultado = $result->fetch_array(MYSQLI_ASSOC))
                {   
                    $codigo = $resultado['TCC_CODIGO'];
                    $pchave1 = $resultado['TCC_PALAVRACHAVE1'];
                    $pchave2 = $resultado['TCC_PALAVRACHAVE2'];
                    $condicao = $resultado['TCC_CONDICAO'];
                    $disponibilidade = $resultado['TCC_DISPONIBILIDADE'];
                    $titulo = $resultado['TCC_TITULO'];
                    $sinopse = $resultado['TCC_SINOPSE'];

                    $linha1 = $codigo."/".$pchave1."/".$pchave2."/".$condicao."/".$disponibilidade."/".$titulo."/".$sinopse;                                                                   
                }
                return $linha1;            
            }
            else{
                return "0";
            }

            $closeCon = $this->fecharConexao($conexao);            
        }

        ////////////////////////// METODO PARA RETORNAR OS VALORES DA SUGESTAO PARA EDIÇÃO //////////////////////////
        public function buscaSg($id){
            $conexao = $this->conectarBancoDados();
            $comandoSQL = "SELECT SG_SUGESTAO FROM TB_SUGESTOES WHERE ID_SUGESTOES = '$id'";
            $result = mysqli_query($conexao, $comandoSQL);

            if(mysqli_num_rows($result) > 0)
            {                
                $linha1 = "";
                while ($resultado = $result->fetch_array(MYSQLI_ASSOC))
                {   
                    $sugestao = $resultado['SG_SUGESTAO'];                    
                    $linha1 = $sugestao;                                                                   
                }
                return $linha1;            
            }
            else{
                return "0";
            }

            $closeCon = $this->fecharConexao($conexao);            
        }

        /////////////////////////////////////////// METODO PARA CADASTRAR NO BANCO /////////////////////////////////////////////
        public function cadastrar($tipo, $valores){

            switch ($tipo) {
                case "tcc":

                    $comandoSQL = "INSERT INTO TB_TCC (COD_USUARIO, COD_COLECAO, TCC_CODIGO, TCC_PALAVRACHAVE1, TCC_PALAVRACHAVE2, 
                    TCC_CONDICAO, TCC_DISPONIBILIDADE, TCC_TITULO, TCC_SINOPSE) VALUES                
                    ('$valores[0]', '$valores[1]', '$valores[2]', '$valores[3]', '$valores[4]', '$valores[5]', '1', '$valores[6]', '$valores[7]');";
                    
                    $conexao = $this->conectarBancoDados();           
                    //echo $comandoSQL;
                    $result = mysqli_query($conexao, $comandoSQL);

                    if($result){
                        echo "<script>alert('TCC de Código: ".$valores[2]." cadastrado com sucesso!');</script>";
                    }else{
                        echo "<script>alert('Ocorreu um erro no cadastro!');</script>";
                    }

                    $closeCon = $this->fecharConexao($conexao);

                    break;

                case "usu":

                    $comandoSQL = "INSERT INTO TB_USUARIO (COD_CURSO, COD_CLASSIFICACAO, USU_CPF, USU_RM, USU_EMAIL, 
                    USU_LASTNAME, USU_FIRSTNAME, USU_TELEFONE, USU_MODULO, USU_PERIODO) VALUES                
                    ('$valores[0]', '$valores[1]', '$valores[2]', '$valores[3]', '$valores[4]', '$valores[5]', '$valores[6]', '$valores[7]', '$valores[8]', '$valores[9]');";                               


                                                            
                    $conexao = $this->conectarBancoDados();           
                    //echo $comandoSQL;
                    $result = mysqli_query($conexao, $comandoSQL);

                    $comandoSQL = "SELECT ID_USUARIO FROM tb_usuario ORDER BY ID_USUARIO DESC LIMIT 1";

                    $result1 = mysqli_query($conexao, $comandoSQL);   

                    $linha = "";
                    while ($resultado = $result1->fetch_array(MYSQLI_ASSOC))
                    {   
                        $linha =  $resultado['ID_USUARIO'];                                                                    
                    }                                  

                    $comandoSQL = "INSERT INTO TB_LOGIN(COD_USUARIO, COD_CLASSIFICACAO, LG_LOGIN, LG_SENHA) VALUES
                    ('$linha', '$valores[1]', '$valores[10]', '$valores[11]');";

                    $result2 = mysqli_query($conexao, $comandoSQL);   

                    if(($result1)&&($result2)&&($result)){
                        echo "<script>alert('Usuario de Código: ".$linha." cadastrado com sucesso!');</script>";
                    }else{
                        echo "<script>alert('Ocorreu um erro no cadastro!');</script>";
                    } 

                    $closeCon = $this->fecharConexao($conexao);                

                    break;

                case "sg":

                    $comandoSQL = "INSERT INTO TB_SUGESTOES (COD_CURSOS, SG_SUGESTAO) VALUES                
                    ('$valores[0]', '$valores[1]');";                               
                    
                    $conexao = $this->conectarBancoDados();           
                    //echo $comandoSQL;
                    $result = mysqli_query($conexao, $comandoSQL);

                    if($result){
                        echo "<script>alert('Sugestão cadastrada com sucesso!');</script>";
                    }else{
                        echo "<script>alert('Ocorreu um erro no cadastro!');</script>";
                    }

                    $closeCon = $this->fecharConexao($conexao);

                    break;

                case "res":

                    $conexao = $this->conectarBancoDados(); 

                    $comandoSQL1 = "INSERT INTO TB_RESERVAS (COD_USUARIO, COD_TCC) VALUES                
                    ('$valores[0]', '$valores[1]');";                                                                   
                    //echo $comandoSQL;
                    $result1 = mysqli_query($conexao, $comandoSQL1);

                    $comandoSQL2 = "UPDATE TB_TCC A SET A.TCC_DISPONIBILIDADE='0' WHERE A.ID_TCC='$valores[1]'";

                    $result2 = mysqli_query($conexao, $comandoSQL2);
                  


                    if(($result1)&&($result2)){
                        echo "<script>
                        alert('TCC Reservado com sucesso! Favor retirar em até 3 dias.');
                        window.location='pagTCC.php?id=".$valores[1]."';
                        </script>";
                    }else{
                        echo "<script>
                        alert('Ocorreu um erro ao tentar reservar o TCC.');
                        window.location='pagTCC.php?id=".$valores[1]."';
                        </script>";
                    }

                    $closeCon = $this->fecharConexao($conexao);

                    break;
                
                default:
                    # code...
                    break;
            }

        }

        ////////////////////////////////// METODO PARA EDITAR NO BANCO ////////////////////////////////////
        public function editar($tipo, $valores){

            switch ($tipo) {
                case "usu":
                    $comandoSQL1 = "UPDATE TB_USUARIO SET COD_CURSO='$valores[8]', COD_CLASSIFICACAO='$valores[1]', USU_CPF='$valores[2]', USU_RM='$valores[3]', USU_EMAIL='$valores[4]', USU_LASTNAME='$valores[5]', USU_FIRSTNAME='$valores[6]', USU_TELEFONE='$valores[7]', USU_MODULO='$valores[9]', USU_PERIODO='$valores[10]' WHERE TB_USUARIO.ID_USUARIO='$valores[0]'";

                                                        
                    $conexao = $this->conectarBancoDados();           
                    //echo $comandoSQL;
                    $result1 = mysqli_query($conexao, $comandoSQL1);                                            

                    $comandoSQL2 = "UPDATE TB_LOGIN SET COD_USUARIO='$valores[0]', COD_CLASSIFICACAO='$valores[1]', LG_LOGIN='$valores[11]', LG_SENHA='$valores[12]' WHERE TB_LOGIN.ID_LOGIN='$valores[0]'";

                    $result2 = mysqli_query($conexao, $comandoSQL2);   

                    $closeCon = $this->fecharConexao($conexao);

                    if(($result1)&&($result2)){
                        echo "<script>
                        alert('Usuario de Código: ".$valores[0]." editado com sucesso!');
                        window.location='editarUsu.php?id=".$valores[0]."&edit=0';
                        </script>";                      
                    }else{
                        echo "<script>
                        alert('ERRO! Não foi possivel editar o usuario.');
                        window.location='editarUsu.php?id=".$valores[0]."&edit=0';
                        </script>";
                    }                    
                    

                    //$id0, $classificacao1, $cpf2, $rm3, $email4, $ultimoNome5, $primeiroNome6, $telefone7, $curso8, $modulo9, $periodo10, $login11, $senha12                                
                    break; 

                case "tcc":
                    $comandoSQL1 = "UPDATE TB_TCC SET COD_USUARIO='$valores[1]', COD_COLECAO='$valores[2]', TCC_CODIGO='$valores[3]', TCC_PALAVRACHAVE1='$valores[4]', TCC_PALAVRACHAVE2='$valores[5]', TCC_CONDICAO='$valores[6]', TCC_DISPONIBILIDADE='$valores[7]', TCC_TITULO='$valores[8]', TCC_SINOPSE='$valores[9]' WHERE TB_TCC.ID_TCC='$valores[0]'";

                                                        
                    $conexao = $this->conectarBancoDados();           
                    //echo $comandoSQL;
                    $result = mysqli_query($conexao, $comandoSQL1);                                            
                    
                    $closeCon = $this->fecharConexao($conexao);

                    if($result){
                        echo "<script>
                        alert('TCC de Código: ".$valores[0]." editado com sucesso!');
                        window.location='editarTcc.php?id=".$valores[0]."&edit=0';
                        </script>";                      
                    }else{
                        echo "<script>
                        alert('ERRO! Não foi possivel editar o TCC.');
                        window.location='editarTcc.php?id=".$valores[0]."&edit=0';
                        </script>";
                    }                    
                    

                    //$id0, $codusu1, $codcolecao2, $TCCCODIGO3, $PCHAVE14, $PCHAVE25, $condicao6, $disponibilidade7, $titulo8, $sinopse9                                
                    break;

                case "sg":
                    $valores[2] = utf8_decode($valores[2]);
                    $comandoSQL1 = "UPDATE TB_SUGESTOES A SET A.COD_CURSOS='$valores[1]', A.SG_SUGESTAO='$valores[2]' WHERE A.ID_SUGESTOES='$valores[0]'";

                                                        
                    $conexao = $this->conectarBancoDados();           
                    //echo $comandoSQL;
                    $result = mysqli_query($conexao, $comandoSQL1);                                            
                    
                    $closeCon = $this->fecharConexao($conexao);

                    if($result){
                        echo "<script>
                        alert('Sugestão editada com sucesso!');
                        window.location='editarSug.php?id=".$valores[0]."&edit=0';
                        </script>";                      
                    }else{
                        echo "<script>
                        alert('ERRO! Não foi possivel editar a sugestão!.');
                        window.location='editarSug.php?id=".$valores[0]."&edit=0';
                        </script>";
                    }    
                
                default:
                    # code...
                    break;
            }                
                        
        }


        ////////////////////////////////////// METODO PARA EXCLUIR UM DADO NO BANCO ///////////////////////////////              
        public function excluir($tipo, $id){

            switch ($tipo) {
                case "usu":
                    $conexao = $this->conectarBancoDados();

                    $comandoSQL0 = "SELECT COD_USUARIO, COD_CLASSIFICACAO, LG_LOGIN, LG_SENHA FROM TB_LOGIN WHERE COD_USUARIO = '$id'";
                    $result0 = mysqli_query($conexao, $comandoSQL0);

                    if(mysqli_num_rows($result0) > 0)
                    {                                        
                        while ($resultado = $result0->fetch_array(MYSQLI_ASSOC))
                        {   
                            $login[0] = $resultado['COD_USUARIO'];
                            $login[1] = $resultado['COD_CLASSIFICACAO'];
                            $login[2] = $resultado['LG_LOGIN'];
                            $login[3] = $resultado['LG_SENHA'];
                        }
                                    
                    }
                    else{
                        exit();
                    }


                    $comandoSQL1 = "DELETE FROM tb_login WHERE COD_USUARIO = '$id'";                                    
                    $result1 = mysqli_query($conexao, $comandoSQL1);

                    if($result1){
                        $comandoSQL2 = "DELETE FROM tb_usuario WHERE ID_USUARIO = '$id'";  
                        $result2 = mysqli_query($conexao, $comandoSQL2);

                        if(($result1)&&($result2)){
                            echo "<script>
                            alert('Usuario de ID: ".$id." excluido com sucesso!');
                            window.location='pesquisa.php';
                            </script>";
                        }else{
                            $comandoSQL3 = "INSERT INTO TB_LOGIN(COD_USUARIO, COD_CLASSIFICACAO, LG_LOGIN, LG_SENHA) VALUES
                            ('$login[0]', '$login[1]', '$login[2]', '$login[3]');";  
                            $result3 = mysqli_query($conexao, $comandoSQL3);

                            echo "<script>
                            alert('ERRO! Não foi possivel excluir o usuario! Possivel vinculamento.');
                            window.location='editarUsu.php?id=".$id."&edit=0';
                            </script>";
                        }   
                    }else{
                        echo "<script>
                        alert('ERRO! Não foi possivel excluir o usuario!');
                         window.location='editarUsu.php?id=".$id."&edit=0';
                        </script>";
                    }                            

                    $closeCon = $this->fecharConexao($conexao); 
                             
                    break;

                case "tcc":
                    $conexao = $this->conectarBancoDados();
                    $comandoSQL1 = "DELETE FROM tb_tcc WHERE ID_TCC = '$id'";
                    $result1 = mysqli_query($conexao, $comandoSQL1);

                    if($result1){
                        echo "<script>
                        alert('TCC excluido com sucesso!');
                        window.location='pesquisa.php';
                        </script>";
                    }else{
                        echo "<script>
                        alert('ERRO! Não foi possivel excluir o TCC.');
                        window.location='editarTcc.php?id=".$id."&edit=0';
                        </script>";
                    }                

                    $closeCon = $this->fecharConexao($conexao); 
                             
                    break;

                case "sg":
                    $conexao = $this->conectarBancoDados();
                    $comandoSQL1 = "DELETE FROM TB_SUGESTOES WHERE ID_SUGESTOES = '$id'";
                    $result1 = mysqli_query($conexao, $comandoSQL1);

                    if($result1){
                        echo "<script>
                        alert('Sugestão excluida com sucesso!');
                        window.location='pesquisa.php';
                        </script>";
                    }else{
                        echo "<script>
                        alert('ERRO! Não foi possivel excluir a sugestão.');
                        window.location='editarSug.php?id=".$id."&edit=0';
                        </script>";
                    }                

                    $closeCon = $this->fecharConexao($conexao); 
                             
                    break;
                
                default:
                    # code...
                    break;
            }                                
        }


        ///////////////////////////////////////// FUNÇÃO PARA EXIBIR AS SUGUESTOES ////////////////////////////
        function exibirSugestoes(){
            $nCurso = 0;
            $nSus = 0;
            $conexao = $this->conectarBancoDados();
            //$comandoSQL = "SELECT A.CRS_NOME, B.SG_SUGESTAO FROM TB_CURSO A INNER JOIN TB_SUGESTOES B WHERE B.COD_CURSOS = A.ID_CURSO";
            $comandoSQL = "SELECT A.CRS_NOME, A.ID_CURSO FROM TB_CURSO A";
            $result = mysqli_query($conexao, $comandoSQL);                                

            if(mysqli_num_rows($result) > 0)
            {                                               

                while($buscar = $result->fetch_array(MYSQLI_ASSOC)) {                                                    

                   $curso = utf8_encode($buscar["CRS_NOME"]);
                   $idCurso = $buscar["ID_CURSO"];

                   if (!isset($theme)) $theme = "w3-theme-cinza";
                   if($theme == "w3-theme-cinza"){
                        $theme = "w3-theme-btcc";
                   }else{
                        $theme = "w3-theme-cinza";
                   }

                   echo "
                    <div class='w3-container'>
         
                    <table class='w3-table w3-bordered w3-hoverable w3-table-all'>

                   <tr><thead>
                    <th class='".$theme." w3-center' >".$curso."</th>
                   </thead></tr>";

                   $comandoSQL1 = "SELECT A.SG_SUGESTAO FROM TB_SUGESTOES A WHERE A.COD_CURSOS = '$idCurso'";
                   $result1 = mysqli_query($conexao, $comandoSQL1);

                    if(mysqli_num_rows($result1) > 0)
                    {

                      while($buscar = $result1->fetch_array(MYSQLI_ASSOC)) {

                        $sugestao = utf8_encode($buscar["SG_SUGESTAO"]);

                        echo "<tr><td>".$sugestao."</td></tr>";

                      }

                    }

                    echo "
                        </table>
                    </div><br><br>
                    ";
                    
                }              
                
            }
            else{
                echo "<tr>";                    
                    echo '<td> SEM RESULTADOS </td>';                
                echo "</tr>";
            }                    

        }



        //////////////////////////////////////////////// METODOS GET AND SET ////////////////////////////////////////////////

        //////////////////////////////////////////////// USUARIO ////////////////////////////////////////////////
        public function setUsuario($newUsuario)
        {
            $this->usuario = $newUsuario;
        }       
        public function getUsuario()
        {
            return $this->usuario;
        }        
        //SENHA
        public function setSenha($newSenha)
        {
            $this->senha = $newSenha;
        }       
        public function getSenha()
        {
            return $this->senha;
        }        
        //BANCO
        public function setBanco($newBanco)
        {
            $this->banco = $newBanco;
        }       
        public function getBanco()
        {
            return $this->banco;
        }    
        //HOST
        public function setHost($newHost)
        {
            $this->host = $newHost;
        }       
        public function getHost()
        {
            return $this->host;
        }            
    }