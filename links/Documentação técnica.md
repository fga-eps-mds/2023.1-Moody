## Visão geral do projeto: 
    
O projeto MOODY é um software desenvolvido para auxiliar os professores na 
plataforma Moodle, em particular na plataforma Aprender 3 da UnB. O objetivo 
principal do MOODY é fornecer aos professores informações abrangentes e 
detalhadas sobre o desempenho dos alunos em suas turmas, facilitando a análise 
e o monitoramento individual de cada aluno.

## Propósito

O propósito do software é resolver o desafio enfrentado pelos professores ao 
acompanhar o progresso e o engajamento dos alunos em um ambiente virtual de 
aprendizagem. Com o MOODY, os professores podem coletar e registrar dados 
importantes, como notas de avaliações, quantidade de atividades realizadas, 
aulas assistidas e outros indicadores relevantes.

## Escorpo

O escopo do software abrange desde a coleta de dados até a apresentação e análise 
dessas informações de forma clara e acessível. Os dados são armazenados e 
organizados em uma planilha, permitindo que os professores visualizem o desempenho
individual de cada aluno, monitorem o progresso ao longo do tempo e identifiquem 
áreas em que os alunos possam precisar de mais apoio.

## As principais funcionalidades do MOODY:

•Coleta de dados: O software coleta informações relevantes, como notas de 
avaliações, quantidade de atividades realizadas, aulas assistidas e outros 
dados relevantes para cada aluno.

•Armazenamento e organização de dados: Os dados coletados são armazenados e 
organizados em uma planilha, permitindo um acesso fácil e estruturado.

•Visualização de dados: Os professores podem visualizar os dados coletados de 
forma clara e compreensível, utilizando gráficos, tabelas e outros recursos 
visuais para facilitar a interpretação e análise.

•Monitoramento do progresso individual: O MOODY permite que os professores 
monitorem o progresso de cada aluno individualmente, identificando áreas de 
melhoria e oferecendo suporte personalizado, se necessário.

•Exportação de dados: Os dados podem ser exportados para arquivos do Google 
Sheets ou Excel, permitindo que os professores compartilhem facilmente as 
informações com outros professores ou a coordenação.

Essas funcionalidades combinadas ajudam os professores a entender melhor o 
desempenho dos alunos, identificar padrões, fornecer feedback individualizado e 
tomar decisões informadas para melhorar a experiência de aprendizagem.

Em resumo, o MOODY visa resolver o problema de acompanhamento e análise do 
progresso dos alunos em um ambiente virtual de aprendizagem, fornecendo aos 
professores as ferramentas necessárias para avaliar, monitorar e apoiar 
individualmente cada aluno em sua turma.

## Design

A escolha inicial do Moody teve com principal inspiração a página do aprender 3,
onde as tonalidades e esquemas visuais seriam feitos de acordo com a estética da 
plataforma.Todavia, o grupo teve que reajustar seus processos de escolha de 
design, uma vez que os planos de funcionalidade e estética do Moody não seriam 
usados diretamente na plataforma do Aprender 3 e sim para a plataforma Moodle. 
Desse modo, e seguindo os conselhos da professora e monitores, a equipe de design
optou por uma abordagem mais minimalista e de fácil interação, o que resultou na 
simples apresentação de um botão dentro de um folder. Vale ressaltar que as cores 
escolhidas pela equipe tem como objetivo não destoar da paleta de cores da 
plataforma, nesse caso branco e azul, além do design de apenas dois botões para 
ser de fácil acesso. O botão estatísticas que irá levar o usuário para uma 
planilha e o botão sobre que irá levar o usuário para a página que irá explicar 
para o usuário como funciona o Moody.

## Arquitetura

A arquitetura em camadas divide um sistema em camadas distintas, cada uma com uma 
responsabilidade específica e bem definida. 
Cada camada se comunica apenas com as camadas adjacentes por meio de interfaces bem definidas.
Dessa forma, ajuda a tornar o sistema escalável, modular e fácil de manter e atualizar.
    
Camada de Dados:

O MOODY utiliza um banco de dados para armazenar os dados coletados, como notas de 
avaliações, atividades realizadas, aulas assistidas, informações de alunos e outras 
informações relevantes.
É utilizado um banco de dados relacional, o MySQL.

Camada de Backend:

O MOODY tem uma camada de backend responsável pela lógica de negócios 
e pela interação com o banco de dados.
Essa camada é desenvolvida utilizando PHP.
A camada de backend seria responsável por receber as solicitações dos usuários, 
processar as informações, realizar operações no banco de dados e fornecer as respostas 
necessárias.

Camada de Frontend:

O MOODY tem uma camada de frontend que permite aos usuários (professores) 
interagir com o sistema e visualizar os dados coletados.
A camada de frontend foi implementada utilizando tecnologias web, como HTML, CSS e 
JavaScript para facilitar o desenvolvimento da interface do usuário.

Integração com Planilha:

O MOODY tem a capacidade de transferir os dados analisados para uma planilha do Google 
Sheets ou Excel.
Para isso, o MOODY utiliza uma integração com a API do Google Sheets e Excel 
para exportar os dados coletados e disponibilizá-los em um formato adequado para análise posterior.







