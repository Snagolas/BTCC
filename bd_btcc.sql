CREATE DATABASE BD_BTCC;

USE BD_BTCC;

/*CRIANDO A TABELA CURSOS */
CREATE TABLE TB_CURSO
(
	ID_CURSO INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	CRS_NOME VARCHAR(50) NOT NULL 
)ENGINE=INNODB;

/*CRIANDO A TABELA COLECAO */
CREATE TABLE TB_COLECAO
(
	ID_COLECAO INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	CLC_NOME VARCHAR(50) NOT NULL
)ENGINE=INNODB;

/*CRIANDO A TABELA CO */
CREATE TABLE TB_CLASSIFICACAO
(
	ID_CLASSIFICACAO INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	CLSS_TIPO VARCHAR(50) NOT NULL
)ENGINE=INNODB;

/*CRIANDO A TABELA USUÁRIO */
CREATE TABLE TB_USUARIO
(
	ID_USUARIO INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	COD_CURSO INT NOT NULL,
	COD_CLASSIFICACAO INT NOT NULL,
	USU_CPF VARCHAR(50) NOT NULL, 
	USU_RM VARCHAR(50) NOT NULL, 
	USU_EMAIL VARCHAR(50) NOT NULL,
	USU_LASTNAME VARCHAR(50) NOT NULL,
	USU_FIRSTNAME VARCHAR(50) NOT NULL,
	USU_TELEFONE VARCHAR(50) NOT NULL,
	USU_MODULO VARCHAR(50) NOT NULL,
	USU_PERIODO VARCHAR(50) NOT NULL,
	CONSTRAINT FOREIGN KEY (COD_CLASSIFICACAO) REFERENCES TB_CLASSIFICACAO(ID_CLASSIFICACAO),
	CONSTRAINT FOREIGN KEY (COD_CURSO) REFERENCES TB_CURSO(ID_CURSO)
)ENGINE=INNODB;

/*CRIANDO A TABELA TCC */
CREATE TABLE TB_TCC
(
	ID_TCC INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	COD_USUARIO INT NOT NULL,
	COD_COLECAO INT NOT NULL,
	TCC_CODIGO VARCHAR(50) NOT NULL,
	TCC_PALAVRACHAVE1 VARCHAR(50) NOT NULL,
	TCC_PALAVRACHAVE2 VARCHAR(50) NOT NULL,
	TCC_CONDICAO VARCHAR(50) NOT NULL,
	TCC_DISPONIBILIDADE BOOLEAN NOT NULL,
	TCC_TITULO VARCHAR(50) NOT NULL,
	TCC_SINOPSE TEXT(500) NOT NULL,
	CONSTRAINT FOREIGN KEY (COD_USUARIO) REFERENCES TB_USUARIO(ID_USUARIO),
	CONSTRAINT FOREIGN KEY (COD_COLECAO) REFERENCES TB_COLECAO(ID_COLECAO)
)ENGINE=INNODB;

/*CRIANDO A TABELA DE RESERVAS */
CREATE TABLE TB_RESERVAS
(
	ID_RESERVA INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	COD_USUARIO INT NOT NULL,
	COD_TCC INT NOT NULL,
	CONSTRAINT FOREIGN KEY (COD_USUARIO) REFERENCES TB_USUARIO(ID_USUARIO),
	CONSTRAINT FOREIGN KEY (COD_TCC) REFERENCES TB_TCC(ID_TCC)
)ENGINE=INNODB;

/*CRIANDO A TABELA DEVOLUCAO */
CREATE TABLE TB_DEVOLUCAO
(
	ID_DEVOLUCAO INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	COD_USUARIO INT NOT NULL,
	COD_TCC INT NOT NULL,
	DATA_DEVOLUCAO VARCHAR(50) NOT NULL,
	CONSTRAINT FOREIGN KEY (COD_USUARIO) REFERENCES TB_USUARIO(ID_USUARIO),
	CONSTRAINT FOREIGN KEY (COD_TCC) REFERENCES TB_TCC(ID_TCC)
)ENGINE=INNODB;

/*CRIANDO A TABELA LOGIN */
CREATE TABLE TB_LOGIN
(
	ID_LOGIN INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	COD_USUARIO INT NOT NULL,	
	COD_CLASSIFICACAO INT NOT NULL,
	LG_LOGIN VARCHAR(50) NOT NULL, 
	LG_SENHA VARCHAR(50) NOT NULL,
	CONSTRAINT FOREIGN KEY (COD_USUARIO) REFERENCES TB_USUARIO(ID_USUARIO)	
)ENGINE=INNODB;

/*CRIANDO A TABELA SUGESTOES */
CREATE TABLE TB_SUGESTOES
(
	ID_SUGESTOES INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	COD_CURSOS INT NOT NULL,		
	SG_SUGESTAO TEXT(500) NOT NULL 		
)ENGINE=INNODB;

/*FIM */


/*SESSÃO DE INSERTS -------------------------------------------------------*/
INSERT INTO TB_CURSO (ID_CURSO, CRS_NOME) VALUES
(1, "Administração"), (2, "Contabilidade"), (3, "Edificações"),
(4, "Enfermagem"), (5, "Eletrônica"), (6, "Eletrotécnica"), 
(7, "Informática"), (8, "Mecatrônica"), (9, "Recursos Humanos"),
 (11, "Vestuário"), (12, "Prótese Dentária"), (13, "ADMIN PROF");

INSERT INTO TB_COLECAO (ID_COLECAO, CLC_NOME) VALUES
(1, "Monografia"), (2, "Trabalhos"), (3, "Biografia"), 
(4, "Artigo"), (5, "Revista");

INSERT INTO TB_CLASSIFICACAO (ID_CLASSIFICACAO, CLSS_TIPO) VALUES
(1, "PROFESSOR"), (2, "ALUNO"), (3, "ADMIN");

INSERT INTO TB_USUARIO (ID_USUARIO, COD_CURSO, COD_CLASSIFICACAO, USU_CPF, USU_RM, USU_EMAIL, 
USU_LASTNAME, USU_FIRSTNAME, USU_TELEFONE, USU_MODULO, USU_PERIODO) VALUES
/*ALUNOS*/
(1, 7, 2, "111.111.111-11", "11111", "jessica@hotmail.com", "Silva", 	"Jessica", 	"(77) 7777-7777", "3 MODULO", "NOITE"),
(2, 7, 2, "222.222.222-22", "22222", "joao@gmail.com", 		"Gabriel", 	"João", 	"(17) 3242-6351", "3 MODULO", "NOITE"),
(3, 7, 2, "333.333.333-33", "33333", "gilvan@live.com", 	"Ribeiro", 	"Gilvan", 	"(17) 3253-1820", "3 MODULO", "NOITE"),
(4, 7, 2, "444.444.444-44", "44444", "carlin@outlook.com", 	"Vinicius", "Carlos", 	"(17) 3662-5547", "3 MODULO", "NOITE"),
(5, 7, 2, "555.555.555-55", "55555", "henrique@live.com", 	"Martinez", "Henrique", "(18) 5512-5231", "3 MODULO", "NOITE"),
/*PROFESSORES*/	
(6, 13, 1, "888.888.888-88", 	"0", "humberto@live.com", 	"Cecconi", 	"Humberto", "(78) 8888-8888", "0", "0"),
(7, 13, 1, "999.999.999-99", 	"0", "aline@hotmail.com", 	"Schmitd", 	"Aline", 	"(17) 9999-9999", "0", "0"),
(8, 13, 1, "777.777.777-77", 	"0", "rosana@gmail.com", 	"Regia", 	"Rosana", 	"(17) 1111-1111", "0", "0"),
(9, 13, 1, "548-548-548-44", 	"0", "fabiana@hotmail.com", "Pontes", 	"Fabiana", 	"(99) 2222-2222", "0", "0"),
(10, 13, 1, "487.487.487-48", 	"0", "alexei@live.com", 	"Bueno", 	"Alexei", 	"(14) 1245-1245", "0", "0"),
/*FUNCIONARIOS*/
(11, 13, 3, "698.698.698-69", 	"0", "pedro@hotmail.com", 	"Godoi", 	"Pedro", 	"(12)3652-2563",  "0", 	"NOITE");



INSERT INTO TB_TCC (	ID_TCC, COD_USUARIO, COD_COLECAO, TCC_CODIGO, TCC_PALAVRACHAVE1, TCC_PALAVRACHAVE2, TCC_CONDICAO, TCC_DISPONIBILIDADE, 
						TCC_TITULO, TCC_SINOPSE) VALUES
(1, 3, 4, "11111111", "BTCC", "BTCC", "MB", 			TRUE,	"BTCC", "Sed at nisi quis lacus tempor tempor. Vestibulum mattis mi orci, vel pulvinar nisl rutrum quis. Vestibulum a euismod erat. Sed non mi commodo, cursus tortor sed, venenatis odio. Suspendisse elementum vulputate mattis. Integer eu lectus varius, fermentum nisi et, volutpat magna. Aliquam maximus purus cursus rhoncus egestas. Ut porttitor dui aliquet urna ultricies, a varius augue varius. Aliquam libero quam, interdum at nisi eu, pharetra condimentum ante.1 "),
(2, 2, 4, "22222222", "Catedral", "SysCare", "MB", 			TRUE,	"Catedral SysCare", "Sed at nisi quis lacus tempor tempor. Vestibulum mattis mi orci, vel pulvinar nisl rutrum quis. Vestibulum a euismod erat. Sed non mi commodo, cursus tortor sed, venenatis odio. Suspendisse elementum vulputate mattis. Integer eu lectus varius, fermentum nisi et, volutpat magna. Aliquam maximus purus cursus rhoncus egestas. Ut porttitor dui aliquet urna ultricies, a varius augue varius. Aliquam libero quam, interdum at nisi eu, pharetra condimentum ante.2 "),
(3, 3, 4, "33333333", "Eco", "Trilha", "MB", 			TRUE,	"Eco Trilha", "Sed at nisi quis lacus tempor tempor. Vestibulum mattis mi orci, vel pulvinar nisl rutrum quis. Vestibulum a euismod erat. Sed non mi commodo, cursus tortor sed, venenatis odio. Suspendisse elementum vulputate mattis. Integer eu lectus varius, fermentum nisi et, volutpat magna. Aliquam maximus purus cursus rhoncus egestas. Ut porttitor dui aliquet urna ultricies, a varius augue varius. Aliquam libero quam, interdum at nisi eu, pharetra condimentum ante.3 "),
(4, 4, 4, "44444444", "Bicho", "Sapeca", "MB", 			TRUE,	"Bicho Sapeca", "Sed at nisi quis lacus tempor tempor. Vestibulum mattis mi orci, vel pulvinar nisl rutrum quis. Vestibulum a euismod erat. Sed non mi commodo, cursus tortor sed, venenatis odio. Suspendisse elementum vulputate mattis. Integer eu lectus varius, fermentum nisi et, volutpat magna. Aliquam maximus purus cursus rhoncus egestas. Ut porttitor dui aliquet urna ultricies, a varius augue varius. Aliquam libero quam, interdum at nisi eu, pharetra condimentum ante.4 "),
(5, 5, 4, "55555555", "Save", "MyLink", "MB", 	TRUE,	"Save MyLink", "Sed at nisi quis lacus tempor tempor. Vestibulum mattis mi orci, vel pulvinar nisl rutrum quis. Vestibulum a euismod erat. Sed non mi commodo, cursus tortor sed, venenatis odio. Suspendisse elementum vulputate mattis. Integer eu lectus varius, fermentum nisi et, volutpat magna. Aliquam maximus purus cursus rhoncus egestas. Ut porttitor dui aliquet urna ultricies, a varius augue varius. Aliquam libero quam, interdum at nisi eu, pharetra condimentum ante.5 ");

INSERT INTO TB_RESERVAS (ID_RESERVA, COD_USUARIO, COD_TCC) VALUES
(1, 1, 1);

INSERT INTO TB_DEVOLUCAO(ID_DEVOLUCAO, COD_USUARIO, COD_TCC, DATA_DEVOLUCAO) VALUES
(1, 1, 1, "1/12"), (2, 2, 2, "30/11"), (3, 3, 3, "30/11"), (4, 4, 4, "2/12");

INSERT INTO TB_LOGIN(ID_LOGIN, COD_USUARIO, COD_CLASSIFICACAO, LG_LOGIN, LG_SENHA) VALUES
(1, 1, 2, "jessica", "jessica"), 
(2, 2, 2, "joao", "joao"), 
(3, 3, 2, "gilvan", "gilvan"),
(4, 4, 2, "carlos", "carlos"),
(5, 5, 2, "henrique", "henrique"),
(6, 6, 1, "humberto", "humberto"),
(7, 7, 1, "aline", "aline"),
(8, 8, 1, "rosana", "rosana"),
(9, 9, 1, "fabiana", "fabiana"),
(10, 10, 1, "alexei", "alexei"), 
(11, 11, 3, "admin", "admin");

INSERT INTO TB_SUGESTOES(ID_SUGESTOES, COD_CURSOS, SG_SUGESTAO) VALUES
(1, 1, "Gestão de RH nas pequenas empresas"),
(2, 1, "As mulheres e o mercado de trabalho"),
(3, 1, "A importância da tecnologia da informação nas tomadas de decisões"),
(4, 2, "Contabilidade Pública"),
(5, 2, "Investimento Permanente em Coligada ou Controlada com Patrimônio Líquido Negativo"),
(6, 2, "Contabilidade e o Controle de Custos"),
(7, 3, "Casas ecológicas"),
(8, 3, "O estudo de viabilidade econômica para a implantação de um complexo esportivo"),
(9, 3, "Concreto reciclado"),
(10, 3, "A valorização da mão de obra"),
(11, 4, "Depressão pós-parto - fatores influentes no quadro psicológico"),
(12, 4, "A importância da manutenção dos equipamentos médicos-hospitalares"),
(13, 5, "Técnicas de redução de Fator de crista aplicações sem sistema de comunicação sem fio"),
(14, 5, "Projeto de amplificador de potência em tecnoligia cmos"),
(15, 5, "Projeto de circuitos RF para aplicações de telefonia 5G"), 
(16, 6, "Desenvolvimento de drivers para leds com controle de luminosidade (dimerização)"),
(17, 6, "Conversores cc-cc operando em alta frequência"),
(18, 7, "Software Saude e Academia (onde medicos podem acompanhar os Pacientes seus desenvolvimentos e os Personais)"),
(19, 8, "Sistema de captalizaçao e reutilização da agua da chuva"),
(20, 9, "Consultoria organizacional em micro e pequenas empresas"),
(21, 9, "Estudo da Responsabilidade Social na empresa"),
(22, 10, "Closet"),
(23, 11, "Prótese fixa com diferentes tipos de encaixe");


